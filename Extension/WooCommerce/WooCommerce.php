<?php

namespace OXI_TABS_PLUGINS\Extension\WooCommerce;

/**
 * Description of WooCommerce
 *
 * @author biplo
 */
class WooCommerce {

// instance container
    private static $instance = null;

    /**
     * Define $wpdb
     *
     * @since 3.1.0
     */
    public $database;

    public static function instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct() {
        add_filter('woocommerce_locate_template', [$this, 'woo_template'], 1, 3);
    }

    public function woo_template($template, $template_name, $template_path) {
        global $woocommerce;
        $_Parent_Template = $template;
        if (!$template_path):
            $template_path = $woocommerce->template_url;
        endif;
        $plugin_path = untrailingslashit(OXI_TABS_PATH) . '/Extension/WooCommerce/Template/';
        if (file_exists($plugin_path . $template_name)):
            $template = $plugin_path . $template_name;
        endif;

        if (!$template):
            $template = locate_template(
                    array(
                        $template_path . $template_name,
                        $template_name
                    )
            );
        endif;

        if (!$template):
            $template = $_Parent_Template;
        endif;

        return $template;
    }

}
