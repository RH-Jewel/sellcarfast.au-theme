<?php

namespace Egns\Inc;

class Footer_Helper
{

    /**
     * Initializes a singleton instance
     *
     * @return \Footer_Helper
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Main construcutor 
     *
     * @return void
     */
    public function __construct()
    {
    }



    // Footer Center function 
    public static function egns_footer_center()
    {
?>
        <?php if (class_exists('CSF') && is_active_sidebar('footer_center')) : ?>
            <?php dynamic_sidebar('footer_center') ?>
        <?php endif; ?>


    <?php
    }

    // Footer widgets function 
    public static function egns_footer_widgets()
    {

    ?>

        <?php if (class_exists('CSF') && (is_active_sidebar('footer_one') || is_active_sidebar('footer_two') || is_active_sidebar('footer_three') || is_active_sidebar('footer_four') || is_active_sidebar('footer_five'))) : ?>
            <div class="footer-top">
                <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-3 row-cols-1 justify-content-center g-lg-4 gy-5 ">
                    <div class="col d-flex justify-content-lg-start">
                        <?php if (is_active_sidebar('footer_one')) : ?>
                            <?php dynamic_sidebar('footer_one') ?>
                        <?php endif ?>
                    </div>
                    <div class="col d-flex justify-content-sm-center">
                        <?php if (is_active_sidebar('footer_two')) : ?>
                            <?php dynamic_sidebar('footer_two') ?>
                        <?php endif ?>
                    </div>
                    <div class="col d-flex justify-content-lg-center justify-content-sm-end">
                        <?php if (is_active_sidebar('footer_three')) : ?>
                            <?php dynamic_sidebar('footer_three') ?>
                        <?php endif ?>
                    </div>
                    <div class="col d-flex justify-content-xl-center justify-content-lg-end justify-content-sm-center">
                        <?php if (is_active_sidebar('footer_four')) : ?>
                            <?php dynamic_sidebar('footer_four') ?>
                        <?php endif ?>
                    </div>
                    <div class="col d-flex justify-content-xl-end justify-content-sm-center">
                        <?php if (is_active_sidebar('footer_five')) : ?>
                            <?php dynamic_sidebar('footer_five') ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>


<?php
    }
} //end main class

Footer_Helper::init();
