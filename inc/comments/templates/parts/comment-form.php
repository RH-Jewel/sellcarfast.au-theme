<div class="comment-form inquiry-form mt-50">
    <?php
    // Custom comments_args here: https://codex.wordpress.org/Function_Reference/comment_form
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');

    $comments_args = array(
        'title_reply'   => esc_html__('Leave a comment:', 'drivco'),
        'fields'     => apply_filters('comment_form_default_fields', array(
            'author' => '<div class="row"><div class="col-md-6 form-inner name"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author'])
                . '" placeholder="' . esc_attr__('Enter your name', 'drivco') . '" ' . esc_html($aria_req) . '></div>',

            'email' => '<div class="col-md-6 form-inner email"> <input  id="email" name="email" type="email"  value="' . esc_attr($commenter['comment_author_email'])
                . '" placeholder="' . esc_attr__('Enter your email', 'drivco') . '" ' . esc_html($aria_req) . '></div></div>',

        )),
        'comment_field' => ' <div class="row"><div class="col-12 form-inner"><textarea class=" text__area" id="comment" name="comment" cols="45" rows="8" placeholder="' . esc_attr__('Your Message', 'drivco') . '"></textarea></div></div>',
        'class_submit' => 'primary-btn3',
        'label_submit' => esc_html__('Post Comment', 'drivco'),
        'format'       => 'xhtml'
    );

    ?>

    <?php
    comment_form($comments_args);
    ?>
</div>