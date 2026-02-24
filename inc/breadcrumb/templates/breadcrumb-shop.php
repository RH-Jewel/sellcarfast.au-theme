<?php

$enable_breadcrumb_by_theme = Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_enable');
$breadcrumb_enable_by_page = Egns\Helper\Egns_Helper::egns_page_option_value('breadcrumb_enable_page');

$page_breadcrumb_image = Egns\Helper\Egns_Helper::egns_page_option_value('breadcrumb_page_bg_image');

?>

<?php if (Egns\Helper\Egns_Helper::is_enabled($enable_breadcrumb_by_theme, $breadcrumb_enable_by_page)) : ?>

    <div class="inner-page-banner">
        <div class="banner-wrapper">
            <div class="container">
                <div class="banner-main-content-wrap">
                    <div class="row">
                        <div class="col-12">
                            <div class="banner-content">
                                <h1><?php woocommerce_page_title(); ?></h1>
                                <?php echo egns_breadcrumb(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>