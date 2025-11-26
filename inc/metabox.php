<?php 

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