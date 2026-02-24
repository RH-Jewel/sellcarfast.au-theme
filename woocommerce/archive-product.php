<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');
// Include breadcrumb template
Egns\Helper\Egns_Helper::egns_template_part('breadcrumb', 'templates/breadcrumb-shop');
?>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>

<div class="container mb-50 mt-100">
	<div class="row">
		<div class="col-12">
			<div class="before-shop-loop">
				<?php
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked woocommerce_output_all_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action('woocommerce_before_shop_loop');
				?>
			</div>
		</div> <!-- before_shop_loop -->

		<?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('woo_sidebar'))) : ?>
			<div class="col-lg-3">
				<?php if (is_active_sidebar('shop_sidebar')) : ?>
					<div class="product-sidebar">
						<?php dynamic_sidebar('shop_sidebar') ?>
					</div>
				<?php endif; ?>
			</div> <!-- End product sidebar col-xl-3  -->
		<?php endif; ?>

		<div class="<?php echo is_active_sidebar('shop_sidebar') && !empty(\Egns\Helper\Egns_Helper::egns_get_theme_option('woo_sidebar'))  ? 'col-lg-9' : 'col-lg-12' ?>">
			<?php
			if (woocommerce_product_loop()) {

				woocommerce_product_loop_start();

				if (wc_get_loop_prop('total')) {
					while (have_posts()) {
						the_post();

						/**
						 * Hook: woocommerce_shop_loop.
						 */
						do_action('woocommerce_shop_loop');

						wc_get_template_part('content', 'product');
					}
				}

				woocommerce_product_loop_end();

				/**
				 * Hook: woocommerce_after_shop_loop.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action('woocommerce_after_shop_loop');
			} else {
				/**
				 * Hook: woocommerce_no_products_found.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action('woocommerce_no_products_found');
			}
			?>
		</div><!-- End product loop col-xl-9  -->

	</div><!-- End row -->
</div><!-- End container -->

<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');



get_footer('shop');
