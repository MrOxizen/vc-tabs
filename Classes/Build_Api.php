<?php

namespace OXI_TABS_PLUGINS\Classes;

/**
 * Description of Tabs Rest API
 *
 * @author $biplob018
 */
class Build_Api {

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
     * Database Import Table
     *
     * @since 3.3.0
     */
    public $child_table;
    public $request;
    public $rawdata;
    public $styleid;
    public $childid;

    /**
     * Constructor of plugin class
     *
     * @since 3.3.0
     */
    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->parent_table = $this->wpdb->prefix . 'content_tabs_ultimate_style';
        $this->child_table = $this->wpdb->prefix . 'content_tabs_ultimate_list';
        $this->import_table = $this->wpdb->prefix . 'content_tabs_ultimate_import';
        $this->build_api();
    }

    public function build_api() {
        add_action('rest_api_init', function () {
            register_rest_route(untrailingslashit('oxilabtabsultimate/v1/'), '/(?P<action>\w+)/', array(
                'methods' => 'POST',
                'callback' => [$this, 'api_action'],
            ));
        });
    }

    public function api_action($request) {
        $this->request = $request;
        $this->rawdata = addslashes($request['rawdata']);
        $this->styleid = $request['styleid'];
        $this->childid = $request['childid'];
        $class = $request['class'];
        $action_class = strtolower($request->get_method()) . '_' . sanitize_key($request['action']);
        if ($class != ''):
            $args = $request['args'];
            $optional = $request['optional'];
            ob_start();
            $CLASS = new $class;
            $CLASS->__construct($request['action'], $this->rawdata, $args, $optional);
            return ob_get_clean();
        else:
            if (method_exists($this, $action_class)):
                return $this->{$action_class}();
            endif;
        endif;
    }

    public function array_replace($arr = [], $search = '', $replace = '') {
        array_walk($arr, function (&$v) use ($search, $replace) {
            $v = str_replace($search, $replace, $v);
        });
        return $arr;
    }

    public function update_oxi_tabs_plugin() {
        $stylelist = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->parent_table ORDER by id ASC"), ARRAY_A);
        foreach ($stylelist as $value) {
            $raw = json_decode(stripslashes($value['rawdata']), true);
            $raw['style-id'] = $value['id'];
            $name = ucfirst($value['style_name']);
            $cls = '\OXI_TABS_PLUGINS\Render\Admin\\' . $name;
            $C = new $cls('admin');
            $f = $C->template_css_render($raw);
        }
        update_option('oxi_tabs_ultimate_update_complete', 'done');
    }

    public function post_create_new() {

        if (!empty($this->styleid)):
            $styleid = (int) $this->styleid;
            $newdata = $this->wpdb->get_row($this->wpdb->prepare('SELECT * FROM ' . $this->parent_table . ' WHERE id = %d ', $styleid), ARRAY_A);
//            if (array_key_exists('css', $newdata) && $newdata['css'] != ''):
//                $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->child_table} (styleid, rawdata, title, files, css) VALUES (%d, %s, %s, %s, %s)", array($newdata['styleid'], $newdata['rawdata'], $newdata['title'], $newdata['files'], $newdata['css'])));
//            else:
            $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->parent_table} (name, style_name, rawdata) VALUES ( %s, %s, %s)", array($this->rawdata, $newdata['style_name'], $newdata['rawdata'])));
            // endif;
            $redirect_id = $this->wpdb->insert_id;
            if ($redirect_id > 0):
                $raw = json_decode(stripslashes($newdata['rawdata']), true);
                $raw['style-id'] = $redirect_id;
                $name = ucfirst($newdata['style_name']);
                $C = '\OXI_TABS_PLUGINS\Render\Admin\\' . $name;
                $f = $C->template_css_render($raw);
                $child = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->child_table WHERE styleid = %d ORDER by id ASC", $styleid), ARRAY_A);
                foreach ($child as $value) {
                    $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->child_table} (styleid, rawdata) VALUES (%d, %s)", array($redirect_id, $value['rawdata'])));
                }
                return admin_url("admin.php?page=oxi-tabs-ultimate-new&styleid=$redirect_id");
            endif;
        else:
            $params = json_decode(stripslashes($this->rawdata), true);
            $newname = $params['addons-style-name'];
            $rawdata = json_decode(stripslashes($params['oxistyledata']), true);
            $style = $rawdata['style'];
            $child = $rawdata['child'];
            $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->parent_table} (name, style_name, rawdata) VALUES ( %s, %s, %s)", array($newname, $style['style_name'], $style['rawdata'])));
            $redirect_id = $this->wpdb->insert_id;
            if ($redirect_id > 0):
                $raw = json_decode(stripslashes($style['rawdata']), true);
                $raw['style-id'] = $redirect_id;
                $name = ucfirst($style['style_name']);
                $CLASS = '\OXI_TABS_PLUGINS\Render\Admin\\' . $name;
                $C = new $CLASS('admin');
                $f = $C->template_css_render($raw);
                foreach ($child as $value) {
                    $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->child_table} (styleid, rawdata) VALUES (%d,  %s)", array($redirect_id, $value['rawdata'])));
                }
                return admin_url("admin.php?page=oxi-tabs-ultimate-new&styleid=$redirect_id");
            endif;
        endif;
    }

    public function post_shortcode_delete() {
        $styleid = (int) $this->styleid;
        if ($styleid):
            $this->wpdb->query($this->wpdb->prepare("DELETE FROM {$this->parent_table} WHERE id = %d", $styleid));
            $this->wpdb->query($this->wpdb->prepare("DELETE FROM {$this->child_table} WHERE styleid = %d", $styleid));
            return 'done';
        else:
            return 'Silence is Golden';
        endif;
    }

    public function post_shortcode_export() {
        $styleid = (int) $this->styleid;
        if ($styleid):
            $st = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM $this->parent_table WHERE id = %d", $styleid), ARRAY_A);
            $c = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->child_table WHERE styleid = %d ORDER by id ASC", $styleid), ARRAY_A);
            $style = [
                'id' => $st['id'],
                'name' => $st['name'],
                'style_name' => $st['style_name'],
                'rawdata' => json_encode($this->array_replace(json_decode(stripslashes($st['rawdata']), true), '"', '&quot;')),
                'stylesheet' => htmlentities($st['stylesheet']),
                'font_family' => $st['font_family'],
            ];
            $child = [];
            foreach ($c as $value) {
                $child[] = [
                    'id' => $value['id'],
                    'styleid' => $value['styleid'],
                    'rawdata' => json_encode($this->array_replace(json_decode(stripslashes($value['rawdata']), true), '"', '&quot;'))
                ];
            }
            $newdata = ['plugin' => 'image-hover', 'style' => $style, 'child' => $child];
            return json_encode($newdata);
        else:
            return 'Silence is Golden';
        endif;
    }

    public function post_shortcode_deactive() {
        $params = json_decode(stripslashes($this->rawdata), true);
        $id = (int) $params['oxideletestyle'];
        if ($id > 0):
            $this->wpdb->query($this->wpdb->prepare("DELETE FROM {$this->import_table} WHERE name = %s", $id));
            return 'done';
        else:
            return 'Silence is Golden';
        endif;
    }

    public function post_shortcode_active() {
        $params = json_decode(stripslashes($this->rawdata), true);
        $id = (int) $params['oxiimportstyle'];
        if ($id > 0):
            $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->import_table} (name) VALUES ( %d)", array($id)));
            return admin_url("admin.php?page=oxi-tabs-ultimate-new#Style" . $id);
        else:
            return 'Silence is Golden';
        endif;
    }

    /**
     * Template Style Data
     *
     * @since 9.3.0
     */
    public function post_elements_template_style() {
        $settings = json_decode(stripslashes($this->rawdata), true);
        $StyleName = sanitize_text_field($settings['style-name']);
        $stylesheet = '';
        if ((int) $this->styleid):
            $transient = 'oxi-responsive-tabs-transient-' . $this->styleid;
            delete_transient($transient);
            $this->wpdb->query($this->wpdb->prepare("UPDATE {$this->parent_table} SET rawdata = %s, stylesheet = %s WHERE id = %d", $this->rawdata, $stylesheet, $this->styleid));
            $name = ucfirst($StyleName);
            $cls = '\OXI_TABS_PLUGINS\Render\Admin\\' . $name;
            $CLASS = new $cls('admin');
            return $CLASS->template_css_render($settings);
        endif;
    }

    /**
     * Template Style Data
     *
     * @since 9.3.0
     */
    public function post_template_change() {
        $rawdata = sanitize_text_field($this->rawdata);
        if ((int) $this->styleid):
            $this->wpdb->query($this->wpdb->prepare("UPDATE {$this->parent_table} SET style_name = %s WHERE id = %d", $rawdata, $this->styleid));
        endif;
    }

    /**
     * Template Name Change
     *
     * @since 9.3.0
     */
    public function post_template_name() {
        $settings = json_decode(stripslashes($this->rawdata), true);
        $name = sanitize_text_field($settings['addonsstylename']);
        $id = $settings['addonsstylenameid'];
        if ((int) $id):
            $this->wpdb->query($this->wpdb->prepare("UPDATE {$this->parent_table} SET name = %s WHERE id = %d", $name, $id));
            return 'success';
        endif;
    }

    /**
     * Template Name Change
     *
     * @since 9.3.0
     */
    public function post_elements_rearrange_modal_data() {
        if ((int) $this->styleid):
            $child = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->child_table WHERE styleid = %d ORDER by id ASC", $this->styleid), ARRAY_A);
            $render = [];
            foreach ($child as $k => $value) {
                $data = json_decode(stripcslashes($value['rawdata']));
                $render[$value['id']] = $data;
            }
            return json_encode($render);
        endif;
    }

    /**
     * Template Name Change
     *
     * @since 9.3.0
     */
    public function post_elements_older_rearrange_modal_data() {
        $rawdata = json_decode(stripslashes($this->rawdata), true);
        if ((int) $this->styleid && count($rawdata) == 2):
            $child = $this->wpdb->get_results($this->wpdb->prepare("SELECT * FROM $this->child_table WHERE styleid = %d ORDER by id ASC", $this->styleid), ARRAY_A);
            $render = [];
            foreach ($child as $k => $value) {
                $data = explode($rawdata[1], $value['title']);
                $render[$value['id']] = $data[$rawdata[0]];
            }
            return json_encode($render);
        endif;
    }

    /**
     * Template Name Change
     *
     * @since 9.3.0
     */
    public function post_elements_template_rearrange_save_data() {
        $params = explode(',', $this->rawdata);
        foreach ($params as $value) {
            if ((int) $value):
                $data = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM $this->child_table WHERE id = %d ", $value), ARRAY_A);
                if (array_key_exists('title', $data)):
                    $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->child_table} (styleid, rawdata, title, files, css) VALUES (%d, %s, %s, %s, %s)", array($data['styleid'], $data['rawdata'], $data['title'], $data['files'], $data['css'])));
                else:
                    $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->child_table} (styleid, rawdata) VALUES (%d, %s)", array($data['styleid'], $data['rawdata'])));
                endif;
                $redirect_id = $this->wpdb->insert_id;
                if ($redirect_id == 0) {
                    return;
                }
                if ($redirect_id != 0) {
                    $this->wpdb->query($this->wpdb->prepare("DELETE FROM $this->child_table WHERE id = %d", $value));
                }
            endif;
        }
        return 'success';
    }

    /**
     * Template Modal Data
     *
     * @since 9.3.0
     */
    public function post_elements_template_modal_data() {
        if ((int) $this->styleid):
            if ((int) $this->childid):
                $this->wpdb->query($this->wpdb->prepare("UPDATE {$this->child_table} SET rawdata = %s WHERE id = %d", $this->rawdata, $this->childid));
            else:
                $this->wpdb->query($this->wpdb->prepare("INSERT INTO {$this->child_table} (styleid, rawdata) VALUES (%d, %s )", array($this->styleid, $this->rawdata)));
            endif;
        endif;
        return 'ok';
    }

    /**
     * Template Template Render
     *
     * @since 9.3.0
     */
    public function post_elements_template_render_data() {
        $transient = 'oxi-responsive-tabs-transient-' . $this->styleid;
        set_transient($transient, $this->rawdata, 1 * HOUR_IN_SECONDS);
        return 'Transient Done';
    }

    /**
     * Template Modal Data Edit Form 
     *
     * @since 9.3.0
     */
    public function post_elements_template_modal_data_edit() {
        if ((int) $this->childid):
            $listdata = $this->wpdb->get_row($this->wpdb->prepare("SELECT * FROM {$this->child_table} WHERE id = %d ", $this->childid), ARRAY_A);
            $returnfile = json_decode(stripslashes($listdata['rawdata']), true);
            $returnfile['shortcodeitemid'] = $this->childid;
            return json_encode($returnfile);
        else:
            return 'Silence is Golden';
        endif;
    }

    /**
     * Template Child Delete Data
     *
     * @since 9.3.0
     */
    public function post_elements_template_modal_data_delete() {
        if ((int) $this->childid):
            $this->wpdb->query($this->wpdb->prepare("DELETE FROM {$this->child_table} WHERE id = %d ", $this->childid));
            return 'done';
        else:
            return 'Silence is Golden';
        endif;
    }

    /**
     * Admin Notice API  loader
     * @return void
     */
    public function post_oxi_recommended() {
        $data = 'done';
        update_option('oxi_image_hover_recommended', $data);
        return $data;
    }

    /**
     * Admin Notice Recommended  loader
     * @return void
     */
    public function post_notice_dissmiss() {
        $notice = $this->request['notice'];
        if ($notice == 'maybe'):
            $data = strtotime("now");
            update_option('oxi_image_hover_activation_date', $data);
        else:
            update_option('oxi_image_hover_nobug', $notice);
        endif;
        return $notice;
    }

}
