<?php

namespace OXI_TABS_PLUGINS\Render;

/**
 * Render Core Class
 *
 * 
 * @author biplob018
 * @package Oxilab Tabs Ultimate
 * @since 3.3.0
 */
class Render {

    /**
     * Current Elements id
     *
     * @since 3.3.0
     */
    public $oxiid;

    /**
     * Current Elements Style Data
     *
     * @since 3.3.0
     */
    public $style = [];

    /**
     * Current Elements Style Full
     *
     * @since 3.3.0
     */
    public $dbdata = [];

    /**
     * Current Elements multiple list data
     *
     * @since 3.3.0
     */
    public $child = [];

    /**
     * Current Elements Global CSS Data
     *
     * @since 3.3.0
     */
    public $CSSDATA = [];

    /**
     * Current Elements Global CSS Data
     *
     * @since 3.3.0
     */
    public $inline_css;

    /**
     * Current Elements Global JS Handle
     *
     * @since 3.3.0
     */
    public $JSHANDLE = 'oxi-tabs-ultimate';

    /**
     * Current Elements Global DATA WRAPPER
     *
     * @since 3.3.0
     */
    public $WRAPPER;

    /**
     * Current Elements Admin Control
     *
     * @since 3.3.0
     */
    public $admin;

    /**
     * load constructor
     *
     * @since 3.3.0
     */

    /**
     * Define $wpdb
     *
     * @since 3.3.0
     */
    public $wpdb;

    /**
     * Database Parent Table
     *
     * @since 3.3.0
     */
    public $parent_table;

    /**
     * Database Import Table
     *
     * @since 3.3.0
     */
    public $import_table;

    /**
     * Database Style Name
     *
     * @since 3.3.0
     */
    public $style_name;

    /**
     * Database Import Table
     *
     * @since 3.3.0
     */
    public $child_table;

    public function __construct(array $dbdata = [], array $child = [], $admin = 'user') {
        if (count($dbdata) > 0):
            global $wpdb;
            $this->dbdata = $dbdata;
            $this->child = $child;
            $this->admin = $admin;
            $this->style_name = ucfirst($dbdata['style_name']);
            $this->wpdb = $wpdb;
            $this->parent_table = $this->wpdb->prefix . 'content_tabs_ultimate_style';
            $this->child_table = $this->wpdb->prefix . 'content_tabs_ultimate_list';
            if (array_key_exists('id', $this->dbdata)):
                $this->oxiid = $this->dbdata['id'];
            else:
                $this->oxiid = rand(100000, 200000);
            endif;
            $this->loader();
        endif;
    }

    /**
     * Current element loader
     *
     * @since 3.3.0
     */
    public function loader() {
        $this->style = json_decode(stripslashes($this->dbdata['rawdata']), true);
        $this->CSSDATA = $this->dbdata['stylesheet'];
        $this->WRAPPER = 'oxi-tabs-wrapper-' . $this->dbdata['id'];
        $this->hooks();
    }

    /**
     * load css and js hooks
     *
     * @since 3.3.0
     */
    public function hooks() {
        $this->public_jquery();
        $this->public_css();
        $this->public_frontend_loader();
        $this->render();
        $inlinecss = $this->inline_public_css() . $this->inline_css . (array_key_exists('oxi-tabs-start-tabs-css', $this->style) ? $this->style['oxi-tabs-start-tabs-css'] : '');
        $inlinejs = $this->inline_public_jquery();
        if ($this->CSSDATA == '' && $this->admin == 'admin') {
            $cls = '\OXI_TABS_PLUGINS\Render\Admin\\' . $this->style_name;
            $CLASS = new $cls('admin');
            $inlinecss .= $CLASS->inline_template_css_render($this->style);
        } else {
            echo $this->font_familly_validation(json_decode(($this->dbdata['font_family'] != '' ? $this->dbdata['font_family'] : "[]"), true));
            $inlinecss .= $this->CSSDATA;
        }
        if ($inlinejs != ''):
            if ($this->admin == 'admin'):
                echo _('<script>
                        (function ($) {
                            setTimeout(function () {');
                echo $inlinejs;
                echo _('    }, 2000);
                        })(jQuery)</script>');
            else:
                $jquery = '(function ($) {' . $inlinejs . '})(jQuery);';
                wp_add_inline_script($this->JSHANDLE, $jquery);
            endif;
        endif;
        if ($inlinecss != ''):
            $inlinecss = html_entity_decode($inlinecss);
            if ($this->admin == 'admin'):
                //only load while ajax called
                echo _('<style>');
                echo $inlinecss;
                echo _('</style>');
            else:
                wp_add_inline_style('oxi-tabs-ultimate', $inlinecss);
            endif;
        endif;
    }

    /**
     * front end loader css and js
     *
     * @since 3.3.0
     */
    public function public_frontend_loader() {
        wp_enqueue_script("jquery");
        wp_enqueue_style('oxi-tabs-ultimate', OXI_TABS_URL . 'assets/frontend/css/style.css', false, OXI_TABS_PLUGIN_VERSION);
        wp_enqueue_style('oxi-plugin-animate', OXI_TABS_URL . 'assets/frontend/css/animate.css', false, OXI_TABS_PLUGIN_VERSION);
        wp_enqueue_style('oxi-tabs-' . strtolower($this->style_name), OXI_TABS_URL . 'Render/Files/' . strtolower($this->style_name) . '.css', false, OXI_TABS_PLUGIN_VERSION);
        wp_enqueue_script('oxi-tabs-ultimate', OXI_TABS_URL . 'assets/frontend/js/tabs.js', false, OXI_TABS_PLUGIN_VERSION);
    }

    /**
     * load current element render since 3.3.0
     *
     * @since 3.3.0
     */
    public function render() {
        if ($this->admin == 'request'):
            $this->default_render($this->style, $this->child, $this->admin);
        else:
            echo '<div class="oxi-addons-container ' . $this->WRAPPER . '" id="' . $this->WRAPPER . '">
                 <div class="oxi-addons-row">';
            $this->default_render($this->style, $this->child, $this->admin);
            echo '   </div>
              </div>';
        endif;
    }

    /**
     * load public jquery
     *
     * @since 3.3.0
     */
    public function public_jquery() {
        echo '';
    }

    /**
     * load public css
     *
     * @since 3.3.0
     */
    public function public_css() {
        echo '';
    }

    /**
     * load inline public jquery
     *
     * @since 3.3.0
     */
    public function inline_public_jquery() {
        echo '';
    }

    /**
     * load inline public css
     *
     * @since 3.3.0
     */
    public function inline_public_css() {
        echo '';
    }

    /**
     * load default render
     *
     * @since 3.3.0
     */
    public function default_render($style, $child, $admin) {
        echo '';
    }

    /**
     * load default render
     *
     * @since 3.3.0
     */
    public function Json_Decode($rawdata) {
        return $rawdata != '' ? json_decode(stripcslashes($rawdata), true) : [];
    }

    public function font_familly_validation($data = []) {
        $api = get_option('oxi_addons_google_font');
        if ($api == 'no'):
            return;
        endif;
        foreach ($data as $value) {
            wp_enqueue_style('' . $value . '', 'https://fonts.googleapis.com/css?family=' . $value . '');
        }
    }

    public function array_render($id, $style) {
        if (array_key_exists($id, $style)):
            return $style[$id];
        endif;
    }

    public function text_render($data) {
        return do_shortcode(str_replace('spTac', '&nbsp;', str_replace('spBac', '<br>', html_entity_decode($data))), $ignore_html = false);
    }

    public function CatStringToClassReplacce($string, $number = '000') {
        $entities = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', "t");
        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]", " ");
        return 'sa_STCR_' . str_replace($replacements, $entities, urlencode($string)) . $number;
    }

    public function url_render($id, $style) {
        $link = [];
        if (array_key_exists($id . '-url', $style) && $style[$id . '-url'] != ''):
            $link['url'] = $style[$id . '-url'];
            if (array_key_exists($id . '-target', $style) && $style[$id . '-target'] != '0'):
                $link['target'] = $style[$id . '-target'];
            else:
                $link['target'] = '';
            endif;
        endif;
        return $link;
    }

    public function media_render($id, $style) {
        $url = '';
        if (array_key_exists($id . '-select', $style)):
            if ($style[$id . '-select'] == 'media-library'):
                $url = $style[$id . '-image'];
            else:
                $url = $style[$id . '-url'];
            endif;
            if (array_key_exists($id . '-image-alt', $style) && $style[$id . '-image-alt'] != ''):
                $r = 'src="' . $url . '" alt="' . $style[$id . '-image-alt'] . '" ';
            else:
                $r = 'src="' . $url . '" ';
            endif;
            return $r;
        endif;
    }

    public function tabs_url_render($style) {
        if ($style['oxi-tabs-modal-components-type'] == 'link'):
            $data = $this->url_render('oxi-tabs-modal-link', $style);
            if (count($data) >= 1):
                return ' data-link=\'' . json_encode($data) . '\'';
            endif;
        endif;
    }

    public function special_charecter($data) {
        $data = html_entity_decode($data);
        $data = str_replace("\'", "'", $data);
        $data = str_replace('\"', '"', $data);
        $data = do_shortcode($data, $ignore_html = false);
        return $data;
    }

    public function header_responsive_static_render($style = [], $ids = []) {
        $render = ' ';
        foreach ($ids as $type) {
            $render .= $style['oxi-tabs-heading-tabs-show-' . $type] . ' ';
            $render .= $style['oxi-tabs-heading-mobile-show-' . $type] . ' ';
        }
        return $render;
    }

    public function title_special_charecter($array, $title, $subtitle) {
        $r = '<div class=\'oxi-tabs-header-li-title\'>';

        $t = false;
        if (!empty($array[$title]) && $array[$title] != ''):
            $t = true;
            $r .= '<div class=\'oxi-tabs-main-title\'>' . $this->special_charecter($array[$title]) . '</div>';
        endif;
        if (!empty($array[$subtitle]) && $array[$subtitle] != ''):
            $t = true;
            $r .= '<div class=\'oxi-tabs-sub-title\'>' . $this->special_charecter($array[$subtitle]) . '</div>';
        endif;
        $r .= '</div>';


        if ($t):
            return $r;
        endif;
    }

    public function number_special_charecter($data) {
        if (!empty($data) && $data != ''):
            return '<div class=\'oxi-tabs-header-li-number\'>' . $this->special_charecter($data) . '</div>';
        endif;
    }

    public function font_awesome_render($data) {
        if (empty($data) || $data == ''):
            return;
        endif;
        $fadata = get_option('oxi_addons_font_awesome');
        if ($fadata == 'yes'):
            wp_enqueue_style('font-awsome.min', OXI_TABS_URL . 'assets/frontend/css/font-awsome.min.css', false, OXI_TABS_PLUGIN_VERSION);
        endif;
        $files = '<i class="' . $data . ' oxi-icons"></i>';
        return $files;
    }

    public function image_special_render($id = '', $array = []) {
        $value = $this->media_render($id, $array);
        if (!empty($value)):
            return ' <img  class=\'oxi-tabs-header-li-image\' ' . $value . '>';
        endif;
    }

    public function admin_edit_panel($id) {
        $data = '';
        if ($this->admin == 'admin'):
            $data = '   <div class="oxi-addons-admin-absulote">
                            <div class="oxi-addons-admin-absulate-edit">
                                <button class="btn btn-primary shortcode-addons-template-item-edit" type="button" value="' . $id . '">Edit</button>
                            </div>
                            <div class="oxi-addons-admin-absulate-delete">
                                <button class="btn btn-danger shortcode-addons-template-item-delete" type="submit" value="' . $id . '">Delete</button>
                            </div>
                        </div>';
        endif;
        return $data;
    }

}
