<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package hello
 */

get_header();

?>

<main id="primary" class="site-main">

    <?php if (class_exists('CSF')) : ?>

        <div class="error-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="error-wrapper">
                            <div class="error-content-area text-center">
                                <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('404_title'))) : ?>
                                    <h1><?php echo wp_kses(Egns\Helper\Egns_Helper::egns_get_theme_option('404_title'), wp_kses_allowed_html('post')) ?></h1>
                                <?php endif ?>
                                <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('404_content'))) : ?>
                                    <p><?php echo wp_kses(Egns\Helper\Egns_Helper::egns_get_theme_option('404_content'), wp_kses_allowed_html('post')) ?></p>
                                <?php endif ?>
                                <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('404_image', 'url'))) : ?>
                                    <div class="error-img mb-50">
                                        <img class="img-fluid" src="<?php echo esc_url(Egns\Helper\Egns_Helper::egns_get_theme_option('404_image', 'url'))  ?>" alt="<?php echo esc_attr('error-image', 'drivco') ?>">
                                    </div>
                                <?php endif ?>
                                <div class="error-btn">
                                    <?php if (!empty(Egns\Helper\Egns_Helper::egns_get_theme_option('404_button_text'))) : ?>
                                        <a class="primary-btn3" href="<?php echo esc_url(home_url('/')); ?>">
                                            <?php echo wp_kses(Egns\Helper\Egns_Helper::egns_get_theme_option('404_button_text'), wp_kses_allowed_html('post')) ?>
                                        </a>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .error-404 -->

    <?php else : ?>

        <div class="error-page">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="error-wrapper">
                            <div class="error-content-area text-center">
                                <h1><?php echo esc_html__('Opps, Page Not Found', 'drivco') ?></h1>
                                <p><?php echo esc_html__('Something went wrong, web page that is displayed to the user when the server cannot find the requested page', 'drivco') ?>.</p>
                                <div class="error-img mb-50">
                                    <img class="img-fluid" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/inner-page/404.svg') ?>" alt="<?php esc_html__('error-img', 'drivco') ?>">
                                </div>
                                <div class="error-btn">
                                    <a class="primary-btn3" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__('Back To Home', 'drivco') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif ?>

</main><!-- #main -->

<?php
get_footer();
