<?php

//Get location terms object
$location = wp_get_object_terms(get_the_ID(), 'location');

$enable_breadcrumb_by_theme = Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_enable');
$breadcrumb_enable_by_page = Egns\Helper\Egns_Helper::egns_page_option_value('breadcrumb_enable_page');

$page_breadcrumb_image = Egns\Helper\Egns_Helper::egns_page_option_value('breadcrumb_page_bg_image');

?>

<?php if (Egns\Helper\Egns_Helper::is_enabled($enable_breadcrumb_by_theme, $breadcrumb_enable_by_page)) : ?>

    <div class="modal signUp-modal fade" id="alartModal01" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="alartModal01Label"><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_notify_form_header') ?></h4>
                    <p><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_notify_form_short_desc') ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body">
                    <?php echo do_shortcode(Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_notify_shortcode')) ?>
                </div>
            </div>
        </div>
    </div>

<?php endif ?>

<!-- Start Banner section -->
<div class="inner-page-banner">
    <div class="banner-wrapper">
        <div class="container">
            <div class="banner-main-content-wrap">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-content style-2">
                            <div class="price-model-and-fav-area">
                                <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_priceShare_enable') == 1) : ?>
                                    <div class="price-and-model">
                                        <div class="price">
                                            <?php if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_auction_or_not') == 'auction_product' && !empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_product'))) :
                                                $auction_product_id = Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_product');
                                                $_product = wc_get_product($auction_product_id);
                                            ?>
                                                <h3>
                                                    <?php echo sprintf('%s', $_product->get_price_html()); ?>
                                                </h3>
                                            <?php else : ?>

                                                <h3>
                                                    <?php echo esc_html__('Price : ', 'drivco');
                                                    echo \Egns\Helper\Egns_Helper::get_vehicle_price() ?>
                                                </h3>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <ul class="share-and-fav">
                                        <li>
                                            <div class="share-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                    <path d="M10.1248 0.750223C9.82642 0.750223 9.54028 0.868748 9.32931 1.07972C9.11833 1.2907 8.99981 1.57684 8.99981 1.8752C8.99981 2.17357 9.11833 2.45971 9.32931 2.67069C9.54028 2.88166 9.82642 3.00019 10.1248 3.00019C10.4232 3.00019 10.7093 2.88166 10.9203 2.67069C11.1312 2.45971 11.2498 2.17357 11.2498 1.8752C11.2498 1.57684 11.1312 1.2907 10.9203 1.07972C10.7093 0.868748 10.4232 0.750223 10.1248 0.750223ZM8.24982 1.8752C8.24976 1.43529 8.4044 1.00936 8.68666 0.671933C8.96893 0.33451 9.36085 0.107081 9.79386 0.0294379C10.2269 -0.0482056 10.6734 0.0288801 11.0553 0.247208C11.4372 0.465536 11.7302 0.811204 11.883 1.22373C12.0358 1.63626 12.0387 2.08939 11.8912 2.50382C11.7436 2.91826 11.455 3.26762 11.0759 3.49078C10.6968 3.71395 10.2513 3.7967 9.81734 3.72456C9.38337 3.65243 8.98859 3.42999 8.70206 3.09618L3.66364 5.43615C3.77947 5.80322 3.77947 6.19705 3.66364 6.56413L8.70206 8.90409C9.00494 8.55184 9.4278 8.32458 9.88869 8.26634C10.3496 8.2081 10.8157 8.32303 11.1967 8.58886C11.5776 8.85469 11.8464 9.25249 11.9508 9.70517C12.0552 10.1578 11.9878 10.6332 11.7617 11.039C11.5356 11.4448 11.1669 11.7523 10.7271 11.9018C10.2872 12.0512 9.80756 12.0321 9.38101 11.8481C8.95446 11.6641 8.61141 11.3282 8.41835 10.9057C8.22529 10.4832 8.19597 10.004 8.33607 9.56108L3.29765 7.22112C3.04823 7.51179 2.71577 7.7191 2.345 7.81517C1.97423 7.91124 1.58293 7.89145 1.22374 7.75847C0.864549 7.62548 0.554702 7.38569 0.33588 7.07133C0.117057 6.75698 -0.000244141 6.38315 -0.000244141 6.00014C-0.000244141 5.61712 0.117057 5.24329 0.33588 4.92894C0.554702 4.61459 0.864549 4.37479 1.22374 4.24181C1.58293 4.10882 1.97423 4.08903 2.345 4.1851C2.71577 4.28117 3.04823 4.48848 3.29765 4.77916L8.33607 2.4392C8.27871 2.2567 8.24963 2.0665 8.24982 1.8752ZM1.87492 4.87515C1.57656 4.87515 1.29042 4.99368 1.07944 5.20465C0.868467 5.41563 0.749942 5.70177 0.749942 6.00014C0.749942 6.2985 0.868467 6.58464 1.07944 6.79562C1.29042 7.00659 1.57656 7.12512 1.87492 7.12512C2.17329 7.12512 2.45943 7.00659 2.67041 6.79562C2.88138 6.58464 2.99991 6.2985 2.99991 6.00014C2.99991 5.70177 2.88138 5.41563 2.67041 5.20465C2.45943 4.99368 2.17329 4.87515 1.87492 4.87515ZM10.1248 9.00009C9.82642 9.00009 9.54028 9.11861 9.32931 9.32959C9.11833 9.54056 8.99981 9.8267 8.99981 10.1251C8.99981 10.4234 9.11833 10.7096 9.32931 10.9205C9.54028 11.1315 9.82642 11.25 10.1248 11.25C10.4232 11.25 10.7093 11.1315 10.9203 10.9205C11.1312 10.7096 11.2498 10.4234 11.2498 10.1251C11.2498 9.8267 11.1312 9.54056 10.9203 9.32959C10.7093 9.11861 10.4232 9.00009 10.1248 9.00009Z" />
                                                </svg>
                                            </div>
                                            <ul class="social-icons">
                                                <li><a href="<?php echo esc_url('http://www.facebook.com/sharer/sharer.php?u=' . get_permalink()); ?>"><i class="bx bxl-facebook"></i></a></li>
                                                <li><a href="<?php echo esc_url('http://www.twitter.com/share?url=' . get_permalink()); ?>"><i class="bx bxl-twitter"></i></a></li>
                                                <li><a href="<?php echo esc_url('http://www.pinterest.com/share?url=' . get_permalink()); ?>"><i class="bx bxl-pinterest"></i></a></li>
                                                <li><a href="<?php echo esc_url('http://www.instagram.com/share?url=' . get_permalink()); ?>"><i class="bx bxl-instagram"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                            <h1><?php the_title() ?></h1>
                            <div class="location-and-notification">
                                <ul>
                                    <?php if ($location ?? '') : ?>
                                        <li>
                                            <i class="bi bi-geo-alt"></i>
                                            <?php echo sprintf(__('%s ', 'drivco'), $location[0]->name) ?>
                                        </li>
                                    <?php endif ?>
                                    <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_notify_label')) && !empty(Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_notify_shortcode'))) : ?>
                                        <li class="alart">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#alartModal01">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 13 14">
                                                    <path d="M10.9778 7.18763V5.87891C10.9778 3.96971 9.63702 2.35154 7.80001 1.82301V1.23047C7.80001 0.551988 7.21684 0 6.50002 0C5.7832 0 5.20003 0.551988 5.20003 1.23047V1.82301C3.36299 2.35154 2.02226 3.96968 2.02226 5.87891V7.18763C2.02226 8.86468 1.3469 10.4549 0.120605 11.6653C0.0618066 11.7234 0.0223205 11.7965 0.00705533 11.8755C-0.00820982 11.9546 0.00141928 12.0362 0.0347455 12.1102C0.0680718 12.1841 0.123625 12.2472 0.1945 12.2915C0.265375 12.3358 0.348445 12.3594 0.433383 12.3594H4.37696C4.57825 13.2943 5.4537 14 6.50002 14C7.54637 14 8.42176 13.2943 8.62308 12.3594H12.5667C12.6516 12.3594 12.7346 12.3358 12.8055 12.2914C12.8764 12.2471 12.9319 12.1841 12.9653 12.1101C12.9986 12.0362 13.0082 11.9546 12.9929 11.8755C12.9777 11.7965 12.9382 11.7234 12.8794 11.6653C11.6531 10.4549 10.9778 8.86465 10.9778 7.18763ZM6.06669 1.23047C6.06669 1.00431 6.26108 0.820312 6.50002 0.820312C6.73896 0.820312 6.93335 1.00431 6.93335 1.23047V1.66053C6.79073 1.64752 6.6462 1.64062 6.50002 1.64062C6.35384 1.64062 6.20931 1.64752 6.06669 1.66053V1.23047ZM6.50002 13.1797C5.9351 13.1797 5.45344 12.8368 5.27456 12.3594H7.72548C7.5466 12.8368 7.06494 13.1797 6.50002 13.1797ZM1.36736 11.5391C2.35422 10.2869 2.88893 8.77166 2.88893 7.18763V5.87891C2.88893 3.99424 4.50886 2.46094 6.50002 2.46094C8.49118 2.46094 10.1111 3.99424 10.1111 5.87891V7.18763C10.1111 8.77166 10.6458 10.2869 11.6327 11.5391H1.36736ZM12.1333 5.87891C12.1333 6.10542 12.3273 6.28906 12.5667 6.28906C12.806 6.28906 13 6.10542 13 5.87891C13 4.23555 12.3239 2.69054 11.0962 1.52852C10.927 1.36836 10.6526 1.36834 10.4834 1.52852C10.3141 1.6887 10.3141 1.94838 10.4834 2.10856C11.5474 3.11566 12.1333 4.45465 12.1333 5.87891ZM0.433383 6.28906C0.672698 6.28906 0.866714 6.10542 0.866714 5.87891C0.866714 4.45468 1.45269 3.11568 2.51667 2.10859C2.6859 1.94841 2.6859 1.68872 2.51667 1.52854C2.34746 1.36836 2.07308 1.36836 1.90385 1.52854C0.676164 2.69057 5.22303e-05 4.23555 5.22303e-05 5.87891C5.22303e-05 6.10542 0.194069 6.28906 0.433383 6.28906Z">
                                                    </path>
                                                </svg><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_notify_label') ?>
                                            </button>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner section -->