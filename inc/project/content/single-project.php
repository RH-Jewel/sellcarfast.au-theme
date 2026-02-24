<?php
$project_gallery = Egns\Helper\Egns_Helper::egns_project_value('project_gallery_image');
$project_gallery_ids = explode(',', $project_gallery);

?>



<div class="portfolio-details sec-mar">
    <div class="container ">

        <?php if (!empty($project_gallery)) : ?>
            <div class="row g-4 mb-80">
                <div class="col-lg-7">
                    <div class="portfolio-img magnetic-item">
                        <?php if (has_post_thumbnail()) :
                            the_post_thumbnail();
                        ?>
                        <?php else : ?>
                            <img class="img-fluid" src="<?php echo esc_url(wp_get_attachment_url($project_gallery_ids[0])); ?>" alt="<?php esc_html__('image', 'drivco') ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="portfolio-img magnetic-item">
                                <img class="img-fluid" src="<?php echo esc_url(wp_get_attachment_url($project_gallery_ids[1])); ?>" alt="<?php echo esc_attr__('portfolio-image', 'drivco') ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="portfolio-img magnetic-item">
                                <img class="img-fluid" src="<?php echo esc_url(wp_get_attachment_url($project_gallery_ids[2])); ?>" alt="<?php esc_html__('review-logo', 'drivco') ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="portfolio-img magnetic-item mb-80">
                <?php the_post_thumbnail() ?>
            </div>
        <?php endif; ?>

        <div class="row gy-5">
            <div class="col-lg-8">
                <div class="portfolio-content">
                    <?php the_content() ?>

                    <div class="working-process">
                        <?php if (!empty(Egns\Helper\Egns_Helper::egns_project_value('project_work_process_heading'))) : ?>
                            <h3><?php echo Egns\Helper\Egns_Helper::egns_project_value('project_work_process_heading') ?></h3>
                        <?php endif; ?>

                        <?php if (!empty(Egns\Helper\Egns_Helper::egns_project_value('project_info_steps'))) : ?>
                            <div class="row g-4 justify-content-center">
                                <?php foreach ((array)Egns\Helper\Egns_Helper::egns_project_value('project_info_steps') as $step_data) : ?>
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="single-process magnetic-item">
                                            <div class="icon">
                                                <img src="<?php echo esc_url($step_data['project_steps_icon']['url']) ?>" alt="<?php esc_html__('review-logo', 'drivco') ?>">
                                            </div>
                                            <span><?php echo sprintf(__('%s', 'drivco'), $step_data['project_steps_count']) ?></span>
                                            <h3><?php echo sprintf(__('%s', 'drivco'), $step_data['project_steps_heading']) ?></h3>
                                            <p><?php echo sprintf(__('%s', 'drivco'), $step_data['project_steps_info']) ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                    $project_conclusion_gallery = Egns\Helper\Egns_Helper::egns_project_value('project_conclusion_gallery');
                    $project_conclusion_gallery_ids = explode(',', $project_conclusion_gallery);
                    $num = 0;
                    ?>
                    <?php if (!empty($project_conclusion_gallery)) : ?>
                        <div class="row g-4 mb-55">
                            <?php foreach ((array)$project_conclusion_gallery_ids as $project_conclusion_gallery_id) : ?>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="portfolio-img magnetic-item">
                                        <img class="img-fluid" src="<?php echo esc_url(wp_get_attachment_url($project_conclusion_gallery_id)) ?>" alt="<?php esc_html__('review-logo', 'drivco') ?>">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty(Egns\Helper\Egns_Helper::egns_project_value('project_conclusion_heading'))) : ?>
                        <h3><?php echo Egns\Helper\Egns_Helper::egns_project_value('project_conclusion_heading') ?></h3>
                    <?php endif; ?>
                    <?php if (!empty(Egns\Helper\Egns_Helper::egns_project_value('project_conclusion_info'))) : ?>
                        <p><?php echo Egns\Helper\Egns_Helper::egns_project_value('project_conclusion_info') ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (!empty(Egns\Helper\Egns_Helper::egns_project_value('project_right_info'))) : ?>
                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <ul>
                            <?php foreach ((array) Egns\Helper\Egns_Helper::egns_project_value('project_right_info') as $info_data) : ?>
                                <li>
                                    <span><?php echo sprintf(__('%s', 'drivco'), $info_data['user_subtitle']) ?></span>
                                    <h5><?php echo sprintf(__('%s', 'drivco'), $info_data['user_title']) ?></h5>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php
                    $pj_banner_bg = Egns\Helper\Egns_Helper::egns_project_value('project_banner_bg', 'url');
                    ?>
                    <div class="portfolio-details-sm-banner" <?php if (!empty($pj_banner_bg)) : ?>style="background-image: url(<?php echo esc_url($pj_banner_bg) ?>);" <?php endif; ?>>
                        <div class="section-title-5">
                            <?php if (!empty(Egns\Helper\Egns_Helper::egns_project_value('project_banner_title'))) : ?>
                                <h2><?php echo Egns\Helper\Egns_Helper::egns_project_value('project_banner_title') ?></h2>
                            <?php endif; ?>

                            <?php if (!empty(Egns\Helper\Egns_Helper::egns_project_value('project_banner_button'))) : ?>
                                <div class="get-btn">
                                    <a class="primary-btn3" href="<?php echo esc_url(Egns\Helper\Egns_Helper::egns_project_value('project_banner_button_link', 'url')) ?>"><?php echo Egns\Helper\Egns_Helper::egns_project_value('project_banner_button') ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="details-navigation">
                    <?php
                    $prev = get_adjacent_post(false, '', true);
                    $next = get_adjacent_post(false, '', false);
                    ?>
                    <?php if (!empty($prev)) : ?>
                        <div class="single-navigation">
                            <div class="content">
                                <a href="<?php echo get_permalink($prev->ID); ?>"><?php echo get_previous_post_link('%link', __('Previous', 'drivco')); ?></a>
                                <h4><a href="<?php echo get_permalink($prev->ID); ?>"><?php echo get_the_title($prev->ID); ?></a></h4>
                            </div>
                            <a href="<?php echo get_permalink($prev->ID); ?>" class="img">
                                <?php the_post_thumbnail($prev->ID) ?>
                                <div class="arrow">
                                    <svg width="12" height="12" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 1H12M12 1V13M12 1L0.5 12"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    <?php endif ?>
                    <?php if (!empty($next)) : ?>
                        <div class="single-navigation two">
                            <a href="<?php echo get_permalink($next->ID); ?>" class="img">
                                <?php the_post_thumbnail($next->ID) ?>
                                <div class="arrow">
                                    <svg width="12" height="12" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 1H12M12 1V13M12 1L0.5 12"></path>
                                    </svg>
                                </div>
                            </a>
                            <div class="content">
                                <a href="<?php echo get_permalink($next->ID); ?>"><?php echo get_next_post_link('%link', __('Next', 'drivco')); ?> </a>
                                <h4><a href="<?php echo get_permalink($next->ID); ?>"><?php echo get_the_title($next->ID); ?></a></h4>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>