
<?php 

function mpd_print_text_footer() {
    echo "Hello, I am in Footer section";
}

add_action( 'wp_footer', 'mpd_print_text_footer' );

function mpd_meta_info() {
    if(is_singular( 'post' )) {
        echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . "\" />\n";
        echo '<meta property="og:title" description="' . esc_attr( get_the_excerpt() ) . "\" />\n";

    }
}
add_action( 'wp_head', 'mpd_meta_info' );


//filter hook for title blog

// function mpd_modify_blog_title($title) {
//     $new_title = $title . "🤫";
//     return $new_title;

// }
// add_filter( 'the_title', 'mpd_modify_blog_title' );

// //filter hook for content blog

// function mpd_modify_blog_content($content) {
//     $new_content = $content . "<p>thank for reading my post!!!</p>";
//     return $new_content;
// }
// add_filter('the_content','mpd_modify_blog_content');

/**
 * Thêm một filter vào 'the_content' để tính toán và chèn thời gian đọc bài viết.
 *
 * @param string $content Nội dung bài viết.
 * @return string Nội dung đã được chèn thời gian đọc.
 */
function add_reading_time_to_content( $content ) {

    // 1. Kiểm tra để đảm bảo chúng ta chỉ chạy trên nội dung chính của bài viết
    // (tránh chạy trên excerpt, sidebar, hoặc các khu vực khác gọi the_content()).
    if ( ! is_single() && ! is_page() ) {
        return $content;
    }

    // 2. Thiết lập tốc độ đọc trung bình (Words Per Minute - WPM).
    // Giả sử tốc độ đọc trung bình là 200 từ mỗi phút.
    $wpm = 200;

    // 3. Chuẩn bị nội dung: loại bỏ các tag HTML để đếm từ chính xác hơn.
    $clean_content = strip_tags( $content );

    // 4. Đếm số từ.
    $word_count = str_word_count( $clean_content );

    // 5. Tính thời gian đọc (làm tròn lên phút gần nhất).
    $time = ceil( $word_count / $wpm );

    // 6. Định dạng chuỗi hiển thị.
    if ( $time == 1 ) {
        $reading_time_output = '<p class="reading-time-estimation">Khoảng 1 phút đọc.</p>';
    } else {
        $reading_time_output = '<p class="reading-time-estimation">Khoảng ' . $time . ' phút đọc.</p>';
    }

    // 7. Chèn thông báo thời gian đọc vào phía trước nội dung bài viết.
    $modified_content = $reading_time_output . $content;

    return $modified_content;
}

// Gắn hàm vào hook 'the_content' với ưu tiên 20 (để nó chạy sau các filter mặc định).
add_filter( 'the_content', 'add_reading_time_to_content', 20 );
