<?php
function egns_ajax_handler()
{
    global $wp_query;
    wp_localize_script('ajax-handler', 'egens_ajax_handler_params', array(
        'ajaxurl' => home_url() . '/wp-admin/admin-ajax.php',
    ));
}

add_action('wp_enqueue_scripts', 'egns_ajax_handler', 100);

// Handle filter vehicle request
add_action('wp_ajax_egns_get_vehicle', 'egns_get_vehicle');
add_action('wp_ajax_nopriv_egns_get_vehicle', 'egns_get_vehicle');

function egns_get_vehicle()
{
    global $wp_query;
    $brands     = !empty($_GET['product_info']['brands']) ? Egns\Helper\Egns_Helper::egns_sanitize_array_fields($_GET['product_info']['brands']) : [];
    $years      = !empty($_GET['product_info']['years']) ? Egns\Helper\Egns_Helper::egns_sanitize_array_fields($_GET['product_info']['years']) : [];
    $body_types = !empty($_GET['product_info']['body_types']) ? Egns\Helper\Egns_Helper::egns_sanitize_array_fields($_GET['product_info']['body_types']) : [];
    $colors     = !empty($_GET['product_info']['colors']) ? Egns\Helper\Egns_Helper::egns_sanitize_array_fields($_GET['product_info']['colors']) : [];
    $location   = !empty($_GET['product_info']['location']) ? Egns\Helper\Egns_Helper::egns_sanitize_array_fields($_GET['product_info']['location']) : [];
    $page_number   = !empty($_GET['product_info']['page_number']) ? sanitize_text_field($_GET['product_info']['page_number']) : 1;
    $min_price  = !empty($_GET['product_info']['min_price']) ? sanitize_text_field($_GET['product_info']['min_price']) : [];
    $max_price  = !empty($_GET['product_info']['max_price']) ? sanitize_text_field($_GET['product_info']['max_price']) : [];
    $vehicle_condition  = !empty($_GET['product_info']['vehicle_condition']) ? sanitize_text_field($_GET['product_info']['vehicle_condition']) : [];

    $args = [];
    $args['post_type']              = 'vehicle';
    $args['posts_per_page']         = 8;
    $args['tax_query']              = [];
    $args['meta_query']             = [];
    $args['tax_query']['relation']  = 'AND';
    $args['meta_query']['relation'] = 'AND';
    if (!empty($page_number)) {
        $args['paged'] = number_format($page_number);
    }
    if (isset($years) && count($years) > 0) {
        $args['tax_query'][] = [
            'taxonomy'  => 'vehicle-year',
            'field'     => 'name',
            'terms'     => $years,
        ];
    }
    if (!empty($max_price) && !empty($min_price)) {
        $args['meta_query'][] = [
            'key'     => 'vehicle_actual_price',
            'type'    => 'NUMERIC',
            'value'   => array($min_price, $max_price),
            'compare' => 'BETWEEN',
        ];
    }
    if (!empty($vehicle_condition)) {
        $args['meta_query'][] = [
            'key'     => 'EGNS_VEHICLE_META_ID',
            'value'   => $vehicle_condition,
            'compare' => 'LIKE',
        ];
    }
    if (isset($brands) && count($brands) > 0) {
        $args['tax_query'][] = [
            'taxonomy'  => 'vehicle-brand',
            'field'     => 'name',
            'terms'     => $brands,
        ];
    }
    if (isset($body_types) && count($body_types) > 0) {
        $args['tax_query'][] = [
            'taxonomy'  => 'body-type',
            'field'     => 'name',
            'terms'     => $body_types,
        ];
    }
    if (isset($colors) && count($colors) > 0) {
        $args['tax_query'][] = [
            'taxonomy'  => 'colors',
            'field'     => 'name',
            'terms'     => $colors,
        ];
    }
    if (isset($location) && count($location) > 0) {
        $args['tax_query'][] = [
            'taxonomy'  => 'location',
            'field'     => 'name',
            'terms'     => $location,
        ];
    }
    $wp_query = new WP_Query($args);
    $num = 0;
?>
    <div class="list-grid-product-wrap grid-group-wrapper">
        <div class="row g-4 justify-content-center mb-40">
            <?php
            if ($wp_query->have_posts()) {
                while ($wp_query->have_posts()) :
                    $num++;
                    $wp_query->the_post();
                    echo Egns\Helper\Egns_Helper::egns_get_template_part('vehicle', 'content/archive-content-sidebar');
                endwhile;
            } else {
                // Include global posts not found
                Egns\Helper\Egns_Helper::egns_template_part('content', 'templates/posts-not-found');
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="pagination-and-next-prev">
                <div class="pagination" id="vehiclePagination">
                    <?php
                    // Pagination
                    Egns\Inc\Blog_Helper::egns_pagination();
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
    die();
}


// Handle bidding form submit
add_action('wp_ajax_egns_register_customer', 'egns_register_customer');
add_action('wp_ajax_nopriv_egns_register_customer', 'egns_register_customer');

function egns_register_customer()
{
    $message = '';
    $username   = sanitize_user($_POST['customer_info']['username']);
    $first_name = sanitize_user($_POST['customer_info']['first_name']);
    $last_name  = sanitize_user($_POST['customer_info']['last_name']);
    $email      = sanitize_email($_POST['customer_info']['email_address']);
    $password   = sanitize_text_field($_POST['customer_info']['password']);
    if (empty($username) || empty($email) || empty($password)) {
        return wp_send_json_error(['message' => __('Something went wrong!!', 'drivco')]);
    } else {
        $user_data = array(
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'user_login' => $username,
            'user_email' => $email,
            'user_pass'  => $password,
            'role'       => 'customer'
        );
        $user_id = wp_insert_user($user_data);
        if (is_wp_error($user_id)) {
            return wp_send_json_error(['message' => __('Something went wrong!!', 'drivco')]);
        } else {
            // Log in the user after successful registration
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
            do_action('wp_login', $username);
            return wp_send_json_success(['message' => __('Registration successful! You are now logged in.', 'drivco')]);
        }
    }
    die();
}

// Handle filter vehicle request
add_action('wp_ajax_egns_submit_auction_data', 'egns_submit_auction_data');
add_action('wp_ajax_nopriv_egns_submit_auction_data', 'egns_submit_auction_data');

function egns_submit_auction_data()
{
    $bidding_id     = !empty($_POST['bidding_info']['bidding_id']) ? sanitize_text_field($_POST['bidding_info']['bidding_id']) : null;
    $bidding_amount = !empty($_POST['bidding_info']['bidding_amount']) ? sanitize_text_field($_POST['bidding_info']['bidding_amount']) : null;
    $full_name      = !empty($_POST['bidding_info']['full_name']) ? sanitize_text_field($_POST['bidding_info']['full_name']) : null;
    $phone_number   = !empty($_POST['bidding_info']['phone_number']) ? sanitize_text_field($_POST['bidding_info']['phone_number']) : null;
    $email_address  = !empty($_POST['bidding_info']['email_address']) ? sanitize_text_field($_POST['bidding_info']['email_address']) : null;
    $message        = !empty($_POST['bidding_info']['message']) ? sanitize_text_field($_POST['bidding_info']['message']) : null;

    $auction_bidding = array(
        'post_type'     => 'auction-bidding',
        'post_title'    => $full_name,
        'post_status'   => 'publish',
    );
    $auction_bidding_id = wp_insert_post($auction_bidding);

    // Get Tour by Id
    $auction_bidded = get_post($bidding_id);
    $auction_meta_data = array(
        'auction_vehicle_id'    => $auction_bidded->post_title ?? '',
        'auction_full_name'     => $full_name,
        'auction_email_address' => $email_address,
        'auction_bidded_price'  => $bidding_amount,
    );
    add_post_meta($auction_bidding_id, 'egns_auction_metadata', $auction_meta_data);
}

add_action('wp_ajax_egns_login_customer', 'egns_login_customer');
add_action('wp_ajax_nopriv_egns_login_customer', 'egns_login_customer');


function egns_login_customer()
{
    $email      = sanitize_email($_POST['customer_login_info']['email_address']);
    $password   = sanitize_text_field($_POST['customer_login_info']['password']);
    if (empty($email) || empty($password)) {
        return wp_send_json_error(['message' => __('Something went wrong!!', 'drivco')]);
    } else {
        $creds = array(
            'user_login' => $email,
            'user_password' => $password,
            'remember' => true,
        );
        $user = wp_signon($creds, false);
        if (is_wp_error($user)) {
            return wp_send_json_error(['message' => __('Login failed. Please check your credentials.', 'drivco')]);
            echo '<div class="error"></div>';
        } else {
            return wp_send_json_success(['message' => __('Login successful. Redirecting...', 'drivco')]);
        }
    }
    die();
}

add_action('wp_ajax__egns_update_product_cart', '_egns_update_product_cart');
add_action('wp_ajax_nopriv__egns_update_product_cart', '_egns_update_product_cart');

function _egns_update_product_cart()
{
    $action = isset($_GET['update_type']) ? sanitize_text_field($_GET['update_type']) : '';
    if ($action == 'add') {
        $cart_count = WC()->cart->get_cart_contents_count() + 1;
        echo sprintf('%d', $cart_count);
    } elseif ($action == 'remove') {
        $cart_count = WC()->cart->get_cart_contents_count() - 1;
        echo sprintf('%d', $cart_count);
    }
    die();
}


add_action('wp_ajax__egns_car_calculator', '_egns_car_calculator');
add_action('wp_ajax_nopriv__egns_car_calculator', '_egns_car_calculator');


function _egns_car_calculator()
{
    $form_data = !empty($_GET['data']) ?  sanitize_text_field($_GET['data']) : null;
    $data = array();
    parse_str($form_data, $data);

    $currency =  \Egns\Helper\Egns_Helper::egns_vehicle_product_value_by_id($data['tour_post_id'], 'vehicle_currency_selector');


?>
    <h2><?php echo esc_html__('Installment Details', 'drivco') ?></h2>
    <?php

    $balance = (float) $data['vehicle_value'];

    $monthly_payment = (($data['interest_rate'] / (100 * 12)) * $data['vehicle_value']) / (1 - pow(1 + $data['interest_rate'] / 1200, (-$data['months'])));
    ?>
    <p>
        <?php echo esc_html__('Loan Payments:', 'drivco') ?> <b><?php echo $currency . number_format($monthly_payment * $data['months'], 2); ?></b><br />
        <?php echo esc_html__('Monthly Payment:', 'drivco') ?> <b><?php echo $currency . number_format($monthly_payment, 2); ?></b><br />
        <?php echo esc_html__('Total Interest:', 'drivco') ?> <b><?php echo $currency . number_format($monthly_payment * $data['months'] - $balance, 2); ?></b>
    </p>
    <table>
        <tbody>
            <tr>
                <th><?php echo esc_html__('Month', 'drivco') ?></th>
                <th><?php echo esc_html__('Balance', 'drivco') ?></th>
                <th><?php echo esc_html__('Principal', 'drivco') ?></th>
                <th><?php echo esc_html__('Interest', 'drivco') ?></th>
                <th><?php echo esc_html__('Payment', 'drivco') ?></th>
            </tr>
            <?php
            for ($month = 0; $month < (int)$data['months']; $month++) {
                $interest = $balance * $data['interest_rate'] / 1200;
                $principal = $monthly_payment - $interest;
            ?>
                <tr>
                    <td><?php echo $month + 1 ?></td>
                    <td><?php echo $currency . number_format($balance, 2) ?></td>
                    <td><?php echo $currency . number_format($principal, 2) ?></td>
                    <td><?php echo $currency . number_format($interest, 2) ?></td>
                    <td><?php echo $currency . number_format($monthly_payment, 2) ?></td>
                </tr>
            <?php
                $balance -= $principal;
            }
            ?>
        </tbody>
    </table>
<?php
    wp_die();
}
