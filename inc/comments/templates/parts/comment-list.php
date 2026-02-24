<div id="comments" class="comment-area">
    <div class="blog-comments">
        <div class="comment-title">
            <h4>
                <?php comments_number(esc_html__('Comment 0', 'drivco'), esc_html__('Comment 01', 'drivco'), esc_html__('Comments (%)', 'drivco')); ?>
            </h4>
            <div class="dash"></div>
        </div>

        <ul class="comment">

            <?php
            wp_list_comments(array(
                'short_ping' => true,
                'callback' => 'egns_comment_callback',
            ));
            ?>
            <?php
            the_comments_navigation();

            // If comments are closed and there are comments, let's leave a little note, shall we?
            if (!comments_open()) {
                echo '<p class="no-comments">' . esc_html__('Comments are closed.', 'drivco') . '</p>';
            }
            ?>

        </ul>
    </div>
</div>