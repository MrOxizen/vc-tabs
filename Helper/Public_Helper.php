<?php

namespace OXI_TABS_PLUGINS\Helper;

if (!defined('ABSPATH'))
    exit;

/**
 *
 * @author biplo
 */
trait Public_Helper {

    public function admin_special_charecter($data) {
        $data = html_entity_decode($data);
        $data = str_replace("\'", "'", $data);
        $data = str_replace('\"', '"', $data);
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
        $files = '<i class="' . $data . ' oxi-icons"></i>';
        return $files;
    }

    public function font_familly_charecter($data) {
        wp_enqueue_style('' . $data . '', 'https://fonts.googleapis.com/css?family=' . $data . '');
        $data = str_replace('+', ' ', $data);
        $data = explode(':', $data);
        $data = $data[0];
        $data = '"' . $data . '"';
        return $data;
    }

    public function html_special_charecter($data) {
        $data = html_entity_decode($data);
        $data = str_replace("\'", "'", $data);
        $data = str_replace('\"', '"', $data);
        $data = do_shortcode($data, $ignore_html = false);
        return $data;
    }

    /**
     * Plugin Name Convert to View
     *
     * @since 2.0.0
     */
    public function name_converter($data) {
        $data = str_replace('tyle', 'tyle ', $data);
        return ucwords($data);
    }

    public function str_replace_first($from, $to, $content) {
        $from = '/' . preg_quote($from, '/') . '/';

        return preg_replace($from, $to, $content, 1);
    }

    public function shortcode_render($styleid, $user = 'public') {
        if (!empty((int) $styleid) && !empty($user)):
            $style = $this->database->wpdb->get_row($this->database->wpdb->prepare('SELECT * FROM ' . $this->database->parent_table . ' WHERE id = %d ', $styleid), ARRAY_A);
            if (!array_key_exists('rawdata', $style)):
                $Installation = new \OXI_TABS_PLUGINS\Classes\Installation();
                $Installation->Datatase();
            endif;
            if ($user == 'admin'):
                $response = get_transient('oxi-responsive-tabs-transient-' . $styleid);
                if ($response):
                    $new = [
                        'rawdata' => $response,
                        'stylesheet' => '',
                        'font_family' => ''
                    ];
                    $style = array_merge($style, $new);
                endif;
            endif;
            $child = $this->database->wpdb->get_results($this->database->wpdb->prepare("SELECT * FROM {$this->database->child_table} WHERE styleid = %d ORDER by id ASC", $styleid), ARRAY_A);
            $template = ucfirst($style['style_name']);
            $row = json_decode(stripslashes($style['rawdata']), true);
            if (is_array($row)):
                $cls = '\OXI_TABS_PLUGINS\Render\Views\\' . $template;
            else:
                $cls = '\OXI_TABS_PLUGINS\Render\Old_Views\\' . $template;
            endif;
            if (class_exists($cls)):
                new $cls($style, $child, $user);
            endif;
        endif;
    }
     public function allowed_html($rawdata) {
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
            'br' => array(),
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
                'title' => array(),
                'style' => array(),
                'id' => array(),
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
        if (is_array($rawdata)):
            return $rawdata = array_map(array($this, 'allowed_html'), $rawdata);
        else:
            return wp_kses($rawdata, $allowed_tags);
        endif;
    }

    public function validate_post($files = '') {
        
        $rawdata = [];
        if (!empty($files) && !is_array($files)):
            $data = json_decode(stripslashes($files), true);
        endif;
        if (is_array($data)):
            $rawdata = array_map(array($this, 'allowed_html'), $data);
        else:
            $rawdata = $this->allowed_html($files);
        endif;
       
        return $rawdata;
    }

}
