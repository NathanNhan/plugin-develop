<?php
// Register Custom Post Type
function register_project_post_type() {
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
add_action('init', 'register_project_post_type', 0);






// Register Custom Taxonomy
function register_project_industries_taxonomy() {
    $labels = array(
        'name'                       => _x('Industries', 'Taxonomy General Name', 'text-domain'),
        'singular_name'              => _x('Industries', 'Taxonomy Singular Name', 'text-domain'),
        'menu_name'                  => __('Industries', 'text-domain'),
        'all_items'                  => __('All Industries', 'text-domain'),
        'parent_item'                => __('Parent Industries', 'text-domain'),
        'parent_item_colon'          => __('Parent Industries:', 'text-domain'),
        'new_item_name'              => __('New Industries Name', 'text-domain'),
        'add_new_item'               => __('Add New Industries', 'text-domain'),
        'edit_item'                  => __('Edit Industries', 'text-domain'),
        'update_item'                => __('Update Industries', 'text-domain'),
        'view_item'                  => __('View Industries', 'text-domain'),
        'search_items'               => __('Search Industries', 'text-domain'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'publicly_queryable'         => true,
        'show_ui'                    => true,
        'show_in_menu'               => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,
        'rest_base'                  => 'project_industries',
        'show_tagcloud'              => true,
        'show_in_quick_edit'         => true,
        'show_admin_column'          => true,
    );

    register_taxonomy('project_industries', ["project"], $args);
}
add_action('init', 'register_project_industries_taxonomy', 0);





// Register Meta Box
function add_mpd_project_meta_box() {
    add_meta_box(
        'mpd_project',
        'My Projects Demo',
        'mpd_project_meta_box_callback',
        ["project"],
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_mpd_project_meta_box');

// Meta Box Callback
function mpd_project_meta_box_callback($post) {
    wp_nonce_field('mpd_project_meta_box', 'mpd_project_meta_box_nonce');
    $values = get_post_meta($post->ID);
    ?>
    <div class="meta-box-container" style="display: flex; gap: 12px;">
        
        <div class="meta-box-field">
            <label for="mpd_demo_url">Demo Link</label>
            <input
                type="url"
                id="mpd_demo_url"
                name="mpd_demo_url"
                value="<?php echo esc_attr(isset($values['mpd_demo_url'][0]) ? $values['mpd_demo_url'][0] : ''); ?>"
            />
        </div>
        
        <div class="meta-box-field">
            <label for="mpd_completed">Completed</label>
            <input
                type="date"
                id="mpd_completed"
                name="mpd_completed"
                value="<?php echo esc_attr(isset($values['mpd_completed'][0]) ? $values['mpd_completed'][0] : ''); ?>"
            />
        </div>
    </div>
    <?php
}

// Save Meta Box Data
function save_mpd_project_meta_box_data($post_id) {
    if (!isset($_POST['mpd_project_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['mpd_project_meta_box_nonce'], 'mpd_project_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    
    if (isset($_POST['mpd_demo_url'])) {
        update_post_meta($post_id, 'mpd_demo_url', sanitize_text_field($_POST['mpd_demo_url']));
    }
    
    if (isset($_POST['mpd_completed'])) {
        update_post_meta($post_id, 'mpd_completed', sanitize_text_field($_POST['mpd_completed']));
    }
}
add_action('save_post', 'save_mpd_project_meta_box_data');