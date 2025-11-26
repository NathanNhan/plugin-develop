<?php

/*
 * Plugin Name:       My Plugin Develop
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(! defined('MPD_PLUGIN_VERSION')) {
    define('MPD_PLUGIN_VERSION','1.0.0');
}

if(! defined('MPD_PLUGIN_DIR_PATH')) {
    define('MPD_PLUGIN_DIR_PATH',plugin_dir_path(__FILE__));
}

if(! defined('MPD_PLUGIN_DIR_URL')) {
    define('MPD_PLUGIN_DIR_URL',plugin_dir_url(__FILE__));
}

if(!defined('MPD_PLUGIN_DB_VERSION')) {
    define('MPD_PLUGIN_DB_VERSION', '2.0');
}

require_once MPD_PLUGIN_DIR_PATH . "/inc/mpd-plugin.php";

register_activation_hook( MPD_PLUGIN_DIR_PATH, 'mpd_install' );















  
  
 
  

