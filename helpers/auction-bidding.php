<?php

function egns_auction_custom_columns_order($columns)
{
    $new_columns = array(
        'cb' => !empty($columns['cb']) ? $columns['cb'] : false, // Checkbox column
        'title' => $columns['title'],
        'custom_column_1' => esc_html__('Customer Username', 'drivco'),
        'custom_column_2' => esc_html__('Bidding Price', 'drivco'),
        'custom_column_3' => esc_html__('Email', 'drivco'),
        'date' => $columns['date'],
    );

    return $new_columns;
}

function egns_auction_custom_columns_data($column_name, $post_id)
{
    $price = Egns_Core\Egns_Helper::egns_vehicle_auction_value($post_id, 'auction_bidded_price');
    $email_address = Egns_Core\Egns_Helper::egns_vehicle_auction_value($post_id, 'auction_email_address');
    $full_name = Egns_Core\Egns_Helper::egns_vehicle_auction_value($post_id, 'auction_full_name');
    $auction_currency = Egns_Core\Egns_Helper::egns_vehicle_auction_value($post_id, 'auction_currency');
    // Add logic to populate your custom columns with data
    if ($column_name == 'custom_column_1') {
        echo sprintf('%s', $full_name);
    }
    if ($column_name == 'custom_column_2') {
?>
        <b><?php echo sprintf('%s%d', $auction_currency, $price); ?></b>
    <?php
    }
    if ($column_name == 'custom_column_3') {
    ?>
        <b><?php echo sprintf('%s', $email_address); ?></b>
<?php
    }
}

// Adjust 'auction-bidding' with your custom post type slug
add_filter('manage_edit-auction-bidding_columns', 'egns_auction_custom_columns_order');
add_action('manage_auction-bidding_posts_custom_column', 'egns_auction_custom_columns_data', 10, 2);
