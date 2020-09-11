<?php
if (!defined('ABSPATH')) {
    exit;
}
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($product_tabs)) :
    $tabs = [];
    $i = 0;
    foreach ($product_tabs as $key => $product_tab) :
        $tabs[$i] = $key;
        $i++;
    endforeach;
    echo '<div class="woocommerce-tabs wc-tabs-wrapper">';
    new OXI_TABS_PLUGINS\Modules\Shortcode(21, 'woocommerce', $product_tabs, $tabs);
    echo '</div>';
    do_action('woocommerce_product_after_tabs');
endif;