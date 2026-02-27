<?php

/**
 * The template for displaying archive pages
 * 
 * Template Name: Vehicle Left Sidebar
 *
 * @link https: //developer.wordpress.org/themes/basics/template-hierarchy/
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
<div class="product-page pt-100 mb-100">
    <div class="container">
        <div class="row g-xl-4 gy-5 justify-content-center">
            <?php
            if (is_active_sidebar('vehicle_sidebar')) {
                // Include global vehicle sidebar
                Egns\Helper\Egns_Helper::egns_template_part('sidebar', 'templates/vehicle-sidebar');
            }
            ?>

            <div class="<?php echo is_active_sidebar('vehicle_sidebar') ? 'col-xl-8' : 'col-xl-10' ?> order-xl-2 order-1">

                <?php
                // Include global Archive Top
                Egns\Helper\Egns_Helper::egns_template_part('vehicle', 'content/archive-top');
                ?>

                <div class="circle-loader"></div>
                <div class="list-grid-main" id="vehicle_wrapper">
                    <div class="list-grid-product-wrap grid-group-wrapper">
                        <div class="row g-4 mb-40">
                            <?php
                            $args = array(
                                'post_type'   => 'vehicle',
                                'post_status' => 'publish',
                                'paged'       => (get_query_var('paged')) ? get_query_var('paged') : 1,
                                // 'posts_per_page' =>  \Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_posts_per_page'),

                            );
                            // APPLY FILTERS FROM URL (GET) TO THIS CUSTOM QUERY
                            $tax_map = array(
                                'make'  => 'vehicle-brand',
                                'model' => 'vehicle-model',
                                'year'  => 'vehicle-year',
                                'loc'   => 'location',
                                'body'  => 'body-type',
                                'color' => 'colors',
                                'cat'   => 'vehicle-category',
                            );

                            $tax_query = array('relation' => 'AND');

                            foreach ($tax_map as $param => $taxonomy) {
                                if (!empty($_GET[$param])) {
                                    $raw   = sanitize_text_field(wp_unslash($_GET[$param]));
                                    $terms = array_filter(array_map('trim', explode(',', $raw)));

                                    $tax_query[] = array(
                                        'taxonomy' => $taxonomy,
                                        'field'    => 'slug',
                                        'terms'    => $terms,
                                        'operator' => 'IN',
                                    );
                                }
                            }

                            if (count($tax_query) > 1) {
                                $args['tax_query'] = $tax_query;
                            }

                            // Optional keyword search: ?q=camry
                            if (!empty($_GET['q'])) {
                                $args['s'] = sanitize_text_field(wp_unslash($_GET['q']));
                            }

                            $wp_query = new WP_Query($args);
                            $num      = 0;

                            if ($wp_query->have_posts()) {

                                while ($wp_query->have_posts()):
                                    $num++;
                                    $wp_query->the_post();

                                    echo Egns\Helper\Egns_Helper::egns_get_template_part('vehicle', 'content/archive-content-sidebar');

                                endwhile;  // End of the loop.
                                wp_reset_postdata();
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
                                <div class="pagination" id="vehiclePagination">
                                    <?php
                                    // Pagination
                                    Egns\Inc\Blog_Helper::egns_pagination();
                                    ?>
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