<?php

$single_terms = get_the_terms(get_the_ID(), 'project-category');

?>
<div class="col-lg-4 col-sm-6 single-item <?php echo str_replace(' ', '', $single_terms[0]->slug) ?>">
    <div class="single-work magnetic-item">
        <div class="work-img magnetic-item">
            <?php the_post_thumbnail() ?>
        </div>
        <div class="work-content">
            <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
            <a href="<?php echo esc_url(get_term_link($single_terms[0]->term_id)) ?>"><?php echo esc_html($single_terms[0]->name) ?></a>
        </div>
    </div>
</div>