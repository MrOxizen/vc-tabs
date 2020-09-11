<?php

namespace OXI_TABS_PLUGINS\Modules;

/**
 * Description of Shortcode
 *
 * @author biplo
 */
class Shortcode {

    /**
     * Current Elements ID
     *
     * @since 3.3.0
     */
    public $oxiid;

    /**
     * Current User
     *
     * @since 3.3.0
     */
    public $user;

    /**
     * Current arg
     *
     * @since 3.3.0
     */
    public $arg;

    /**
     * WooCommerce keys
     *
     * @since 3.3.0
     */
    public $key;

    /**
     * Define $wpdb
     *
     * @since 3.1.0
     */
    public $database;

    /**
     * Template constructor.
     */
    public function __construct($styleid, $user = 'public', $arg = [], $keys = []) {
        if (empty((int) $styleid) || empty($user)):
            return false;
        endif;
        $this->oxiid = $styleid;
        $this->user = $user;
        $this->arg = $arg;
        $this->key = $keys;
        $this->database = new \OXI_TABS_PLUGINS\Helper\Database();
        $this->shortcode();
    }

    public function shortcode() {
        $style = $this->database->wpdb->get_row($this->database->wpdb->prepare('SELECT * FROM ' . $this->database->parent_table . ' WHERE id = %d ', $this->oxiid), ARRAY_A);
        if (!array_key_exists('rawdata', $style)):
            $Installation = new \OXI_TABS_PLUGINS\Classes\Installation();
            $Installation->Datatase();
        endif;
        $child = $this->database->wpdb->get_results($this->database->wpdb->prepare("SELECT * FROM {$this->database->child_table} WHERE styleid = %d ORDER by id ASC", $this->oxiid), ARRAY_A);
        if ($this->user == 'woocommerce'):
            $current = count($child);
            $woo = count($this->arg);
            if ($current > $woo):
                for($i = $woo;$i < $current; $i++ ):
                    unset($child[$i]);
                endfor;
            else:
               for($i = $woo;$i < $current; $i++ ):
                   $child[$i] = $child[0];
                endfor;
            endif;
        endif;


        $template = ucfirst($style['style_name']);
        $row = json_decode(stripslashes($style['rawdata']), true);
        if (is_array($row)):
            $cls = '\OXI_TABS_PLUGINS\Render\Views\\' . $template;
        else:
            $cls = '\OXI_TABS_PLUGINS\Render\Old_Views\\' . $template;
        endif;
        if (class_exists($cls)):
            new $cls($style, $child, $this->user, $this->arg, $this->key);
        endif;
    }

}
