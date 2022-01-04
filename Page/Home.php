<?php

namespace OXI_TABS_PLUGINS\Page;

if (!defined('ABSPATH'))
    exit;

/**
 * Description of Home
 *
 * @author biplo
 */
class Home {

    use \OXI_TABS_PLUGINS\Helper\Public_Helper;
    use \OXI_TABS_PLUGINS\Helper\CSS_JS_Loader;

    /**
     * Database
     *
     * @since 3.1.0
     */
    public $database;

    public function __construct() {
        $this->database = new \OXI_TABS_PLUGINS\Helper\Database();
        $this->CSSJS_load();
        $this->Render();
    }

    public function database_data() {
        return $this->database->wpdb->get_results("SELECT * FROM " . $this->database->parent_table . " ORDER BY id DESC", ARRAY_A);
    }

    public function CSSJS_load() {
        $this->manual_import_style();
        $this->admin_css_loader();
        $this->admin_home();
        $this->admin_ajax_load();
        apply_filters('oxi-tabs-plugin/admin_menu', TRUE);
    }

    /**
     * Admin Notice JS file loader
     * @return void
     */
    public function admin_ajax_load() {
        wp_enqueue_script('oxi-tabs-home', OXI_TABS_URL . '/assets/backend/custom/home.js', false, 'vc-tabs');
    }

    /**
     * Generate safe path
     * @since v1.0.0
     */
    public function safe_path($path) {

        $path = str_replace(['//', '\\\\'], ['/', '\\'], $path);
        return str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    }

    public function manual_import_style() {
        if (!empty($_REQUEST['_wpnonce'])) {
            $nonce = $_REQUEST['_wpnonce'];
        }

        if (!empty($_POST['importdatasubmit']) && $_POST['importdatasubmit'] == 'Save') {
            if (!wp_verify_nonce($nonce, 'vc-tabs-ultimate-import')) {
                die('You do not have sufficient permissions to access this page.');
            } else {
                if (apply_filters('oxi-tabs-plugin/pro_version', false) == TRUE):
                    if (isset($_FILES['importtabsfilefile'])) :

                        if (!current_user_can('upload_files')):
                            wp_die(esc_html('You do not have permission to upload files.'));
                        endif;

                        $allowedMimes = array(
                            'json' => 'text/plain'
                        );

                        $fileInfo = wp_check_filetype(basename($_FILES['importtabsfilefile']['name']), $allowedMimes);
                        if (empty($fileInfo['ext'])) {
                            wp_die(esc_html('You do not have permission to upload files.'));
                        }

                        $content = json_decode(file_get_contents($_FILES['importtabsfilefile']['tmp_name']), true);

                        if (empty($content)) {
                            return new \WP_Error('file_error', 'Invalid File');
                        }
                        $style = $content['style'];

                        if (!is_array($style) || $style['data-type'] != 'responsive-tabs') {
                            return new \WP_Error('file_error', 'Invalid Content In File');
                        }

                        $ImportApi = new \OXI_TABS_PLUGINS\Classes\Build_Api;
                        $ImportApi->post_json_import($content);
                    endif;
                endif;
            }
        }
    }

    public function Render() {
        ?>
        <div class="oxi-addons-row">
            <?php
            $this->Admin_header();
            $this->created_shortcode();
            $this->create_new();
            ?>
        </div>
        <?php
    }

    public function Admin_header() {
        ?>
        <div class="oxi-addons-wrapper">
            <div class="oxi-addons-import-layouts">
                <h1>Responsive Tabs › Home
                </h1>
                <p> Collect Responsive Tabs Shortcode, Edit, Delect, Clone or Export it. </p>
            </div>
        </div>
        <?php
    }

    public function create_new() {


        echo '<div class="modal fade" id="oxi-addons-style-create-modal" >
                        <form method="post" id="oxi-addons-style-modal-form">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tabs Clone</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class=" form-group row">
                                            <label for="addons-style-name" class="col-sm-6 col-form-label" oxi-addons-tooltip="Give your Shortcode Name Here">Name</label>
                                            <div class="col-sm-6 addons-dtm-laptop-lock">
                                                <input class="form-control" type="text" value="" id="addons-style-name"  name="addons-style-name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" id="oxistyleid" name="oxistyleid" value="">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-success" name="addonsdatasubmit" id="addonsdatasubmit" value="Save">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    ';
        if (apply_filters('oxi-tabs-plugin/pro_version', false)):


            echo '<div class="oxi-addons-row">
                        <div class="oxi-addons-col-1 oxi-import">
                            <div class="oxi-addons-style-preview">
                                <div class="oxilab-admin-style-preview-top">
                                    <a href="#" id="oxilab-tabs-import-json">
                                        <div class="oxilab-admin-add-new-item">
                                            <span>
                                                <i class="fas fa-plus-circle oxi-icons"></i>
                                                Import Tabs
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';

            echo '<div class="modal fade" id="oxi-addons-style-import-modal" >
                        <form method="post" id="oxi-addons-import-modal-form" enctype = "multipart/form-data">
                            <div class="modal-dialog modal-sm modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Import Form</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <input class="form-control" type="file" name="importtabsfilefile" accept=".json,application/json,.zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-success" name="importdatasubmit" id="importdatasubmit" value="Save">
                                    </div>
                                </div>
                            </div>
                               ' . wp_nonce_field("vc-tabs-ultimate-import") . '
                        </form>
                    </div>';
        endif;
    }

    public function created_shortcode() {
        $return = ' <div class="oxi-addons-row"> <div class="oxi-addons-row table-responsive abop" style="margin-bottom: 20px; opacity: 0; height: 0px">
                        <table class="table table-hover widefat oxi_addons_table_data" style="background-color: #fff; border: 1px solid #ccc">
                            <thead>
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th style="width: 15%">Name</th>
                                    <th style="width: 10%">Templates</th>
                                    <th style="width: 30%">Shortcode</th>
                                    <th style="width: 40%">Edit Delete</th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($this->database_data() as $value) {
            $id = $value['id'];
            $return .= '<tr>';
            $return .= '<td>' . esc_html($id) . '</td>';
            $return .= '<td>' . esc_html(ucwords($value['name']) . '</td>');
            $return .= '<td>' . esc_html($this->name_converter($value['style_name']) . '</td>');
            $return .= '<td><span>Shortcode &nbsp;&nbsp;<input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="[ctu_ultimate_oxi id=&quot;' . esc_attr($id) . '&quot;]"></span> <br>'
                    . '<span>Php Code &nbsp;&nbsp; <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[ctu_ultimate_oxi  id=&quot;' . esc_attr($id) . '&quot;]&#039;); ?&gt;"></span></td>';
            $return .= '<td>
                        <button type="button" class="btn btn-success oxi-addons-style-clone"  style="float:left" oxiaddonsdataid="' . esc_attr($id) . '">Clone</button>
                        <a href="' . admin_url("admin.php?page=oxi-tabs-ultimate-new&styleid=$id") . '"  title="Edit"  class="btn btn-info" style="float:left; margin-right: 5px; margin-left: 5px;">Edit</a>
                       <form method="post" class="oxi-addons-style-delete">
                               <input type="hidden" name="oxideleteid" id="oxideleteid" value="' . esc_attr($id) . '">
                               <button class="btn btn-danger" style="float:left"  title="Delete"  type="submit" value="delete" name="addonsdatadelete">Delete</button>
                       </form>
                       <a href="' . esc_url_raw(rest_url()) . 'oxilabtabsultimate/v1/shortcode_export?styleid=' . $id . '&_wpnonce=' . wp_create_nonce('wp_rest') . '"  title="Export"  class="btn btn-info" style="float:left; margin-right: 5px; margin-left: 5px;">Export</a>
                </td>';
            $return .= ' </tr>';
        }
        $return .= '      </tbody>
                </table>
            </div>
            <br>
            <br></div>';
        echo $return;
    }

}
