<?php

// Handle bidding actions
$total_bid = 0;
// Calculate bidding price
$vehicle_bidding_price = Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_price');
$userdata        = get_userdata(get_current_user_id());
$currency = Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_currency_selector');
$message = '';
$is_bidding_form = isset($_REQUEST['place_bid']) ? true : false;
if ($is_bidding_form && $userdata) {
    $bidding_amount  = !empty($_POST['bidding_price']) ? sanitize_text_field($_POST['bidding_price']) : null;
    $bidding_id      = get_the_ID();
    $auction_bidded     = get_post($bidding_id);
    if ($bidding_amount > $vehicle_bidding_price) {
        $full_name       = !empty($userdata->display_name) ? sanitize_text_field($userdata->display_name) : null;
        $email_address   = !empty($userdata->user_email) ? sanitize_text_field($userdata->user_email) : null;
        $auction_bidding = array(
            'post_type'   => 'auction-bidding',
            'post_title'  => $auction_bidded->post_title ?? '',
            'post_status' => 'publish',
        );
        $auction_bidding_id = wp_insert_post($auction_bidding);
        $auction_meta_data  = array(
            'auction_vehicle_id'    => $auction_bidded->post_title ?? '',
            'auction_full_name'     => $full_name,
            'auction_email_address' => $email_address,
            'auction_bidded_price'  => $bidding_amount,
            'auction_currency'      => $currency,
        );
        add_post_meta($auction_bidding_id, 'egns_auction_metadata', $auction_meta_data);
        $message = sprintf(__('Your bidding has been successfull at %s%d', 'drivco'), $currency, $bidding_amount);
    } else {
        $message = sprintf(__('Bidding price should be gretter then %s%d', 'drivco'), $currency, $vehicle_bidding_price);
    }
}
$total_bid = Egns_Core\Egns_Helper::get_count_auction(get_the_title());
$total_bids = Egns_Core\Egns_Helper::get_auction_vehicle_by_meta(get_the_title());
if (!empty($total_bids) && count($total_bids) > 0) {
    foreach ($total_bids as $single_bid) {
        $price = Egns_Core\Egns_Helper::egns_vehicle_auction_value($single_bid->ID, 'auction_bidded_price');
        if (!empty($price) && $price > $vehicle_bidding_price) {
            $vehicle_bidding_price = $price;
        }
    }
}
?>

<!-- breadcrumb  -->

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
<!-- Start Car-Details section -->
<div class="car-details-area mb-100">
    <div class="container">
        <div class="vehicle-single-breadcrumb">
            <div class="row align-items-end g-4">
                <div class="col-lg-8">
                    <div class="banner-content">
                        <?php echo egns_breadcrumb(); ?>
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
                <div class="col-lg-4">
                    <div class="price-model-and-fav-area">
                        <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_priceShare_enable') == 1) : ?>
                            <ul class="share-and-fav">
                                <li>
                                    <div class="share-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                            <path d="M10.1248 0.750223C9.82642 0.750223 9.54028 0.868748 9.32931 1.07972C9.11833 1.2907 8.99981 1.57684 8.99981 1.8752C8.99981 2.17357 9.11833 2.45971 9.32931 2.67069C9.54028 2.88166 9.82642 3.00019 10.1248 3.00019C10.4232 3.00019 10.7093 2.88166 10.9203 2.67069C11.1312 2.45971 11.2498 2.17357 11.2498 1.8752C11.2498 1.57684 11.1312 1.2907 10.9203 1.07972C10.7093 0.868748 10.4232 0.750223 10.1248 0.750223ZM8.24982 1.8752C8.24976 1.43529 8.4044 1.00936 8.68666 0.671933C8.96893 0.33451 9.36085 0.107081 9.79386 0.0294379C10.2269 -0.0482056 10.6734 0.0288801 11.0553 0.247208C11.4372 0.465536 11.7302 0.811204 11.883 1.22373C12.0358 1.63626 12.0387 2.08939 11.8912 2.50382C11.7436 2.91826 11.455 3.26762 11.0759 3.49078C10.6968 3.71395 10.2513 3.7967 9.81734 3.72456C9.38337 3.65243 8.98859 3.42999 8.70206 3.09618L3.66364 5.43615C3.77947 5.80322 3.77947 6.19705 3.66364 6.56413L8.70206 8.90409C9.00494 8.55184 9.4278 8.32458 9.88869 8.26634C10.3496 8.2081 10.8157 8.32303 11.1967 8.58886C11.5776 8.85469 11.8464 9.25249 11.9508 9.70517C12.0552 10.1578 11.9878 10.6332 11.7617 11.039C11.5356 11.4448 11.1669 11.7523 10.7271 11.9018C10.2872 12.0512 9.80756 12.0321 9.38101 11.8481C8.95446 11.6641 8.61141 11.3282 8.41835 10.9057C8.22529 10.4832 8.19597 10.004 8.33607 9.56108L3.29765 7.22112C3.04823 7.51179 2.71577 7.7191 2.345 7.81517C1.97423 7.91124 1.58293 7.89145 1.22374 7.75847C0.864549 7.62548 0.554702 7.38569 0.33588 7.07133C0.117057 6.75698 -0.000244141 6.38315 -0.000244141 6.00014C-0.000244141 5.61712 0.117057 5.24329 0.33588 4.92894C0.554702 4.61459 0.864549 4.37479 1.22374 4.24181C1.58293 4.10882 1.97423 4.08903 2.345 4.1851C2.71577 4.28117 3.04823 4.48848 3.29765 4.77916L8.33607 2.4392C8.27871 2.2567 8.24963 2.0665 8.24982 1.8752ZM1.87492 4.87515C1.57656 4.87515 1.29042 4.99368 1.07944 5.20465C0.868467 5.41563 0.749942 5.70177 0.749942 6.00014C0.749942 6.2985 0.868467 6.58464 1.07944 6.79562C1.29042 7.00659 1.57656 7.12512 1.87492 7.12512C2.17329 7.12512 2.45943 7.00659 2.67041 6.79562C2.88138 6.58464 2.99991 6.2985 2.99991 6.00014C2.99991 5.70177 2.88138 5.41563 2.67041 5.20465C2.45943 4.99368 2.17329 4.87515 1.87492 4.87515ZM10.1248 9.00009C9.82642 9.00009 9.54028 9.11861 9.32931 9.32959C9.11833 9.54056 8.99981 9.8267 8.99981 10.1251C8.99981 10.4234 9.11833 10.7096 9.32931 10.9205C9.54028 11.1315 9.82642 11.25 10.1248 11.25C10.4232 11.25 10.7093 11.1315 10.9203 10.9205C11.1312 10.7096 11.2498 10.4234 11.2498 10.1251C11.2498 9.8267 11.1312 9.54056 10.9203 9.32959C10.7093 9.11861 10.4232 9.00009 10.1248 9.00009Z" />
                                        </svg>
                                    </div>
                                    <span>share</span>
                                    <ul class="social-icons">
                                        <li><a href="<?php echo esc_url('http://www.facebook.com/sharer/sharer.php?u=' . get_permalink()); ?>"><i class="bx bxl-facebook"></i></a></li>
                                        <li><a href="<?php echo esc_url('http://www.twitter.com/share?url=' . get_permalink()); ?>"><i class="bx bxl-twitter"></i></a></li>
                                        <li><a href="<?php echo esc_url('http://www.pinterest.com/share?url=' . get_permalink()); ?>"><i class="bx bxl-pinterest"></i></a></li>
                                        <li><a href="<?php echo esc_url('http://www.instagram.com/share?url=' . get_permalink()); ?>"><i class="bx bxl-instagram"></i></a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="price-and-model">
                                <div class="price">
                                    <?php if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_auction_or_not') == 'auction_product' && !empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_product'))) :
                                        $auction_product_id = Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_product');
                                        $_product = wc_get_product($auction_product_id);
                                    ?>
                                        <?php if ($_product && method_exists($_product, 'get_price_html')) : ?>
                                            <h3>
                                                <?php echo sprintf('%s', $_product->get_price_html()); ?>
                                            </h3>
                                        <?php endif; ?>
                                    <?php else : ?>

                                        <h3>
                                            <?php echo  \Egns\Helper\Egns_Helper::get_vehicle_price() ?>
                                        </h3>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $imageData = Egns_Core\Egns_Helper::egns_vehicle_gallery('vehicle_exterior_gallery');
        ?>
        <div class="vehicle-gallery">
            <div class="row align-items-center g-3">
                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_exterior_gallery'))) : ?>
                    <div class="col-lg-8">
                        <div class="product-img">
                            <?php if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_video_switcher') == true && Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_video_clip_url', 'url')) : ?>
                                <div class="video-btn">
                                    <a class="video-popup" href="<?php echo esc_url(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_video_clip_url', 'url')) ?>"><i class="bi bi-play-circle"></i><?php echo esc_html__('Video Clip', 'drivco') ?></a>
                                </div>
                            <?php else : ?>
                                <?php if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_video_switcher') == true && Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_video_clip', 'url')) : ?>
                                    <div class="video-btn">
                                        <a class="video-popup" href="<?php echo esc_url(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_video_clip', 'url')) ?>"><i class="bi bi-play-circle"></i><?php echo esc_html__('Video Clip', 'drivco') ?></a>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_exterior_gallery'))) : ?>
                                <div class="slider-btn-group">
                                    <div class="product-stand-prev swiper-arrow">
                                        <svg width="8" height="13" viewBox="0 0 8 13" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 6.50008L8 0L2.90909 6.50008L8 13L0 6.50008Z" />
                                        </svg>
                                    </div>
                                    <div class="product-stand-next swiper-arrow">
                                        <svg width="8" height="13" viewBox="0 0 8 13" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 6.50008L0 0L5.09091 6.50008L0 13L8 6.50008Z" />
                                        </svg>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="swiper product-img-slider">
                                <div class="swiper-wrapper">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="swiper-slide">
                                            <?php the_post_thumbnail() ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_exterior_gallery'))) : ?>
                                        <?php foreach ((array) Egns_Core\Egns_Helper::egns_vehicle_gallery('vehicle_exterior_gallery') as $key => $data) : ?>
                                            <div class="swiper-slide">
                                                <img src="<?php echo wp_get_attachment_url($data)  ?>" alt="<?php echo esc_attr__('image-product', 'drivco') ?>">
                                                <a data-fancybox=" gallery-01" href="<?php echo wp_get_attachment_url($data)  ?>"></a>
                                            </div>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 h-100">
                        <div class="row g-3 h-100">
                            <?php if ($imageData['1'] ?? '') : ?>
                                <div class="col-6">
                                    <div class="gallery-img-wrap">
                                        <img src="<?php echo wp_get_attachment_url($imageData['1']); ?>" alt="">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($imageData['2'] ?? '') : ?>
                                <div class="col-6">
                                    <div class="gallery-img-wrap">
                                        <img src="<?php echo wp_get_attachment_url($imageData['2']); ?>" alt="">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($imageData['3'] ?? '') : ?>
                                <div class="col-6">
                                    <div class="gallery-img-wrap">
                                        <img src="<?php echo wp_get_attachment_url($imageData['3']); ?>" alt="">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-6">
                                <div class="gallery-img-wrap active">
                                    <img src="<?php echo wp_get_attachment_url(end($imageData)); ?>" alt="">
                                    <a data-fancybox=" gallery-01" href="<?php echo wp_get_attachment_url(end($imageData)); ?>"><i class="bi bi-plus"></i><?php echo esc_html__('Images ', 'drivco') . '(' . count($imageData) . ')' ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="col-lg-12">
                        <div class="product-img only-thumb">
                            <?php the_post_thumbnail() ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <!-- ++++++++ Above New design add+++++++  -->

        <div class="row">
            <div class="col-lg-8">
                <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="0" class="scrollspy-example" tabindex="0">

                    <div class="single-item mb-50" id="car-info">
                        <div class="car-info">
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_info_heading'))) : ?>
                                <div class="title mb-20">
                                    <h5><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_info_heading') ?></h5>
                                </div>
                            <?php endif; ?>
                            <ul>

                                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_milage_info_value') || Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_milage_info_label'))) : ?>
                                    <li>
                                        <div class="icon">
                                            <img src="<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_milage_info_icon', 'url') ?>" alt="<?php esc_html__('cart-img', 'drivco') ?>">
                                        </div>
                                        <div class="content">
                                            <h6><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_milage_info_value') ?></h6>
                                            <span><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_milage_info_label') ?></span>
                                        </div>
                                    </li>
                                <?php endif; ?>

                                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_engine_info_label') || Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_engine_info_value'))) : ?>
                                    <li>
                                        <div class="icon">
                                            <img src="<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_engine_info_icon', 'url') ?>" alt="<?php esc_html__('cart-img', 'drivco') ?>">
                                        </div>
                                        <div class="content">
                                            <h6><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_engine_info_value') ?></h6>
                                            <span><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_engine_info_label') ?></span>
                                        </div>
                                    </li>
                                <?php endif; ?>

                                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_type_info_value') || Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_type_info_label'))) : ?>
                                    <li>
                                        <div class="icon">
                                            <img src="<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_type_info_icon', 'url') ?>" alt="<?php esc_html__('icon-img', 'drivco') ?>">
                                        </div>
                                        <div class="content">
                                            <h6><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_type_info_value') ?></h6>
                                            <span><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_type_info_label') ?></span>
                                        </div>
                                    </li>
                                <?php endif; ?>

                                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_condition_info_value') || Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_condition_info_label'))) : ?>
                                    <li>
                                        <div class="icon">
                                            <img src="<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_condition_info_icon', 'url') ?>" alt="<?php esc_html__('icon-img', 'drivco') ?>">
                                        </div>
                                        <div class="content">
                                            <h6><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_condition_info_value') ?></h6>
                                            <span><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_condition_info_label') ?></span>
                                        </div>
                                    </li>
                                <?php endif; ?>

                            </ul>
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_info_editor'))) : ?>
                                <div class="description mt-40">
                                    <?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_info_editor') ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <?php if (!empty(get_the_content())) : ?>
                        <div class="single-item mb-50">
                            <div class="description">
                                <div class="title mb-20">
                                    <h5><?php echo esc_html__('Description', 'drivco') ?></h5>
                                </div>
                                <p> <?php the_content() ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="single-item mb-50" id="kye-features">
                        <div class="kye-features">
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_key_feature_heading'))) : ?>
                                <div class="title mb-20">
                                    <h5><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_key_feature_heading') ?></h5>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_key_features'))) : ?>
                                <ul>
                                    <?php foreach ((array)Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_key_features') as $key_feature) : ?>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                                <path d="M6 11.25C4.60761 11.25 3.27226 10.6969 2.28769 9.71231C1.30312 8.72774 0.75 7.39239 0.75 6C0.75 4.60761 1.30312 3.27226 2.28769 2.28769C3.27226 1.30312 4.60761 0.75 6 0.75C7.39239 0.75 8.72774 1.30312 9.71231 2.28769C10.6969 3.27226 11.25 4.60761 11.25 6C11.25 7.39239 10.6969 8.72774 9.71231 9.71231C8.72774 10.6969 7.39239 11.25 6 11.25ZM6 12C7.5913 12 9.11742 11.3679 10.2426 10.2426C11.3679 9.11742 12 7.5913 12 6C12 4.4087 11.3679 2.88258 10.2426 1.75736C9.11742 0.632141 7.5913 0 6 0C4.4087 0 2.88258 0.632141 1.75736 1.75736C0.632141 2.88258 0 4.4087 0 6C0 7.5913 0.632141 9.11742 1.75736 10.2426C2.88258 11.3679 4.4087 12 6 12Z" />
                                                <path d="M8.22751 3.72747C8.22217 3.73264 8.21716 3.73816 8.21251 3.74397L5.60776 7.06272L4.03801 5.49222C3.93138 5.39286 3.79034 5.33876 3.64462 5.34134C3.49889 5.34391 3.35985 5.40294 3.25679 5.506C3.15373 5.60906 3.0947 5.7481 3.09213 5.89382C3.08956 6.03955 3.14365 6.18059 3.24301 6.28722L5.22751 8.27247C5.28097 8.32583 5.34463 8.36788 5.4147 8.39611C5.48476 8.42433 5.5598 8.43816 5.63532 8.43676C5.71084 8.43536 5.78531 8.41876 5.85428 8.38796C5.92325 8.35716 5.98531 8.31278 6.03676 8.25747L9.03076 4.51497C9.13271 4.40796 9.18845 4.26514 9.18593 4.11737C9.18341 3.9696 9.12284 3.82875 9.0173 3.72529C8.91177 3.62182 8.76975 3.56405 8.62196 3.56446C8.47417 3.56486 8.33247 3.62342 8.22751 3.72747Z" />
                                            </svg>
                                            <?php echo sprintf(__('%s', 'drivco'), $key_feature['vehicle_key_feature']) ?>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            <?php endif; ?>

                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_key_features_editor'))) : ?>
                                <div class="description mt-40">
                                    <?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_key_features_editor') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="single-item mb-50" id="overview">
                        <div class="overview">
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_overviews_heading'))) : ?>
                                <div class="title mb-25">
                                    <h5><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_overviews_heading') ?></h5>
                                </div>
                            <?php endif; ?>
                            <div class="overview-content">

                                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_overview_items'))) : ?>
                                    <ul>
                                        <?php foreach ((array)Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_overview_items') as $key_overview) : ?>
                                            <li><span><?php echo sprintf(__('%s', 'drivco'), $key_overview['vehicle_overview_label']) ?></span> <?php echo sprintf(__('%s', 'drivco'), $key_overview['vehicle_overview_value']) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                <?php endif; ?>

                                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_overview_editor'))) : ?>
                                    <div class="description mt-40">
                                        <?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_overview_editor') ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                    <div class="single-item mb-50" id="performance">
                        <div class="engine-performance">
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_performance_heading'))) : ?>
                                <div class="title mb-25">
                                    <h5><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_performance_heading') ?></h5>
                                </div>
                            <?php endif; ?>
                            <div class="overview-content">
                                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_performance_items'))) : ?>
                                    <ul>
                                        <?php foreach ((array)Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_performance_items') as $key_performance) : ?>
                                            <li><span><?php echo sprintf(__('%s', 'drivco'), $key_performance['vehicle_performance_label']) ?></span> <?php echo sprintf(__('%s', 'drivco'), $key_performance['vehicle_performance_value']) ?></li>
                                        <?php endforeach ?>
                                    </ul>
                                <?php endif; ?>

                                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_performance_editor'))) : ?>
                                    <div class="description mt-40">
                                        <?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_performance_editor') ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                    <div class="single-item mb-50" id="car-color">
                        <div class="car-colors">
                            <div class="title-and-slider-btn mb-25">
                                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_colors_heading'))) : ?>
                                    <div class="title">
                                        <h5><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_colors_heading') ?></h5>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_colors_gallery'))) : ?>
                                    <div class="slider-btn-group2">
                                        <div class="slider-btn prev-2">
                                            <svg width="7" height="13" viewBox="0 0 8 13" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0 6.50008L8 0L2.90909 6.50008L8 13L0 6.50008Z"></path>
                                            </svg>
                                        </div>
                                        <div class="slider-btn next-2">
                                            <svg width="7" height="13" viewBox="0 0 8 13" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 6.50008L0 0L5.09091 6.50008L0 13L8 6.50008Z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_colors_gallery'))) : ?>
                                <div class="swiper car-color-slider">
                                    <div class="swiper-wrapper">
                                        <?php foreach ((array) Egns_Core\Egns_Helper::egns_vehicle_gallery('vehicle_colors_gallery') as $data) : ?>
                                            <div class="swiper-slide">
                                                <div class="car-color-wrap">
                                                    <div class="car-img">
                                                        <img src="<?php echo wp_get_attachment_url($data) ?>" alt="<?php echo esc_attr__('product-img', 'drivco') ?>">
                                                    </div>
                                                    <div class="content">
                                                        <h6><?php echo get_the_title($data) ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="single-item mb-50" id="car-milage">
                        <div class="car-milage">
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_mileage_heading'))) : ?>
                                <div class="title mb-25">
                                    <h5><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_mileage_heading') ?></h5>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_mileage_items') || Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_mileage_editor'))) : ?>
                                <div class="overview-content">
                                    <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_mileage_items'))) : ?>
                                        <ul>
                                            <?php foreach ((array)Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_mileage_items') as $key_mileage) : ?>
                                                <li><span><?php echo sprintf(__('%s', 'drivco'), $key_mileage['vehicle_mileage_label'])  ?></span> <?php echo sprintf(__('%s', 'drivco'), $key_mileage['vehicle_mileage_value']) ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    <?php endif; ?>

                                    <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_mileage_editor'))) : ?>
                                        <div class="description mt-40">
                                            <?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_mileage_editor') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="single-item mb-50" id="car-location">
                        <div class="car-milage">
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_location_heading'))) : ?>
                                <div class="title mb-25">
                                    <h5><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_location_heading') ?></h5>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_location'))) : ?>
                                <div class="overview-content">
                                    <?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_location') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="single-item mb-50" id="car-calculator">
                        <div class="car-calculator">
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_car_loan_heading'))) : ?>
                                <div class="title mb-25">
                                    <h5><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_car_loan_heading') ?></h5>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_location'))) : ?>
                                <div class="overview-content">
                                    <div id="form-wrapper">
                                        <form id="calculate-loan" method="post" action="">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="inner-part">
                                                        <label for="vehicle_value"><?php echo esc_html__('Price:', 'drivco') ?></label>
                                                        <div class="with-currency">
                                                            <input type="text" id="currency" value="<?php echo \Egns\Helper\Egns_Helper::egns_vehicle_product_value('vehicle_currency_selector'); ?>" disabled>
                                                            <input type="hidden" name="tour_post_id" id="currency" value="<?php echo get_the_ID() ?>">
                                                            <input type="text" id="vehicle_value" name="vehicle_value" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="inner-part">
                                                        <label for="interest_rate"><?php echo esc_html__('Interest Rate(%):', 'drivco') ?></label>
                                                        <input type="text" min="1" max="100" id="interest_rate" name="interest_rate" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="inner-part">
                                                        <label for="months"><?php echo esc_html__('Loan Term (months):', 'drivco') ?></label>
                                                        <input type="text" step="1" id="months" name="months" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="inner-part">
                                                    <button type="submit" name="submit" value="Submit" class="primary-btn3"><?php echo esc_html__('Calculate', 'drivco') ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="loan-details"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="single-item mb-100" id="faqs">
                        <div class="faq-area">
                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_faqs_heading'))) : ?>
                                <div class="title mb-25">
                                    <h5><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_faqs_heading') ?></h5>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_faqs_items'))) : ?>
                                <div class="faq-wrap">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <?php foreach ((array)Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_faqs_items') as $key => $key_faqs) : ?>
                                            <div class="accordion-item">
                                                <h5 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo esc_attr($key) ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        <?php echo sprintf(__('%s', 'drivco'), $key_faqs['vehicle_faqs_question']) ?>
                                                    </button>
                                                </h5>
                                                <div id="flush-collapse<?php echo esc_attr($key) ?>" class="accordion-collapse collapse <?php echo esc_attr($key) == 0 ? 'show' : '' ?>" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body"><?php echo sprintf(__('%s', 'drivco'), $key_faqs['vehicle_faqs_answer']) ?></div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <?php if (comments_open() || get_comments_number()) { ?>
                        <div class="single-item" id="qus-ans">
                            <div class="user-qustion-area">
                                <?php
                                //If comments are open or we have at least one comment, load up the comment template.
                                if (comments_open() || get_comments_number()) {
                                    comments_template();
                                }
                                ?>
                            </div>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="car-details-sidebar">
                    <?php if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_auction_or_not') == 'auction_product') : ?>

                        <?php
                        if (class_exists('WooCommerce')) {

                            $auction_product_id = Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_product');
                            $_product = wc_get_product($auction_product_id);
                        }

                        if ($_product && method_exists($_product, 'get_price_html')) {
                            if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_auction_or_not') == 'auction_product'  &&  class_exists('WooCommerce') && class_exists('WooCommerce_simple_auction') && !empty(Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_product')) && $_product->is_type('auction')) : ?>
                                <div class="auction-info mb-50">
                                    <?php
                                    $auction_product_id = Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_product');

                                    //HERE we print the notices
                                    wc_print_notices();

                                    $_product = wc_get_product($auction_product_id);
                                    // echo "<pre>";
                                    // print_r($_product);
                                    // echo "</pre>";

                                    ?>

                                    <div class="auction-time" id="countdown"><?php echo apply_filters('time_text', esc_html__('Time Left:', 'drivco'), $auction_product_id); ?>
                                        <div class="main-auction auction-time-countdown" data-time="<?php echo esc_attr($_product->get_seconds_remaining()) ?>" data-auctionid="<?php echo esc_attr($auction_product_id); ?>" data-format="<?php echo get_option('simple_auctions_countdown_format') ?>"></div>
                                    </div>
                                    <?php
                                    // get current price
                                    echo sprintf('%s', $_product->get_price_html());

                                    ?>

                                    <?php
                                    $gmt_offset = get_option('gmt_offset') > 0 ? '+' . get_option('gmt_offset') : get_option('gmt_offset');
                                    $dateformat = get_option('date_format');
                                    $timeformat = get_option('time_format');

                                    if ($_product->get_type() !== 'auction') {
                                        return;
                                    }
                                    if (($_product->is_closed() === false) && ($_product->is_started() === true)) : ?>
                                        <p class="auction-end">
                                            <?php echo apply_filters('time_left_text', esc_html__('Auction ends:', 'drivco'), $_product); ?> <span><?php echo date_i18n($dateformat, strtotime($_product->get_auction_end_time())); ?> <?php echo date_i18n($timeformat, strtotime($_product->get_auction_end_time())); ?></span>
                                        </p>
                                        <p class="auction-end">
                                            <?php printf(esc_html__('TIMEZONE: %s', 'drivco'), get_option('timezone_string') ? get_option('timezone_string') : esc_html__('UTC ', 'drivco') . $gmt_offset); ?>
                                        </p>
                                    <?php
                                    elseif (($_product->is_closed() === false) && ($_product->is_started() === false)) :
                                    ?>
                                        <p class="auction-starts"><?php echo apply_filters('time_text', esc_html__('Auction starts:', 'drivco'), $_product->get_id()); ?> <?php echo date_i18n($dateformat, strtotime($_product->get_auction_start_time())); ?> <?php echo date_i18n($timeformat, strtotime($_product->get_auction_start_time())); ?></p>
                                        <p class="auction-end"><?php echo apply_filters('time_text', esc_html__('Auction ends:', 'drivco'), $_product->get_id()); ?> <?php echo date_i18n($dateformat, strtotime($_product->get_auction_end_time())); ?> <?php echo date_i18n($timeformat, strtotime($_product->get_auction_end_time())); ?> </p>
                                    <?php
                                    endif;
                                    ?>
                                    <p class="auction-condition">
                                        <?php echo apply_filters('conditiond_text', esc_html__('Item condition', 'drivco'), $_product); ?>:
                                        <span class="curent-bid"><?php esc_html_e($_product->get_condition(), 'drivco') ?></span>
                                    </p>
                                    <form class="auction_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo esc_attr($auction_product_id); ?>">
                                        <?php do_action('woocommerce_before_bid_button'); ?>
                                        <input type="hidden" name="bid" value="<?php echo esc_attr($auction_product_id); ?>" />
                                        <div class="quantity buttons_added">
                                            <input type="button" value="-" class="minus" />
                                            <input type="text" name="bid_value" data-auction-id="<?php echo esc_attr($auction_product_id); ?>" <?php if ($_product->get_auction_sealed() != 'yes') { ?> value="<?php echo esc_attr(number_format($_product->bid_value(), wc_get_price_decimals() == 0 ? 2 : wc_get_price_decimals(), wc_get_price_decimal_separator(), wc_get_price_thousand_separator())); ?>" <?php } ?> <?php if ($_product->get_auction_sealed() != 'yes') {
                                                                                                                                                                                                                                                                                                                                                                                                                                if ($_product->get_auction_type() == 'reverse') { ?> max="<?php echo esc_attr(number_format($_product->bid_value(), wc_get_price_decimals(), wc_get_price_decimal_separator(), wc_get_price_thousand_separator())); ?>" <?php } else { ?> min="<?php echo esc_attr(number_format($_product->bid_value(), wc_get_price_decimals(), wc_get_price_decimal_separator(), wc_get_price_thousand_separator())); ?>" <?php } ?> <?php } ?> step="any" size="<?php echo strlen($_product->get_curent_bid()) + 2; ?>" title="bid" class="input-text qty bid text left" />
                                            <input type="button" value="+" class="plus" />
                                        </div>
                                        <button type="submit" class="bid_button button alt primary-btn3">
                                            <?php echo apply_filters('bid_text', esc_html__('Place Bids', 'drivco'), $_product); ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                <path d="M12.3195 5.44834C12.4414 5.32646 12.6395 5.32646 12.7613 5.44834C12.8835 5.57053 12.8835 5.76834 12.7613 5.89021C12.6395 6.0124 12.4413 6.0124 12.3195 5.89021C12.1973 5.76834 12.1973 5.57053 12.3195 5.44834ZM8.08753 13.9912C7.94975 13.8046 7.87528 13.5798 7.87528 13.3434C7.87528 12.7403 8.36591 12.2497 8.969 12.2497H14.2813C14.5736 12.2497 14.8483 12.3634 15.0547 12.5699C15.2613 12.7764 15.375 13.0511 15.375 13.3434C15.3752 13.5764 15.3006 13.8034 15.1621 13.9909C15.6597 14.2525 16 14.7744 16 15.3745V15.687C16 15.8596 15.8601 15.9995 15.6875 15.9995H7.56281C7.39025 15.9995 7.25031 15.8596 7.25031 15.687V15.3745C7.25031 14.7747 7.59031 14.253 8.08753 13.9912ZM14.6128 13.0118C14.5694 12.9681 14.5177 12.9335 14.4608 12.91C14.4039 12.8864 14.3429 12.8744 14.2813 12.8746H8.969C8.71053 12.8746 8.50028 13.0849 8.50028 13.3433C8.50028 13.4686 8.54903 13.5863 8.63753 13.6748C8.68097 13.7185 8.73263 13.7531 8.78954 13.7767C8.84644 13.8002 8.90745 13.8122 8.96903 13.8121H14.2813C14.5398 13.8121 14.75 13.6018 14.75 13.3433C14.75 13.2181 14.7013 13.1003 14.6128 13.0118ZM15.375 15.3745C15.375 14.8576 14.9545 14.4371 14.4376 14.4371H8.81275C8.29584 14.4371 7.87528 14.8576 7.87528 15.3745H15.375Z"></path>
                                                <path d="M0.290648 13.1288C0.396773 12.9644 0.523397 12.8189 0.667054 12.6966L2.12721 11.423C2.13878 11.4056 2.15207 11.3894 2.16687 11.3746C2.19155 11.35 2.22017 11.3297 2.25155 11.3146L3.13458 10.5445L7.22177 6.97912C7.05446 6.80422 6.96233 6.5755 6.96233 6.33228C6.96233 6.08172 7.05987 5.84625 7.23715 5.669C7.31241 5.59379 7.40005 5.53209 7.49624 5.48659L7.11812 5.10847C7.01276 5.13657 6.90419 5.15084 6.79515 5.15094C6.47512 5.15091 6.15505 5.02909 5.91143 4.78547C5.67524 4.54931 5.54518 4.23541 5.54518 3.90156C5.54518 3.56772 5.67524 3.25381 5.9114 3.01766L8.5629 0.366219C8.79905 0.130062 9.11299 0 9.44693 0C9.78071 0 10.0946 0.130062 10.3307 0.366219C10.6571 0.692594 10.7645 1.156 10.6537 1.57294L14.4263 5.34556C14.5319 5.31746 14.6406 5.30322 14.7499 5.30322C15.0839 5.30322 15.3976 5.43319 15.6336 5.66912C16.121 6.1565 16.121 6.94953 15.6336 7.43694L12.9821 10.0884C12.7384 10.3321 12.4183 10.454 12.0982 10.454C11.7781 10.454 11.458 10.3321 11.2143 10.0884C10.8879 9.76203 10.7805 9.29865 10.8913 8.88172L10.514 8.50434C10.468 8.60027 10.406 8.68767 10.3306 8.76281C10.1536 8.93987 9.91818 9.03741 9.66768 9.03741C9.42471 9.03741 9.19608 8.94544 9.02093 8.77831L4.66762 13.78C4.65562 13.7987 4.64162 13.8166 4.62524 13.833C4.61965 13.8386 4.61371 13.8437 4.6078 13.8487L3.31059 15.3392C3.27796 15.3776 3.24376 15.4148 3.20809 15.4504C2.8518 15.8066 2.38121 15.9999 1.88715 15.9999C1.80005 15.9999 1.71215 15.9939 1.62412 15.9817C1.03571 15.9002 0.52718 15.5482 0.228992 15.0158C-0.0976639 14.4323 -0.0733509 13.6914 0.290648 13.1288ZM9.88871 0.808156C9.83083 0.749934 9.76198 0.703768 9.68615 0.672329C9.61031 0.64089 9.52899 0.624804 9.4469 0.625C9.36476 0.624779 9.28339 0.640853 9.2075 0.672292C9.13162 0.703731 9.06272 0.74991 9.0048 0.808156L6.3533 3.45962C6.29507 3.51753 6.24891 3.5864 6.21747 3.66227C6.18604 3.73813 6.16996 3.81948 6.17018 3.90159C6.16996 3.98371 6.18604 4.06506 6.21748 4.14093C6.24892 4.21679 6.29509 4.28567 6.35333 4.34356C6.59693 4.58722 6.99337 4.58722 7.23696 4.34356L9.88855 1.69197L9.88871 1.69181C10.1324 1.44819 10.1324 1.05178 9.88871 0.808156ZM11.6562 9.6465C11.8999 9.89019 12.2965 9.89022 12.5402 9.6465L15.1917 6.99503C15.4354 6.75131 15.4354 6.35481 15.1917 6.11106C15.0738 5.99316 14.9169 5.92822 14.7499 5.92822C14.5829 5.92822 14.4261 5.99312 14.3082 6.11094L11.6563 8.76287C11.4126 9.00647 11.4126 9.4029 11.6562 9.6465ZM10.3406 7.44712L11.2143 8.32094L13.8661 5.66919L10.3307 2.13372L7.67896 4.78547L8.55433 5.66087C8.55718 5.66356 8.55996 5.66619 8.56296 5.66916L10.3298 7.436C10.3334 7.43959 10.337 7.44334 10.3406 7.44712ZM9.22474 8.09903L9.22658 8.10087L9.44665 8.32094C9.47562 8.35005 9.51007 8.37312 9.54801 8.38883C9.58596 8.40453 9.62664 8.41256 9.66771 8.41244C9.70877 8.41256 9.74946 8.40453 9.7874 8.38882C9.82534 8.37311 9.85978 8.35002 9.88874 8.3209C9.91789 8.29192 9.94099 8.25745 9.95672 8.21948C9.97245 8.1815 9.98048 8.14079 9.98037 8.09969C9.98037 8.01787 9.94915 7.94091 9.89249 7.88284L8.11746 6.10781C7.9958 5.9895 7.79912 5.99097 7.6789 6.11106C7.64976 6.14005 7.62666 6.17452 7.61094 6.2125C7.59522 6.25047 7.58718 6.29118 7.5873 6.33228C7.58717 6.37334 7.5952 6.41401 7.61093 6.45194C7.62666 6.48986 7.64977 6.52428 7.67893 6.55319L7.89771 6.77197C7.89921 6.77344 7.9007 6.77493 7.90218 6.77644L9.22474 8.09903ZM8.57762 8.33575L7.6643 7.42244L3.79737 10.7954L5.20843 12.2065L8.57762 8.33575ZM4.79715 12.6791L3.3253 11.2072L2.85321 11.619L4.38587 13.1517L4.79715 12.6791ZM0.774273 14.7105C0.97596 15.0706 1.31693 15.3082 1.70977 15.3626C2.10171 15.4169 2.4868 15.2878 2.76624 15.0085C2.7901 14.9846 2.81294 14.9598 2.83471 14.9341L2.83774 14.9305L3.97462 13.6242L2.38115 12.0307L1.07646 13.1687L1.07346 13.1713C0.975804 13.2544 0.889148 13.3541 0.815617 13.468C0.579304 13.8332 0.562741 14.3326 0.774273 14.7105Z"></path>
                                                <path d="M10.1099 3.2385C10.232 3.11646 10.4298 3.11646 10.5518 3.2385L11.8777 4.56437C11.9997 4.6864 11.9997 4.88428 11.8777 5.00628C11.8487 5.03534 11.8143 5.05839 11.7764 5.0741C11.7384 5.0898 11.6978 5.09786 11.6567 5.09781C11.6157 5.09786 11.5751 5.08979 11.5371 5.07409C11.4992 5.05838 11.4648 5.03533 11.4358 5.00628L10.1099 3.6804C9.98787 3.5584 9.98787 3.36056 10.1099 3.2385Z"></path>
                                            </svg>
                                        </button>
                                        <input type="hidden" name="place-bid" value="<?php echo esc_attr($auction_product_id); ?>" />
                                        <input type="hidden" name="product_id" value="<?php echo esc_attr($auction_product_id); ?>" />
                                        <?php if (is_user_logged_in()) { ?>
                                            <input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>" />
                                        <?php } ?>
                                        <?php do_action('woocommerce_after_bid_button'); ?>
                                    </form>
                                </div>
                        <?php endif;
                        } ?>
                    <?php else : ?>
                        <div class="contact-info mb-50">
                            <?php if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_contact_label') ?? '') : ?>
                                <div class="single-contact" id="phoneNumber" data-phone="<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_contact_number') ?>">
                                    <a><i class='<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_contact_icon', 'url') ?>'></i><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_contact_label') ?></a>
                                </div>
                            <?php endif ?>
                            <?php if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_email_label') ?? '') : ?>
                                <div class="single-contact" id="emailAdress" data-email="<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_contact_email') ?>">
                                    <a><i class='<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_email_icon', 'url') ?>'></i><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_email_label') ?></a>
                                </div>
                            <?php endif ?>
                            <?php if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_whatsapp_label') ?? '') : ?>
                                <div class="single-contact" id="emailAdresss" data-whatsapp="<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_whatsapp_number') ?>" data-emails="<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_whatsapp_link', 'url') ?>">
                                    <a><i class='<?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_whatsapp_icon', 'url') ?>'></i><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_whatsapp_label') ?></a>
                                </div>
                            <?php endif ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty(\Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_contact_form_shortcode')) && \Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_inquiry_switcher') == 1) : ?>
                        <div class="inquiry-form mb-50">
                            <div class="title">
                                <?php if (!empty(\Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_contact_form_heading'))) : ?>
                                    <h4><?php echo \Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_contact_form_heading') ?></h4>
                                <?php endif; ?>
                                <?php if (!empty(\Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_contact_form_subheading'))) : ?>
                                    <p><?php echo \Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_contact_form_subheading') ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty(\Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_contact_form_shortcode'))) : ?>
                                <?php echo do_shortcode(\Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_contact_form_shortcode')) ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>


                    <?php if (\Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_rightside_recent_product') == true) : ?>
                        <div class="recent-car-area">
                            <div class="title mb-30">
                                <h5><?php echo esc_html__('Recent Vehicles', 'drivco') ?></h5>
                            </div>

                            <?php
                            $terms = get_the_terms(get_the_ID(), 'vehicle-category');

                            // Get the slug from the term object
                            function collect_terms($ids)
                            {
                                $taxonomy = wp_get_object_terms(get_the_ID(), 'vehicle-category');

                                foreach ($taxonomy as $cat) {
                                    $ids = $cat->slug;
                                    return $ids;
                                }
                            }
                            $ids = '';

                            $term_query = new WP_Query(array(
                                'post_type' => 'vehicle',
                                'posts_per_page' => 4,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'vehicle-category',
                                        'field' => 'slug',
                                        'terms' => collect_terms($ids),
                                    )
                                ),
                            ));

                            ?>
                            <ul class="nav nav-tabs" id="myTab6" role="tablist">
                                <?php foreach ((array) $terms as $key => $term) :
                                    if ($key <= 2 && !empty($term)) :
                                ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link <?php echo esc_attr($key) == 0 ? 'active' : '' ?>" id="new-car-tab" data-bs-toggle="tab" data-bs-target="#new-car<?php echo esc_attr($key) ?>" type="button" role="tab" aria-controls="new-car" aria-selected="true"><?php echo sprintf(__('%s', 'drivco'), $term->name) ?></button>
                                        </li>
                                <?php endif;
                                endforeach; ?>
                            </ul>
                            <div class="tab-content" id="myTab6Content">

                                <?php
                                $key2 = 0;
                                while ($term_query->have_posts()) :
                                    $term_query->the_post();

                                ?>
                                    <div class="tab-pane fade <?php echo esc_attr($key2) == 0 ? 'show active' : '' ?>" id="new-car<?php echo esc_attr($key2) ?>" role="tabpanel" aria-labelledby="new-car-tab">
                                        <div class="product-st-card1 two">
                                            <div class="product-img">
                                                <div class="product-price">
                                                    <span>
                                                        <?php echo \Egns\Helper\Egns_Helper::get_vehicle_price() ?>
                                                    </span>
                                                </div>
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <div class="car-img">
                                                        <?php the_post_thumbnail() ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="product-content">
                                                <h6><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h6>
                                                <ul class="features">
                                                    <li>
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/home4/icon/menual.svg') ?>" alt="<?php esc_html__('feature-img', 'drivco') ?>">
                                                        <?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_milage_info_value') ?>
                                                    </li>
                                                    <li>
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/home4/icon/fuel.svg')  ?>" alt="<?php esc_html__('feature-img', 'drivco') ?>">
                                                        <?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_type_info_value') ?>
                                                    </li>
                                                    <li>
                                                        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/home4/icon/electric.svg')  ?>" alt="<?php esc_html__('feature-img', 'drivco') ?>">
                                                        <?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_engine_info_value') ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                    $key2++;
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (\Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_sidebar_banner') ?? '') : ?>
                        <div class="side-banner mt-50">
                            <?php foreach ((array)\Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_sidebar_banner') as $item) : ?>
                                <a href="<?php echo esc_url($item['vehicle_banner_image_link']['url']) ?>"><img src="<?php echo esc_url($item['vehicle_banner_image']['url']) ?>" alt=""></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Car-Details section -->