<?php

namespace OXI_TABS_PLUGINS\Classes;

if (!defined('ABSPATH'))
    exit;

/**
 * Description of Installation
 *
 * @author biplo
 */
class Installation {

    protected static $lfe_instance = NULL;

    const ADMINMENU = 'get_oxilab_addons_menu';

    /**
     * Constructor of Shortcode Addons
     *
     * @since 2.0.0
     */
    public function __construct() {
        
    }

    /**
     * Access plugin instance. You can create further instances by calling
     */
    public static function get_instance() {
        if (NULL === self::$lfe_instance)
            self::$lfe_instance = new self;

        return self::$lfe_instance;
    }

    public function Tabs_Datatase() {
        global $wpdb;
        $parent_table = $wpdb->prefix . 'content_tabs_ultimate_style';
        $child_table = $wpdb->prefix . 'content_tabs_ultimate_list';
        $import_table = $wpdb->prefix . 'content_tabs_ultimate_import';

        $headersize = 0;
        $fawesome = '5.3.1||https://use.fontawesome.com/releases/v5.3.1/css/all.css';
        $charset_collate = $wpdb->get_charset_collate();

        $sql1 = "CREATE TABLE $parent_table (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                name varchar(50) NOT NULL,
		style_name varchar(10) NOT NULL,
                rawdata longtext,
                stylesheet longtext,
                font_family text,
		PRIMARY KEY  (id)
	) $charset_collate;";
        $sql2 = "CREATE TABLE $child_table (
                id mediumint(5) NOT NULL AUTO_INCREMENT,
                styleid mediumint(6) NOT NULL,
		rawdata longtext,
		PRIMARY KEY  (id)
	)$charset_collate;";
        $sql3 = "CREATE TABLE $import_table (
                id mediumint(5) NOT NULL AUTO_INCREMENT,
                name mediumint(5) NOT NULL,
                PRIMARY KEY (id),
                UNIQUE name (name)
                ) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql1);
        dbDelta($sql2);
        dbDelta($sql3);
        add_option('content_tabs_ultimate_version', OXI_TABS_PLUGIN_VERSION);
        add_option('oxi_addons_font_awesome_version', $fawesome);
        add_option('oxi_addons_fixed_header_size', $headersize);
    }

    /**
     * Get  Oxi Tabs Menu.
     * @return mixed
     */
    public function Tabs_Menu() {
        $response = !empty(get_transient(self::ADMINMENU)) ? get_transient(self::ADMINMENU) : [];
        if (!array_key_exists('Tabs', $response)):
            $response['Tabs']['Tabs'] = [
                'name' => 'Tabs',
                'homepage' => 'oxi-tabs-ultimate'
            ];
            $response['Tabs']['Create New'] = [
                'name' => 'Create New',
                'homepage' => 'oxi-tabs-ultimate-new'
            ];
            $response['Tabs']['Import Templates'] = [
                'name' => 'Import Templates',
                'homepage' => 'oxi-tabs-ultimate-import'
            ];
            $response['Tabs']['Addons'] = [
                'name' => 'Addons',
                'homepage' => 'oxi-tabs-ultimate-addons'
            ];
            set_transient(self::ADMINMENU, $response, 10 * DAY_IN_SECONDS);
        endif;
    }

    /**
     * Get  Oxi Tabs Menu Deactive.
     * @return mixed
     */
    public function Tabs_Menu_Deactive() {
        delete_transient(self::ADMINMENU);
    }

    /**
     * Plugin activation hook
     *
     * @since 3.1.0
     */
    public function plugin_activation_hook() {
        $this->Tabs_Menu();
        $this->Tabs_Datatase();
        // Redirect to options page
        set_transient('oxi_tabs_activation_redirect', true, 30);
    }

    /**
     * Plugin deactivation hook
     *
     * @since 3.1.0
     */
    public function plugin_deactivation_hook() {
        $this->Tabs_Menu_Deactive();
    }

    /**
     * Plugin upgrade hook
     *
     * @since 1.0.0
     */
    public function plugin_upgrade_hook($upgrader_object, $options) {
        if ($options['action'] == 'update' && $options['type'] == 'plugin') {
            if (isset($options['plugins'][OXI_TABS_TEXTDOMAIN])) {
                $this->Tabs_Menu();
                $this->Tabs_Datatase();
            }
        }
    }

}
