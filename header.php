<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')) ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>itemtype="https://schema.org/WebPage">

	<?php
	// Hook to include default WordPress hook after body tag open
	if (function_exists('wp_body_open')) {
		wp_body_open();
	}
	$enable_breadcrumb_by_theme = Egns\Helper\Egns_Helper::egns_get_theme_option('breadcrumb_enable');
	$breadcrumb_enable_by_page = Egns\Helper\Egns_Helper::egns_page_option_value('breadcrumb_enable_page');
	$get_page_layout = !empty(get_post_meta(get_the_ID(), '_wp_page_template')[0]) ? get_post_meta(get_the_ID(), '_wp_page_template')[0] : '';
	?>
	<!-- app -->
	<div id="app" class="<?php echo Egns\Helper\Egns_Helper::is_enabled($enable_breadcrumb_by_theme, $breadcrumb_enable_by_page) && $get_page_layout !== 'elementor_header_footer' ? 'inner-page-header' : '' ?>">
		<?php
		// Hook to include page header template
		do_action('egns_action_page_header_template'); ?>