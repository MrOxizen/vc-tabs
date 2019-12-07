<?php

namespace OXI_TABS_PLUGINS\Helper;

/**
 *
 * @author biplo
 */
trait CSS_JS_Loader {

    public function loader_font_familly_validation($data = []) {
        foreach ($data as $value) {
            wp_enqueue_style('' . $value . '', 'https://fonts.googleapis.com/css?family=' . $value . '');
        }
    }

    public function admin_css() {
        $this->loader_font_familly_validation(['Bree+Serif', 'Source+Sans+Pro']);
        wp_enqueue_style('oxilab-tabs-bootstrap', OXI_TABS_URL . 'assets/backend/css/bootstrap.min.css', false, OXI_TABS_PLUGIN_VERSION);
        wp_enqueue_style('font-awsome.min', OXI_TABS_URL . 'assets/frontend/css/font-awsome.min.css', false, OXI_TABS_PLUGIN_VERSION);
        wp_enqueue_style('oxilab-admin-css', OXI_TABS_URL . '/assets/backend/css/admin.css', false, OXI_TABS_PLUGIN_VERSION);
    }

    public function admin_js() {
        wp_enqueue_script("jquery");
        wp_enqueue_script('oxilab-popper', OXI_TABS_URL . '/assets/backend/js/popper.min.js', false, OXI_TABS_PLUGIN_VERSION);
        wp_enqueue_script('oxilab-bootstrap', OXI_TABS_URL . '/assets/backend/js/bootstrap.min.js', false, OXI_TABS_PLUGIN_VERSION);
    }

    public function admin_home() {
        wp_enqueue_script("jquery");
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-widget');
        wp_enqueue_script('jquery-ui-mouse');
        wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script('jquery-ui-autocomplete');
        wp_enqueue_script('jquery-ui-slider');
        wp_enqueue_script('jquery-ui-draggable');
        wp_enqueue_script('jquery.dataTables.min', OXI_TABS_URL . '/assets/backend/js/jquery.dataTables.min.js', false, OXI_TABS_PLUGIN_VERSION);
        wp_enqueue_script('dataTables.bootstrap.min', OXI_TABS_URL . '/assets/backend/js/dataTables.bootstrap.min.js', false, OXI_TABS_PLUGIN_VERSION);
    }

    public function admin_css_loader() {
        $this->admin_css();
        $this->admin_js();
    }

}
