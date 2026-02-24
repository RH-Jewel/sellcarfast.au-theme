<div class="search-bar">
    <div class="close-btn">
        <i class="bi bi-x"></i>
    </div>
    <?php echo do_shortcode('[egns_general_filter style=2]') ?>
</div>


<!-- Start header section -->
<div class="sidebar-menu">
    <div class="mobile-logo-area d-flex justify-content-between align-items-center">
        <div class="mobile-logo-wrap">
            <?php
            if (!empty(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_four_logo_mobile', 'url'))) {
                Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_four_logo_mobile', 'url'));
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

    <div class="topbar-bottom-mobile">
        <ul>
            <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_search_show') == true) : ?>
                <li>
                    <div class="search-btn">
                        <a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                <path d="M8.80684 7.75632C9.53304 6.76537 9.85829 5.53677 9.71754 4.31631C9.57678 3.09585 8.9804 1.97354 8.04769 1.17391C7.11499 0.374287 5.91476 -0.0436852 4.68712 0.00361793C3.45949 0.050921 2.29498 0.560011 1.42657 1.42904C0.558166 2.29806 0.0499094 3.46294 0.00348477 4.69061C-0.0429399 5.91828 0.375891 7.11821 1.17619 8.05034C1.97648 8.98247 3.09922 9.57805 4.31978 9.71794C5.54034 9.85782 6.76871 9.53168 7.75913 8.80478H7.75838C7.78088 8.83478 7.80488 8.86328 7.83188 8.89103L10.7193 11.7784C10.8599 11.9191 11.0507 11.9982 11.2496 11.9983C11.4486 11.9984 11.6394 11.9194 11.7801 11.7788C11.9208 11.6382 11.9999 11.4474 12 11.2485C12.0001 11.0495 11.9211 10.8587 11.7805 10.718L8.89309 7.83057C8.86628 7.80342 8.83744 7.77835 8.80684 7.75557V7.75632ZM9.00034 4.87343C9.00034 5.41511 8.89364 5.95149 8.68635 6.45194C8.47906 6.95239 8.17522 7.40711 7.7922 7.79013C7.40917 8.17316 6.95445 8.477 6.454 8.68429C5.95355 8.89158 5.41717 8.99827 4.87549 8.99827C4.33381 8.99827 3.79743 8.89158 3.29698 8.68429C2.79653 8.477 2.34181 8.17316 1.95878 7.79013C1.57576 7.40711 1.27192 6.95239 1.06463 6.45194C0.857338 5.95149 0.750645 5.41511 0.750645 4.87343C0.750645 3.77945 1.18523 2.73028 1.95878 1.95672C2.73234 1.18316 3.78151 0.748583 4.87549 0.748583C5.96947 0.748583 7.01864 1.18316 7.7922 1.95672C8.56576 2.73028 9.00034 3.77945 9.00034 4.87343V4.87343Z" />
                            </svg>
                        </a>
                    </div>
                </li>
            <?php endif; ?>
            <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_wishlist_show') == true  && class_exists('WooCommerce') && defined('YITH_WCWL') && !function_exists('yith_wcwl_add_wishlist_to_loop')) : ?>
                <li>
                    <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()) ?>">
                        <svg width="12" height="12" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.00012 2.40453L6.37273 1.75966C4.90006 0.245917 2.19972 0.76829 1.22495 2.67141C0.767306 3.56653 0.664053 4.8589 1.4997 6.50827C2.30473 8.09639 3.97953 9.99864 7.00012 12.0706C10.0207 9.99864 11.6946 8.09639 12.5005 6.50827C13.3362 4.85803 13.2338 3.56653 12.7753 2.67141C11.8005 0.76829 9.10019 0.245042 7.62752 1.75879L7.00012 2.40453ZM7.00012 13.125C-6.41666 4.25953 2.86912 -2.65995 6.84612 1.00016C6.89862 1.04829 6.95024 1.09816 7.00012 1.14979C7.04949 1.09821 7.10087 1.04859 7.15413 1.00104C11.1302 -2.6617 20.4169 4.25865 7.00012 13.125Z" />
                        </svg>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_signIn_show') == true) : ?>
                <?php if (is_user_logged_in()) : ?>
                    <li>
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'drivco'); ?>">
                            <svg width="12" height="12" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4311 12.759C15.417 11.4291 16 9.78265 16 8C16 3.58169 12.4182 0 8 0C3.58169 0 0 3.58169 0 8C0 12.4182 3.58169 16 8 16C10.3181 16 12.4058 15.0141 13.867 13.4387C14.0673 13.2226 14.2556 12.9957 14.4311 12.759ZM13.9875 12C14.7533 10.8559 15.1999 9.48009 15.1999 8C15.1999 4.02355 11.9764 0.799983 7.99991 0.799983C4.02355 0.799983 0.799983 4.02355 0.799983 8C0.799983 9.48017 1.24658 10.8559 2.01245 12C2.97866 10.5566 4.45301 9.48194 6.17961 9.03214C5.34594 8.45444 4.79998 7.49102 4.79998 6.39995C4.79998 4.63266 6.23271 3.19993 8 3.19993C9.76729 3.19993 11.2 4.63266 11.2 6.39995C11.2 7.49093 10.654 8.45444 9.82039 9.03206C11.5469 9.48194 13.0213 10.5565 13.9875 12ZM13.4722 12.6793C12.3495 10.8331 10.3188 9.59997 8.00008 9.59997C5.68126 9.59997 3.65049 10.8331 2.52776 12.6794C3.84829 14.2222 5.80992 15.2 8 15.2C10.1901 15.2 12.1517 14.2222 13.4722 12.6793ZM8 8.79998C9.32551 8.79998 10.4 7.72554 10.4 6.39995C10.4 5.07444 9.32559 3.99992 8 3.99992C6.6744 3.99992 5.59997 5.07452 5.59997 6.40003C5.59997 7.72554 6.67449 8.79998 8 8.79998Z" />
                            </svg>
                        </a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                            <svg width="12" height="12" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4311 12.759C15.417 11.4291 16 9.78265 16 8C16 3.58169 12.4182 0 8 0C3.58169 0 0 3.58169 0 8C0 12.4182 3.58169 16 8 16C10.3181 16 12.4058 15.0141 13.867 13.4387C14.0673 13.2226 14.2556 12.9957 14.4311 12.759ZM13.9875 12C14.7533 10.8559 15.1999 9.48009 15.1999 8C15.1999 4.02355 11.9764 0.799983 7.99991 0.799983C4.02355 0.799983 0.799983 4.02355 0.799983 8C0.799983 9.48017 1.24658 10.8559 2.01245 12C2.97866 10.5566 4.45301 9.48194 6.17961 9.03214C5.34594 8.45444 4.79998 7.49102 4.79998 6.39995C4.79998 4.63266 6.23271 3.19993 8 3.19993C9.76729 3.19993 11.2 4.63266 11.2 6.39995C11.2 7.49093 10.654 8.45444 9.82039 9.03206C11.5469 9.48194 13.0213 10.5565 13.9875 12ZM13.4722 12.6793C12.3495 10.8331 10.3188 9.59997 8.00008 9.59997C5.68126 9.59997 3.65049 10.8331 2.52776 12.6794C3.84829 14.2222 5.80992 15.2 8 15.2C10.1901 15.2 12.1517 14.2222 13.4722 12.6793ZM8 8.79998C9.32551 8.79998 10.4 7.72554 10.4 6.39995C10.4 5.07444 9.32559 3.99992 8 3.99992C6.6744 3.99992 5.59997 5.07452 5.59997 6.40003C5.59997 7.72554 6.67449 8.79998 8 8.79998Z" />
                            </svg>
                        </a>
                    </li>
                <?php endif ?>
            <?php endif; ?>
        </ul>
    </div>

    <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_button_enable') == true) : ?>
        <div class="hotline-area d-flex">
            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_icon'))) : ?>
                <div class="icon">
                    <img src="<?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_icon', 'url') ?>" alt="<?php esc_html__('icon', 'drivco') ?>">
                </div>
            <?php endif; ?>
            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_type'))) : ?>
                <div class="content">
                    <span><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_head_label') ?></span>
                    <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_type') == 'number') : ?>
                        <h6><a href="tel:<?php echo str_replace([' ', '-', '+'], '', esc_attr(Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_label'))) ?>"><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_label') ?></a></h6>
                    <?php elseif (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_type') == 'mail') : ?>
                        <h6><a href="mailto:<?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_label') ?>"><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_label') ?></a></h6>
                    <?php else : ?>
                        <h6><span><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_sidebar_contact_label') ?></span></h6>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</div>
<!-- End Sidebar -->

<header class="header-area style-4">

    <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_menu_show') == true) : ?>
        <div class="menu-button sidebar-button mobile-menu-btn">
            <svg width="15" height="12" viewBox="0 0 15 12" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0.75C0 0.551088 0.0790176 0.360322 0.21967 0.21967C0.360322 0.0790178 0.551088 0 0.75 0H10.5C10.6989 0 10.8897 0.0790178 11.0303 0.21967C11.171 0.360322 11.25 0.551088 11.25 0.75C11.25 0.948912 11.171 1.13968 11.0303 1.28033C10.8897 1.42098 10.6989 1.5 10.5 1.5H0.75C0.551088 1.5 0.360322 1.42098 0.21967 1.28033C0.0790176 1.13968 0 0.948912 0 0.75ZM14.25 5.25H0.75C0.551088 5.25 0.360322 5.32902 0.21967 5.46967C0.0790176 5.61032 0 5.80109 0 6C0 6.19891 0.0790176 6.38968 0.21967 6.53033C0.360322 6.67098 0.551088 6.75 0.75 6.75H14.25C14.4489 6.75 14.6397 6.67098 14.7803 6.53033C14.921 6.38968 15 6.19891 15 6C15 5.80109 14.921 5.61032 14.7803 5.46967C14.6397 5.32902 14.4489 5.25 14.25 5.25ZM7.5 10.5H0.75C0.551088 10.5 0.360322 10.579 0.21967 10.7197C0.0790176 10.8603 0 11.0511 0 11.25C0 11.4489 0.0790176 11.6397 0.21967 11.7803C0.360322 11.921 0.551088 12 0.75 12H7.5C7.69891 12 7.88968 11.921 8.03033 11.7803C8.17098 11.6397 8.25 11.4489 8.25 11.25C8.25 11.0511 8.17098 10.8603 8.03033 10.7197C7.88968 10.579 7.69891 10.5 7.5 10.5Z" />
            </svg>
            <span><?php echo esc_html__('MENU', 'drivco') ?></span>
        </div>
    <?php endif; ?>


    <div class="main-menu">
        <div class="mobile-logo-area d-lg-none d-flex justify-content-between align-items-center">
            <div class="mobile-logo-wrap">
                <?php
                if (!empty(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_four_logo_mobile', 'url'))) {
                    Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_four_logo_mobile', 'url'));
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

        <!-- Topbar Menu -->
        <?php Egns\Helper\Egns_Helper::egns_get_theme_menu('topbar-menu', '', '', 'menu-list', 1); ?>

    </div>
    <div class="header-logo">
        <?php
        if (!empty(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_four_logo', 'url'))) {
            Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_page_option_value('page_header_four_logo', 'url'));
        } else {
            if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_logo', 'url'))) {
                Egns\Helper\Egns_Helper::get_theme_logo(Egns\Helper\Egns_Helper::egns_get_theme_option('header_logo', 'url'));
            } else {
                Egns\Helper\Egns_Helper::get_theme_logo(NULL);
            }
        }
        ?>
    </div>
    <div class="nav-right d-lg-flex d-none jsutify-content-end align-items-center">

        <div class="header-right">
            <ul>
                <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_search_show') == true) : ?>
                    <li>
                        <div class="search-btn">
                            <a>
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                    <path d="M8.80684 7.75632C9.53304 6.76537 9.85829 5.53677 9.71754 4.31631C9.57678 3.09585 8.9804 1.97354 8.04769 1.17391C7.11499 0.374287 5.91476 -0.0436852 4.68712 0.00361793C3.45949 0.050921 2.29498 0.560011 1.42657 1.42904C0.558166 2.29806 0.0499094 3.46294 0.00348477 4.69061C-0.0429399 5.91828 0.375891 7.11821 1.17619 8.05034C1.97648 8.98247 3.09922 9.57805 4.31978 9.71794C5.54034 9.85782 6.76871 9.53168 7.75913 8.80478H7.75838C7.78088 8.83478 7.80488 8.86328 7.83188 8.89103L10.7193 11.7784C10.8599 11.9191 11.0507 11.9982 11.2496 11.9983C11.4486 11.9984 11.6394 11.9194 11.7801 11.7788C11.9208 11.6382 11.9999 11.4474 12 11.2485C12.0001 11.0495 11.9211 10.8587 11.7805 10.718L8.89309 7.83057C8.86628 7.80342 8.83744 7.77835 8.80684 7.75557V7.75632ZM9.00034 4.87343C9.00034 5.41511 8.89364 5.95149 8.68635 6.45194C8.47906 6.95239 8.17522 7.40711 7.7922 7.79013C7.40917 8.17316 6.95445 8.477 6.454 8.68429C5.95355 8.89158 5.41717 8.99827 4.87549 8.99827C4.33381 8.99827 3.79743 8.89158 3.29698 8.68429C2.79653 8.477 2.34181 8.17316 1.95878 7.79013C1.57576 7.40711 1.27192 6.95239 1.06463 6.45194C0.857338 5.95149 0.750645 5.41511 0.750645 4.87343C0.750645 3.77945 1.18523 2.73028 1.95878 1.95672C2.73234 1.18316 3.78151 0.748583 4.87549 0.748583C5.96947 0.748583 7.01864 1.18316 7.7922 1.95672C8.56576 2.73028 9.00034 3.77945 9.00034 4.87343V4.87343Z" />
                                </svg>
                            </a>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_wishlist_show') == true  && class_exists('WooCommerce') && defined('YITH_WCWL') && !function_exists('yith_wcwl_add_wishlist_to_loop')) : ?>
                    <li>
                        <a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()) ?>">
                            <svg width="12" height="12" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.00012 2.40453L6.37273 1.75966C4.90006 0.245917 2.19972 0.76829 1.22495 2.67141C0.767306 3.56653 0.664053 4.8589 1.4997 6.50827C2.30473 8.09639 3.97953 9.99864 7.00012 12.0706C10.0207 9.99864 11.6946 8.09639 12.5005 6.50827C13.3362 4.85803 13.2338 3.56653 12.7753 2.67141C11.8005 0.76829 9.10019 0.245042 7.62752 1.75879L7.00012 2.40453ZM7.00012 13.125C-6.41666 4.25953 2.86912 -2.65995 6.84612 1.00016C6.89862 1.04829 6.95024 1.09816 7.00012 1.14979C7.04949 1.09821 7.10087 1.04859 7.15413 1.00104C11.1302 -2.6617 20.4169 4.25865 7.00012 13.125Z" />
                            </svg>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_signIn_show') == true) : ?>
                    <?php if (is_user_logged_in()) : ?>
                        <li>
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'drivco'); ?>">
                                <svg width="12" height="12" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4311 12.759C15.417 11.4291 16 9.78265 16 8C16 3.58169 12.4182 0 8 0C3.58169 0 0 3.58169 0 8C0 12.4182 3.58169 16 8 16C10.3181 16 12.4058 15.0141 13.867 13.4387C14.0673 13.2226 14.2556 12.9957 14.4311 12.759ZM13.9875 12C14.7533 10.8559 15.1999 9.48009 15.1999 8C15.1999 4.02355 11.9764 0.799983 7.99991 0.799983C4.02355 0.799983 0.799983 4.02355 0.799983 8C0.799983 9.48017 1.24658 10.8559 2.01245 12C2.97866 10.5566 4.45301 9.48194 6.17961 9.03214C5.34594 8.45444 4.79998 7.49102 4.79998 6.39995C4.79998 4.63266 6.23271 3.19993 8 3.19993C9.76729 3.19993 11.2 4.63266 11.2 6.39995C11.2 7.49093 10.654 8.45444 9.82039 9.03206C11.5469 9.48194 13.0213 10.5565 13.9875 12ZM13.4722 12.6793C12.3495 10.8331 10.3188 9.59997 8.00008 9.59997C5.68126 9.59997 3.65049 10.8331 2.52776 12.6794C3.84829 14.2222 5.80992 15.2 8 15.2C10.1901 15.2 12.1517 14.2222 13.4722 12.6793ZM8 8.79998C9.32551 8.79998 10.4 7.72554 10.4 6.39995C10.4 5.07444 9.32559 3.99992 8 3.99992C6.6744 3.99992 5.59997 5.07452 5.59997 6.40003C5.59997 7.72554 6.67449 8.79998 8 8.79998Z" />
                                </svg>
                            </a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                                <svg width="12" height="12" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4311 12.759C15.417 11.4291 16 9.78265 16 8C16 3.58169 12.4182 0 8 0C3.58169 0 0 3.58169 0 8C0 12.4182 3.58169 16 8 16C10.3181 16 12.4058 15.0141 13.867 13.4387C14.0673 13.2226 14.2556 12.9957 14.4311 12.759ZM13.9875 12C14.7533 10.8559 15.1999 9.48009 15.1999 8C15.1999 4.02355 11.9764 0.799983 7.99991 0.799983C4.02355 0.799983 0.799983 4.02355 0.799983 8C0.799983 9.48017 1.24658 10.8559 2.01245 12C2.97866 10.5566 4.45301 9.48194 6.17961 9.03214C5.34594 8.45444 4.79998 7.49102 4.79998 6.39995C4.79998 4.63266 6.23271 3.19993 8 3.19993C9.76729 3.19993 11.2 4.63266 11.2 6.39995C11.2 7.49093 10.654 8.45444 9.82039 9.03206C11.5469 9.48194 13.0213 10.5565 13.9875 12ZM13.4722 12.6793C12.3495 10.8331 10.3188 9.59997 8.00008 9.59997C5.68126 9.59997 3.65049 10.8331 2.52776 12.6794C3.84829 14.2222 5.80992 15.2 8 15.2C10.1901 15.2 12.1517 14.2222 13.4722 12.6793ZM8 8.79998C9.32551 8.79998 10.4 7.72554 10.4 6.39995C10.4 5.07444 9.32559 3.99992 8 3.99992C6.6744 3.99992 5.59997 5.07452 5.59997 6.40003C5.59997 7.72554 6.67449 8.79998 8 8.79998Z" />
                                </svg>
                            </a>
                        </li>
                    <?php endif ?>
                <?php endif; ?>
                <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_button_enable') == true) : ?>
                    <li>
                        <div class="hotline-area d-xl-flex d-none">
                            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_icon'))) : ?>
                                <div class="icon">
                                    <img src="<?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_icon', 'url') ?>" alt="<?php esc_html__('icon', 'drivco') ?>">
                                </div>
                            <?php endif; ?>
                            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_type'))) : ?>
                                <div class="content">
                                    <span><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_head_label') ?></span>
                                    <?php if (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_type') == 'number') : ?>
                                        <h6><a href="tel:<?php echo str_replace([' ', '-', '+'], '', esc_attr(Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_label'))) ?>"><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_label') ?></a></h6>
                                    <?php elseif (Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_type') == 'mail') : ?>
                                        <h6><a href="mailto:<?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_label') ?>"><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_label') ?></a></h6>
                                    <?php else : ?>
                                        <h6><span><?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('header_four_contact_label') ?></span></h6>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>
<!-- End header section -->