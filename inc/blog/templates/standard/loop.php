<?php

if (have_posts()) {
    while (have_posts()) : the_post();
        // Include blog standard
        if (is_single()) {
            if (Egns\Helper\Egns_Helper::egns_check_template_part('blog', 'templates/single/post/post', get_post_format())) {
                echo apply_filters('egns_filter_blog_single_template', Egns\Helper\Egns_Helper::egns_get_template_part('blog', 'templates/single/post/post', get_post_format() ? get_post_format() : 'default'));
            } else {
                echo apply_filters('egns_filter_blog_single_template', Egns\Helper\Egns_Helper::egns_get_template_part('blog', 'templates/single/post/post', 'default'));
            }
        } else {
            if (Egns\Helper\Egns_Helper::egns_check_template_part('blog', 'templates/single/post/post', get_post_format())) {
                echo apply_filters('egns_filter_blog_single_template', Egns\Helper\Egns_Helper::egns_get_template_part('blog', 'templates/standard/post/post', get_post_format() ? get_post_format() : 'default'));
            } else {
                echo apply_filters('egns_filter_blog_single_template', Egns\Helper\Egns_Helper::egns_get_template_part('blog', 'templates/standard/post/post', 'default'));
            }
        }

    endwhile; // End of the loop.
} else {
    // Include global posts not found
    Egns\Helper\Egns_Helper::egns_template_part('content', 'templates/posts-not-found');
}
?>

<div class="pagination-and-next-prev">
    <div class="pagination">
        <?php
        // Pagination
        Egns\Inc\Blog_Helper::egns_pagination();
        ?>
    </div>
    <div class="next-prev-btn">
        <ul>
            <li>
                <?php posts_nav_link('|', '<svg xmlns="http://www.w3.org/2000/svg" width="7" height="14" viewBox="0 0 7 14">
                        <path d="M0 7.00008L7 0L2.54545 7.00008L7 14L0 7.00008Z"></path>
                    </svg>Prev', 'Next <svg xmlns="http://www.w3.org/2000/svg" width="7" height="14" viewBox="0 0 7 14">
                    <path d="M7 7.00008L0 0L4.45455 7.00008L0 14L7 7.00008Z"></path>
                </svg>'); ?>
            </li>
        </ul>
    </div>
</div>


<?php

wp_reset_postdata();
