<?php

namespace Egns\Inc;

class Header_Helper
{

    /**
     * Initializes a singleton instance
     *
     * @return \Header_Helper
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

    public static function global_search()
    {
?>
        <div class="mobile-search">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center gy-4">
                    <div class="col-10">
                        <?php get_search_form() ?>
                    </div>
                    <div class="col-2 d-flex justify-content-end align-items-center gap-2">
                        <div class="search-cross-btn style-two">
                            <i class="bi bi-x-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

Header_Helper::init();
