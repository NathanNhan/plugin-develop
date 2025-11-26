<?php 

if ( ! class_exists( 'mpd_plugin' ) ) {
    class mpd_plugin {
        public function __construct()
        {
            add_action('admin_menu', array($this,'my_plugin_dev_add_admin_menu'));
            add_action('init', array($this,'register_project_post_type'));
            add_action( 'wp_enqueue_scripts', array($this,'load_assets'));
            $this->load_dependencies();

        }

        private function load_dependencies() {
            require_once MPD_PLUGIN_DIR_PATH . "/inc/taxonomy.php";
            require_once MPD_PLUGIN_DIR_PATH . "/inc/metabox.php";
            require_once MPD_PLUGIN_DIR_PATH . "/inc/shortcode.php";
            require_once MPD_PLUGIN_DIR_PATH . "/inc/page-option.php";
            require_once MPD_PLUGIN_DIR_PATH . "/inc/settings-field.php";
            require_once MPD_PLUGIN_DIR_PATH . "/inc/db.php";
        }

        public function load_assets() {
            wp_enqueue_style( 'my-public-css',MPD_PLUGIN_DIR_URL . '/public/css/style.css' , [], '1.0.0', 'all' );
            wp_enqueue_script( 'index-js', MPD_PLUGIN_DIR_URL . '/public/js/index.js' , [], '1.0.0', true );
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
                    'name'                  => _x('projects', 'Post Type General Name', 'text-domain'),
                    'singular_name'         => _x('project', 'Post Type Singular Name', 'text-domain'),
                    'menu_name'            => __('projects', 'text-domain'),
                    'all_items'            => __('All projects', 'text-domain'),
                    'add_new_item'         => __('Add New project', 'text-domain'),
                    'add_new'              => __('Add New', 'text-domain'),
                    'edit_item'            => __('Edit project', 'text-domain'),
                    'update_item'          => __('Update project', 'text-domain'),
                    'search_items'         => __('Search project', 'text-domain'),
                );

                $args = array(
                    'label'                 => __('project', 'text-domain'),
                    'labels'                => $labels,
                    'supports'              => ["title","editor","thumbnail","excerpt"],
                    'hierarchical'          => true,
                    'public'                => true,
                    'show_ui'               => true,
                    'show_in_menu'          => true,
                    'menu_icon'             => 'dashicons-index-card',
                    'show_in_admin_bar'     => true,
                    'show_in_nav_menus'     => true,
                    'can_export'            => true,
                    'has_archive'           => true,
                    'exclude_from_search'   => false,
                    'publicly_queryable'    => true,
                    'capability_type'       => 'post',
                );

                register_post_type('project', $args);
        }

    }

    new mpd_plugin();

    
}