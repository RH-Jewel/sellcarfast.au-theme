<div class="col-lg-4 col-md-6 col-sm-10">
    <div class="success-storie-card">
        <div class="success-img">
            <div class="magnetic-wrap magnetic-item">
                <?php the_post_thumbnail() ?>
            </div>
        </div>
        <div class="success-content">
            <?php $terms = get_the_terms(get_the_ID(), 'project-category');
            if (!empty($terms)) :
            ?>
                <a href="<?php echo esc_url(get_term_link($terms[0]->term_id)) ?>"> <?php echo esc_html($terms[0]->name) ?></a>
            <?php endif ?>
            <h3><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h3>
            <div class="view-btn">
                <a href="<?php the_permalink() ?>">
                    <svg width="12" height="12" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1H12M12 1V13M12 1L0.5 12"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>