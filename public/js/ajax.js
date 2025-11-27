jQuery(document).ready(function ($) {
    $('.mpd-like').on("click", function () {
        var post_id = $(this).data('post-id');
        var user_id = $(this).data('user-id');

        if (!user_id) {
            alert("You must login to vote");
        } else {
            $.ajax({
                url: mpd_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'mpd_post_voting',
                    pid: post_id,
                    uid: user_id
                },
                success: function (response) {
                    alert(response.message)
                }
            })
        }
    })
})