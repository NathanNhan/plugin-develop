<?php 


// add_shortcode( 'testing', 'render_html' );

// function render_html () {
//     return "Hello, I am Trong Nhan Dev";
// }


function test_shortcode($atts) {
    // Extract and merge attributes with defaults
    $atts = shortcode_atts(array(
        'title' => '',
		'link' => ''
    ), $atts, 'format_text');

    // Start output buffering
    ob_start();

    // Your shortcode logic here
    ?>
    
    <div class="test-shortcode">
        <a href="<?= esc_attr($atts['link']);  ?>"><?= $atts['title']  ?> </a>
    </div>
    <?php

    // Return the buffered content
    return ob_get_clean();
}
add_shortcode('format_text', 'test_shortcode');

// Usage example:
// [test attr="value"]

//short to show project

function mpd_project_meta_shortcode($atts) {
    // Extract and merge attributes with defaults
    $atts = shortcode_atts(array(
        'id' => get_the_ID(),
    ), $atts, 'PROJECT_META');

    
    $project_demo_link = get_post_meta($atts['id'],'mpd_demo_url', true);
    $project_completed = get_post_meta($atts['id'],'mpd_completed', true);
    // Your shortcode logic here
    $html = '<div class="project-meta">';
        $html .= '<span><a href="' . $project_demo_link . '" target="_blank">Vist Project</a></span>';
        $html .= '<span>'. $project_completed . '</span>';
    $html .= '</div>';

    return $html;

   
}
add_shortcode('PROJECT_META', 'mpd_project_meta_shortcode');
