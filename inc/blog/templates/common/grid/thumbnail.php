<?php if (has_post_thumbnail(get_the_ID())) : ?>
    <div class="news-img">
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('egns-thumb-cart') ?></a>
        <div class="date">
            <?php \Egns\Helper\Egns_Helper::the_first_category() ?>
        </div>
    </div>
<?php endif; ?>