<!-- Sidebar Menu -->
<div class="sidebar-menu">
    <div class="mobile-logo-area d-flex justify-content-between align-items-center">
        <div class="mobile-logo-wrap">
            <?php
            if (!empty(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_two_logo_mobile', 'url'))) {
                Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_two_logo_mobile', 'url'));
            } else {
                if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_logo_mobile', 'url'))) {
                    Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_get_theme_option('header_logo_mobile', 'url'));
                } else {
                    Egns\Helper\Egns_Helper::get_theme_logo(NULL);
                }
            }
            ?>
        </div>
        <div class="menu-button menu-close-btn">
            <i class="bi bi-x"></i>
        </div>
    </div>


    <!-- Main Menu -->
    <?php Egns\Helper\Egns_Helper::egns_get_theme_menu('primary-menu', 'main-menu', '<i class="bi bi-plus dropdown-icon"></i>', 'menu-list', 3); ?>


    <div class="topbar-right">

        <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_wishlist_show') == true) : ?>
            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_wishlist_label')) && class_exists('WooCommerce') && defined('YITH_WCWL') && !function_exists('yith_wcwl_add_wishlist_to_loop')) : ?>
                <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()) ?>">
                    <svg width="16" height="16" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.00012 2.40453L6.37273 1.75966C4.90006 0.245917 2.19972 0.76829 1.22495 2.67141C0.767306 3.56653 0.664053 4.8589 1.4997 6.50827C2.30473 8.09639 3.97953 9.99864 7.00012 12.0706C10.0207 9.99864 11.6946 8.09639 12.5005 6.50827C13.3362 4.85803 13.2338 3.56653 12.7753 2.67141C11.8005 0.76829 9.10019 0.245042 7.62752 1.75879L7.00012 2.40453ZM7.00012 13.125C-6.41666 4.25953 2.86912 -2.65995 6.84612 1.00016C6.89862 1.04829 6.95024 1.09816 7.00012 1.14979C7.04949 1.09821 7.10087 1.04859 7.15413 1.00104C11.1302 -2.6617 20.4169 4.25865 7.00012 13.125Z"></path>
                    </svg>
                    <?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_wishlist_label') ?>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_signIn_show') == true) : ?>
            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_signIn_label'))) : ?>
                <?php if (is_user_logged_in()) : ?>
                    <a class="primary-btn3" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'drivco'); ?>">
                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4311 12.759C15.417 11.4291 16 9.78265 16 8C16 3.58169 12.4182 0 8 0C3.58169 0 0 3.58169 0 8C0 12.4182 3.58169 16 8 16C10.3181 16 12.4058 15.0141 13.867 13.4387C14.0673 13.2226 14.2556 12.9957 14.4311 12.759ZM13.9875 12C14.7533 10.8559 15.1999 9.48009 15.1999 8C15.1999 4.02355 11.9764 0.799983 7.99991 0.799983C4.02355 0.799983 0.799983 4.02355 0.799983 8C0.799983 9.48017 1.24658 10.8559 2.01245 12C2.97866 10.5566 4.45301 9.48194 6.17961 9.03214C5.34594 8.45444 4.79998 7.49102 4.79998 6.39995C4.79998 4.63266 6.23271 3.19993 8 3.19993C9.76729 3.19993 11.2 4.63266 11.2 6.39995C11.2 7.49093 10.654 8.45444 9.82039 9.03206C11.5469 9.48194 13.0213 10.5565 13.9875 12ZM13.4722 12.6793C12.3495 10.8331 10.3188 9.59997 8.00008 9.59997C5.68126 9.59997 3.65049 10.8331 2.52776 12.6794C3.84829 14.2222 5.80992 15.2 8 15.2C10.1901 15.2 12.1517 14.2222 13.4722 12.6793ZM8 8.79998C9.32551 8.79998 10.4 7.72554 10.4 6.39995C10.4 5.07444 9.32559 3.99992 8 3.99992C6.6744 3.99992 5.59997 5.07452 5.59997 6.40003C5.59997 7.72554 6.67449 8.79998 8 8.79998Z" />
                        </svg>
                        <?php _e('My Account', 'drivco'); ?>
                    </a>
                <?php else : ?>
                    <a class="primary-btn3" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4311 12.759C15.417 11.4291 16 9.78265 16 8C16 3.58169 12.4182 0 8 0C3.58169 0 0 3.58169 0 8C0 12.4182 3.58169 16 8 16C10.3181 16 12.4058 15.0141 13.867 13.4387C14.0673 13.2226 14.2556 12.9957 14.4311 12.759ZM13.9875 12C14.7533 10.8559 15.1999 9.48009 15.1999 8C15.1999 4.02355 11.9764 0.799983 7.99991 0.799983C4.02355 0.799983 0.799983 4.02355 0.799983 8C0.799983 9.48017 1.24658 10.8559 2.01245 12C2.97866 10.5566 4.45301 9.48194 6.17961 9.03214C5.34594 8.45444 4.79998 7.49102 4.79998 6.39995C4.79998 4.63266 6.23271 3.19993 8 3.19993C9.76729 3.19993 11.2 4.63266 11.2 6.39995C11.2 7.49093 10.654 8.45444 9.82039 9.03206C11.5469 9.48194 13.0213 10.5565 13.9875 12ZM13.4722 12.6793C12.3495 10.8331 10.3188 9.59997 8.00008 9.59997C5.68126 9.59997 3.65049 10.8331 2.52776 12.6794C3.84829 14.2222 5.80992 15.2 8 15.2C10.1901 15.2 12.1517 14.2222 13.4722 12.6793ZM8 8.79998C9.32551 8.79998 10.4 7.72554 10.4 6.39995C10.4 5.07444 9.32559 3.99992 8 3.99992C6.6744 3.99992 5.59997 5.07452 5.59997 6.40003C5.59997 7.72554 6.67449 8.79998 8 8.79998Z" />
                        </svg>
                        <?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_signIn_label') ?>
                    </a>
                <?php endif ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_button_enable') == true) : ?>
        <div class="hotline-area d-flex">
            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_icon'))) : ?>
                <div class="icon">
                    <img src="<?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_icon', 'url') ?>" alt="<?php esc_html__('review-logo', 'drivco') ?>">
                </div>
            <?php endif; ?>

            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_type'))) : ?>
                <div class="content">
                    <span><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_head_label') ?></span>
                    <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_type') == 'number') : ?>
                        <h6><a href="tel:<?php echo str_replace([' ', '-', '+'], '', esc_attr(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_label'))) ?>"><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_label') ?></a></h6>
                    <?php elseif (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_type') == 'mail') : ?>
                        <h6><a href="mailto:<?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_label') ?>"><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_label') ?></a></h6>
                    <?php else : ?>
                        <h6><span><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_sidebar_contact_label') ?></span></h6>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>
<!-- End Sidebar Menu -->


<div class="topbar-header">
    <div class="top-bar style-2">
        <div class="company-logo">
            <?php
            if (!empty(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_two_logo', 'url'))) {
                Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_two_logo', 'url'));
            } else {
                if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_logo', 'url'))) {
                    Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_get_theme_option('header_logo', 'url'));
                } else {
                    Egns\Helper\Egns_Helper::get_theme_logo(NULL);
                }
            }
            ?>
        </div>

        <!-- Topbar Menu -->
        <?php Egns\Helper\Egns_Helper::egns_get_theme_menu('topbar-menu', 'top-bar-items', '', 'ul', 1); ?>

        <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_search_show') == true) : ?>
            <div class="search-area">
                <?php echo do_shortcode('[vehicle_search_form]') ?>
            </div>
        <?php endif; ?>

        <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_button_enable') == true) : ?>
            <div class="topbar-right">
                <div class="hotline-area d-xl-flex d-none">
                    <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_icon'))) : ?>
                        <div class="icon">
                            <img src="<?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_icon', 'url') ?>" alt="<?php esc_html__('review-logo', 'drivco') ?>">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_type'))) : ?>
                        <div class="content">
                            <span><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_head_label') ?></span>
                            <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_type') == 'number') : ?>
                                <h6><a href="tel:<?php echo str_replace([' ', '-', '+'], '', esc_attr(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_label'))) ?>"><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_label') ?></a></h6>
                            <?php elseif (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_type') == 'mail') : ?>
                                <h6><a href="mailto:<?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_label') ?>"><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_label') ?></a></h6>
                            <?php else : ?>
                                <h6><span><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_contact_label') ?></span></h6>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <!-- Start header section -->
    <header class="header-area style-2">
        <div class="header-logo d-lg-none d-flex">
            <?php
            if (!empty(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_two_logo', 'url'))) {
                Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_two_logo', 'url'));
            } else {
                if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_logo', 'url'))) {
                    Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_get_theme_option('header_logo', 'url'));
                } else {
                    Egns\Helper\Egns_Helper::get_theme_logo(NULL);
                }
            }
            ?>
        </div>

        <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_menu_show') == true) : ?>
            <div class="menu-button sidebar-button mobile-menu-btn">
                <svg width="15" height="12" viewBox="0 0 15 12" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0.75C0 0.551088 0.0790176 0.360322 0.21967 0.21967C0.360322 0.0790178 0.551088 0 0.75 0H10.5C10.6989 0 10.8897 0.0790178 11.0303 0.21967C11.171 0.360322 11.25 0.551088 11.25 0.75C11.25 0.948912 11.171 1.13968 11.0303 1.28033C10.8897 1.42098 10.6989 1.5 10.5 1.5H0.75C0.551088 1.5 0.360322 1.42098 0.21967 1.28033C0.0790176 1.13968 0 0.948912 0 0.75ZM14.25 5.25H0.75C0.551088 5.25 0.360322 5.32902 0.21967 5.46967C0.0790176 5.61032 0 5.80109 0 6C0 6.19891 0.0790176 6.38968 0.21967 6.53033C0.360322 6.67098 0.551088 6.75 0.75 6.75H14.25C14.4489 6.75 14.6397 6.67098 14.7803 6.53033C14.921 6.38968 15 6.19891 15 6C15 5.80109 14.921 5.61032 14.7803 5.46967C14.6397 5.32902 14.4489 5.25 14.25 5.25ZM7.5 10.5H0.75C0.551088 10.5 0.360322 10.579 0.21967 10.7197C0.0790176 10.8603 0 11.0511 0 11.25C0 11.4489 0.0790176 11.6397 0.21967 11.7803C0.360322 11.921 0.551088 12 0.75 12H7.5C7.69891 12 7.88968 11.921 8.03033 11.7803C8.17098 11.6397 8.25 11.4489 8.25 11.25C8.25 11.0511 8.17098 10.8603 8.03033 10.7197C7.88968 10.579 7.69891 10.5 7.5 10.5Z" />
                </svg>
                <span><?php echo esc_html__('MENU', 'drivco') ?></span>
            </div>
        <?php endif; ?>
        <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_mega_menu_show') == true) : ?>
            <div class="main-menu">
                <div class="mobile-logo-area d-lg-none d-flex justify-content-between align-items-center">
                    <div class="mobile-logo-wrap">
                        <?php
                        if (!empty(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_two_logo_mobile', 'url'))) {
                            Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_two_logo_mobile', 'url'));
                        } else {
                            if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_logo_mobile', 'url'))) {
                                Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_get_theme_option('header_logo_mobile', 'url'));
                            } else {
                                Egns\Helper\Egns_Helper::get_theme_logo(NULL);
                            }
                        }
                        ?>
                    </div>
                </div>

                <!-- mega menu  -->
                <?php Egns\Helper\Egns_Helper::egns_get_theme_menu('mega-menu', 'mega-menu', '<i class="bi bi-plus dropdown-icon"></i>', 'menu-list', 3); ?>

            </div>
        <?php endif; ?>

        <div class="nav-right d-flex jsutify-content-end align-items-center">
            <!-- Button trigger modal -->
            <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_cart_show') == true) : ?>
                <!-- Button trigger modal -->
                <div class="dropdown">
                    <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_cart_label')) && class_exists('WooCommerce')) : ?>
                        <button class="modal-btn header-cart-btn" type="button">
                            <i class="bi bi-bag-check"></i> <?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_cart_label') . ' (' . WC()->cart->get_cart_contents_count() . ')' ?>
                        </button>
                    <?php endif; ?>
                    <?php if (class_exists('WooCommerce')) : ?>
                        <div class="cart-menu">
                            <div class="cart-body">
                                <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="header-right">
                <ul>
                    <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_wishlist_show') == true) : ?>
                        <li>
                            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_wishlist_label')) && class_exists('WooCommerce') && defined('YITH_WCWL') && !function_exists('yith_wcwl_add_wishlist_to_loop')) : ?>
                                <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()) ?>">
                                    <svg width="16" height="16" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.00012 2.40453L6.37273 1.75966C4.90006 0.245917 2.19972 0.76829 1.22495 2.67141C0.767306 3.56653 0.664053 4.8589 1.4997 6.50827C2.30473 8.09639 3.97953 9.99864 7.00012 12.0706C10.0207 9.99864 11.6946 8.09639 12.5005 6.50827C13.3362 4.85803 13.2338 3.56653 12.7753 2.67141C11.8005 0.76829 9.10019 0.245042 7.62752 1.75879L7.00012 2.40453ZM7.00012 13.125C-6.41666 4.25953 2.86912 -2.65995 6.84612 1.00016C6.89862 1.04829 6.95024 1.09816 7.00012 1.14979C7.04949 1.09821 7.10087 1.04859 7.15413 1.00104C11.1302 -2.6617 20.4169 4.25865 7.00012 13.125Z" />
                                    </svg>
                                    <?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_wishlist_label') ?>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>


                    <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_signIn_show') == true) : ?>
                        <li>
                            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_signIn_label'))) : ?>
                                <?php if (is_user_logged_in()) : ?>
                                    <a class="primary-btn1" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'drivco'); ?>">
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4311 12.759C15.417 11.4291 16 9.78265 16 8C16 3.58169 12.4182 0 8 0C3.58169 0 0 3.58169 0 8C0 12.4182 3.58169 16 8 16C10.3181 16 12.4058 15.0141 13.867 13.4387C14.0673 13.2226 14.2556 12.9957 14.4311 12.759ZM13.9875 12C14.7533 10.8559 15.1999 9.48009 15.1999 8C15.1999 4.02355 11.9764 0.799983 7.99991 0.799983C4.02355 0.799983 0.799983 4.02355 0.799983 8C0.799983 9.48017 1.24658 10.8559 2.01245 12C2.97866 10.5566 4.45301 9.48194 6.17961 9.03214C5.34594 8.45444 4.79998 7.49102 4.79998 6.39995C4.79998 4.63266 6.23271 3.19993 8 3.19993C9.76729 3.19993 11.2 4.63266 11.2 6.39995C11.2 7.49093 10.654 8.45444 9.82039 9.03206C11.5469 9.48194 13.0213 10.5565 13.9875 12ZM13.4722 12.6793C12.3495 10.8331 10.3188 9.59997 8.00008 9.59997C5.68126 9.59997 3.65049 10.8331 2.52776 12.6794C3.84829 14.2222 5.80992 15.2 8 15.2C10.1901 15.2 12.1517 14.2222 13.4722 12.6793ZM8 8.79998C9.32551 8.79998 10.4 7.72554 10.4 6.39995C10.4 5.07444 9.32559 3.99992 8 3.99992C6.6744 3.99992 5.59997 5.07452 5.59997 6.40003C5.59997 7.72554 6.67449 8.79998 8 8.79998Z" />
                                        </svg>
                                        <?php _e('My Account', 'drivco'); ?>
                                    </a>
                                <?php else : ?>
                                    <a class="primary-btn1" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                        <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4311 12.759C15.417 11.4291 16 9.78265 16 8C16 3.58169 12.4182 0 8 0C3.58169 0 0 3.58169 0 8C0 12.4182 3.58169 16 8 16C10.3181 16 12.4058 15.0141 13.867 13.4387C14.0673 13.2226 14.2556 12.9957 14.4311 12.759ZM13.9875 12C14.7533 10.8559 15.1999 9.48009 15.1999 8C15.1999 4.02355 11.9764 0.799983 7.99991 0.799983C4.02355 0.799983 0.799983 4.02355 0.799983 8C0.799983 9.48017 1.24658 10.8559 2.01245 12C2.97866 10.5566 4.45301 9.48194 6.17961 9.03214C5.34594 8.45444 4.79998 7.49102 4.79998 6.39995C4.79998 4.63266 6.23271 3.19993 8 3.19993C9.76729 3.19993 11.2 4.63266 11.2 6.39995C11.2 7.49093 10.654 8.45444 9.82039 9.03206C11.5469 9.48194 13.0213 10.5565 13.9875 12ZM13.4722 12.6793C12.3495 10.8331 10.3188 9.59997 8.00008 9.59997C5.68126 9.59997 3.65049 10.8331 2.52776 12.6794C3.84829 14.2222 5.80992 15.2 8 15.2C10.1901 15.2 12.1517 14.2222 13.4722 12.6793ZM8 8.79998C9.32551 8.79998 10.4 7.72554 10.4 6.39995C10.4 5.07444 9.32559 3.99992 8 3.99992C6.6744 3.99992 5.59997 5.07452 5.59997 6.40003C5.59997 7.72554 6.67449 8.79998 8 8.79998Z" />
                                        </svg>
                                        <?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_two_signIn_label') ?>
                                    </a>
                                <?php endif ?>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </header>
    <!-- End header section -->
</div>