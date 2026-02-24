<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header('shop');

// For increment,dicrement 
if (class_exists('WooCommerce')) {
	if (is_product() && is_single()) {
		function drivco_set_product_quantity($args, $product)
		{
			$args['input_value'] = 0;

			return $args;
		}
		add_filter('woocommerce_quantity_input_args', 'drivco_set_product_quantity', 10, 2);
	}

	add_filter('woocommerce_reset_variations_link', '__return_empty_string', 9999);
}

// Include breadcrumb template
Egns\Helper\Egns_Helper::egns_template_part('breadcrumb', 'templates/breadcrumb-single');
?>


<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action('woocommerce_before_main_content');
?>
<div class="single-product sec-mar">
	<div class="container">
		<div class="row">

			<?php while (have_posts()) : ?>
				<?php the_post(); ?>

				<?php wc_get_template_part('content', 'single-product'); ?>

			<?php endwhile; // end of the loop. 
			?>
		</div><!-- End row -->
	</div><!-- End container -->
</div><!-- End single-product -->
<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
