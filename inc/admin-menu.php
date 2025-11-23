<?php 
//bai 5 + 6 + 7

// Add admin menu page
  function my_plugin_dev_add_admin_menu() {
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
  add_action('admin_menu', 'my_plugin_dev_add_admin_menu');




