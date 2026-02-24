<div class="news-card2 mb-50">
    <?php
    Egns\Inc\Blog_Helper::egns_blog_is_sticky();
    Egns\Helper\Egns_Helper::egns_template_part('blog', 'templates/common/thumbnail');
    Egns\Helper\Egns_Helper::egns_template_part('blog', 'templates/common/content');
    ?>
</div>