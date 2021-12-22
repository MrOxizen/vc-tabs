<?php

namespace OXI_TABS_PLUGINS\Render;

if (!defined('ABSPATH'))
    exit;

/**
 * Render Core Class
 *
 *
 * @author biplob018
 * @package Oxilab Tabs Ultimate
 * @since 3.3.0
 */
class Old_Render {

    public $style;
    public $child;
    public $user;
    public $WRAPPER;
    public $ID;
    public $JQUERY;
    public $CSS;

    /**
     * Constructor of Oxilab tabs Home Page
     *
     * @since 2.0.0
     */
    public function __construct($style = [], $child = [], $user = '') {
        if (array_key_exists('id', $style)):
            $this->ID = $style['id'];
            $this->WRAPPER = 'oxi-addons-container-' . $style['id'];
        else:
            return;
        endif;
        $this->style = explode('|', $style['css']);
        $this->child = $child;
        $this->user = $user;
        $this->JS_CSS();
        $this->Template();
        $this->inline_load();
    }

    public function inline_public_jquery() {
        echo '';
    }

    public function inline_public_css() {
        echo '';
    }

    public function public_jquery_css() {
        wp_enqueue_script("jquery");
        wp_enqueue_style('vc-tabs-style', OXI_TABS_URL . '/assets/frontend/css/style.css', false, OXI_TABS_PLUGIN_VERSION);
        wp_enqueue_script('vc-tabs-jquery', OXI_TABS_URL . '/assets/frontend/js/old.js', false, OXI_TABS_PLUGIN_VERSION);
    }

    public function default_render() {
        echo '';
    }

    public function inline_load() {
        $inlinejs = $this->JQUERY;
        $inlinecss = $this->CSS;
        if ($inlinejs != ''):
            $jquery = '(function ($) {' . $inlinejs . '})(jQuery);';
            wp_add_inline_script('vc-tabs-jquery', $jquery);
        endif;
        if ($inlinecss != ''):
            wp_add_inline_style('vc-tabs-style', $inlinecss);
        endif;
    }

    public function allowed_tags() {

        $allowed_tags = array(
            'a' => array(
                'class' => array(),
                'href' => array(),
                'rel' => array(),
                'title' => array(),
            ),
            'abbr' => array(
                'title' => array(),
            ),
            'b' => array(),
            'blockquote' => array(
                'cite' => array(),
            ),
            'cite' => array(
                'title' => array(),
            ),
            'code' => array(),
            'del' => array(
                'datetime' => array(),
                'title' => array(),
            ),
            'dd' => array(),
            'div' => array(
                'class' => array(),
                'ref' => array(),
                'style' => array(),
                'id' => array(),
                'data-oxi-tabs' => array(),
                'data-link' => array(),
            ),
            'blockquote' => array(
                'class' => array(),
                'ref' => array(),
                'style' => array(),
                'id' => array(),
                'data-oxi-tabs' => array(),
                'data-link' => array(),
            ),
            'table' => array(
                'class' => array(),
                'id' => array(),
                'style' => array(),
            ),
            'button' => array(
                'class' => array(),
                'type' => array(),
                'value' => array(),
            ),
            'input' => array(
                'onkeyup' => array(),
                'class' => array(),
                'id' => array(),
                'name' => array(),
                'type' => array(),
                'value' => array(),
                'placeholder' => array(),
                'onclick' => array(),
            ),
            'form' => array(
                'class' => array(),
                'id' => array(),
                'method' => array(),
                'action' => array(),
            ),
            'thead' => array(),
            'tbody' => array(),
            'tr' => array(),
            'td' => array(),
            'dt' => array(),
            'em' => array(),
            'h1' => array(),
            'h2' => array(),
            'h3' => array(),
            'h4' => array(),
            'h5' => array(),
            'h6' => array(),
            'i' => array(
                'class' => array(),
            ),
            'img' => array(
                'alt' => array(),
                'class' => array(),
                'height' => array(),
                'src' => array(),
                'width' => array(),
            ),
            'li' => array(
                'class' => array(),
            ),
            'ol' => array(
                'class' => array(),
            ),
            'p' => array(
                'class' => array(),
            ),
            'q' => array(
                'cite' => array(),
                'title' => array(),
            ),
            'span' => array(
                'class' => array(),
                'title' => array(),
                'style' => array(),
            ),
            'strike' => array(),
            'strong' => array(),
            'ul' => array(
                'class' => array(),
            ),
        );

        return $allowed_tags;
    }

    public function JS_CSS() {
        $this->public_jquery_css();
        $this->inline_public_css();
        $this->inline_public_jquery();
    }

    public function Template() {
        echo '<div class="oxi-addons-container ' . $this->WRAPPER . '">
                 <div class="oxi-addons-row">';
        $this->default_render();
        echo '   </div>
              </div>';
    }

    public function special_charecter($data) {
        $data = html_entity_decode($data);
        $data = str_replace("\'", "'", $data);
        $data = str_replace('\"', '"', $data);
        $data = do_shortcode($data, $ignore_html = false);
        return $data;
    }

    public function font_familly($data) {
        wp_enqueue_style('' . $data . '', 'https://fonts.googleapis.com/css?family=' . $data . '');
        $data = str_replace('+', ' ', $data);
        $data = explode(':', $data);
        $data = $data[0];
        $data = '"' . $data . '"';
        return $data;
    }

    public function icon_font_selector($data) {
        $icon = explode(' ', $data);
        $fadata = get_option('oxi_addons_font_awesome');
        $faversion = get_option('oxi_addons_font_awesome_version');
        $faversion = explode('||', $faversion);
        if ($fadata != 'no') {
            wp_enqueue_style('font-awesome-' . $faversion[0], $faversion[1]);
        }
        $files = '<i class="' . esc_attr($data) . ' oxi-icons"></i>';
        return $files;
    }

    public function admin_edit_panel($id) {
        $data = '';
        if ($this->user == 'admin'):
            $data = '<div class="oxi-addons-admin-absulote">
                        <div class="oxi-addons-admin-absulate-edit">
                            <form method="post">
                                <input type="hidden" name="item-id" value="' . esc_attr($id) . '">
                                <button class="btn btn-primary" type="submit" value="edit" name="edit" title="Edit">Edit</button>
                                ' . wp_nonce_field("oxitabseditdata") . '
                            </form>
                        </div>
                        <div class="oxi-addons-admin-absulate-delete">
                            <form method="post">
                                <input type="hidden" name="item-id" value="' . esc_attr($id) . '">
                                <button class="btn btn-danger" type="submit" value="delete" name="delete" title="Delete">Delete</button>
                                ' . wp_nonce_field("oxitabsdeletedata") . '
                            </form>
                        </div>
                    </div>';
        endif;
        return $data;
    }

}
