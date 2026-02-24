<div class="content">
    <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
    <p><?php echo wp_trim_words(get_the_content(), 25); ?></p>
    <div class="news-btm d-flex align-items-center justify-content-between">
        <div class="author-area">
            <div class="author-img">
                <?php echo get_avatar(get_the_ID()) ?>
            </div>
            <div class="author-content">
                <h6><?php echo get_the_author_meta('display_name') ?></h6>
                <span><?php echo esc_html__('Posted on - ', 'drivco') ?><a href="<?php echo esc_url(home_url(get_the_date('Y/m/d'))) ?>"><?php echo get_the_date('d F Y ') ?></a></span>
            </div>
        </div>
        <a class="view-btn" href="<?php the_permalink() ?>"><?php echo esc_html__('Read More', 'drivco') ?></a>
    </div>
</div>