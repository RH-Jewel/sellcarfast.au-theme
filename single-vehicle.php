<?php

get_header();

?>


<?php
// Include vehicle single product template
Egns\Helper\Egns_Helper::egns_template_part('vehicle', 'content/single-vehicle');
?>


<?php
if (\Egns\Helper\Egns_Helper::egns_get_theme_option('vehicle_related_switcher') == 1) {
    // Include vehicle releted product template
    Egns\Helper\Egns_Helper::egns_template_part('vehicle', 'content/vehicle-related-brand');
}
?>

<?php
get_footer();
