<?php

namespace OXI_TABS_PLUGINS\Helper;

if (!defined('ABSPATH'))
    exit;

/**
 *
 * @author biplo
 */
Class Database {

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
    protected static $lfe_instance = NULL;

    /**
     * Access plugin instance. You can create further instances by calling
     */
    public static function get_instance() {
        if (NULL === self::$lfe_instance)
            self::$lfe_instance = new self;

        return self::$lfe_instance;
    }

    public function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->parent_table = $wpdb->prefix . 'content_tabs_ultimate_style';
        $this->child_table = $wpdb->prefix . 'content_tabs_ultimate_list';
        $this->import_table = $wpdb->prefix . 'oxi_div_import';
    }

    public function update_database() {
        $charset_collate = $this->wpdb->get_charset_collate();

        $sql1 = "CREATE TABLE $this->parent_table (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                name varchar(50) NOT NULL,
		style_name varchar(10) NOT NULL,
                rawdata longtext,
                stylesheet longtext,
                font_family text,
		PRIMARY KEY  (id)
	) $charset_collate;";
        $sql2 = "CREATE TABLE $this->child_table (
                id mediumint(5) NOT NULL AUTO_INCREMENT,
                styleid mediumint(6) NOT NULL,
		rawdata longtext,
		PRIMARY KEY  (id)
	)$charset_collate;";

        $sql3 = "CREATE TABLE $this->import_table (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                type varchar(50) NULL,
                name varchar(100) NULL,
                font varchar(200) NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql1);
        dbDelta($sql2);
        dbDelta($sql3);
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

}
