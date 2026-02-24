<?php

$enable_breadcrumb_by_theme = Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_enable');
$breadcrumb_enable_by_page = Egns\Helper\Egns_Helper::egns_page_option_value('breadcrumb_enable_page');

$page_breadcrumb_image = Egns\Helper\Egns_Helper::egns_page_option_value('breadcrumb_page_bg_image');

$term = get_queried_object();
?>

<?php if (Egns\Helper\Egns_Helper::is_enabled($enable_breadcrumb_by_theme, $breadcrumb_enable_by_page)) : ?>

    <div class="inner-page-banner">
        <div class="banner-wrapper">
            <div class="container">
                <div class="banner-main-content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="banner-content <?php echo is_post_type_archive('vehicle') || is_tax() ? 'mb-70' : '' ?>">
                                <h1>
                                    <?php
                                    if (is_category()) {
                                        echo esc_html__('Category : ', 'drivco');
                                        single_cat_title();
                                    } elseif (is_tag()) {
                                        echo esc_html__('Tag : ', 'drivco');
                                        single_tag_title();
                                    } elseif (is_author()) {
                                        echo esc_html__('Author : ', 'drivco');
                                        the_author();
                                    } elseif (is_date()) {
                                        echo esc_html__('Date : ', 'drivco');
                                        if (is_day()) {
                                            echo get_the_time('F j, Y');
                                        } else if (is_month()) {
                                            echo get_the_time('F, Y');
                                        } else if (is_year()) {
                                            echo get_the_time('Y');
                                        }
                                    } elseif (is_tax() && $term->taxonomy == 'vehicle-brand' && $term) {
                                        Egns\Helper\Egns_Helper::egns_translate_with_escape_('Brand: ');
                                        echo sprintf(__('%s', 'drivco'), $term->name);
                                    } elseif (is_tax() && $term->taxonomy == 'vehicle-category' && $term) {
                                        Egns\Helper\Egns_Helper::egns_translate_with_escape_('Category: ');
                                        echo sprintf(__('%s', 'drivco'), $term->name);
                                    } elseif (is_tax() && $term) {
                                        echo sprintf(__('%s', 'drivco'), $term->taxonomy) . ": " . sprintf(__('%s', 'drivco'), $term->name);
                                    } elseif (is_home()) {
                                        Egns\Helper\Egns_Helper::egns_translate_with_escape_('Blog');
                                    } elseif (is_post_type_archive('vehicle')) {
                                        Egns\Helper\Egns_Helper::egns_translate_with_escape_('Vehicle');
                                    } else {
                                        the_title();
                                    }
                                    ?>
                                </h1>
                                <?php echo egns_breadcrumb(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>