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
    public $customize;

    public static function instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct() {

        /*
         * Add Tabs Panel into WooCommerce Postbox
         */
        add_filter('woocommerce_product_data_tabs', [$this, 'add_postbox_tabs']);
        add_action('admin_head', [$this, 'oxilab_tabs_css_icon']);
        /*
         * Enqueue our JS / CSS files
         */
        // 
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts_and_styles'), 10, 1);
        /*
         * Tab content Panels
         */
        add_action('woocommerce_product_data_panels', [$this, 'add_product_panels']);
        add_action('woocommerce_process_product_meta', [$this, 'product_meta_fields_save']);
        add_action('woocommerce_init', array($this, 'init'));
    }

    public function init() {

        if ($this->use_the_content_filter()):
            add_filter('oxi_woo_tab_content_filter', array($this, 'content_filter'), 10, 1);
        endif;
        add_filter('oxi_woo_tab_product_tabs_content', 'do_shortcode');
        // Allow the use of shortcodes within the tab content
        // Add our custom product tabs section to the product page
        add_filter('woocommerce_product_tabs', array($this, 'add_custom_product_tabs'));
        // Add our custom product tabs layoouts to the product page
        $this->reorder_default_tabs();
        $settigs = get_option('oxilab_tabs_woocommerce_default');
        if ($settigs > 0):
            add_filter('woocommerce_locate_template', [$this, 'woo_template'], 1, 3);
        endif;
    }

    public function reorder_default_tabs() {
        $check_customization = json_decode(stripslashes(get_option('oxilab_tabs_woocommerce_customize_default_tabs')), true);

        if (is_array($check_customization) && count($check_customization) > 1):
            $customize = [];
            foreach ($check_customization as $key => $value) {
                if (isset($value['title']) && $value['title'] != ''):
                    $customize['title'][$key] = $value['title'];
                endif;
                if (isset($value['icon']) && $value['icon'] != ''):
                    $customize['icon'][$key] = $value['icon'];
                endif;
                if (isset($value['priority']) && $value['priority'] != ''):
                    $customize['priority'][$key] = $value['priority'];
                endif;
                if (isset($value['callback']) && $value['callback'] != ''):
                    $customize['callback'][$key] = $value['callback'];
                endif;
                if (isset($value['unset']) && $value['unset'] == 'on'):
                    $customize['unset'][$key] = $value['unset'];
                endif;
            }
            if (count($customize) > 0):
                $this->customize = $customize;
                add_filter('woocommerce_product_tabs', [$this, 'oxi_remove_product_tabs'], 10);
            endif;
        endif;
    }

    public function oxi_remove_product_tabs($tabs) {
        $customize = $this->customize;
        if (isset($customize['unset'])):
            foreach ($customize['unset'] as $k => $value) {
                if (isset($tabs[$k])):
                    unset($tabs[$k]);
                endif;
            }
        endif;
        if (isset($customize['title'])):
            foreach ($customize['title'] as $k => $value) {
                if (isset($tabs[$k])):
                    $tabs[$k]['title'] = $value;
                endif;
            }
        endif;
        if (isset($customize['icon'])):
            foreach ($customize['icon'] as $k => $value) {
                if (isset($tabs[$k])):
                    $tabs[$k]['custom_icon'] = $value;
                endif;
            }
        endif;
        if (isset($customize['priority'])):
            foreach ($customize['priority'] as $k => $value) {
                if (isset($tabs[$k])):
                    $tabs[$k]['priority'] = $value;
                endif;
            }
        endif;
        if (isset($customize['callback'])):
            foreach ($value as $k => $value) {
                if (isset($tabs[$k])):
                    $tabs[$k]['callback'] = $value;
                endif;
            }

        endif;
        return $tabs;
    }

    public function content_filter($content) {
        $content = function_exists('capital_P_dangit') ? capital_P_dangit($content) : $content;
        $content = function_exists('wptexturize') ? wptexturize($content) : $content;
        $content = function_exists('convert_smilies') ? convert_smilies($content) : $content;
        $content = function_exists('wpautop') ? wpautop($content) : $content;
        $content = function_exists('shortcode_unautop') ? shortcode_unautop($content) : $content;
        $content = function_exists('prepend_attachment') ? prepend_attachment($content) : $content;
        $content = function_exists('wp_filter_content_tags') ? wp_filter_content_tags($content) : $content;
        $content = function_exists('do_shortcode') ? do_shortcode($content) : $content;

        if (class_exists('WP_Embed')) {
            $embed = new \WP_Embed;
            $content = method_exists($embed, 'autoembed') ? $embed->autoembed($content) : $content;
        }

        return $content;
    }

    public function oxilab_tabs_css_icon() {
        echo '<style>
	#woocommerce-product-data ul.wc-tabs li.oxilab_tabs_options.oxilab_tabs_tab a:before{
		content: "\f163";
	}
	</style>';
    }

    public function add_postbox_tabs($tabs) {
        $tabs['oxilab_tabs'] = array(
            'label' => 'Oxilab Tabs',
            'target' => 'oxilab_tabs_product_data',
        );
        return $tabs;
    }

    public function add_product_panels() {
        global $post;
        $post_id = $post->ID;
        $new = new \OXI_TABS_PLUGINS\Modules\Shortcode();
        $get_style = $new->get_all_style();
        ?>
        <div id="oxilab_tabs_product_data" class="panel woocommerce_options_panel">
            <?php
            woocommerce_wp_select(array(
                'id' => '_oxilab_tabs_woo_layouts',
                'label' => __('Select Tabs Layots', 'my_theme_domain'),
                'description' => __('Select Layouts which ', OXI_TABS_TEXTDOMAIN),
                'desc_tip' => true,
                'options' => $get_style,
            ));
            $tabs = new \OXI_TABS_PLUGINS\Extension\WooCommerce\Admin();
            $tabs->render_html();
            ?>
        </div>
        <?php
    }

    public function product_meta_fields_save($post_id) {
        echo 'save the text field datasave the text field datasave the text field datasave the text field datasave the text field datasave the text field datasave the text field datasave the text field datasave the text field datasave the text field datasave the text field datasave the text field datasave the text field datasave the text field datasave the text field data';
        // save the woo layouts

        $layouts = isset($_POST['_oxilab_tabs_woo_layouts']) ? esc_attr($_POST['_oxilab_tabs_woo_layouts']) : '';
        if ($layouts != ''):
            update_post_meta($post_id, '_oxilab_tabs_woo_layouts', $layouts);
        else:
            delete_post_meta($post_id, '_oxilab_tabs_woo_layouts');
        endif;
        $tab_data = [];
        // save the woo data
        if (isset($_POST['_oxilab_tabs_woo_layouts_tab_title_'])):
            $titles = $_POST['_oxilab_tabs_woo_layouts_tab_title_'];
            $prioritys = $_POST['_oxilab_tabs_woo_layouts_tab_priority_'];
            $contents = $_POST['_oxilab_tabs_woo_layouts_tab_content_'];
            $callback = $_POST['_oxilab_tabs_woo_layouts_tab_callback_'];

            foreach ($titles as $key => $value) {
                $tab_title = stripslashes($titles[$key]);
                $tab_priority = stripslashes($prioritys[$key]);
                $tab_callback = stripslashes($callback[$key]);
                $tab_content = stripslashes($contents[$key]);
                if (empty($tab_title) && empty($tab_priority)):
                    return false;
                else:
                    $tab_data[$key] = [
                        'title' => $tab_title,
                        'priority' => $tab_priority,
                        'callback' => $tab_callback,
                        'content' => $tab_content,
                    ];
                endif;
            }
        endif;
        if (count($tab_data) == 0):
            delete_post_meta($post_id, '_oxilab_tabs_woo_data');
        else:
            $tab_data = array_values($tab_data);
            update_post_meta($post_id, '_oxilab_tabs_woo_data', $tab_data);
        endif;
    }

    public function enqueue_scripts_and_styles($hook) {
        global $post;
        global $wp_version;
        if ($hook === 'post-new.php' || $hook === 'post.php') {
            if (isset($post->post_type) && $post->post_type === 'product') {
                if (function_exists('wp_enqueue_editor')) {
                    wp_enqueue_editor();
                }
                wp_enqueue_style('oxilab_tabs_woo-styles', OXI_TABS_URL . 'assets/woocommerce/css/admin.css', false, OXI_TABS_PLUGIN_VERSION);
                wp_enqueue_script('oxilab_tabs_woo_admin', OXI_TABS_URL . 'assets/woocommerce/js/admin.js', false, OXI_TABS_PLUGIN_VERSION);
            }
        }
    }

    public function add_custom_product_tabs($tabs) {
        global $product;
        $product_id = method_exists($product, 'get_id') === true ? $product->get_id() : $product->ID;
        $product_tabs = maybe_unserialize(get_post_meta($product_id, '_oxilab_tabs_woo_data', true));
        if (is_array($product_tabs) && !empty($product_tabs)) {
            $priority = 25;
            foreach ($product_tabs as $key => $tab) {
                if (empty($tab['title'])) {
                    continue;
                }
                $default = [
                    'priority' => $priority++,
                    'callback' => ''
                ];
                $tab = array_merge($default, $tab);
                $keys = urldecode(sanitize_title($tab['title']));
                if (array_key_exists($keys, $tabs)):
                    $k = 100;
                    for ($i = 0; $i < $k; $i++) {
                        $new = $keys . '-' . $i;
                        if (array_key_exists($new, $tabs) == false):
                            $keys = $new;
                            break;
                        endif;
                    }
                endif;
                if ($tab['callback'] == ''):
                    $tab['callback'] = [$this, 'product_tabs_content'];
                endif;

                $tabs[$keys] = array(
                    'title' => $tab['title'],
                    'priority' => $tab['priority'],
                    'callback' => $tab['callback'],
                    'content' => $tab['content']
                );
            }
        }
        return $tabs;
    }

    public function product_tabs_content($key, $tab) {
        $content = '';
        $content = apply_filters('oxi_woo_tab_content_filter', $tab['content']);
        $sub = get_option('oxi_tabs_woo_sub_title');
        if ($sub):
            $tab_title_html = '<h2 class="oxi_woo_tab-title oxi_woo_tab-tab-title-' . urldecode(sanitize_title($tab['title'])) . '">' . $tab['title'] . '</h2>';
            echo apply_filters('oxi_woo_tab_product_tabs_heading', $tab_title_html, $tab);
        endif;

        echo apply_filters('oxi_woo_tab_product_tabs_content', $content, $tab);
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

    /**
     * Check if we should use the filter
     */
    public function use_the_content_filter() {
        return get_option('oxi_tabs_use_the_content') == 'yes' ? true : false;
    }

}
