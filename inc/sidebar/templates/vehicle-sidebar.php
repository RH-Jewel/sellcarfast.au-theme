<?php
// Get minimum and Maximum price from woocommerce
$args = array(
    'post_type'      => 'vehicle',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'fields'         => 'ids',
);
$product_ids = get_posts($args);
$min_price = PHP_INT_MAX;
$max_price = 0;
foreach ($product_ids as $product_id) {
    $price = get_post_meta($product_id, 'vehicle_actual_price', true);
    if ($price < $min_price) {
        $min_price = $price;
    }
    if ($price > $max_price) {
        $max_price = $price;
    }
}

?>
<div class="col-xl-4 order-xl-1 order-2">

    <div class="product-sidebar">
        <?php
        if (is_active_sidebar('vehicle_sidebar')) {
        ?>
            <div class="product-widget mb-20">
                <?php dynamic_sidebar('vehicle_sidebar'); ?>
            </div>
        <?php
        }
        ?>
        <?php
        $brands = get_terms('vehicle-brand');
        ?>
        <?php if (count($brands) > 0) : ?>
            <div class="product-widget mb-20">
                <div class="check-box-item">
                    <h6 class="product-widget-title mb-20"><?php echo esc_html__('Brand', 'drivco') ?></h6>
                    <div class="checkbox-container">
                        <ul>
                            <?php foreach ($brands as $brand) : ?>
                                <li>
                                    <label class="containerss">
                                        <input type="checkbox" value="<?php echo sprintf(__('%s', 'drivco'), $brand->name) ?? '' ?>" class="brand_checkbox">
                                        <span class="checkmark"></span>
                                        <span class="text"><?php echo sprintf(__('%s', 'drivco'), $brand->name) ?? '' ?></span>
                                        <span class="qty">(<?php echo sprintf(__('%s', 'drivco'), $brand->count) ?? '' ?>)</span>
                                    </label>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php
        $years = get_terms('vehicle-year');
        ?>
        <?php if (count($years) > 0) : ?>
            <div class="product-widget mb-20">
                <div class="check-box-item">
                    <h6 class="product-widget-title mb-20"><?php echo esc_html__('Vehicle Year', 'drivco') ?></h6>
                    <div class="checkbox-container">
                        <ul>
                            <?php foreach ($years as $year) : ?>
                                <li>
                                    <label class="containerss">
                                        <input type="checkbox" value="<?php echo sprintf(__('%s', 'drivco'), $year->name) ?? '' ?>" class="year_checkbox">
                                        <span class="checkmark"></span>
                                        <span class="text"><?php echo sprintf(__('%s', 'drivco'), $year->name) ?? '' ?></span>
                                        <span class="qty">(<?php echo sprintf(__('%s', 'drivco'), $year->count) ?? '' ?>)</span>
                                    </label>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php
        $body_type = get_terms('body-type');
        ?>
        <?php if (!empty($body_type) && count($body_type) > 0) : ?>
            <div class="product-widget mb-20">
                <div class="check-box-item">
                    <h6 class="product-widget-title mb-20"><?php echo esc_html__('Body Type', 'drivco') ?></h6>
                    <div class="checkbox-container">
                        <ul>
                            <?php foreach ($body_type as $type) : ?>
                                <li>
                                    <label class="containerss">
                                        <input type="checkbox" class="body_type_checkbox" value="<?php echo sprintf(__('%s', 'drivco'), $type->name) ?? '' ?>">
                                        <span class="checkmark"></span>
                                        <span class="text"><?php echo sprintf(__('%s', 'drivco'), $type->name) ?? '' ?></span>
                                        <span class="qty">(<?php echo sprintf(__('%s', 'drivco'), $type->count) ?? '' ?>)</span>
                                    </label>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div class="product-widget mb-20">
            <div class="check-box-item">
                <h6 class="product-widget-title mb-25"><?php echo esc_html__('Price', 'drivco') ?></h6>
                <div class="range-wrapper">
                    <div class="slider-wrapper">
                        <div id="eg-range-slider"></div>
                    </div>
                    <div class="valus">
                        <div class="min-value">
                            <?php if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_price_currency')) : ?>
                                <span><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_price_currency') ?></span>
                            <?php endif; ?>
                            <input readonly type="number" min=<?php echo sprintf(('%d'), $min_price) ?> max="<?php echo sprintf(('%d'), $max_price) ?>" oninput="validity.valid||(value='<?php echo sprintf(('%d'), $min_price) ?>');" id="min_price" class="from" />
                        </div>
                        <div class="min-value">
                            <?php if (Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_price_currency')) : ?>
                                <span><?php echo Egns_Core\Egns_Helper::egns_vehicle_product_value('vehicle_bidding_price_currency') ?></span>
                            <?php endif; ?>
                            <input readonly type="number" min=<?php echo sprintf(('%d'), $min_price) ?> max="<?php echo sprintf(('%d'), $max_price) ?>" oninput="validity.valid||(value='<?php echo sprintf(('%d'), $max_price) ?>');" id="max_price" class="price-range-field" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $colors = get_terms('colors');
        ?>
        <?php if (!empty($colors) && count($colors) > 0) : ?>
            <div class="product-widget mb-20">
                <div class="check-box-item">
                    <h6 class="product-widget-title mb-20"><?php echo esc_html__('Color', 'drivco') ?></h6>
                    <div class="checkbox-container d-flex gap-5">
                        <ul class="color-area">
                            <?php foreach ($colors as $color) : ?>
                                <li>
                                    <label class="containerss">
                                        <input type="checkbox" class="color_checkbox" value="<?php echo sprintf(__('%s', 'drivco'), $color->name) ?? '' ?>">
                                        <span class="checkmark"></span>
                                        <span class="text"><?php echo sprintf(__('%s', 'drivco'), $color->name) ?? '' ?></span>
                                        <span class="qty">(<?php echo sprintf(__('%s', 'drivco'), $color->count) ?? '' ?>)</span>
                                    </label>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php
        $location = get_terms('location');
        ?>
        <?php if (!empty($location) && count($location) > 0) : ?>
            <div class="product-widget mb-20">
                <div class="check-box-item">
                    <h6 class="product-widget-title mb-20"><?php echo esc_html__('Location', 'drivco') ?></h6>
                    <div class="checkbox-container">
                        <ul>
                            <?php foreach ($location as $loc) : ?>
                                <li>
                                    <label class="containerss">
                                        <input type="checkbox" class="location_checkbox" value="<?php echo sprintf(__('%s', 'drivco'), $loc->name) ?? '' ?>">
                                        <span class="checkmark"></span>
                                        <span class="text"><?php echo sprintf(__('%s', 'drivco'), $loc->name) ?? '' ?></span>
                                        <span class="qty">(<?php echo sprintf(__('%s', 'drivco'), $loc->count) ?? '' ?>)</span>
                                    </label>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>