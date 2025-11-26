<?php
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