<?php

/**
 * The template for displaying archive pages
 * 
 * Template Name: Vehicle Right Sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package drivco
 */

get_header();

// Include breadcrumb template
Egns\Helper\Egns_Helper::egns_template_part('breadcrumb', 'templates/breadcrumb-archive');
?>
<div class="product-page pt-100 mb-100">
    <div class="container">
        <div class="row g-xl-4 gy-5 justify-content-center">

            <div class="<?php echo is_active_sidebar('vehicle_sidebar') ? 'col-xl-8' : 'col-xl-10' ?>">

                <?php
                // Include global Archive Top
                Egns\Helper\Egns_Helper::egns_template_part('vehicle', 'content/archive-top');
                ?>

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
                            $wp_query = new WP_Query($args);
                            $num = 0;

                            if ($wp_query->have_posts()) {

                                while ($wp_query->have_posts()) :
                                    $num++;
                                    $wp_query->the_post();

                                    echo Egns\Helper\Egns_Helper::egns_get_template_part('vehicle', 'content/archive-content-sidebar');

                                endwhile; // End of the loop.+-----------------

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

            <?php
            if (is_active_sidebar('vehicle_sidebar')) {
                // Include global vehicle sidebar
                Egns\Helper\Egns_Helper::egns_template_part('sidebar', 'templates/vehicle-sidebar');
            }
            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>