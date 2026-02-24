<?php

namespace Egns\Helper;

use Egns_Helpers as GlobalEgns_Helpers;
use Elementor\Plugin;

if (!class_exists('Egns_Helper')) {

	/**
	 * Helper handlers class
	 */
	class Egns_Helper
	{

		/**
		 * Helper Class constructor
		 */
		function __construct()
		{
			// Before, After page load
			$this->actions();

			// Fire hook to include main header template
			add_action('egns_action_page_header_template', array($this, 'egns_load_page_header'));

			// Ajax hook to include
			add_action('wp_enqueue_scripts', array($this, 'egns_enqueue_scripts'));

			add_filter('post_row_actions',  array($this, 'remove_permalink_row_action'), 10, 2);
			if (self::egns_get_theme_option('rtl_enable')) {
				add_filter('woocommerce_single_product_carousel_options',  array($this, 'woocommerce_carousel_rtl'), 10, 1);
			}
		}


		public function woocommerce_carousel_rtl($data)
		{

			$data['rtl'] = true;
			return $data;
		}


		public function remove_permalink_row_action($actions, $post)
		{
			if ($post->post_type === 'auction-bidding') {
				unset($actions['view']);
			}
			return $actions;
		}


		public function egns_load_page_header()
		{
			// Include header template
			echo apply_filters('egns_filter_header_template', self::egns_header_template());
		}

		/**
		 * Method that echo module template part.
		 *
		 * @param string $module name of the module from inc folder
		 * @param string $template full path of the template to load
		 * @param string $slug
		 * @param array  $params array of parameters to pass to template
		 */
		public static function egns_template_part($module, $template, $slug = '', $params = array())
		{
			echo self::egns_get_template_part($module, $template, $slug, $params);
		}

		/**
		 * Method that load module template part.
		 *
		 * @param string $module name of the module from inc folder
		 * @param string $template full path of the template to load
		 * @param string $slug
		 * @param array  $params array of parameters to pass to template
		 *
		 * @return string - string containing html of template
		 */
		public static function egns_get_template_part($module, $template, $slug = '', $params = array())
		{

			//HTML Content from template
			$html          = '';
			$template_path = EGNS_INC_ROOT_DIR . '/' . $module;

			$temp = $template_path . '/' . $template;
			if (is_array($params) && count($params)) {
				extract($params);
			}

			$template = '';

			if (!empty($temp)) {
				if (!empty($slug)) {
					$template = "{$temp}-{$slug}.php";

					if (!file_exists($template)) {
						$template = $temp . '.php';
					}
				} else {
					$template = $temp . '.php';
				}
			}

			if ($template) {
				ob_start();
				include($template);
				$html = ob_get_clean();
			}

			return $html;
		}

		/**
		 * Method that check file exists or not.
		 *
		 * @param string $module name of the module from inc folder
		 * @param string $template full path of the template to load
		 * @param string $slug
		 *
		 * @return boolean - if exists then return true or false
		 */
		public static function egns_check_template_part($module, $template, $slug = '', $params = array())
		{

			//HTML Content from template
			$html          = '';
			$template_path = EGNS_INC_ROOT_DIR . '/' . $module;

			$temp = $template_path . '/' . $template;
			if (is_array($params) && count($params)) {
				extract($params);
			}

			$template = '';

			if (!empty($temp)) {
				if (!empty($slug)) {
					$template = "{$temp}-{$slug}.php";

					if (!file_exists($template)) {
						return false;
					} else {
						return true;
					}
				} else {
					$template = $temp . '.php';
					if (!file_exists($template)) {
						return false;
					} else {
						return true;
					}
				}
			}
		}

		/**
		 * Method that checks if forward plugin installed
		 *
		 * @param string $plugin - plugin name
		 *
		 * @return bool
		 */
		public static function egns_is_installed($plugin)
		{

			switch ($plugin) {
				case 'egns-core';
					return class_exists('Egns_Core');
					break;
				case 'woocommerce';
					return class_exists('WooCommerce');
					break;
				default:
					return false;
			}
		}


		/**
		 * Overwrite the theme option when page option is available.
		 *
		 * @param mixed theme option value.
		 * @param mixed page option value.
		 * @since   1.2.0
		 * @return bool 
		 */
		public static function is_enabled($theme_option, $page_option)
		{

			if (class_exists('CSF')) {

				if ($theme_option == 1) {

					if ($page_option == 1) {
						return true;
					} elseif (is_singular('vehicle') || is_singular('post') || is_single('post') || self::drivco_is_blog_pages() || is_404()) {
						return true;
					} elseif ($theme_option == 1 && empty($page_option) && $page_option != 0) {
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				return true;
			}
		}





		/**
		 * Get first category with link
		 *
		 * @since   1.2.0
		 */
		public static function the_first_category()
		{
			$categories = get_the_category();
			if (!empty($categories)) {
				echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
			}
		}

		public static function egns_sanitize_array_fields(&$array)
		{
			array_walk_recursive($array, function (&$value) {
				$value = is_string($value) ? sanitize_text_field($value) : $value;
			});
			return $array;
		}

		/**
		 * Option Dynamic Styles (Header)
		 *
		 * @since   1.2.0
		 */
		public function egns_header_template()
		{
			$egns_enable_preloader = self::egns_get_theme_option('preloader_enable');


			if (1 == $egns_enable_preloader) {
				get_template_part('inc/common/templates/preloader'); // Preloader
			}

			$get_header_style 	  	 	= self::egns_get_theme_option('header_menu_style');
			$get_page_header_style 		= self::egns_page_option_value('page_header_menu_style');
			$page_main_header_enable 	= self::egns_page_option_value('page_main_header_enable');
			// Page Header Layout
			if (!empty($page_main_header_enable) && ($page_main_header_enable == 'disable') && class_exists('CSF')) {
				$get_header_style = 'no_header';
			} else {
				if (!empty($get_page_header_style) && $get_page_header_style == 'header_one' && class_exists('CSF')) {
					$get_header_style = 'header_one';
				}
				if (!empty($get_page_header_style) && $get_page_header_style == 'header_two' && class_exists('CSF')) {
					$get_header_style = 'header_two';
				}
				if (!empty($get_page_header_style) && $get_page_header_style == 'header_three' && class_exists('CSF')) {
					$get_header_style = 'header_three';
				}
				if (!empty($get_page_header_style) && $get_page_header_style == 'header_four' && class_exists('CSF')) {
					$get_header_style = 'header_four';
				}
				if (!empty($get_page_header_style) && $get_page_header_style == 'header_five' && class_exists('CSF')) {
					$get_header_style = 'header_five';
				}
			}

			switch ($get_header_style) {
				case 'header_one':
					get_template_part('inc/header/templates/parts/header_one');
					break;
				case 'header_two':
					get_template_part('inc/header/templates/parts/header_two');
					break;
				case 'header_three':
					get_template_part('inc/header/templates/parts/header_three');
					break;
				case 'header_four':
					get_template_part('inc/header/templates/parts/header_four');
					break;
				case 'header_five':
					get_template_part('inc/header/templates/parts/header_five');
					break;
				case 'no_header':
					break;
				default:
					get_template_part('inc/header/templates/parts/header_one');
					break;
			}
		}


		/**
		 * Is Pages
		 *
		 * @since   1.2.0
		 */
		public static function egns_is_blog_pages()
		{
			return ((((is_search()) || (is_404()) || is_archive()) || (is_single()) || (is_singular())  ||  (is_author()) || (is_category()) || (is_home()) || (is_tag()))) ? true : false;
		}

		/**
		 * Is Blog Pages
		 *
		 * @since   1.2.0
		 */
		public static function drivco_is_blog_pages()
		{
			return ((((is_search()) || is_archive()) ||  (is_author()) || (is_category()) || (is_home()) || (is_tag()))) ? true : false;
		}

		/**
		 * Get theme options.
		 *
		 * @param string $opts Required. Option name.
		 * @param string $key Required. Option key.
		 * @param string $default Optional. Default value.
		 * @since   1.2.0
		 */

		public static function egns_get_theme_option($key, $key2 = '', $default = '')
		{
			$egns_theme_options = get_option('egns_theme_options');

			if (!empty($key2)) {
				return	isset($egns_theme_options[$key][$key2]) ? $egns_theme_options[$key][$key2] : $default;
			} else {
				return isset($egns_theme_options[$key]) ? $egns_theme_options[$key] : $default;
			}
		}

		/**
		 * Css Minifier.
		 * @param $css get css
		 * @since   1.2.0
		 */
		public static function cssminifier($css)
		{
			$css = str_replace(
				["\r\n", "\r", "\n", "\t", '    '],
				'',
				preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', trim($css))
			);
			return str_replace(
				['{ ', ' }', ' {', '} ', ' screen and '],
				['{', '}', '{', '}', ''],
				$css
			);
		}

		/**
		 * Return Page Option Value Based on Given Page Option ID.
		 *
		 * @since 1.2.0
		 *
		 * @param string $page_option_key Optional. Page Option id. By Default It will return all value.
		 * 
		 * @return mixed Page Option Value.
		 */
		public static function  egns_page_option_value($key1, $key2 = '', $default = '')
		{

			$page_options = get_post_meta(get_the_ID(), 'egns_page_options', true);

			if (isset($page_options[$key1][$key2])) {

				return $page_options[$key1][$key2];
			} else {
				if (isset($page_options[$key1])) {

					return  $page_options[$key1];
				} else {
					return $default;
				}
			}
		}

		/**
		 * Return Page Option Value Based on Given Page Option ID.
		 *
		 * @since 1.2.0
		 *
		 * @param string $page_option_key Optional. Page Option id. By Default It will return all value.
		 * 
		 * @return mixed Page Option Value.
		 */
		public static function  egns_project_value($key1, $key2 = '', $key3 = '', $default = '')
		{

			$page_options = get_post_meta(get_the_ID(), 'EGNS_PROJECT_META_ID', true);

			if (isset($page_options[$key1][$key2][$key3])) {
				return $page_options[$key1][$key2][$key3];
			} elseif (isset($page_options[$key1][$key2])) {
				return $page_options[$key1][$key2];
			} elseif (isset($page_options[$key1])) {
				return $page_options[$key1];
			} else {
				return $default;
			}
		}

		/**
		 * Return Page Option Value Based on Given Page Option ID.
		 *
		 * @since 1.2.0
		 *
		 * @param string $page_option_key Optional. Page Option id. By Default It will return all value.
		 * 
		 * @return mixed Page Option Value.
		 */
		public static function  egns_product_tab_value($key1, $key2 = '', $key3 = '', $default = '')
		{

			$page_options = get_post_meta(get_the_ID(), 'EGNS_PRODUCT_META_ID', true);

			if (isset($page_options[$key1][$key2][$key3])) {
				return $page_options[$key1][$key2][$key3];
			} elseif (isset($page_options[$key1][$key2])) {
				return $page_options[$key1][$key2];
			} elseif (isset($page_options[$key1])) {
				return $page_options[$key1];
			} else {
				return $default;
			}
		}

		/**
		 * Get Blog layout
		 *
		 * @since   1.2.0
		 */
		public static function egns_post_layout()
		{
			$egns_theme_options = get_option('egns_theme_options');

			$blog_layout = !empty($egns_theme_options['blog_layout_options']) ? $egns_theme_options['blog_layout_options'] : 'default';

			return $blog_layout;
		}

		/**
		 * Escape any String with Translation
		 *
		 * @since   1.2.0
		 */

		public static function egns_translate($value)
		{
			echo sprintf(__('%s', 'drivco'), $value);
		}
		/**
		 * Escape any String with Translation
		 *
		 * @since   1.2.0
		 */

		public static function egns_translate_with_escape_($value)
		{
			$value = esc_html($value);
			echo sprintf(__('%s', 'drivco'), $value);
		}

		/**
		 * Dynamic blog layout for post archive pages.
		 *
		 * @since   1.2.0
		 */
		public static function egns_dynamic_blog_layout()
		{
			$blog_layout = self::egns_post_layout();
			if (!empty($blog_layout)) {
				if ('default' == $blog_layout) {
					get_template_part('template-parts/blog/blog-standard');
				} elseif ($blog_layout == 'layout-01') {
					get_template_part('template-parts/blog/blog-grid-sidebar');
				}
			} else {
				get_template_part('template-parts/blog/blog-standard');
			}
		}

		/**
		 * 
		 * @return [string] audio url for audio post
		 */
		public static function egns_embeded_audio($width, $height)
		{
			$url = esc_url(get_post_meta(get_the_ID(), 'egns_audio_url', 1));
			if (!empty($url)) {
				return '<div class="post-media">' . wp_oembed_get($url, array('width' => $width, 'height' => $height)) . '</div>';
			}
		}

		/**
		 * @return [string] Checks For Embed Audio In The Post.
		 */
		public static function egns_has_embeded_audio()
		{
			$url = esc_url(get_post_meta(get_the_ID(), 'egns_audio_url', 1));
			if (!empty($url)) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Post Meta Box Key Information
		 *
		 * @param  String $meta_key
		 */

		public static function egns_post_meta_box_value($meta_key, $meta_key_value)
		{
			return get_post_meta(get_the_ID(), $meta_key, true)[$meta_key_value];
		}

		/**
		 * Find Related Project
		 *
		 * @param  int $post_id
		 * @param  String $post_type
		 * @param  String $custom_post_taxonomy
		 * 
		 */

		public static function egns_find_related_project($post_id, $post_type, $custom_post_taxonomy)
		{
			//get the taxonomy terms of custom post type
			$customTaxonomyTerms = wp_get_object_terms($post_id, $custom_post_taxonomy, array('fields' => 'ids'));

			//query arguments
			$args = array(
				'post_type' => $post_type,
				'post_status' => 'publish',
				'posts_per_page' => 5,
				'orderby' => 'rand',
				'tax_query' => array(
					array(
						'taxonomy' => $custom_post_taxonomy,
						'field' => 'id',
						'terms' => $customTaxonomyTerms
					)
				),
				'post__not_in' => array($post_id),
			);
			return $args;
		}

		/**
		 * Find Project Categories
		 *
		 * @param  String $custom_post_taxonomy
		 */
		public static function egns_find_project_categories($custom_post_taxonomy)
		{
			$project_categories = get_the_terms(get_the_ID(), $custom_post_taxonomy);
			return $project_categories;
		}

		/**
		 * Find Project Categories By Post ID
		 *
		 * @param  String $post_id
		 * @param  String $custom_post_taxonomy
		 */
		public static function egns_find_project_categories_by_post_id($post_id, $custom_post_taxonomy)
		{
			$project_categories = get_the_terms($post_id, $custom_post_taxonomy);
			return $project_categories;
		}

		/**
		 * Find Project Categories
		 *
		 * @param  String $custom_post_type
		 * @param  String $custom_post_taxonomy
		 * @param  String $order_by
		 * @param  String $order
		 */
		public static function egns_find_all_project_categories($custom_post_type, $custom_post_taxonomy, $order_by = 'name', $order = 'ASC')
		{
			$args = array(
				'type'                     => $custom_post_type,
				'child_of'                 => 0,
				'parent'                   => '',
				'orderby'                  => $order_by,
				'order'                    => $order,
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'taxonomy'                 => $custom_post_taxonomy,
				'pad_counts'               => false
			);
			$categories = get_categories($args);

			return $categories;
		}
		/**
		 * @return [string] Embed gallery for the post.
		 */
		public static function egns_gallery_images()
		{
			$images = get_post_meta(get_the_ID(), 'egns_gallery_images', 1);

			$images = explode(',', $images);
			if ($images && count($images) > 1) {
				$gallery_slide = '<div class="swiper blog-archive-slider">';
				$gallery_slide .= '<div class="swiper-wrapper">';
				foreach ($images as $image) {
					$gallery_slide .= '<div class="swiper-slide"><a href="' . get_the_permalink() . '"><img src="' . wp_get_attachment_image_url($image, 'full') . '" alt="' . esc_attr(get_the_title()) . '"></a></div>';
				}
				$gallery_slide .= '</div>';
				$gallery_slide .= '</div>';

				$gallery_slide .= '<div class="slider-arrows arrows-style-2 sibling-3 text-center d-flex flex-row justify-content-between align-items-center w-100">';
				$gallery_slide .= '<div class="blog1-prev swiper-prev-arrow" tabindex="0" role="button" aria-label="' . esc_html('Previous slide') . '"> <i class="bi bi-arrow-left"></i> </div>';

				$gallery_slide .= '<div class="blog1-next swiper-next-arrow" tabindex="0" role="button" aria-label="' . esc_html('Next slide') . '"><i class="bi bi-arrow-right"></i></div>';
				$gallery_slide .= '</div>';

				return $gallery_slide;
			}
		}

		/**
		 * @return [string] Has Gallery for Gallery post.
		 */
		public static function has_egns_gallery()
		{
			$images = get_post_meta(get_the_ID(), 'egns_gallery_images', 1);
			if (!empty($images)) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * @return string get the attachment image.
		 */
		public static function egns_thumb_image()
		{
			$image = get_post_meta(get_the_ID(), 'egns_thumb_images', 1);
			if ($image ?? '') :
				echo '<a href="' . get_the_permalink() . '"><img src="' . isset($image['url']) . '" alt="' . esc_attr(get_the_title()) . ' "class="img-fluid wp-post-image"></a>';
			endif;
		}

		/**
		 * @return [quote] text for quote post
		 */
		public static function egns_quote_content()
		{
			$text =  get_post_meta(get_the_ID(), 'egns_quote_text', 1);
			if (!empty($text)) {
				return sprintf(esc_attr__("%s", 'drivco'), $text);
			}
		}

		/**
		 * @return [string] video url for video post
		 */
		public static function egns_embeded_video($width = '', $height = '')
		{
			$url = esc_url(get_post_meta(get_the_ID(), 'egns_video_url', 1));
			if (!empty($url)) {
				return wp_oembed_get($url, array('width' => $width, 'height' => $height));
			}
		}

		/**
		 * @return [string] Has embed video for video post.
		 */
		public static function has_egns_embeded_video()
		{
			$url = esc_url(get_post_meta(get_the_ID(), 'egns_video_url', 1));
			if (!empty($url)) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Audio layout for post formet audio.
		 *
		 * @since   1.2.0
		 */
		public static function dynamic_audio_layout()
		{

			$blog_layout = self::egns_post_layout();
			$layout = self::egns_embeded_audio(400, 275);
			if (is_single()) {
				$layout = self::egns_embeded_audio(850, 550);
			} elseif ($blog_layout == 'layout-02') {
				$layout = self::egns_embeded_audio(500, 450);
			} elseif ($blog_layout == 'layout-01') {
				$layout = self::egns_embeded_audio(400, 275);
			} else {
				$layout = self::egns_embeded_audio(400, 275);
			}
			return $layout;
		}

		/**
		 * Video layout for post formet video.
		 *
		 * @since   1.2.0
		 */
		public static function dynamic_video_layout()
		{

			$blog_layout = self::egns_post_layout();
			$layout = self::egns_embeded_video(400, 275);
			if (is_single()) {
				$layout = self::egns_embeded_video(1050, 474);
			} elseif ($blog_layout == 'layout-02') {
				$layout = self::egns_embeded_video(600, 550);
			} elseif ($blog_layout == 'layout-01') {
				$layout = self::egns_embeded_video(400, 275);
			} else {
				$layout = self::egns_embeded_video(400, 275);
			}
			return $layout;
		}

		public static function get_theme_logo($logo_url, $echo = true)
		{
			if (has_custom_logo()) :
				the_custom_logo();
			elseif (!empty($logo_url)) :
?>
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
					<?php if (!empty($logo_url)) : ?>
						<img class="img-fluid" src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"></a>
			<?php endif ?>
			<?php
			else : {
			?>
				<div class="site-title">
					<h3><a href="<?php echo esc_url(home_url('/')) ?>"><?php echo esc_html(get_bloginfo('name')); ?></a></h3>
				</div>

			<?php
				}
			endif;
		}

		public static function get_copyright_theme_logo($logo_url, $echo = true)
		{
			if (has_custom_logo()) :
				the_custom_logo();
			elseif (!empty($logo_url)) :
			?>
			<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
				<?php if (!empty($logo_url)) : ?>
					<img class="img-fluid" src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"></a>
		<?php endif ?>
		<?php
			endif;
		}

		/**
		 * Menu links.
		 *
		 * @param   string $theme_location menu type.
		 * @param   string $container_class main class.
		 * @param   string $after icon tag.
		 * @param   string $menu_class .
		 * @param   string $depth.
		 * @since   1.2.0
		 */

		public static function  egns_get_theme_menu($theme_location = 'primary-menu', $container_class = 'main-nav-wrapper menu-list', $after = '<i class="bi bi-plus dropdown-icon"></i>', $menu_class = 'ul', $depth = 3, $echo = true)
		{
			if (has_nav_menu('primary-menu')) {
				wp_nav_menu(
					array(
						'theme_location'  => $theme_location,
						'container_class' => $container_class,
						'link_before'     => '',
						'link_after'      => '',
						'after'           => $after,
						'container_id'    => '',
						'menu_class'      => $menu_class,
						'fallback_cb'     => '',
						'menu_id'         => '',
						'depth'           => $depth,
					)
				);
			} else {
				if (is_user_logged_in()) { ?>
			<div class="set-menu">
				<h4>
					<a href="<?php echo admin_url(); ?>nav-menus.php">
						<?php echo esc_html('Set Menu Here...', 'drivco'); ?>
					</a>
				</h4>
			</div>
		<?php }
			}
		}


		/**
		 * Post Details Pagination
		 * @since   1.2.0
		 */

		public static function egns_get_post_pagination()
		{
			wp_link_pages(
				array(
					'before'           => '<ul class="pagination d-flex justify-content-center align-items-center"><span class="page-title">' . esc_html__('Pages: ', 'drivco') . '</span><li>',
					'after'            => '</li></ul>',
					'link_before'      => '',
					'link_after'       => '',
					'next_or_number'   => 'number',
					'separator'        => '</li><li>',
					'pagelink'         => '%',
					'echo'             => 1
				)
			);
		}

		/**
		 * Option Dynamic Styles.
		 *
		 * @since   1.2.0
		 */
		public function egns_enqueue_scripts()
		{
			$objects = array(
				'sticky_header_enable'            => self::sticky_header_enable(),
				'animation_enable'                => self::animation_enable(),
				'is_egns_core_enable'  			  => class_exists('CSF') ? true : false,
				'admin_ajax'				 	  => admin_url('admin-ajax.php'),

			);
			wp_localize_script('custom', 'egns_localize', $objects);
		}


		public static function sticky_header_enable()
		{
			$page_sticky_option = Egns_Helper::egns_page_option_value('sticky_header_enable');
			$sticky_header = Egns_Helper::egns_get_theme_option('header_sticky_enable');

			if (Egns_Helper::is_enabled($sticky_header, $page_sticky_option)) {
				return true;
			} else {
				return false;
			}
		}

		public static function animation_enable()
		{
			$animation_enable = Egns_Helper::egns_get_theme_option('animation_enable');

			if ($animation_enable == 1) {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Get Page Options Value
		 *
		 * @since   1.2.0
		 */

		public static function egns_get_options_value($theme_option, $page_option)
		{
			if (!empty($page_option)) {
				return $page_option;
			} else {
				return $theme_option;
			}
		}


		public static function get_all_brand($is_main_query = false)
		{
			$brands =  get_terms('vehicle-brand'); // Get all brands.
			if ($is_main_query) {
				return $brands;
			}
			$brand_options = [];
			foreach ($brands as $brand) {
				$brand_options[$brand->term_id] = $brand->name;
			}

			return $brand_options;
		}


		/**
		 * Return Page Option Value Based on Given Page Option ID.
		 *
		 * @since 1.2.0
		 *
		 * @param string $page_option_key Optional. Page Option id. By Default It will return all value.
		 * 
		 * @return mixed Vehicle Option Value.
		 */
		public static function  egns_vehicle_product_value_by_id($post_id, $key1, $key2 = '', $key3 = '', $default = '')
		{

			$vehicle_options = get_post_meta($post_id, 'EGNS_VEHICLE_META_ID', true);

			if (isset($vehicle_options[$key1][$key2][$key3])) {
				return $vehicle_options[$key1][$key2][$key3];
			} elseif (isset($vehicle_options[$key1][$key2])) {
				return $vehicle_options[$key1][$key2];
			} elseif (isset($vehicle_options[$key1])) {
				return $vehicle_options[$key1];
			} else {
				return $default;
			}
		}


		/**
		 * Return Page Option Value Based on Given Page Option ID.
		 *
		 * @since 1.2.0
		 *
		 * @param string $page_option_key Optional. Page Option id. By Default It will return all value.
		 * 
		 * @return mixed Vehicle Option Value.
		 */
		public static function  egns_vehicle_product_value($key1, $key2 = '', $key3 = '', $default = '')
		{

			$vehicle_options = get_post_meta(get_the_ID(), 'EGNS_VEHICLE_META_ID', true);

			if (isset($vehicle_options[$key1][$key2][$key3])) {
				return $vehicle_options[$key1][$key2][$key3];
			} elseif (isset($vehicle_options[$key1][$key2])) {
				return $vehicle_options[$key1][$key2];
			} elseif (isset($vehicle_options[$key1])) {
				return $vehicle_options[$key1];
			} else {
				return $default;
			}
		}


		/**
		 * Return vehicle price with sale.
		 *
		 * @since 1.2.0
		 * 
		 * @return mixed Vehicle price Value.
		 */
		public static function get_vehicle_price()
		{
			$currency = self::egns_vehicle_product_value('vehicle_currency_selector');
			$regular_price = self::egns_vehicle_product_value('vehicle_regular_price');
			$sale_price = self::egns_vehicle_product_value('vehicle_discount_price');
			$currency_side = self::egns_vehicle_product_value('vehicle_currency_left_right_label');

			// Format prices
			$regular_price_formatted = number_format((int) $regular_price, 2);
			$sale_price_formatted = number_format((int) $sale_price, 2);
			$currency_symbol = sprintf(__('%s', 'drivco'), $currency);

			// Check if there is a sale price
			if (!empty($sale_price)) {
				if ($currency_side) {
					// Currency symbol after the price
					echo $sale_price_formatted . $currency_symbol;
					echo ' <del>' . $regular_price_formatted . $currency_symbol . '</del>';
				} else {
					// Currency symbol before the price
					echo $currency_symbol . $sale_price_formatted;
					echo ' <del>' . $currency_symbol . $regular_price_formatted . '</del>';
				}
			} else {
				if ($currency_side) {
					echo $regular_price_formatted . $currency_symbol;
				} else {
					echo $currency_symbol . $regular_price_formatted;
				}
			}
		}



		/**
		 * Define the core functionality of the.
		 *
		 * @since   1.2.0
		 */
		public function actions()
		{
			add_action('egns_page_before', array($this, 'open_container'));
			add_action('egns_page_after', array($this, 'close_container'));
			add_action('egns_post_before', array($this, 'post_open_container'));
			add_action('egns_post_after', array($this, 'post_close_container'));
			add_action('egns_header_template', [$this, 'egns_header_template']);
		}


		/**
		 * Is elementor.
		 *
		 * @since   1.2.0
		 */
		public static function is_elementor()
		{
			if (self::drivco_is_blog_pages()) {
				return false;
			}
			if (did_action('elementor/loaded')) {
				return Plugin::$instance->documents->get(get_the_ID())->is_built_with_elementor();
			} else {
				return false;
			}
		}

		/**
		 * Open Page Container.
		 *
		 * @since   1.2.0
		 */
		public function open_container()
		{
			if (!self::is_elementor()) : ?>
		<div class="container">
		<?php
			endif;
			if (self::egns_get_theme_option('header_menu_style') == 'header_three' || self::egns_page_option_value('page_header_menu_style') == 'header_three') {
		?>
			<div class="main-container">
				<div class="main-content">
				<?php
			}
		}

		/**
		 * Close Page Container.
		 *
		 * @since   1.2.0
		 */
		public function close_container()
		{
			if (!self::is_elementor()) :
				?>
				</div> <!-- end .container -->
			</div>
		</div> <!-- End Main Content Area  -->
	<?php endif;
		}

		/**
		 * Post Open Container.
		 *
		 * @since   1.2.0
		 */
		public function post_open_container()
		{
			if (is_single()) {
	?>
		<div class="blog-details">
		<?php
			} else {
		?>
			<div>
			<?php
			}
		}

		/**
		 * Post Close Container.
		 *
		 * @since   1.2.0
		 */
		public function post_close_container()
		{
			?>
			</div>
<?php
		}
	} // end Main Egns Helper class








}
