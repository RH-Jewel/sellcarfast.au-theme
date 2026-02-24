<div class="modal signUp-modal fade" id="auctionSignUpForm" tabindex="-1" aria-labelledby="auctionSignUpFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="auctionSignUpFormLabel"><?php echo esc_html__('Sign Up', 'drivco') ?></h4>
                <p><?php echo esc_html__('Already have an account?', 'drivco') ?> <button type="button" data-bs-toggle="modal" data-bs-target="#auctionLoginForm"><?php echo esc_html__('Log In', 'drivco') ?></button></p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body">
                <div class="registration-form">
                    <form id="custom-registration-form" action="<?php echo get_permalink() ?>" method="post">
                        <div class="customer_registration_message d-none"></div>
                        <label for="first_name"><?php echo esc_html__('First Name:', 'drivco') ?></label>
                        <input type="text" name="first_name" id="first_name" placeholder="<?php echo esc_attr__('Enter your first name', 'drivco') ?>" required>
                        <br>

                        <label for="last_name"><?php echo esc_html__('Last Name:', 'drivco') ?></label>
                        <input type="text" name="last_name" id="last_name" placeholder="<?php echo esc_attr__('Enter your last name', 'drivco') ?>" required>
                        <br>

                        <label for="username"><?php echo esc_html__('Username:', 'drivco') ?></label>
                        <input type="text" name="username" id="username" placeholder="<?php echo esc_attr__('Enter your username', 'drivco') ?>" required>
                        <br>

                        <label for="email_address"><?php echo esc_html__('Email:', 'drivco') ?></label>
                        <input type="email" name="email_address" id="email_address" placeholder="<?php echo esc_attr__('Enter your email address', 'drivco') ?>" required>
                        <br>

                        <label for="password"><?php echo esc_html__('Password:', 'drivco') ?></label>
                        <input type="password" name="password" id="password" placeholder="<?php echo esc_attr__('Enter your password', 'drivco') ?>" required>
                        <br>
                        <button class="primary-btn3" type="submit" name="customer" ><?php echo esc_html__('Register', 'drivco') ?></button>
                    </form>
                    <?php
                    if (is_user_logged_in()) { ?>
                        <a class="dashboard" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'drivco'); ?>"><?php _e('Go Dashboard', 'drivco'); ?> <i class="bi bi-arrow-up-right"></i></a>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal signUp-modal fade" id="auctionLoginForm" tabindex="-1" aria-labelledby="auctionLoginFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="auctionLoginFormLabel"><?php echo esc_html__('Log In', 'drivco') ?></h4>
                <p><?php echo esc_html__('Don’t have any account?', 'drivco') ?> <button type="button" data-bs-toggle="modal" data-bs-target="#auctionSignUpForm"><?php echo esc_html__('Sign Up', 'drivco') ?></button></p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x"></i></button>
            </div>
            <div class="modal-body">
                <div class="login-form">
                    <form id="custom-login-form" action="<?php echo get_permalink() ?>" method="post">
                        <div class="customer_login_message d-none"></div>
                        <label for="login_email_address"><?php echo esc_html__('Email:', 'drivco') ?></label>
                        <input type="email" name="email_address" id="login_email_address" placeholder="<?php echo esc_attr__('Enter your email address', 'drivco') ?>" required>
                        <br>

                        <label for="login_password"><?php echo esc_html__('Password:', 'drivco') ?></label>
                        <input type="password" name="password" id="login_password" placeholder="<?php echo esc_attr__('Enter your email password', 'drivco') ?>" required>
                        <br>
                        <button class="primary-btn3" type="submit" name="customer_login" ><?php echo esc_html__('Login', 'drivco') ?></button>
                    </form>
                </div>
                <?php
                if (is_user_logged_in()) { ?>
                    <a class="dashboard" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account', 'drivco'); ?>"><?php _e('Go Dashboard', 'drivco'); ?> <i class="bi bi-arrow-up-right"></i></a>
                <?php }  ?>
            </div>
        </div>
    </div>
</div>