<div class="author-area">
    <div class="author-img">
        <?php echo get_avatar(get_the_ID()) ?>
    </div>
    <div class="author-content">
        <h6><?php echo get_the_author_meta('display_name') ?></h6>
        <span><?php echo esc_html__('Posted on - ', 'drivco') ?><a href="<?php echo esc_url(home_url(get_the_date('Y/m/d'))) ?>"><?php echo get_the_date('d F Y ') ?></a></span>
    </div>
</div>