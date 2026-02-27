<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package drivco
 */

get_header();

// Include breadcrumb template
// Egns\Helper\Egns_Helper::egns_template_part('breadcrumb', 'templates/breadcrumb-archive');

?>
<div class="sellcarfast-filter">
    <div class="container">
        <h2 class="banner-heading"><?php echo esc_html__('Cars & Light Commercial', 'drivco') ?></h2>
        <p class="banner-subheading">
            <?php echo esc_html__('Search the range of passenger vehicles at SellcarFast, or browse all', 'drivco') ?> <a class="upcomingEvents" href="/auction-vehicle-list"><?php echo esc_html__('View All Auctions', 'drivco') ?></a>
        </p>
        <?php echo do_shortcode('[sellcarfast]'); ?>
    </div>
</div>
<div class="product-search-area">
    <?php
    // Search Filter 
    // echo do_shortcode('[egns_general_filter style=3]');
    ?>
</div>

<?php

global $wp_query;
$args = array(
    'post_type'   => 'vehicle',
    'post_status' => 'publish',
    'paged'       => (get_query_var('paged')) ? get_query_var('paged') : 1,
    's'           => (get_query_var('title')) ? get_query_var('title') : '',
);
$args     = array_merge($wp_query->query_vars);
$wp_query = new WP_Query($args);
$num      = $wp_query->found_posts;
?>
<div class="product-page no-sidebar sec-mar">
    <div class="container">
        <div class="row g-xl-4 gy-5">
            <div class="col-xl-12">
                <?php
                // Include global Archive Top
                Egns\Helper\Egns_Helper::egns_template_part('vehicle', 'content/archive-top', '', ['vehicle_count' => $num]);
                ?>
                <div class="list-grid-main">
                    <div class="list-grid-product-wrap grid-group-wrapper">
                        <div class="row g-4 mb-40">
                            <?php
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

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
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
                                            <?php
                                            posts_nav_link('|', '<svg xmlns="http://www.w3.org/2000/svg" width="7" height="14" viewBox="0 0 7 14">
                                                        <path d="M0 7.00008L7 0L2.54545 7.00008L7 14L0 7.00008Z"></path>
                                                    </svg>Prev', 'Next <svg xmlns="http://www.w3.org/2000/svg" width="7" height="14" viewBox="0 0 7 14">
                                                    <path d="M7 7.00008L0 0L4.45455 7.00008L0 14L7 7.00008Z"></path>
                                                </svg>');
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>