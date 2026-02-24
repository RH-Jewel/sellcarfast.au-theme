<article aria-label="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="blog-details-wrap">
        <div class="row g-lg-4 gy-5 justify-content-center">
            <div class="<?php echo is_active_sidebar('blog_sidebar') ? 'col-lg-8' : 'col-lg-10' ?>">

                <?php if (has_post_thumbnail()) : ?>
                    <?php Egns\Helper\Egns_Helper::egns_template_part('blog', 'templates/common/single/thumbnail'); ?>
                <?php endif ?>

                <?php
                Egns\Helper\Egns_Helper::egns_template_part('blog', 'templates/common/single/author');
                Egns\Helper\Egns_Helper::egns_template_part('blog', 'templates/common/single/content');
                Egns\Helper\Egns_Helper::egns_template_part('blog', 'templates/common/single/post-link');
                ?>

                <?php
                //If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>
            </div>

            <?php
            // Include page content sidebar
            Egns\Helper\Egns_Helper::egns_template_part('sidebar', 'templates/sidebar');
            ?>
        </div>
    </div>

</article>