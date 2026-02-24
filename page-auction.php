<?php

/**
 * The main template file
 *
 * Template Name: Auction product archive
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
        <div class="row g-lg-4 gy-5">
            <?php
            $args = array(
                'post_type' => 'vehicle', //it is a Page right?
                'post_status' => 'publish',
                'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
                'meta_query'        =>  array(
                    array(
                        'key'       =>  'EGNS_VEHICLE_META_ID',
                        'value'     =>  'auction_product',
                        'compare' => 'LIKE',
                    ),
                )

            );

            $wp_query = new WP_Query($args);
            $num = 0;
            if ($wp_query->have_posts()) {

                while ($wp_query->have_posts()) :
                    $num++;
                    $wp_query->the_post();

                    echo Egns\Helper\Egns_Helper::egns_get_template_part('vehicle', 'content/archive-content');

                endwhile; // End of the loop.

            } else {
                // Include global posts not found
                Egns\Helper\Egns_Helper::egns_template_part('content', 'templates/posts-not-found');
            }
            ?>
        </div>
        <div class="pagination-and-next-prev justify-content-center">
            <div class="pagination auction">
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