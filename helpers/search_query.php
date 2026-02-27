<?php
function add_query_vars_filter($vars)
{
    // add custom query vars that will be public
    // https://codex.wordpress.org/WordPress_Query_Vars
    $vars[]     .= 'vehicle_type';
    $vars[]     .= 'vehicle_min_price';
    $vars[]     .= 'vehicle_max_price';
    $vars[]     .= 'vehicle_brand';
    $vars[]     .= 'locations';
    $vars[]     .= 'brand';
    $vars[]     .= 'body-type';
    $vars[]     .= 'fuel';
    $vars[]     .= 'steering';
    $vars[]     .= 'color';
    $vars[]     .= 'years';
    $vars[]     .= 'min_miles';
    $vars[]     .= 'max_miles';
    $vars[]     .= 'vehicle_condition';
    $vars[]     .= 'vehicle_category';
    $vars[]     .= 'vehicle_model';
    $vars[]     .= 'title';

    // sellcarfast.au filter
    $vars[]     .= 'vehicle_tab';
    $vars[]     .= 'vehicle_make';
    // $vars[]     .= 'vehicle_model';
    $vars[]     .= 'vehicle_year';
    $vars[]     .= 'vehicle_states';
    // $vars[]     .= 'vehicle_location';
    $vars[]     .= 'custom_keyword';
    $vars[]     .= 'sale_type';

    return $vars;
}
add_filter('query_vars', 'add_query_vars_filter');
/**
 * Override Vehicle Archive Query
 * https://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
 */

function egns_vechiles_filter($query)
{

    if ($query->is_archive('vehicle') && $query->is_main_query() && !is_admin()) {
        $vehicle_type                 = get_query_var('vehicle_type');
        $vehicle_condition_info_value = get_query_var('vehicle_condition_info_value');
        $vehicle_condition            = get_query_var('vehicle_condition');
        $vehicle_min_price            = get_query_var('vehicle_min_price');
        $vehicle_max_price            = get_query_var('vehicle_max_price');
        $vehicle_brand                = get_query_var('vehicle_brand');
        $vehicle_model                = get_query_var('vehicle_model');
        $locations                    = get_query_var('locations');
        $body_type                    = get_query_var('body-type');
        $fuel                         = get_query_var('fuel');
        $steering                     = get_query_var('steering');
        $color                        = get_query_var('color');
        $years                        = get_query_var('years');
        $min_miles                    = get_query_var('min_miles');
        $max_miles                    = get_query_var('max_miles');

        // sellcarfast.au filter
        $vehicle_tab  = get_query_var('vehicle_tab');
        $vehicle_make = get_query_var('vehicle_make');
        // $vehicle_model = get_query_var('vehicle_model');
        $vehicle_year   = get_query_var('vehicle_year');
        $vehicle_states = get_query_var('vehicle_states');
        // $vehicle_location = get_query_var('vehicle_location');
        $custom_keyword = get_query_var('custom_keyword');
        $sale_type      = get_query_var('sale_type');

        // Start meta query
        $meta_query_array = array('relation' => 'AND');

        // sellcarfast.au filter
        $custom_keyword ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $custom_keyword, 'compare' => 'LIKE')) : null;

        // main filter 
        $vehicle_condition_info_value ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $vehicle_condition_info_value, 'compare' => 'LIKE')) : null;
        $vehicle_condition ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $vehicle_condition, 'compare' => 'LIKE')) : null;
        $vehicle_type ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $vehicle_type, 'compare' => 'LIKE')) : null;
        $steering ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $steering, 'compare' => 'LIKE')) : null;
        $fuel ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $fuel, 'compare' => 'LIKE')) : null;
        $min_miles ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $min_miles, 'compare' => 'LIKE')) : null;
        $max_miles ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $max_miles, 'compare' => 'LIKE')) : null;
        $vehicle_min_price && $vehicle_max_price ? array_push($meta_query_array, array('key' => 'vehicle_actual_price', 'type' => 'NUMERIC', 'value' => array($vehicle_min_price, $vehicle_max_price), 'compare' => 'BETWEEN')) : null;
        $min_miles && $max_miles ? array_push($meta_query_array, array('key' => 'vehicle_milage_info_value', 'type' => 'NUMERIC', 'value' => array($min_miles, $max_miles), 'compare' => 'BETWEEN')) : null;
        // final meta_query
        $query->set('meta_query', $meta_query_array);

        // Start taxonomy query
        $tax_query_array = array('relation' => 'AND');

        // sellcarfast.au filter
        if (!empty($vehicle_tab)) {
            $vehicle_tab ? array_push($tax_query_array, array('taxonomy' => 'vehicle-tab', 'field' => 'name', 'terms' => $vehicle_tab)) : null;
        }
        if (!empty($vehicle_make)) {
            $vehicle_make ? array_push($tax_query_array, array('taxonomy' => 'vehicle-make', 'field' => 'name', 'terms' => $vehicle_make)) : null;
        }
        // if (!empty($vehicle_model)) {
        //     $vehicle_model ? array_push($tax_query_array, array('taxonomy' => 'vehicle-model', 'field' => 'name', 'terms' => $vehicle_model)) : null;
        // }
        if (!empty($vehicle_year)) {
            $vehicle_year ? array_push($tax_query_array, array('taxonomy' => 'vehicle-year', 'field' => 'name', 'terms' => $vehicle_year)) : null;
        }
        if (!empty($vehicle_states)) {
            $vehicle_states ? array_push($tax_query_array, array('taxonomy' => 'vehicle-states', 'field' => 'name', 'terms' => $vehicle_states)) : null;
        }
        // if (!empty($vehicle_location)) {
        //     $vehicle_location ? array_push($tax_query_array, array('taxonomy' => 'location', 'field' => 'name', 'terms' => $vehicle_location)) : null;
        // }
        if (!empty($sale_type)) {
            $sale_type ? array_push($tax_query_array, array('taxonomy' => 'sale-type', 'field' => 'name', 'terms' => $sale_type)) : null;
        }

        // main filter 
        if (!empty($locations)) {
            $locations ? array_push($tax_query_array, array('taxonomy' => 'location', 'field' => 'name', 'terms' => $locations)) : null;
        }
        if (!empty($vehicle_brand)) {
            $vehicle_brand ? array_push($tax_query_array, array('taxonomy' => 'vehicle-brand', 'field' => 'name', 'terms' => $vehicle_brand)) : null;
        }
        if (!empty($color)) {
            $color ? array_push($tax_query_array, array('taxonomy' => 'colors', 'field' => 'name', 'terms' => $color)) : null;
        }
        if (!empty($years)) {
            $years ? array_push($tax_query_array, array('taxonomy' => 'vehicle-year', 'field' => 'name', 'terms' => $years)) : null;
        }
        if (!empty($body_type)) {
            $body_type ? array_push($tax_query_array, array('taxonomy' => 'body-type', 'field' => 'name', 'terms' => $body_type)) : null;
        }
        if (!empty($vehicle_model)) {
            $vehicle_model ? array_push($tax_query_array, array('taxonomy' => 'vehicle-model', 'field' => 'name', 'terms' => $vehicle_model)) : null;
        }
        if (!empty($vehicle_category)) {
            $vehicle_category ? array_push($tax_query_array, array('taxonomy' => 'vehicle-category', 'field' => 'name', 'terms' => $vehicle_category)) : null;
        }
        // final tax_query
        $query->set('tax_query', $tax_query_array);
    }
}
add_action('pre_get_posts', 'egns_vechiles_filter');
