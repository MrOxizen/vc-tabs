<?php

namespace OXI_TABS_PLUGINS\Classes;

/**
 * Description of Admin_Ajax
 *
 * @author biplo
 */
class Admin_Ajax {

    /**
     * Define $wpdb
     *
     * @since 3.1.0
     */
    public $wpdb;

    /**
     * Database Parent Table
     *
     * @since 3.1.0
     */
    public $parent_table;

    /**
     * Database Import Table
     *
     * @since 3.1.0
     */
    public $import_table;

    /**
     * Database Import Table
     *
     * @since 3.1.0
     */
    public $child_table;

    /**
     * Constructor of plugin class
     *
     * @since 3.1.0
     */
    public function __construct($type = '', $data = '', $styleid = '', $itemid = '') {
        if (!empty($type) && !empty($data)):
            global $wpdb;
            $this->wpdb = $wpdb;
            $this->parent_table = $this->wpdb->prefix . 'content_tabs_ultimate_style';
            $this->child_table = $this->wpdb->prefix . 'content_tabs_ultimate_list';
            $this->import_table = $this->wpdb->prefix . 'content_tabs_ultimate_import';
            $this->$type($data, $styleid, $itemid);
        endif;
    }

    public function create_tabs($data = '', $styleid = '', $itemid = '') {

        if (!empty($styleid)):
            $styleid = (int) $styleid;
            $newdata = $this->wpdb->get_row($this->wpdb->prepare('SELECT * FROM ' . $this->parent_table . ' WHERE id = %d ', $styleid), ARRAY_A);
            $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->parent_table} (name, style_name, css) VALUES ( %s, %s, %s)", array($data, $newdata['style_name'], $newdata['css'])));
            $redirect_id = $this->wpdb->insert_id;
            if ($redirect_id > 0):
                $child = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->child_table WHERE styleid = %d ORDER by id ASC", $styleid), ARRAY_A);
                foreach ($child as $value) {
                    $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->child_table} (styleid, title, files, css) VALUES (%d, %s, %s, %s)", array($redirect_id, $value['title'], $value['files'], $value['css'])));
                }
                echo admin_url("admin.php?page=oxi-tabs-ultimate-new&styleid=$redirect_id");
            endif;
        else:
            parse_str($data, $params);
            $newname = $params['addons-style-name'];
            $DATA = json_decode(stripcslashes($params['oxistyledata']), true);
            $style = $DATA['style'];
            $child = $DATA['child'];
            $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->parent_table} (name, style_name, css) VALUES ( %s, %s, %s)", array($newname, $style['style_name'], $style['css'])));
            $redirect_id = $this->wpdb->insert_id;
            if ($redirect_id > 0):
                foreach ($child as $value) {
                    $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->child_table} (styleid, title, files, css) VALUES (%d, %s, %s, %s)", array($redirect_id, $value['title'], $value['files'], $value['css'])));
                }
                echo admin_url("admin.php?page=oxi-tabs-ultimate-new&styleid=$redirect_id");
            endif;
        endif;
    }

    public function shortcode_delete($data = '', $styleid = '', $itemid = '') {
        $styleid = (int) $styleid;
        if ($styleid):
            $this->wpdb->query($this->wpdb->prepare("DELETE FROM {$this->parent_table} WHERE id = %d", $styleid));
            $this->wpdb->query($this->wpdb->prepare("DELETE FROM {$this->child_table} WHERE styleid = %d", $styleid));
            echo 'done';
        else:
            echo 'Silence is Golden';
        endif;
    }

    public function shortcode_export($data = '', $styleid = '', $itemid = '') {
        $styleid = (int) $styleid;
        if ($styleid):
            $style = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM $this->parent_table WHERE id = %d", $styleid), ARRAY_A);
            $child = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->child_table WHERE styleid = %d ORDER by id ASC", $styleid), ARRAY_A);
            $newdata = [
                ['plugin' => 'tabs'],
                ['style' => $style, 'child' => $child]
            ];
            echo json_encode($newdata);
        else:
            echo 'Silence is Golden';
        endif;
    }

    public function shortcode_deactive($data = '', $styleid = '', $itemid = '') {
        parse_str($data, $params);
        $styleid = (int) $params['oxideletestyle'];
        if ($styleid):
            $this->wpdb->query($this->wpdb->prepare("DELETE FROM {$this->import_table} WHERE name = %d", $styleid));
            echo 'done';
        else:
            echo 'Silence is Golden';
        endif;
    }

    public function addons_rearrange($data = '', $styleid = '', $itemid = '') {
        $list = explode(',', $data);
        foreach ($list as $value) {
            $data = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM $this->child_table WHERE id = %d ", $value), ARRAY_A);
            $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->child_table} (styleid, title, files, css) VALUES (%d, %s, %s, %s)", array($data['styleid'], $data['title'], $data['files'], $data['css'])));
            $redirect_id = $this->wpdb->insert_id;
            if ($redirect_id == 0) {
                return;
            }
            if ($redirect_id != 0) {
                $this->wpdb->query($this->wpdb->prepare("DELETE FROM $this->child_table WHERE id = %d", $value));
            }
        }
        echo 'ajshdjsad';
        return;
    }

    public function shortcode_active($data = '', $styleid = '', $itemid = '') {
        parse_str($data, $params);
        $styleid = (int) $params['oxiimportstyle'];
        if ($styleid):
            $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->import_table} (name) VALUES (%d)", array($styleid)));
            echo admin_url("admin.php?page=oxi-tabs-ultimate-new#Style" . $styleid);
        else:
            echo 'Silence is Golden';
        endif;
    }

}
