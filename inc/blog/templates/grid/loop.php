<?php
$args = array(
    'post_type'   => 'post',                                                //it is a Page right?
    'post_status' => 'publish',
    'orderby'     => "DESC",
    'paged'       => (get_query_var('paged')) ? get_query_var('paged') : 1
);
$wp_query = new WP_Query($args); ?>
<div class="news-section grid-view">
    <div class="row justify-content-center g-4 mb-30">
        <?php
        $num = 0;
        if ($wp_query->have_posts()) {

            while ($wp_query->have_posts()) :
                $num++;
                $wp_query->the_post();

                echo apply_filters('egns_filter_blog_single_template', Egns\Helper\Egns_Helper::egns_get_template_part('blog', 'templates/grid/post/post', get_post_format() ? get_post_format() : 'default'));

            endwhile;  // End of the loop.

        } else {
            // Include global posts not found
            Egns\Helper\Egns_Helper::egns_template_part('content', 'templates/posts-not-found');
        }
        ?>
    </div>
</div>

<?php wp_reset_postdata(); ?>