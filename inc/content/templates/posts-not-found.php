<div class="error-area-wrapper text-center">
    <a><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/search-not-found/search-not-found.png'); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" class="img-fluid"></a>
    <div class="mt-30 mb-30">
        <h3> <?php echo esc_html__('Sorry!, Nothing Found!', 'drivco'); ?> </h3>
        <p><?php echo esc_html__('Nothing Match your search terms. Please try again with some different keywords.', 'drivco'); ?></p>
    </div>
    <?php
    get_template_part('searchform');
    ?>
</div>