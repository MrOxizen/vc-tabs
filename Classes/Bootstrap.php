<?php

namespace OXI_TABS_PLUGINS\Classes;

if (!defined('ABSPATH'))
    exit;

/**
 * Description of Bootstrap
 *
 * @author biplo
 */
use OXI_TABS_PLUGINS\Classes\Build_Api as Build_Api;

class Bootstrap {

    use \OXI_TABS_PLUGINS\Helper\Public_Helper;
    use \OXI_TABS_PLUGINS\Helper\Admin_helper;

    // instance container
    private static $instance = null;

    /**
     * Define $wpdb
     *
     * @since 3.1.0
     */
    public $database;

    const ADMINMENU = 'get_oxilab_addons_menu';

    public static function instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct() {
        do_action('oxi-tabs-plugin/before_init');
        // Load translation
        add_action('init', array($this, 'i18n'));
        $this->Shortcode_loader();
        new Build_Api();
        if (is_admin()) {
            $this->Admin_Filters();
            $this->User_Admin();
            $this->User_Reviews();
            if (isset($_GET['page']) && 'oxi-tabs-style-view' === $_GET['page']) {
                new \OXI_TABS_PLUGINS\Modules\Template();
            }
        }
    }

    /**
     * Load Textdomain
     *
     * @since 3.1.0
     * @access public
     */
    public function i18n() {
        load_plugin_textdomain('oxi-tabs-plugin');
        $this->database = new \OXI_TABS_PLUGINS\Helper\Database();
    }

    /**
     * Shortcode loader
     *
     * @since 3.1.0
     * @access public
     */
    protected function Shortcode_loader() {
        add_shortcode('ctu_ultimate_oxi', [$this, 'tabs_shortcode']);
        new \OXI_TABS_PLUGINS\Modules\Visual_Composer();
        $Tabs_Widget = new \OXI_TABS_PLUGINS\Modules\Tabs_Widget();
        add_filter('widget_text', 'do_shortcode');
        add_action('widgets_init', array($Tabs_Widget, 'tabs_register_tabswidget'));
        add_filter('the_content', [$this, 'view_count_jquery']);
    }

    /**
     * Execute Shortcode
     *
     * @since 3.1.0
     * @access public
     */
    public function tabs_shortcode($atts) {
        extract(shortcode_atts(array('id' => ' ',), $atts));
        $styleid = $atts['id'];
        ob_start();
        $this->shortcode_render($styleid, 'user');
        return ob_get_clean();
    }

    public function Admin_Filters() {
//        echo $this->fixed_data('76632d746162732d737570706f72742d616e642d636f6d6d656e7473');
//        echo $this->fixed_data('6f78692d746162732d706c7567696e2f70726f5f76657273696f6e');
//        echo $this->fixed_data('6f78692d746162732d706c7567696e2f61646d696e5f6d656e75');
        add_filter('vc-tabs-support-and-comments', array($this, $this->fixed_data('537570706f7274416e64436f6d6d656e7473')));
        add_filter('oxi-tabs-plugin/pro_version', array($this, $this->fixed_data('636865636b5f63757272656e745f74616273')));
        add_filter('oxi-tabs-plugin/admin_menu', array($this, $this->fixed_data('6f78696c61625f61646d696e5f6d656e75')));
    }

    public function User_Admin() {
        add_action('admin_menu', [$this, 'Admin_Menu']);
        add_action('admin_head', [$this, 'Tabs_Icon']);
    }

    public function view_count_jquery($content) {
        if (!is_single()):
            return $content; // Only on single posts
        endif;

        global $post;
        $id = $post->ID;

        $exclude_admins = apply_filters('oxi_view_count_exclude_admins', false);
        if ($exclude_admins === true):
            $exclude_admins = 'edit_posts';
        endif;
        if ($exclude_admins && current_user_can($exclude_admins)):
            return $content;
        endif;

        $count = get_post_meta($id, '_oxi_post_view_count', true);
        if ((int) $count):
            update_post_meta($id, '_oxi_post_view_count', $count + 1);
        else:
            update_post_meta($id, '_oxi_post_view_count', 1);
        endif;

        remove_filter('the_content', [$this, 'view_count_jquery']);

        return $content;
    }

}

// public function vc_tabs_settings() {
//        //register our settings
//        register_setting('oxi-addons-vc-tabs-settings-group', 'oxi_addons_user_permission');
//        register_setting('oxi-addons-vc-tabs-settings-group', 'oxi_addons_font_awesome');
//        register_setting('oxi-addons-vc-tabs-settings-group', 'oxi_addons_font_awesome_version');
//        register_setting('oxi-addons-vc-tabs-settings-group', 'oxi_addons_fixed_header_size');
//    }
//
//    public function register_license() {
//        register_setting('responsive_tabs_with_accordions_license', 'responsive_tabs_with_accordions_license_key', [$this, 'sanitize_license']);
//    }
//
//    public function sanitize_license($new) {
//        $old = get_option('responsive_tabs_with_accordions_license_key');
//        if ($old && $old != $new) {
//            delete_option('responsive_tabs_with_accordions_license_status');
//        }
//        return $new;
//    }
//
//    public function activate_license() {
//
//        if (isset($_POST['responsive_tabs_with_accordions_license_activate'])) {
//
//
//            if (!check_admin_referer('responsive_tabs_with_accordions_nonce', 'responsive_tabs_with_accordions_nonce'))
//                return;
//            $license = trim(get_option('responsive_tabs_with_accordions_license_key'));
//
//            $api_params = array(
//                'edd_action' => 'activate_license',
//                'license' => $license,
//                'item_name' => urlencode('Responsive Tabs with Accordions'),
//                'url' => home_url()
//            );
//
//            $response = wp_remote_post('https://www.oxilab.org', array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));
//
//            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
//                if (is_wp_error($response)) {
//                    $message = $response->get_error_message();
//                } else {
//                    $message = __('An error occurred, please try again.');
//                }
//            } else {
//
//                $license_data = json_decode(wp_remote_retrieve_body($response));
//
//                if (false === $license_data->success) {
//
//                    switch ($license_data->error) {
//
//                        case 'expired' :
//
//                            $message = sprintf(
//                                    __('Your license key expired on %s.'), date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
//                            );
//                            break;
//
//                        case 'revoked' :
//
//                            $message = __('Your license key has been disabled.');
//                            break;
//
//                        case 'missing' :
//
//                            $message = __('Invalid license.');
//                            break;
//
//                        case 'invalid' :
//                        case 'site_inactive' :
//
//                            $message = __('Your license is not active for this URL.');
//                            break;
//
//                        case 'item_name_mismatch' :
//
//                            $message = sprintf(__('This appears to be an invalid license key for %s.'), Responsive_Tabs_with_Accordions);
//                            break;
//
//                        case 'no_activations_left':
//
//                            $message = __('Your license key has reached its activation limit.');
//                            break;
//
//                        default :
//
//                            $message = __('An error occurred, please try again.');
//                            break;
//                    }
//                }
//            }
//
//            if (!empty($message)) {
//                $base_url = admin_url('admin.php?page=oxi-tabs-ultimate-settings');
//                $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);
//
//                wp_redirect($redirect);
//                exit();
//            }
//            update_option('responsive_tabs_with_accordions_license_status', $license_data->license);
//            wp_redirect(admin_url('admin.php?page=oxi-tabs-ultimate-settings'));
//            exit();
//        }
//    }
//
//    public function deactivate_license() {
//        if (isset($_POST['responsive_tabs_with_accordions_license_deactivate'])) {
//            if (!check_admin_referer('responsive_tabs_with_accordions_nonce', 'responsive_tabs_with_accordions_nonce'))
//                return;
//            $license = trim(get_option('responsive_tabs_with_accordions_license_key'));
//            $api_params = array(
//                'edd_action' => 'deactivate_license',
//                'license' => $license,
//                'item_name' => urlencode('Responsive Tabs with Accordions'),
//                'url' => home_url()
//            );
//
//            $response = wp_remote_post('https://www.oxilab.org', array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));
//
//
//            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
//
//                if (is_wp_error($response)) {
//                    $message = $response->get_error_message();
//                } else {
//                    $message = __('An error occurred, please try again.');
//                }
//
//                $base_url = admin_url('admin.php?page=oxi-tabs-ultimate-settings');
//                $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);
//
//                wp_redirect($redirect);
//                exit();
//            }
//            $license_data = json_decode(wp_remote_retrieve_body($response));
//            if ($license_data->license == 'deactivated') {
//                delete_option('responsive_tabs_with_accordions_license_status');
//            }
//
//            wp_redirect(admin_url('admin.php?page=oxi-tabs-ultimate-settings'));
//            exit();
//        }
//    }