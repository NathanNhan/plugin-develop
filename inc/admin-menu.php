<?php 
//bai 5 + 6 + 7
add_action( 'admin_menu', 'mpd_options_page' );
function mpd_options_page() {
    add_menu_page(
        'My Plugin',
        'My Plugin',
        'manage_options',
        'mpdplugin.php',
        'mpd_render_my_plugin',
        'dashicons-superhero',
        20
    );

    add_submenu_page(
		'mpdplugin.php',
		'WPOrg Options',
		'WPOrg Options',
		'manage_options',
		'wporg',
		'wporg_options_page_html'
	);
}




