<?php

function mpd_install() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'liveshoutbox';
    
    $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    name tinytext NOT NULL,
    text text NOT NULL,
    url varchar(55) DEFAULT '' NOT NULL,
    PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    update_option( "mpd_db_version", MPD_PLUGIN_DB_VERSION );
}

function mpd_install_version_02() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'livestream';

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		text text NOT NULL,
		url varchar(100) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	);";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	update_option( "mpd_db_version", MPD_PLUGIN_DB_VERSION );
}


function myplugin_update_db_check() {
    
    if ( get_site_option( 'mpd_db_version' ) != MPD_PLUGIN_DB_VERSION ) {
        mpd_install_version_02();
    }
}
add_action( 'plugins_loaded', 'myplugin_update_db_check' );
