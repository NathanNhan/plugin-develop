<?php 

if ( ! class_exists( 'mpd_plugin' ) ) {
    class mpd_plugin {

        public static function mpd_install() {

            global $wpdb;

            $charset_collate = $wpdb->get_charset_collate();
            $table_name = $wpdb->prefix . 'post_vote';

            $sql = "CREATE TABLE {$table_name} (
                id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                post_id BIGINT(20) UNSIGNED NOT NULL,
                user_id BIGINT(20) UNSIGNED NOT NULL,
                vote_type VARCHAR(50) NOT NULL,
                voted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY  (id),
                KEY post_id (post_id),
                KEY user_id (user_id),
                KEY voted_at (voted_at)
            ) {$charset_collate};";

            // FIX QUAN TRỌNG
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            add_option( "mpd_db_version", "1.0" );
        }

        public function __construct() {
            add_action('admin_menu', array($this,'my_plugin_dev_add_admin_menu'));
            add_action('init', array($this,'register_project_post_type'));
            add_action( 'wp_enqueue_scripts', array($this,'load_assets') );
            add_action('wp_ajax_mpd_post_voting', array($this, 'mpd_vote_post'));
            $this->load_dependencies();
        }

        private function load_dependencies() {
            require_once MPD_PLUGIN_DIR_PATH . "inc/taxonomy.php";
            require_once MPD_PLUGIN_DIR_PATH . "inc/metabox.php";
            require_once MPD_PLUGIN_DIR_PATH . "inc/shortcode.php";
            require_once MPD_PLUGIN_DIR_PATH . "inc/page-option.php";
            require_once MPD_PLUGIN_DIR_PATH . "inc/settings-field.php";
        }

        public function load_assets() {

            wp_enqueue_style( 'my-public-css', MPD_PLUGIN_DIR_URL . '/public/css/style.css', [], '1.0.0', 'all' );

            wp_enqueue_script( 'vote-js', MPD_PLUGIN_DIR_URL . '/public/js/ajax.js', ['jquery'], '1.1.0', true );

            // FIX handle script
            wp_localize_script(
                'vote-js',
                'mpd_ajax',
                [
                    'ajax_url' => admin_url('admin-ajax.php'),
                ]
            );
        }

        public function my_plugin_dev_add_admin_menu() {
            add_menu_page(
                __('My plugin Dev', 'text-domain'),
                __('My Plugin Dev', 'text-domain'),
                'manage_options',
                'my_plugin_dev-settings',
                'my_plugin_dev_options_page',
                'dashicons-superhero',
                80
            );
        }

        public function register_project_post_type() {
            $labels = array(
                'name'          => _x('projects', 'Post Type General Name', 'text-domain'),
                'singular_name' => _x('project', 'Post Type Singular Name', 'text-domain'),
            );

            $args = array(
                'label'         => __('project', 'text-domain'),
                'labels'        => $labels,
                'supports'      => ["title","editor","thumbnail","excerpt"],
                'public'        => true,
                'has_archive'   => true,
            );

            register_post_type('project', $args);
        }

        public function mpd_vote_post() {
            global $wpdb;

            $table_votes = $wpdb->prefix . 'post_vote';

            $post_id = intval($_POST['pid']);
            $user_id = intval($_POST['uid']);

            if (!empty($post_id) && !empty($user_id)) {

                $query = $wpdb->insert(
                    $table_votes, 
                    [
                        'post_id' => $post_id,
                        'user_id' => $user_id,
                        'vote_type' => 'like'
                    ],
                    ['%d','%d','%s']
                );

                if ($query) {
                    wp_send_json_success(['message' => 'Vote success!']);
                } else {
                    $error = $wpdb->last_error;

                    wp_send_json_error([
                        'message' => 'Insert failed',
                        'error'   => $error,
                        'sql'     => $wpdb->last_query
                    ]);
                }
            }
        }
    }

    new mpd_plugin();

    
}
