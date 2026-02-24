    <!-- Start Footer Section -->
    <footer>
        <div class="container-fluid">

            <?php if (Egns\Helper\Egns_Helper::egns_is_blog_pages() || (class_exists('CSF') && (Egns\Helper\Egns_Helper::egns_page_option_value('footer_widget_enable') == true))) :  ?>

                <!-- Footer Widgets Area -->
                <?php Egns\Inc\Footer_Helper::egns_footer_widgets(); ?>

                <!-- Footer Widgets Area -->
                <?php Egns\Inc\Footer_Helper::egns_footer_center(); ?>

            <?php endif; ?>

            <?php
            if (class_exists('CSF') && !empty(Egns\Helper\Egns_Helper::egns_get_theme_option('copyright_text'))) {  ?>
                ?>
                <div class="footer-btm <?php echo Egns\Helper\Egns_Helper::egns_get_theme_option('footer_social_enable') == false ? 'justify-content-center' : '' ?>">
                    <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('copyright_text'))) : ?>
                        <div class="copyright-area">
                            <p><?php echo  Egns\Helper\Egns_Helper::egns_get_theme_option('copyright_text') ?></p>
                        </div>
                    <?php endif ?>

                    <?php if (class_exists('CSF') && Egns\Helper\Egns_Helper::egns_get_theme_option('footer_social_enable') == true && !empty(Egns\Helper\Egns_Helper::egns_get_theme_option('footer_bottom_social_head') || Egns\Helper\Egns_Helper::egns_get_theme_option('footer_bottom_social'))) : ?>
                        <div class="social-area">
                            <h6><?php echo  Egns\Helper\Egns_Helper::egns_get_theme_option('footer_bottom_social_head') ?></h6>
                            <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('footer_bottom_social'))) : ?>
                                <ul>
                                    <?php
                                    if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('footer_bottom_social'))) :
                                        foreach ((array) Egns\Helper\Egns_Helper::egns_get_theme_option('footer_bottom_social') as $icon) :
                                    ?>
                                            <li><a href="<?php echo esc_url($icon['footer_social_icon_url']['url']) ?>"><i class='<?php echo esc_attr($icon['footer_social_icon_class']) ?>'></i></a></li>
                                    <?php endforeach;
                                    endif; ?>
                                </ul>
                            <?php endif ?>
                        </div>
                    <?php endif ?>
                </div>
            <?php
            } else {
            ?>
                <div class="footer-btm justify-content-center">
                    <div class="copyright-area">
                        <p><?php echo esc_html__('© Copyright 2024', 'drivco') ?> <a href="<?php echo esc_url('https://www.drivco-wp.egenslab.com/') ?>"><?php echo esc_html__('DRIVCO', 'drivco') ?></a> <?php echo esc_html__('| Design By', 'drivco') ?> <a href="<?php echo esc_url('https://www.egenslab.com/') ?>"><?php echo esc_html__(' Egens Lab', 'drivco') ?></a></p>
                    </div>
                </div>

            <?php }
            ?>


        </div>
    </footer>
    <!-- End Footer Section -->