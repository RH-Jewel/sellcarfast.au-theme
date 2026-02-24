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

        // Start meta query
        $meta_query_array = array('relation' => 'AND');
        $vehicle_condition_info_value ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $vehicle_condition_info_value, 'compare' => 'LIKE')) : null;
        $vehicle_condition ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $vehicle_condition, 'compare' => 'LIKE')) : null;
        $vehicle_type ? array_push($meta_query_array, array('key' => 'EGNS_VEHICLE_META_ID', 'value' => $vehicle_type, 'compare' => 'LIKE')) : null;
        $steering ? array_push($meta_query_array, array('key'     => 'EGNS_VEHICLE_META_ID', 'value' => $steering, 'compare'     => 'LIKE')) : null;
        $fuel ? array_push($meta_query_array, array('key'        => 'EGNS_VEHICLE_META_ID', 'value' => $fuel, 'compare'         => 'LIKE')) : null;
        $min_miles ? array_push($meta_query_array, array('key'   => 'EGNS_VEHICLE_META_ID', 'value' => $min_miles, 'compare'    => 'LIKE')) : null;
        $max_miles ? array_push($meta_query_array, array('key'   => 'EGNS_VEHICLE_META_ID', 'value' => $max_miles, 'compare'    => 'LIKE')) : null;
        $vehicle_min_price && $vehicle_max_price ? array_push($meta_query_array, array('key' => 'vehicle_actual_price', 'type' => 'NUMERIC', 'value' => array($vehicle_min_price, $vehicle_max_price), 'compare' => 'BETWEEN')) : null;
        $min_miles && $max_miles ? array_push($meta_query_array, array('key' => 'vehicle_milage_info_value', 'type' => 'NUMERIC', 'value' => array($min_miles, $max_miles), 'compare' => 'BETWEEN')) : null;
        // final meta_query
        $query->set('meta_query', $meta_query_array);

        // Start taxonomy query
        $tax_query_array = array('relation' => 'AND');
        if (!empty($locations)) {
            $locations ? array_push($tax_query_array, array('taxonomy'      => 'location', 'field'      => 'name', 'terms' => $locations)) : null;
        }
        if (!empty($vehicle_brand)) {
            $vehicle_brand ? array_push($tax_query_array, array('taxonomy'  => 'vehicle-brand', 'field' => 'name', 'terms' => $vehicle_brand)) : null;
        }
        if (!empty($color)) {
            $color ? array_push($tax_query_array, array('taxonomy'         => 'colors', 'field'        => 'name', 'terms' => $color)): null;
        }
        if( !empty( $years ) ) {
            $years ? array_push($tax_query_array, array('taxonomy'         => 'vehicle-year', 'field'        => 'name', 'terms' => $years) ): null ;
        }
        if( !empty( $body_type ) ) {
            $body_type ? array_push($tax_query_array, array('taxonomy'     => 'body-type', 'field'        => 'name', 'terms' => $body_type) ): null ;
        }
        if( !empty( $vehicle_model ) ) {
            $vehicle_model ? array_push($tax_query_array, array('taxonomy' => 'vehicle-model', 'field'        => 'name', 'terms' => $vehicle_model) ): null ;
        }
        if( !empty( $vehicle_category ) ) {
            $vehicle_category ? array_push($tax_query_array, array('taxonomy' => 'vehicle-category', 'field'        => 'name', 'terms' => $vehicle_category) ): null ;
        }
        // final tax_query
        $query->set('tax_query', $tax_query_array);
    }
}
add_action('pre_get_posts', 'egns_vechiles_filter');
