<?php

namespace Egns\Helper;

if (!class_exists('Egns_Assets')) {

    /**
     * Assets handlers class
     */
    class Egns_Assets
    {

        /**
         * Class constructor
         */
        function __construct()
        {

            // Theme setup and enqueue files
            add_action('wp_enqueue_scripts', array($this, 'egns_enqueue_assets'));

            // Theme setup and admin enqueue files
            add_action('admin_enqueue_scripts', array($this, 'egns_enqueue_admin_assets'));
        }

        /**
         * Return all available scripts
         *
         * @version 1.2.0
         * @return array
         */
        function egns_get_scripts()
        {
            return [
                'jquery-ui' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/jquery-ui.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/jquery-ui.js'),
                    'deps'    => ['jquery']
                ],
                'range-slider' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/rangeSlider.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/rangeSlider.min.js'),
                    'deps'    => ['jquery']
                ],

                'bootstrap' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/bootstrap.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/bootstrap.min.js'),
                    'deps'    => ['jquery']
                ],
                'swiper' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/swiper-bundle.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/swiper-bundle.min.js'),
                    'deps'    => ['jquery']
                ],
                'slick' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/slick.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/slick.js'),
                    'deps'    => ['jquery']
                ],
                'waypoints' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/waypoints.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/waypoints.min.js'),
                    'deps'    => ['jquery']
                ],
                'counterup' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/jquery.counterup.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/jquery.counterup.min.js'),
                    'deps'    => ['jquery']
                ],
                'isotope' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/isotope.pkgd.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/isotope.pkgd.min.js'),
                    'deps'    => ['jquery']
                ],
                'datatable' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/datatable.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/datatable.js'),
                    'deps'    => ['jquery']
                ],
                'magnific-popup' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/jquery.magnific-popup.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/jquery.magnific-popup.min.js'),
                    'deps'    => ['jquery']
                ],

                'gsap' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/gsap.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/gsap.min.js'),
                    'deps'    => ['jquery']
                ],
                'simpleParallax' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/simpleParallax.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/simpleParallax.min.js'),
                    'deps'    => ['jquery']
                ],
                'TweenMax' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/TweenMax.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/TweenMax.min.js'),
                    'deps'    => ['jquery']
                ],
                'marquee' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/jquery.marquee.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/jquery.marquee.min.js'),
                    'deps'    => ['jquery']
                ],

                'nice-select' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/jquery.nice-select.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/jquery.nice-select.min.js'),
                    'deps'    => ['jquery']
                ],

                'fancybox' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/jquery.fancybox.min.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/jquery.fancybox.min.js'),
                    'deps'    => ['jquery']
                ],
                'custom' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/custom.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/custom.js'),
                    'deps'    => ['jquery']
                ],
                'ajax-handler' => [
                    'src'     => EGNS_ASSETS_ROOT . '/js/ajax-handler.js',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/js/ajax-handler.js'),
                    'deps'    => ['jquery']
                ],

            ];
        }


        /**
         * Return all available styles
         *
         * @version 1.2.0
         * @return array
         */
        function egns_get_styles()
        {
            $assets =  [
                'egns-fonts' => [
                    'src'     => 'https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800;900&family=Open+Sans:wght@300;400;500;600;700;800&display=swap',
                    'deps' => [],
                    'version' => null,
                    'priority'  => 10,
                ],
                'bootstrap-icons' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/bootstrap-icons.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/bootstrap-icons.css'),
                    'priority'  => 30,
                ],
                'all-fontawesome' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/all.min.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/all.min.css'),
                    'priority'  => 40,
                ],
                'fontawesome' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/fontawesome.min.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/fontawesome.min.css'),
                    'priority'  => 50,
                ],
                'datatable' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/datatable.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/datatable.css'),
                    'priority'  => 60,
                ],
                'fancybox' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/jquery.fancybox.min.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/jquery.fancybox.min.css'),
                    'priority'  => 70,
                ],
                'swiper-bundle' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/swiper-bundle.min.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/swiper-bundle.min.css'),
                    'priority'  => 80,
                ],
                'slick' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/slick.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/slick.css'),
                    'priority'  => 90,
                ],
                'slick-theme' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/slick-theme.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/slick-theme.css'),
                    'priority'  => 100,
                ],
                'magnific' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/magnific-popup.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/magnific-popup.css'),
                    'priority'  => 110,
                ],
                'boxicons' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/boxicons.min.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/boxicons.min.css'),
                    'priority'  => 120,
                ],
                'nice-select' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/nice-select.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/nice-select.css'),
                    'priority'  => 130,
                ],
                'rangeSlider' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/rangeSlider.min.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/rangeSlider.min.css'),
                    'priority'  => 140,
                ],
                'jquery-ui' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/jquery-ui.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/jquery-ui.css'),
                    'priority'  => 150,
                ],

            ];

            // Load RTL css 
            if (Egns_Helper::egns_get_theme_option('rtl_enable')) {

                $assets['bootstrap-rtl'] = [
                    'src'     => EGNS_ASSETS_ROOT . '/css/bootstrap.rtl.min.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/bootstrap.rtl.min.css'),
                    'priority'  => 20,
                ];
                $assets['blog-page'] = [
                    'src'     => EGNS_ASSETS_ROOT . '/css/blog-and-pages.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/blog-and-pages.css'),
                    'priority'  => 160,
                ];
                $assets['WooCommerce'] = [
                    'src'     => EGNS_ASSETS_ROOT . '/css/woocommerce-custom.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/woocommerce-custom.css'),
                    'priority'  => 170,
                ];
                $assets['egns-style'] = [
                    'src'     => EGNS_ASSETS_ROOT . '/css/style.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/style.css'),
                    'priority'  => 990,
                ];
                $assets['egns-style-rtl'] = [
                    'src'     => EGNS_ASSETS_ROOT . '/css/style-rtl.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/style-rtl.css'),
                    'deps' => ['egns-style'],
                    'priority'  => 990,
                ];
                $assets['egns-theme'] =  [
                    'src'     => EGNS_ROOT . '/style.css',
                    'version' => rand(10, 100),
                    'priority'  => 1000,
                ];
            } else {
                $assets['bootstrap'] = [
                    'src'     => EGNS_ASSETS_ROOT . '/css/bootstrap.min.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/bootstrap.min.css'),
                    'priority'  => 20,
                ];

                $assets['blog-page'] = [
                    'src'     => EGNS_ASSETS_ROOT . '/css/blog-and-pages.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/blog-and-pages.css'),
                    'priority'  => 160,
                ];
                $assets['WooCommerce'] = [
                    'src'     => EGNS_ASSETS_ROOT . '/css/woocommerce-custom.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/woocommerce-custom.css'),
                    'priority'  => 170,
                ];
                $assets['egns-style'] = [
                    'src'     => EGNS_ASSETS_ROOT . '/css/style.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/style.css'),
                    'priority'  => 990,
                ];
                $assets['egns-theme'] =  [
                    'src'     => EGNS_ROOT . '/style.css',
                    'version' => rand(10, 100),
                    'priority'  => 1000,
                ];
            }

            return $assets;
        }


        /**
         * Return all available admin styles
         *
         * @version 1.2.0
         * @return array
         */
        function egns_get_admin_styles()
        {
            return [
                'admin_css' => [
                    'src'     => EGNS_ASSETS_ROOT . '/css/admin.css',
                    'version' => filemtime(EGNS_ASSETS_ROOT_DIR . '/css/admin.css'),
                ],

            ];
        }

        //sorting position 
        public function sortByPriority($data1, $data2)
        {
            return $data1['priority'] - $data2['priority'];
        }

        public function array_order($array)
        {
            // Sorting the array based on 'priority'
            uasort($array, [$this, 'sortByPriority']);

            return $array;
        }


        /**
         * Drivco enqueue scripts and styles 
         * 
         * @since 1.2.0
         * 
         * @return void
         */
        public function egns_enqueue_assets()
        {

            $scripts = $this->egns_get_scripts();
            $styles  = $this->egns_get_styles();

            // Applied filter hook for scripts and styles
            $scripts = apply_filters('egns_filter_scripts', $scripts);
            $styles  = apply_filters('egns_filter_styles', $styles);

            // Enqueue all styles
            foreach ($styles as $handle => $style) {
                $deps = isset($style['deps']) ? $style['deps'] : false;

                wp_enqueue_style($handle, $style['src'], $deps, $style['version'], 'all');
            }

            // Enqueue all scripts
            foreach ($scripts as $handle => $script) {
                $deps = isset($script['deps']) ? $script['deps'] : false;

                wp_enqueue_script($handle, $script['src'], $deps, $script['version'], true);
            }

            if (is_singular() && comments_open() && get_option('thread_comments')) {
                wp_enqueue_script('comment-reply');
            }
        }

        /**
         * Drivco enqueue admin scripts and styles 
         * 
         * @since 1.2.0
         * 
         * @return void
         */
        public function egns_enqueue_admin_assets()
        {
            $admin_styles  = $this->egns_get_admin_styles();

            // Applied filter hook for scripts and styles
            $admin_styles  = apply_filters('egns_filter_admin_styles', $admin_styles);

            // Enqueue all admin styles
            foreach ($admin_styles as $handle => $admin_style) {
                $deps = isset($admin_style['deps']) ? $admin_style['deps'] : false;

                wp_enqueue_style($handle, $admin_style['src'], $deps, $admin_style['version'], 'all');
            }
        }
    }
}
