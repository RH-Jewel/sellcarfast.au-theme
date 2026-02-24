<div class="blog-details-content">
    <?php
    the_content();
    Egns\Inc\Blog_Helper::egns_post_pagination();
    Egns\Helper\Egns_Helper::egns_template_part('blog', 'templates/common/single/info');
    ?>

</div>