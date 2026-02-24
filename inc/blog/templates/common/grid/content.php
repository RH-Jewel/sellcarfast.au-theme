<div class="content">
    <h6><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h6>

    <div class="news-btm">
        <div class="author-area">
            <div class="author-img">
                <?php echo get_avatar(get_the_ID()) ?>
            </div>
            <div class="author-content">
            <h6><?php echo get_the_author_meta('display_name') ?></h6>
            <a href="#"><?php echo  esc_html__('Posted on - ', 'drivco') . get_the_date('d F Y ') ?></a>
            </div>
        </div>
    </div>
</div>