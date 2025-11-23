<?php 
//1 section -> 1 nhóm trường -> nhiều trường thông tin (input) để cho user nhập vào
 // Register settings
  function my_plugin_dev_settings_init() {
      add_settings_section(
          'my_plugin_dev_options_section',
          __('My plugin Dev', 'text-domain'),
          function() {
              
          },
          'my_plugin_dev-settings'
      );
  
      
      add_settings_field(
          'mpd_shortcode',
          __('ShortCode Default', 'text-domain'),
          function() {
              $value = get_option('mpd_shortcode');
              ?>
              <input
              type="text"
              name="mpd_shortcode"
              id="mpd_shortcode"
              value="<?php echo esc_attr($value); ?>"
              class="regular-text"
              placeholder="[mpd_plugin_default]"
          />
              
              <?php
          },
          'my_plugin_dev-settings',
          'my_plugin_dev_options_section'
      );
  
      register_setting('my_plugin_dev_options', 'mpd_shortcode');

      add_settings_field(
          'mpd_enable_shortcode',
          __('Enable shortcode', 'text-domain'),
          function() {
              $value = get_option('mpd_enable_shortcode');
              ?>
              <select
              name="mpd_enable_shortcode"
              id="mpd_enable_shortcode"
              class="regular-text"
          >
              <option value=""><?php _e('Select an option', 'text-domain'); ?></option>
              <?php
              // Example options - replace with actual options
              $options = array(
                  'enable' => __('YES', 'text-domain'),
                  'disable' => __('NO', 'text-domain'),
                  
              );
            
              /*
                $options_db = [
                   'enable' => 'YES',
                   
                ]
                $value = 'YES'
              
              */
              
              
              foreach ($options as $option_value => $option_label) {
                  printf(
                      '<option value="%s" %s>%s</option>',
                      esc_attr($option_value),
                      selected($value, $option_value, false),
                      esc_html($option_label)
                  );
              }
              ?>
          </select>
              
              <?php
          },
          'my_plugin_dev-settings',
          'my_plugin_dev_options_section'
      );
  
      register_setting('my_plugin_dev_options', 'mpd_enable_shortcode');
  }
  add_action('admin_init', 'my_plugin_dev_settings_init');