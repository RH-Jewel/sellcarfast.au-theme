<?php

/**
 * Remove WooCommerce breadcrumbs 
 */
function drivco_remove_breadcrumbs()
{
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
}
add_action('init', 'drivco_remove_breadcrumbs');


/**
 * Shop page product column
 */
if (class_exists('CSF')) {

    function wc_loop_shop_columns($number_columns)
    {
        return \Egns\Helper\Egns_Helper::egns_get_theme_option('shop_column');
    }
    add_filter('loop_shop_columns', 'wc_loop_shop_columns', 1, 10);
} else {
    function wc_loop_shop_columns($number_columns)
    {
        return 4;
    }
    add_filter('loop_shop_columns', 'wc_loop_shop_columns', 1, 10);
}


/**
 * Change the Number of WooCommerce Products Displayed Per Page
 */
function lw_loop_shop_per_page($products)
{
    $products = 12;
    return $products;
}
add_filter('loop_shop_per_page', 'lw_loop_shop_per_page', 30);

/**
 * WooCommerce product archive page title link add
 */
function astripChangeProductsTitle()
{
?>
    <h2 class="woocommerce-loop-product__title"><a href="<?php echo esc_url(get_the_permalink()) ?>"><?php echo get_the_title(); ?></a></h2>
    <?php
}
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'astripChangeProductsTitle', 10);

/**
 * Change rating position archive page
 */

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 6);


/**
 * Change rating position single page
 */

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 21);


/**
 * Change rating position single page
 */

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 1);


/**
 * Change cart button position archive page
 */

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10);

/**
 * Remove notice archive page
 */

remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);

/**
 * Change rating position comment form single page
 */

remove_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10);
add_action('woocommerce_review_meta', 'woocommerce_review_display_rating', 11);

/**
 * WooCommerce Single Product Page Add new tab
 */

function woo_new_product_tab($tabs)
{

    $tabs['new_tab'] = array(
        'title'     => \Egns\Helper\Egns_Helper::egns_product_tab_value('product_tab_heading'),
        'priority'     => 50,
        'callback'     => 'woo_new_product_tab_content'
    );

    return $tabs;
}
add_filter('woocommerce_product_tabs', 'woo_new_product_tab');


/**
 *Swap "Regular price" and "Sale price"
 */
function swap_sale_regular_price($price, $regular_price, $sale_price)
{
    $price = '<ins>' . (is_numeric($sale_price) ? wc_price($sale_price) : $sale_price) . '</ins><del aria-hidden="true">' . (is_numeric($regular_price) ? wc_price($regular_price) : $regular_price) . '</del>';
    return $price;
}
add_filter('woocommerce_format_sale_price', 'swap_sale_regular_price', 10, 3);


/**
 * WooCommerce Single Product Page Add new tab content
 */
function woo_new_product_tab_content()
{
    if (!empty(\Egns\Helper\Egns_Helper::egns_product_tab_value('product_tab_heading'))) :
    ?>

        <div class="addithonal-information">
            <?php if (!empty(\Egns\Helper\Egns_Helper::egns_product_tab_value('product_tab_content'))) : ?>
                <table class="table total-table2">
                    <tbody>
                        <?php foreach ((array)\Egns\Helper\Egns_Helper::egns_product_tab_value('product_tab_content') as $items) : ?>
                            <tr>
                                <td><?php echo sprintf(__('%s', 'drivco'), $items['product_tab_content_label']) ?></td>
                                <td><?php echo sprintf(__('%s', 'drivco'), $items['product_tab_content_value']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2><?php echo esc_html__('No content found', 'drivco') ?></h2>
            <?php endif; ?>
        </div>


<?php
    endif;
}

//theme option value
$sale = \Egns\Helper\Egns_Helper::egns_get_theme_option('flash_sale_percentage');
if (!$sale == 0) {
    /**
     * woocommerce sale badge percentage
     * 
     * Woocommerce Discount Percentage on the Sale Badge for variable products and single products
     */
    function display_percentage_on_sale_badge($html, $post, $product)
    {

        if ($product->is_type('variable')) {
            $percentages = array();

            // This will get all the variation prices and loop throughout them
            $prices = $product->get_variation_prices();

            foreach ($prices['price'] as $key => $price) {
                // Only on sale variations
                if ($prices['regular_price'][$key] !== $price) {
                    // Calculate and set in the array the percentage for each variation on sale
                    $percentages[] = round(100 - (floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100));
                }
            }
            // Displays maximum discount value
            $percentage = max($percentages) . '%';
        } elseif ($product->is_type('grouped')) {
            $percentages = array();

            // This will get all the variation prices and loop throughout them
            $children_ids = $product->get_children();

            foreach ($children_ids as $child_id) {
                $child_product = wc_get_product($child_id);

                $regular_price = (float) $child_product->get_regular_price();
                $sale_price    = (float) $child_product->get_sale_price();

                if ($sale_price != 0 || !empty($sale_price)) {
                    // Calculate and set in the array the percentage for each child on sale
                    $percentages[] = round(100 - ($sale_price / $regular_price * 100));
                }
            }
            // Displays maximum discount value
            $percentage = max($percentages) . '%';
        } else {
            $regular_price = (float) $product->get_regular_price();
            $sale_price    = (float) $product->get_sale_price();

            if ($sale_price != 0 || !empty($sale_price)) {
                $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
            } else {
                return $html;
            }
        }
        return '<span class="onsale">' . esc_html__('-', 'drivco') . ' ' . $percentage . '</span>'; // If needed then change or remove "up to -" text
    }
    add_filter('woocommerce_sale_flash', 'display_percentage_on_sale_badge', 20, 3);
}


// 1. Show plus minus buttons
function astrip_display_quantity_plus()
{
    echo '<button type="button" class="plus"><i class="bi bi-plus-lg"></i></button>';
}
add_action('woocommerce_after_quantity_input_field', 'astrip_display_quantity_plus');

function astrip_display_quantity_minus()
{
    echo '<button type="button" class="minus"><i class="bi bi-dash-lg"></i></button>';
}
add_action('woocommerce_before_quantity_input_field', 'astrip_display_quantity_minus');

if (class_exists('WooCommerce', false)) {
    // 2. Trigger update quantity script
    function astrip_add_cart_quantity_plus_minus()
    {

        if (!is_product() && !is_cart()) return;
        wc_enqueue_js("
            $(document).on( 'click', 'button.plus, button.minus', function() {
                var qty = $( this ).parent( '.quantity' ).find( '.qty' );
                var val = parseFloat(qty.val());
                var max = parseFloat(qty.attr( 'max' ));
                var min = parseFloat(qty.attr( 'min' ));
                var step = parseFloat(qty.attr( 'step' ));

                if ( $( this ).is( '.plus' ) ) {
                if ( max && ( max <= val ) ) {
                qty.val( max ).change();
                } else {
                qty.val( val + step ).change();
                }
                } else {
                if ( min && ( min >= val ) ) {
                qty.val( min ).change();
                } else if ( val > 1 ) {
                qty.val( val - step ).change();
                }
                }
                });

        ");
    }

    add_action('wp_footer', 'astrip_add_cart_quantity_plus_minus');
}


/**
 * Exclude auction product from shop page
 * 
 * @param object $q data
 *
 */
function show_active_lotteries_only($q)
{
    if ($q->is_main_query() && !is_admin() && $q->is_post_type_archive('product')) {
        if (is_shop()) {
            $tax_query = array(
                array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => 'auction',
                    'operator' => 'NOT IN'
                )
            );
            $q->set('tax_query', $tax_query);
        }
    }
}
add_action('pre_get_posts', 'show_active_lotteries_only');


/**
 * Display post per page for custom post type
 * 
 * @param object $query data
 *
 */
function egns_custom_type_archive_display($query)
{
    if (is_post_type_archive('vehicle')) {
        $query->set('posts_per_page', \Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_posts_per_page'));
        return;
    }
}
add_action('pre_get_posts', 'egns_custom_type_archive_display');
