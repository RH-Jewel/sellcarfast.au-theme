<?php

/**
 * The main template file
 *
 * Template Name: Blog grid
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package drivco
 * @since 1.2.0
 * 
 */

get_header();

if (!is_front_page()) :
    // Include breadcrumb template
    Egns\Helper\Egns_Helper::egns_template_part('breadcrumb', 'templates/breadcrumb-page');
endif;

?>
<div class="news-section grid-view sec-mar">
    <div class="container">
        <div class="row g-lg-4 gy-4">
            <?php
            $args = array(
                'post_type' => 'post', //it is a Page right?
                'post_status' => 'publish',
                'posts_per_page' => 9,
                'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1
            );
            $wp_query = new WP_Query($args);
            $num = 0;
            if ($wp_query->have_posts()) {

                while ($wp_query->have_posts()) :
                    $num++;
                    $wp_query->the_post();

                    echo apply_filters('egns_filter_blog_single_template', Egns\Helper\Egns_Helper::egns_get_template_part('blog', 'templates/grid/post/post', get_post_format() ? get_post_format() : 'default'));

                endwhile; // End of the loop.

            } else {
                // Include global posts not found
                Egns\Helper\Egns_Helper::egns_template_part('content', 'templates/posts-not-found');
            }
            ?>
        </div>
        <div class="pagination-and-next-prev justify-content-center mt-50">
            <div class="pagination">
                <?php
                // Pagination
                Egns\Inc\Blog_Helper::egns_pagination();
                ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>