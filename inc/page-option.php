<?php 
  // Create the options page
  function my_plugin_dev_options_page() {
      ?>
      <div class="wrap">
          <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
          <form action="options.php" method="post">
              <?php
              settings_fields('my_plugin_dev_options');
              do_settings_sections('my_plugin_dev-settings');
              submit_button();
              ?>
          </form>
      </div>
      <?php
  }


