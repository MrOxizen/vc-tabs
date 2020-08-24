<?php

namespace OXI_TABS_PLUGINS\Page;

/**
 * Description of Create
 *
 * @author biplo
 */
class Create {

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
    public $child_table;

    /**
     * Database Import Table
     *
     * @since 3.1.0
     */
    public $import_table;

    /**
     * Define $wpdb
     *
     * @since 3.1.0
     */
    public $wpdb;

    /**
     * Define Page Type
     *
     * @since 3.1.0
     */
    public $opage;

    /**
     * Define Page Type
     *
     * @since 3.1.0
     */
    public $layouts;

    use \OXI_TABS_PLUGINS\Helper\Public_Helper;
    use \OXI_TABS_PLUGINS\Helper\CSS_JS_Loader;

    public $IMPORT = [];
    public $TEMPLATE;

    /**
     * Constructor of Oxilab tabs Home Page
     *
     * @since 2.0.0
     */
    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->parent_table = $this->wpdb->prefix . 'content_tabs_ultimate_style';
        $this->child_table = $this->wpdb->prefix . 'content_tabs_ultimate_list';
        $this->import_table = $this->wpdb->prefix . 'content_tabs_ultimate_import';
        $this->opage = (isset($_GET['page']) && $_GET['page'] == 'oxi-tabs-ultimate-import' ? 'import' : 'create');
        $this->layouts = (isset($_GET['layouts']) ? $_GET['layouts'] : '');
        $this->CSSJS_load();
        $this->Render();
    }

    public function CSSJS_load() {
        $this->admin_css_loader();
        $this->admin_ajax_load();
        apply_filters('oxi-tabs-plugin/admin_menu', TRUE);
        $import = $this->wpdb->get_results("SELECT name FROM $this->import_table ORDER by name ASC ", ARRAY_A);
        if (count($import) == 0):
            $this->wpdb->query("INSERT INTO {$this->import_table} (name) VALUES (1),(2),(3),(4),(5)");
            $this->IMPORT = [
                [1 => 1],
                [2 => 2],
                [3 => 3],
                [4 => 4],
                [5 => 5],
            ];
        else:
            foreach ($import as $value) {
                $this->IMPORT[$value['name']] = $value['name'];
            }
        endif;
    }

    /**
     * Admin Notice JS file loader
     * @return void
     */
    public function admin_ajax_load() {
        wp_enqueue_script('oxi-tabs-create', OXI_TABS_URL . '/assets/backend/js/create.js', false, OXI_TABS_TEXTDOMAIN);
    }

    public function Render() {
        ?>
        <div class="oxi-addons-row">
            <?php
            if ($this->opage == 'import'):
                $cache = new \OXI_TABS_PLUGINS\Render\Json\Template();
                $this->TEMPLATE = $cache->Render();
                $this->Import_header();
                $this->Import_template();
            else:
                if ((int) $this->layouts):

                else:
                    $cache = new \OXI_TABS_PLUGINS\Render\Json\Template();
                    $this->TEMPLATE = $cache->Render();
                    $this->Create_header();
                    $this->Create_template();
                    $this->Create_new();
                endif;

            endif;
            ?>
        </div>
        <?php
    }

    public function Import_header() {
        ?>
        <div class="oxi-addons-wrapper">
            <div class="oxi-addons-import-layouts">
                <h1>Responsive Tabs › Import Template
                </h1>
                <p> Select Tabs layout and import for feture use. </p>
            </div>
        </div>
        <?php
    }

    public function Create_header() {
        ?>
        <div class="oxi-addons-wrapper">
            <div class="oxi-addons-import-layouts">
                <h1>Responsive Tabs › Create New
                </h1>
                <p> Select Tabs layouts, give your Tabs name and create new Tabs. </p>
            </div>
        </div>
        <?php
    }

    public function Create_new() {
        echo _('<div class="oxi-addons-row">
                        <div class="oxi-addons-col-1 oxi-import">
                            <div class="oxi-addons-style-preview">
                                <div class="oxilab-admin-style-preview-top">
                                    <a href="' . admin_url("admin.php?page=oxi-tabs-ultimate-import") . '">
                                        <div class="oxilab-admin-add-new-item">
                                            <span>
                                                <i class="fas fa-plus-circle oxi-icons"></i>  
                                                Import Templates
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>');

        echo __('<div class="modal fade" id="oxi-addons-style-create-modal" >
                        <form method="post" id="oxi-addons-style-modal-form">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">                    
                                        <h4 class="modal-title">New Tabs</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class=" form-group row">
                                            <label for="addons-style-name" class="col-sm-6 col-form-label" oxi-addons-tooltip="Give your Shortcode Name Here">Name</label>
                                            <div class="col-sm-6 addons-dtm-laptop-lock">
                                                <input class="form-control" type="text" value="" id="addons-style-name"  name="addons-style-name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" id="oxistyledata" name="oxistyledata" value="">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-success" name="addonsdatasubmit" id="addonsdatasubmit" value="Save">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>');
    }

    public function Create_template() {
        ?>
        <div class="oxi-addons-row">
            <?php
            foreach ($this->IMPORT as $value) {
                $Style = 'Style' . $value;
                $number = rand();
                if (array_key_exists($Style, $this->TEMPLATE)):
                    $REND = json_decode($this->TEMPLATE[$Style], true);
                    $C = 'OXI_TABS_PLUGINS\Render\Views\\' . $Style;
                    ?>
                    <div class="oxi-addons-col-1" id="<?php echo $Style; ?>">
                        <div class="oxi-addons-style-preview">
                            <div class="oxi-addons-style-preview-top oxi-addons-center">
                                <?php
                                if (class_exists($C) && isset($REND['style']['rawdata'])):
                                    new $C($REND['style'], $REND['child']);
                                endif;
                                ?>
                            </div>
                            <div class="oxi-addons-style-preview-bottom">
                                <div class="oxi-addons-style-preview-bottom-left">
                                    <?php echo $REND['style']['name']; ?>
                                </div>
                                <div class="oxi-addons-style-preview-bottom-right">
                                    <form method="post" style=" display: inline-block; " class="shortcode-addons-template-deactive">
                                        <input type="hidden" name="oxideletestyle" value="<?php echo $value; ?>">
                                        <button class="btn btn-warning oxi-addons-addons-style-btn-warning" title="Delete"  type="submit" value="Deactive" name="addonsstyledelete">Deactive</button>  
                                    </form>
                                    <textarea style="display:none" id="oxistyle<?php echo $number; ?>data"  value=""><?php echo $this->TEMPLATE[$Style]; ?></textarea>
                                    <button type="button" class="btn btn-success oxi-addons-addons-template-create oxi-addons-addons-js-create" data-toggle="modal" addons-data="oxistyle<?php echo $number; ?>data">Create Style</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
            }
            ?>
        </div>
        <?php
    }

    public function Import_template() {
        ?>
        <div class="oxi-addons-row">
            <?php
            foreach ($this->TEMPLATE as $k => $value) {
                $id = (int) explode('tyle', $k)[1];
                if (!array_key_exists($id, $this->IMPORT)):
                    $REND = json_decode($this->TEMPLATE[$k], true);
                    $C = 'OXI_TABS_PLUGINS\Render\Views\\' . ucfirst($k);
                    ?>
                    <div class="oxi-addons-col-1" id="<?php echo $k; ?>">
                        <div class="oxi-addons-style-preview">
                            <div class="oxi-addons-style-preview-top oxi-addons-center">
                                <?php
                                if (class_exists($C) && isset($REND['style']['rawdata'])):
                                    new $C($REND['style'], $REND['child']);
                                endif;
                                ?>
                            </div>
                            <div class="oxi-addons-style-preview-bottom">
                                <div class="oxi-addons-style-preview-bottom-left">
                                    <?php echo $REND['style']['name']; ?>
                                </div>
                                <div class="oxi-addons-style-preview-bottom-right">
                                    <?php
                                    $checking = apply_filters('oxi-tabs-plugin/pro_version', true);
                                    if ($id > 10 && $checking == false):
                                        ?>
                                        <form method="post" style=" display: inline-block; " class="shortcode-addons-template-pro-only">
                                            <button class="btn btn-warning oxi-addons-addons-style-btn-warning" title="Pro Only"  type="submit" value="pro only" name="addonsstyleproonly">Pro Only</button>  
                                        </form>
                                        <?php
                                    else:
                                        ?>
                                        <form method="post" style=" display: inline-block; " class="shortcode-addons-template-import">
                                            <input type="hidden" name="oxiimportstyle" value="<?php echo $id; ?>">
                                            <button class="btn btn-success oxi-addons-addons-template-create" title="import"  type="submit" value="Import" name="addonsstyleimport">Import</button>  
                                        </form>
                                    <?php
                                    endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endif;
            }
            ?>
        </div>
        <?php
    }

}
