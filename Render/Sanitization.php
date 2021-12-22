<?php

namespace OXI_TABS_PLUGINS\Render;

if (!defined('ABSPATH'))
    exit;

/**
 *
 * @author $biplob018
 */
use OXI_TABS_PLUGINS\Render\Controls as Controls;

trait Sanitization {

    /**
     * font settings sanitize
     * works at layouts page to adding font Settings sanitize
     */
    public function AdminTextSenitize($data) {
        $data = str_replace('\\\\"', '&quot;', $data);
        $data = str_replace('\\\"', '&quot;', $data);
        $data = str_replace('\\"', '&quot;', $data);
        $data = str_replace('\"', '&quot;', $data);
        $data = str_replace('"', '&quot;', $data);
        $data = str_replace('\\\\&quot;', '&quot;', $data);
        $data = str_replace('\\\&quot;', '&quot;', $data);
        $data = str_replace('\\&quot;', '&quot;', $data);
        $data = str_replace('\&quot;', '&quot;', $data);
        $data = str_replace("\\\\'", '&apos;', $data);
        $data = str_replace("\\\'", '&apos;', $data);
        $data = str_replace("\\'", '&apos;', $data);
        $data = str_replace("\'", '&apos;', $data);
        $data = str_replace("\\\\&apos;", '&apos;', $data);
        $data = str_replace("\\\&apos;", '&apos;', $data);
        $data = str_replace("\\&apos;", '&apos;', $data);
        $data = str_replace("\&apos;", '&apos;', $data);
        $data = str_replace("'", '&apos;', $data);
        $data = str_replace('<', '&lt;', $data);
        $data = str_replace('>', '&gt;', $data);
        $data = sanitize_text_field($data);
        return $data;
    }

    /*
     * Oxi Tabs Style Admin Panel header
     *
     * @since 3.3.0
     */

    public function start_section_header($id, array $arg = []) {
        echo '<ul class="oxi-addons-tabs-ul">   ';
        foreach ($arg['options'] as $key => $value) {
            echo '<li ref="#shortcode-addons-section-' . esc_attr($key) . '">' . esc_html($value) . '</li>';
        }
        echo '</ul>';
    }

    /*
     * Oxi Tabs Style Admin Panel Body
     *
     * @since 3.3.0
     */

    public function start_section_tabs($id, array $arg = []) {
        echo '<div class="oxi-addons-tabs-content-tabs" id="shortcode-addons-section-';
        if (array_key_exists('condition', $arg)) :
            foreach ($arg['condition'] as $value) {
                echo esc_attr($value);
            }
        endif;
        echo '"  ' . (array_key_exists('padding', $arg) ? 'style="padding: ' . esc_attr($arg['padding']) . '"' : '') . '>';
    }

    /*
     * Oxi Tabs Style Admin Panel end Body
     *
     * @since 3.3.0
     */

    public function end_section_tabs() {
        echo '</div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Col 6 or Entry devider
     *
     * @since 3.3.0
     */

    public function start_section_devider() {
        echo '<div class="oxi-addons-col-6">';
    }

    /*
     * Oxi Tabs Style Admin Panel end Entry Divider
     *
     * @since 3.3.0
     */

    public function end_section_devider() {
        echo '</div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Form Dependency
     *
     * @since 3.3.0
     */

    public function forms_condition(array $arg = []) {

        if (array_key_exists('condition', $arg)) :
            $i = $arg['condition'] != '' ? count($arg['condition']) : 0;
// echo $i;
            $data = '';
            $s = 1;
            $form_condition = array_key_exists('form_condition', $arg) ? $arg['form_condition'] : '';
            foreach ($arg['condition'] != '' ? $arg['condition'] : [] as $key => $value) {
                if (is_array($value)):
                    $c = count($value);
                    $crow = 1;
                    if ($c > 1 && $i > 1):
                        $data .= '(';
                    endif;
                    foreach ($value as $item) {
                        $data .= $form_condition . $key . ' === \'' . $item . '\'';
                        if ($crow < $c) :
                            $data .= ' || ';
                            $crow++;
                        endif;
                    }
                    if ($c > 1 && $i > 1):
                        $data .= ')';
                    endif;
                elseif ($value == 'COMPILED') :
                    $data .= $form_condition . $key;
                elseif ($value == 'EMPTY') :
                    $data .= $form_condition . $key . ' !== \'\'';
                elseif (empty($value)) :
                    $data .= $form_condition . $key;
                else :
                    $data .= $form_condition . $key . ' === \'' . $value . '\'';
                endif;
                if ($s < $i) :
                    $data .= ' && ';
                    $s++;
                endif;
            }
            if (!empty($data)) :
                return 'data-condition="' . $data . '"';
            endif;
        endif;
    }

    /*
     * Oxi Tabs Style Admin Panel Each Tabs
     *
     * @since 3.3.0
     */

    public function start_controls_section($id, array $arg = []) {
        $defualt = ['showing' => FALSE];
        $arg = array_merge($defualt, $arg);
        $condition = $this->forms_condition($arg);
        echo '<div class="oxi-addons-content-div ' . (($arg['showing']) ? '' : 'oxi-admin-head-d-none') . '" ' . esc_attr($condition) . '>
                    <div class="oxi-head">
                    ' . esc_html($arg['label']) . '
                    <div class="oxi-head-toggle"></div>
                    </div>
                    <div class="oxi-addons-content-div-body">';
    }

    /*
     * Oxi Tabs Style Admin Panel end Each Tabs
     *
     * @since 3.3.0
     */

    public function end_controls_section() {
        echo '</div></div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Section Inner Tabs
     * This Tabs like inner tabs as Normal view and Hover View
     *
     * @since 3.3.0
     */

    public function start_controls_tabs($id, array $arg = []) {
        $defualt = ['options' => ['normal' => 'Normal', 'hover' => 'Hover']];
        $arg = array_merge($defualt, $arg);
        $condition = $this->forms_condition($arg);
        echo '<div class="shortcode-form-control shortcode-control-type-control-tabs ' . (array_key_exists('separator', $arg) ? ($arg['separator'] === TRUE ? 'shortcode-form-control-separator-before' : '') : '') . '" ' . esc_attr($condition) . ' >
                <div class="shortcode-form-control-content shortcode-form-control-content-tabs">
                    <div class="shortcode-form-control-field">';
        foreach ($arg['options'] as $key => $value) {
            echo '  <div class="shortcode-control-type-control-tab-child">
			<div class="shortcode-control-content">
				' . esc_html($value) . '
                        </div>
                    </div>';
        }
        echo '</div>
              </div>
              <div class="shortcode-form-control-content">';
    }

    /*
     * Oxi Tabs Style Admin Panel end Section Inner Tabs
     *
     * @since 3.3.0
     */

    public function end_controls_tabs() {
        echo '</div> </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Section Inner Tabs Child
     *
     * @since 3.3.0
     */

    public function start_controls_tab() {
        echo '<div class="shortcode-form-control-content shortcode-form-control-tabs-content shortcode-control-tab-close">';
    }

    /*
     * Oxi Tabs Style Admin Panel End Section Inner Tabs Child
     *
     * @since 3.3.0
     */

    public function end_controls_tab() {
        echo '</div>';
    }

    /*
     * Oxi Tabs Style Admin Panel  Section Popover
     *
     * @since 3.3.0
     */

    public function start_popover_control($id, array $arg = [], $data = []) {
        if ($this->render_condition_control($id, $data, $arg)):
            $this->Popover_Condition = true;
        else:
            $this->Popover_Condition = false;
        endif;

        $condition = $this->forms_condition($arg);
        $separator = (array_key_exists('separator', $arg) ? ($arg['separator'] === TRUE ? 'shortcode-form-control-separator-before' : '') : '');
        echo '  <div class="shortcode-form-control shortcode-control-type-popover ' . esc_attr($separator) . '" ' . esc_attr($condition) . '>
                    <div class="shortcode-form-control-content shortcode-form-control-content-popover">
                        <div class="shortcode-form-control-field">
                            <label for="" class="shortcode-form-control-title">' . esc_html($arg['label']) . '</label>
                            <div class="shortcode-form-control-input-wrapper">
                                <span class="dashicons popover-set"></span>
                            </div>
                        </div>
                        ' . (array_key_exists('description', $arg) ? '<div class="shortcode-form-control-description">' . esc_html($arg['description']) . '</div>' : '') . '

                    </div>
                    <div class="shortcode-form-control-content shortcode-form-control-content-popover-body">

               ';
    }

    /*
     * Oxi Tabs Style Admin Panel end Popover
     *
     * @since 3.3.0
     */

    public function end_popover_control() {
        $this->Popover_Condition = true;
        echo '</div></div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Form Add Control.
     * Call All Input Control from here Based on Control Name.
     *
     * @since 3.3.0
     */

    public function add_control($id, array $data = [], array $arg = []) {
        /*
         * Responsive Control Start
         * @since 3.3.0
         */
        $responsive = $responsiveclass = '';
        if (array_key_exists('responsive', $arg)) :
            if ($arg['responsive'] == 'laptop') :
                $responsiveclass = 'shortcode-addons-form-responsive-desktop';
            elseif ($arg['responsive'] == 'tab') :
                $responsiveclass = 'shortcode-addons-form-responsive-tablet';
            elseif ($arg['responsive'] == 'mobile') :
                $responsiveclass = 'shortcode-addons-form-responsive-mobile';
            endif;
        endif;

        if (array_key_exists('customresponsive', $arg)):
            $arg['responsive'] = $arg['customresponsive'];
        endif;
        $defualt = [
            'type' => 'text',
            'label' => 'Input Text',
            'default' => '',
            'label_on' => esc_html__('Yes', 'vc-tabs'),
            'label_off' => esc_html__('No', 'vc-tabs'),
            'placeholder' => esc_html__('', 'vc-tabs'),
            'selector-data' => TRUE,
            'render' => TRUE,
            'responsive' => 'laptop',
        ];

        /*
         * Data Currection while Its comes from group Control
         */
        if (array_key_exists('selector-value', $arg)) :
            foreach ($arg['selector'] as $key => $value) {
                $arg['selector'][$key] = $arg['selector-value'];
            }
        endif;

        $arg = array_merge($defualt, $arg);
        if ($arg['type'] == 'animation'):
            $arg['type'] = 'select';
            $arg['options'] = [
                '' => esc_html__('None', 'vc-tabs'),
                'bounce' => esc_html__('Bounce', 'vc-tabs'),
                'flash' => esc_html__('Flash', 'vc-tabs'),
                'pulse' => esc_html__('Pulse', 'vc-tabs'),
                'rubberBand' => esc_html__('RubberBand', 'vc-tabs'),
                'shake' => esc_html__('Shake', 'vc-tabs'),
                'swing' => esc_html__('Swing', 'vc-tabs'),
                'tada' => esc_html__('Tada', 'vc-tabs'),
                'wobble' => esc_html__('Wobble', 'vc-tabs'),
                'jello' => esc_html__('Jello', 'vc-tabs'),
            ];
        endif;

        $condition = $this->forms_condition($arg);
        $toggle = (array_key_exists('toggle', $arg) ? 'shortcode-addons-form-toggle' : '');
        $separator = (array_key_exists('separator', $arg) ? ($arg['separator'] === TRUE ? 'shortcode-form-control-separator-before' : '') : '');

        $loader = (array_key_exists('loader', $arg) ? $arg['loader'] == TRUE ? ' shortcode-addons-control-loader ' : '' : '');
        echo '<div class="shortcode-form-control shortcode-control-type-' . esc_attr($arg['type']) . ' ' . esc_attr($separator) . ' ' . esc_attr($toggle) . ' ' . esc_attr($responsiveclass) . ' ' . esc_attr($loader) . '" ' . esc_attr($condition) . '>
                <div class="shortcode-form-control-content">
                    <div class="shortcode-form-control-field">';
        echo '<label for="" class="shortcode-form-control-title">' . esc_html($arg['label']) . '</label>';
        if (array_key_exists('responsive', $arg)) :
            echo '<div class="shortcode-form-control-responsive-switchers">
                                <a class="shortcode-form-responsive-switcher shortcode-form-responsive-switcher-desktop" data-device="desktop">
                                    <span class="dashicons dashicons-desktop"></span>
                                </a>
                                <a class="shortcode-form-responsive-switcher shortcode-form-responsive-switcher-tablet" data-device="tablet">
                                    <span class="dashicons dashicons-tablet"></span>
                                </a>
                                <a class="shortcode-form-responsive-switcher shortcode-form-responsive-switcher-mobile" data-device="mobile">
                                    <span class="dashicons dashicons-smartphone"></span>
                                </a>
                            </div>';
        endif;

        $fun = $arg['type'] . '_admin_control';
        echo $this->$fun($id, $data, $arg);
        echo '      </div>';
        echo (array_key_exists('description', $arg) ? '<div class="shortcode-form-control-description">' . esc_html($arg['description']) . '</div>' : '');

        echo ' </div>
        </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Responsive Control.
     * Can Possible to modify any Add control to Responsive Control
     *
     * @since 3.3.0
     */

    public function add_responsive_control($id, array $data = [], array $arg = []) {
        $lap = $id . '-lap';
        $tab = $id . '-tab';
        $mob = $id . '-mob';
        $laparg = ['responsive' => 'laptop'];

        $this->add_control($lap, $data, array_merge($arg, $laparg));

        if ($arg['type'] == 'dimensions' || $arg['type'] == 'slider'):
            $tabarg = [
                'responsive' => 'tab',
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
            ];
            $mobarg = [
                'responsive' => 'mobile',
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
            ];
        elseif ($arg['type'] == 'number'):
            $tabarg = [
                'responsive' => 'tab',
                'default' => '',
            ];
            $mobarg = [
                'responsive' => 'mobile',
                'default' => '',
            ];
        else:
            $tabarg = [
                'responsive' => 'tab',
            ];
            $mobarg = [
                'responsive' => 'mobile',
            ];
        endif;

        $this->add_control($tab, $data, array_merge($arg, $tabarg));
        $this->add_control($mob, $data, array_merge($arg, $mobarg));
    }

    /*
     * Oxi Tabs Style Admin Panel Group Control.
     *
     * @since 3.3.0
     */

    public function add_group_control($id, array $data = [], array $arg = []) {
        $defualt = [
            'type' => 'text',
            'label' => 'Input Text',
            'description' => '',
            'simpledescription' => ''
        ];
        $arg = array_merge($defualt, $arg);
        $fun = $arg['type'] . '_admin_group_control';
        echo $this->$fun($id, $data, $arg);
    }

    public function add_rearrange_control($id, array $data = [], array $arg = []) {
        $condition = $this->forms_condition($arg);
        $separator = (array_key_exists('separator', $arg) ? ($arg['separator'] === TRUE ? 'shortcode-form-control-separator-before' : '') : '');
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        echo '<div class="shortcode-form-control shortcode-control-type-' . esc_attr($arg['type']) . ' ' . esc_attr($separator) . '" ' . esc_attr($condition) . '>
                <div class="shortcode-form-control-content">
                    <div class="shortcode-form-control-field">
                        <label for="" class="shortcode-form-control-title">' . esc_html($arg['label']) . '</label>
                    </div>
                    <div class="shortcode-form-rearrange-fields-wrapper" vlid="#' . esc_attr($id) . '">';
        $rearrange = explode(',', $value);
        foreach ($rearrange as $k => $vl) {
            if ($vl != ''):
                echo '  <div class="shortcode-form-repeater-fields" id="' . esc_attr($vl) . '">
                            <div class="shortcode-form-repeater-controls">
                                <div class="shortcode-form-repeater-controls-title">
                                    ' . esc_html($arg['fields'][$vl]['label']) . '
                                </div>
                            </div>
                        </div>';
            endif;
        }
        echo '          <div class="shortcode-form-control-input-wrapper">
                            <input type="hidden" value="' . esc_attr($value) . '" name="' . esc_attr($id) . '" id="' . esc_attr($id) . '">
                        </div>
                    </div>
                </div>
            </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Heading Input.
     *
     * @since 3.3.0
     */

    public function heading_admin_control($id, array $data = [], array $arg = []) {
        echo ' ';
    }

    /*
     * Oxi Tabs Style Admin Panel Switcher Input.
     *
     * @since 3.3.0
     */

    public function separator_admin_control($id, array $data = [], array $arg = []) {
        echo '';
    }

    public function multiple_selector_handler($data, $val) {

        $val = preg_replace_callback('/\{\{\K(.*?)(?=}})/', function ($match)use ($data) {
            $ER = explode('.', $match[0]);
            if (strpos($match[0], 'SIZE') !== FALSE):
                $size = array_key_exists($ER[0] . '-size', $data) ? $data[$ER[0] . '-size'] : '';
                $match[0] = str_replace('.SIZE', $size, $match[0]);
            endif;
            if (strpos($match[0], 'UNIT') !== FALSE):
                $size = array_key_exists($ER[0] . '-choices', $data) ? $data[$ER[0] . '-choices'] : '';
                $match[0] = str_replace('.UNIT', $size, $match[0]);
            endif;
            if (strpos($match[0], 'VALUE') !== FALSE):
                $size = array_key_exists($ER[0], $data) ? $data[$ER[0]] : '';
                $match[0] = str_replace('.VALUE', $size, $match[0]);
            endif;
            return str_replace($ER[0], '', $match[0]);
        }, $val);
        return str_replace("{{", '', str_replace("}}", '', $val));
    }

    /*
     * Oxi Tabs Style Admin Panel Switcher Input.
     *
     * @since 3.3.0
     */

    public function switcher_admin_control($id, array $data = [], array $arg = []) {
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        echo '  <div class="shortcode-form-control-input-wrapper">
                    <label class="shortcode-switcher">
                        <input type="checkbox" ' . ($value == esc_attr($arg['return_value']) ? 'checked ckdflt="true"' : '') . ' value="' . esc_attr($arg['return_value']) . '"  name="' . esc_attr($id) . '" id="' . esc_attr($id) . '"/>
                        <span data-on="' . esc_attr($arg['label_on']) . '" data-off="' . esc_attr($arg['label_off']) . '"></span>
                    </label>
                </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Text Input.
     *
     * @since 3.3.0
     */

    public function text_admin_control($id, array $data = [], array $arg = []) {
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
        if (array_key_exists('link', $arg)) :
            echo '<div class="shortcode-form-control-input-wrapper shortcode-form-control-input-link">
                     <input type="text"  name="' . esc_attr($id) . '" id="' . esc_attr($id) . '" value="' . esc_attr(htmlspecialchars($value)) . '" placeholder="' . esc_attr($arg['placeholder']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>
                     <span class="dashicons dashicons-admin-generic"></span>';
        else :
            echo '<div class="shortcode-form-control-input-wrapper">
                <input type="text"  name="' . esc_attr($id) . '" id="' . esc_attr($id) . '" value="' . esc_attr(htmlspecialchars($value)) . '" placeholder="' . esc_attr($arg['placeholder']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>
            </div>';
        endif;
    }

    /*
     * Oxi Tabs Style Admin Panel Hidden Input.
     *
     * @since 3.3.0
     */

    public function hidden_admin_control($id, array $data = [], array $arg = []) {

        $value = array_key_exists($id, $data) ? $data[$id] : '';

        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
        if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $this->render_condition_control($id, $data, $arg)) :
            if (array_key_exists('selector', $arg)) :
                foreach ($arg['selector'] as $key => $val) {
                    $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                    $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                    $file = str_replace('{{VALUE}}', $value, $val);
                    if (strpos($file, '{{') !== FALSE):
                        $file = $this->multiple_selector_handler($data, $file);
                    endif;
                    if (!empty($value)):
                        $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                    endif;
                }
            endif;
        endif;
        echo ' <div class="shortcode-form-control-input-wrapper">
                   <input type="hidden" value="' . esc_attr($value) . '" name="' . esc_attr($id) . '" id="' . esc_attr($id) . '">
               </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Textarea Input.
     *
     * @since 3.3.0
     */

    public function textarea_admin_control($id, array $data = [], array $arg = []) {
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
        echo '<div class="shortcode-form-control-input-wrapper">
                 <textarea  name="' . esc_attr($id) . '" id="' . esc_attr($id) . '" retundata=\'' . esc_attr($retunvalue) . '\' class="shortcode-form-control-tag-area" rows="' . (int) ((strlen($value) / 50) + 2) . '" placeholder="' . esc_attr($arg['placeholder']) . '">' . esc_textarea($value) . '</textarea>
              </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel WYSIWYG Input.
     *
     * @since 3.3.0
     */

    public function wysiwyg_admin_control($id, array $data = [], array $arg = []) {
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
        echo ' <div class="shortcode-form-control-input-wrapper"  retundata=\'' . esc_attr($retunvalue) . '\'>';
        echo wp_editor(
                $value, $id, $settings = array(
            'textarea_name' => $id,
            'wpautop' => false,
            'textarea_rows' => 7,
            'force_br_newlines' => true,
            'force_p_newlines' => false
                )
        );
        echo ' </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Image Input.
     *
     * @since 3.3.0
     */

    public function image_admin_control($id, array $data = [], array $arg = []) {
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        $alt = array_key_exists($id . '-alt', $data) ? $data[$id . '-alt'] : '';
        echo '  <div class="shortcode-form-control-input-wrapper">
                    <div class="shortcode-addons-media-control ' . (empty($value) ? 'shortcode-addons-media-control-hidden-button' : '') . '">
                        <div class="shortcode-addons-media-control-pre-load">
                        </div>
                        <div class="shortcode-addons-media-control-image-load" style="background-image: url(' . $value . ');" ckdflt="background-image: url(' . esc_url($value) . ');">
                            <div class="shortcode-addons-media-control-image-load-delete-button">
                            </div>
                        </div>
                        <div class="shortcode-addons-media-control-choose-image">
                            Choose Image
                        </div>
                    </div>
                    <input type="hidden" class="shortcode-addons-media-control-link" id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" value="' . esc_url($value) . '" >
                    <input type="hidden" class="shortcode-addons-media-control-link-alt" id="' . esc_attr($id) . '-alt" name="' . esc_attr($id) . '-alt" value="' . esc_html($alt) . '" >
                </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Number Input.
     *
     * @since 3.3.0
     */

    public function number_admin_control($id, array $data = [], array $arg = []) {

        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
        if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $this->render_condition_control($id, $data, $arg)) :
            if (array_key_exists('selector', $arg)) :
                foreach ($arg['selector'] as $key => $val) {
                    $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                    $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                    $file = str_replace('{{VALUE}}', $value, $val);
                    if (strpos($file, '{{') !== FALSE):
                        $file = $this->multiple_selector_handler($data, $file);
                    endif;
                    if (!empty($value)):
                        $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                    endif;
                }
            endif;
        endif;

        $defualt = ['min' => 0, 'max' => 1000, 'step' => 1,];
        $arg = array_merge($defualt, $arg);
        echo '  <div class="shortcode-form-control-input-wrapper">
                    <input id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" type="number" min="' . esc_attr($arg['min']) . '" max="' . esc_attr($arg['max']) . '" step="' . esc_attr($arg['step']) . '" value="' . esc_attr($value) . '"  responsive="' . esc_attr($arg['responsive']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>
                </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Slider Input.
     *
     * @since 3.3.0
     * Done With Number Information
     */

    public function slider_admin_control($id, array $data = [], array $arg = []) {
        $unit = array_key_exists($id . '-choices', $data) ? $data[$id . '-choices'] : $arg['default']['unit'];
        $size = array_key_exists($id . '-size', $data) ? $data[$id . '-size'] : $arg['default']['size'];
        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
        if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $arg['render'] == TRUE && $this->render_condition_control($id, $data, $arg)) :
            if (array_key_exists('selector', $arg)) :
                foreach ($arg['selector'] as $key => $val) {
                    if ($size != '' && $val != '') :
                        $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                        $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                        $file = str_replace('{{SIZE}}', $size, $val);
                        $file = str_replace('{{UNIT}}', $unit, $file);
                        if (strpos($file, '{{') !== FALSE):
                            $file = $this->multiple_selector_handler($data, $file);
                        endif;
                        if (!empty($size)):
                            $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                        endif;
                    endif;
                }
            endif;
        endif;
        if (array_key_exists('range', $arg)) :
            if (count($arg['range']) > 1) :
                echo ' <div class="shortcode-form-units-choices">';
                foreach ($arg['range'] as $key => $val) {
                    $rand = rand(10000, 233333333);
                    echo '<input id="' . esc_attr($id) . '-choices-' . esc_attr($rand) . '" type="radio" name="' . esc_attr($id) . '-choices"  value="' . esc_attr($key) . '" ' . ( esc_attr($key) == $unit ? 'checked' : '') . '  min="' . esc_attr($val['min']) . '" max="' . esc_attr($val['max']) . '" step="' . esc_attr($val['step']) . '">
                      <label class="shortcode-form-units-choices-label" for="' . esc_attr($id) . '-choices-' . esc_attr($rand) . '">' . esc_html($key) . '</label>';
                }
                echo '</div>';
            endif;
        endif;
        $unitvalue = array_key_exists($id . '-choices', $data) ? 'unit="' . $data[$id . '-choices'] . '"' : '';
        echo '  <div class="shortcode-form-control-input-wrapper">
                    <div class="shortcode-form-slider" id="' . esc_attr($id) . '-slider' . '"></div>
                    <div class="shortcode-form-slider-input">
                        <input name="' . esc_attr($id) . '-size" custom="' . (array_key_exists('custom', $arg) ? '' . esc_attr($arg['custom']) . '' : '') . '" id="' . esc_attr($id) . '-size' . '" type="number" min="' . esc_attr($arg['range'][$unit]['min']) . '" max="' . esc_attr($arg['range'][$unit]['max']) . '" step="' . esc_attr($arg['range'][$unit]['step']) . '" value="' . esc_attr($size) . '" default-value="' . esc_attr($size) . '" ' . esc_attr($unitvalue) . ' responsive="' . esc_attr($arg['responsive']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>
                    </div>
                </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Select Input.
     *
     * @since 3.3.0
     */

    public function select_admin_control($id, array $data = [], array $arg = []) {
        $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id );
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        $retun = [];

        if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE) {
            if (array_key_exists('selector', $arg)) :
                foreach ($arg['selector'] as $key => $val) {
                    $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                    if (!empty($value) && !empty($val) && $arg['render'] == TRUE && $this->render_condition_control($id, $data, $arg)) {
                        $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                        $file = str_replace('{{VALUE}}', $value, $val);
                        if (strpos($file, '{{') !== FALSE):
                            $file = $this->multiple_selector_handler($data, $file);
                        endif;
                        if (!empty($value)):
                            $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                        endif;
                    }
                    $retun[$key][$key]['type'] = ($val != '' ? 'CSS' : 'HTML');
                    $retun[$key][$key]['value'] = $val;
                }
            endif;
        }
        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($retun)) : '';
        $multiple = (array_key_exists('multiple', $arg) && $arg['multiple']) == true ? TRUE : FALSE;

        echo '<div class="shortcode-form-control-input-wrapper">
                <div class="shortcode-form-control-input-select-wrapper">
                <select id="' . esc_attr($id) . '" class="shortcode-addons-select-input ' . ($multiple ? 'js-example-basic-multiple' : '' ) . '" ' . ($multiple ? 'multiple' : '' ) . ' name="' . esc_attr($id) . '' . ($multiple ? '[]' : '' ) . '"  responsive="' . esc_attr($arg['responsive']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>';
        foreach ($arg['options'] as $key => $val) {
            if (is_array($val)):
                if (isset($val[0]) && $val[0] == true):
                    echo '<optgroup label="' . $val[1] . '">';
                else:
                    echo '</optgroup>';
                endif;
            else:
                if (is_array($value)):
                    $new = array_flip($value);
                    echo ' <option value="' . esc_attr($key) . '" ' . (array_key_exists($key, $new) ? 'selected' : '') . '>' . esc_html($val) . '</option>';
                else:
                    echo ' <option value="' . esc_attr($key) . '" ' . ($value == $key ? 'selected' : '') . '>' . esc_html($val) . '</option>';
                endif;
            endif;
        }
        echo '</select>
                </div>
            </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Choose Input.
     *
     * @since 3.3.0
     */

    public function choose_admin_control($id, array $data = [], array $arg = []) {
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        $retun = [];

        $operator = array_key_exists('operator', $arg) ? $arg['operator'] : 'text';
        if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE) {
            if (array_key_exists('selector', $arg)) :
                foreach ($arg['selector'] as $key => $val) {
                    $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                    if (!empty($val) && $this->render_condition_control($id, $data, $arg)) {
                        $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                        $file = str_replace('{{VALUE}}', $value, $val);
                        if (strpos($file, '{{') !== FALSE):
                            $file = $this->multiple_selector_handler($data, $file);
                        endif;
                        if (!empty($value)):
                            $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                        endif;
                    }
                    $retun[$key][$key]['type'] = ($val != '' ? 'CSS' : 'HTML');
                    $retun[$key][$key]['value'] = $val;
                }
            endif;
        }
        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($retun)) : '';
        echo '<div class="shortcode-form-control-input-wrapper">
                <div class="shortcode-form-choices" responsive="' . esc_attr($arg['responsive']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>';
        foreach ($arg['options'] as $key => $val) {
            echo '  <input id="' . esc_attr($id) . '-' . esc_attr($key) . '" type="radio" name="' . esc_attr($id) . '" value="' . esc_attr($key) . '" ' . ($value == $key ? 'checked  ckdflt="true"' : '') . '>
                                    <label class="shortcode-form-choices-label" for="' . esc_attr($id) . '-' . esc_attr($key) . '" tooltip="' . esc_html($val['title']) . '">
                                        ' . (($operator == 'text') ? esc_html($val['title']) : '<i class="' . esc_attr($val['icon']) . '" aria-hidden="true"></i>') . '
                                    </label>';
        }
        echo '</div>
        </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Color Input.
     *
     * @since 3.3.0
     */

    public function render_condition_control($id, array $data = [], array $arg = []) {
        if (!$this->Popover_Condition):
            return false;
        endif;
        if (array_key_exists('condition', $arg)):
            foreach ($arg['condition'] as $key => $value) {
                if (array_key_exists('conditional', $arg) && $arg['conditional'] == 'outside'):
                    $data = $this->style;
                elseif (array_key_exists('conditional', $arg) && $arg['conditional'] == 'inside' && isset($arg['form_condition'])):
                    $key = $arg['form_condition'] . $key;
                endif;
                if (strpos($key, '&') !== FALSE):
                    return true;
                endif;
                if (!array_key_exists($key, $data)):
                    return false;
                endif;
                if ($data[$key] != $value):
                    if (is_array($value)):
                        $t = false;
                        foreach ($value as $val) {
                            if ($data[$key] == $val):
                                $t = true;
                            endif;
                        }
                        return $t;
                    endif;
                    if ($value == 'EMPTY' && $data[$key] != '0'):
                        return true;
                    endif;
                    if (strpos($data[$key], '&') !== FALSE):
                        return true;
                    endif;
                    return false;
                endif;
            }
        endif;
        return true;
    }

    public function color_admin_control($id, array $data = [], array $arg = []) {
        $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id );
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
        if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $arg['render'] == TRUE && $this->render_condition_control($id, $data, $arg)) {
            if (array_key_exists('selector', $arg)) :
                foreach ($arg['selector'] as $key => $val) {
                    $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                    $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                    $file = str_replace('{{VALUE}}', $value, $val);
                    if (strpos($file, '{{') !== FALSE):
                        $file = $this->multiple_selector_handler($data, $file);
                    endif;
                    if (!empty($value)):
                        $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                    endif;
                }
            endif;
        }
        $type = array_key_exists('oparetor', $arg) ? 'data-format="rgb" data-opacity="TRUE"' : '';
        echo '<div class="shortcode-form-control-input-wrapper">
                <input ' . esc_attr($type) . ' type="text"  class="oxi-addons-minicolor" id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" value="' . esc_attr($value) . '" responsive="' . esc_attr($arg['responsive']) . '" retundata=\'' . esc_attr($retunvalue) . '\' custom="' . (array_key_exists('custom', $arg) ? '' . esc_attr($arg['custom']) . '' : '') . '">
             </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Icon Selector.
     *
     * @since 3.3.0
     */

    public function icon_admin_control($id, array $data = [], array $arg = []) {
        $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id );
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        echo '  <div class="shortcode-form-control-input-wrapper">
                    <input type="text"  class="oxi-admin-icon-selector" id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" value="' . esc_html($value) . '">
                    <span class="input-group-addon"></span>
                </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Font Selector.
     *
     * @since 3.3.0
     */

    public function font_admin_control($id, array $data = [], array $arg = []) {
        $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id );
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        if ($value != '' && array_key_exists($value, $this->google_font)) :
            $this->font[$value] = $value;
        endif;

        if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE) {
            if (array_key_exists('selector', $arg) && $value != '') :
                foreach ($arg['selector'] as $key => $val) {
                    if ($arg['render'] == TRUE && !empty($val)) :
                        $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                        $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                        $file = str_replace('{{VALUE}}', str_replace("+", ' ', esc_html($value)), $val);
                        if (strpos($file, '{{') !== FALSE):
                            $file = $this->multiple_selector_handler($data, $file);
                        endif;
                        if (!empty($value)):
                            $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                        endif;
                    endif;
                }
            endif;
        }
        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';

        echo '  <div class="shortcode-form-control-input-wrapper">
                    <input type="text"  class="shortcode-addons-family" id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" value="' . esc_html($value) . '" responsive="' . esc_attr($arg['responsive']) . '" retundata="' . esc_attr($retunvalue) . '">
                </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Date and Time Selector.
     *
     * @since 3.3.0
     */

    public function date_time_admin_control($id, array $data = [], array $arg = []) {
        $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id );
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        $format = 'date';
        if (array_key_exists('time', $arg)) :
            if ($arg['time'] == TRUE) :
                $format = 'datetime-local';
            endif;
        endif;
        echo '  <div class="shortcode-form-control-input-wrapper">
                    <input type="' . esc_attr($format) . '"  id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" value="' . esc_html($value) . '">
                </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Gradient Selector.
     *
     * @since 3.3.0
     */

    public function gradient_admin_control($id, array $data = [], array $arg = []) {
        $id = (array_key_exists('repeater', $arg) ? $id . ']' : $id );
        $value = array_key_exists($id, $data) ? $data[$id] : $arg['default'];
        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
        if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $this->render_condition_control($id, $data, $arg)) {
            if (array_key_exists('selector', $arg)) :
                foreach ($arg['selector'] as $key => $val) {
                    if ($arg['render'] == TRUE) :
                        $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                        $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                        $file = str_replace('{{VALUE}}', $value, $val);
                        if (strpos($file, '{{') !== FALSE):
                            $file = $this->multiple_selector_handler($data, $file);
                        endif;
                        if (!empty($value)):
                            $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                        endif;
                    endif;
                }
            endif;
        }
        $background = (array_key_exists('gradient', $arg) ? $arg['gradient'] : '');
        echo '  <div class="shortcode-form-control-input-wrapper">
                    <input type="text" background="' . esc_attr($background) . '"  class="oxi-addons-gradient-color" id="' . esc_attr($id) . '" name="' . esc_attr($id) . '" value="' . esc_html($value) . '" responsive="' . esc_attr($arg['responsive']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>
                </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Dimensions Selector.
     *
     * @since 3.3.0
     */

    public function dimensions_admin_control($id, array $data = [], array $arg = []) {
        $unit = array_key_exists($id . '-choices', $data) ? $data[$id . '-choices'] : $arg['default']['unit'];
        $top = array_key_exists($id . '-top', $data) ? $data[$id . '-top'] : $arg['default']['size'];
        $bottom = array_key_exists($id . '-bottom', $data) ? $data[$id . '-bottom'] : $top;
        $left = array_key_exists($id . '-left', $data) ? $data[$id . '-left'] : $top;
        $right = array_key_exists($id . '-right', $data) ? $data[$id . '-right'] : $top;

        $retunvalue = array_key_exists('selector', $arg) ? htmlspecialchars(json_encode($arg['selector'])) : '';
        $ar = [$top, $bottom, $left, $right];
        $unlink = (count(array_unique($ar)) === 1 ? '' : 'link-dimensions-unlink');
        if (array_key_exists('selector-data', $arg) && $arg['selector-data'] == TRUE && $arg['render'] == TRUE) {
            if (array_key_exists('selector', $arg)) :
                if (is_numeric($top) && is_numeric($right) && is_numeric($bottom) && is_numeric($left) && $this->render_condition_control($id, $data, $arg)) :
                    foreach ($arg['selector'] as $key => $val) {
                        $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                        $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                        $file = str_replace('{{UNIT}}', $unit, $val);
                        $file = str_replace('{{TOP}}', $top, $file);
                        $file = str_replace('{{RIGHT}}', $right, $file);
                        $file = str_replace('{{BOTTOM}}', $bottom, $file);
                        $file = str_replace('{{LEFT}}', $left, $file);
                        if (strpos($file, '{{') !== FALSE):
                            $file = $this->multiple_selector_handler($data, $file);
                        endif;
                        $this->CSSDATA[$arg['responsive']][$class][$file] = $file;
                    }
                endif;
            endif;
        }

        if (array_key_exists('range', $arg)) :
            if (count($arg['range']) > 1) :
                echo ' <div class="shortcode-form-units-choices">';
                foreach ($arg['range'] as $key => $val) {
                    $rand = rand(10000, 233333333);
                    echo '<input id="' . esc_attr($id) . '-choices-' . $rand . '" type="radio" name="' . esc_attr($id) . '-choices"  value="' . esc_attr($key) . '" ' . ($key == $unit ? 'checked' : '') . '  min="' . esc_attr($val['min']) . '" max="' . esc_attr($val['max']) . '" step="' . esc_attr($val['step']) . '">
                      <label class="shortcode-form-units-choices-label" for="' . esc_attr($id) . '-choices-' . esc_attr($rand) . '">' . esc_html($key) . '</label>';
                }
                echo '</div>';
            endif;
        endif;
        $unitvalue = array_key_exists($id . '-choices', $data) ? 'unit="' . $data[$id . '-choices'] . '"' : '';
        echo '<div class="shortcode-form-control-input-wrapper">
                <ul class="shortcode-form-control-dimensions">
                    <li class="shortcode-form-control-dimension">
                        <input id="' . esc_attr($id) . '-top" input-id="' . esc_attr($id) . '" name="' . esc_attr($id) . '-top" type="number"  min="' . esc_attr($arg['range'][$unit]['min']) . '" max="' . esc_attr($arg['range'][$unit]['max']) . '" step="' . esc_attr($arg['range'][$unit]['step']) . '" value="' . esc_attr($top) . '" default-value="' . esc_attr($top) . '" ' . esc_attr($unitvalue) . ' responsive="' . esc_attr($arg['responsive']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>
                        <label for="' . esc_attr($id) . '-top" class="shortcode-form-control-dimension-label">Top</label>
                    </li>
                    <li class="shortcode-form-control-dimension">
                       <input id="' . esc_attr($id) . '-right" input-id="' . esc_attr($id) . '" name="' . esc_attr($id) . '-right" type="number"  min="' . esc_attr($arg['range'][$unit]['min']) . '" max="' . esc_attr($arg['range'][$unit]['max']) . '" step="' . esc_attr($arg['range'][$unit]['step']) . '" value="' . esc_attr($right) . '" default-value="' . esc_attr($right) . '" ' . esc_attr($unitvalue) . ' responsive="' . esc_attr($arg['responsive']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>
                         <label for="' . esc_attr($id) . '-right" class="shortcode-form-control-dimension-label">Right</label>
                    </li>
                    <li class="shortcode-form-control-dimension">
                       <input id="' . esc_attr($id) . '-bottom" input-id="' . esc_attr($id) . '" name="' . esc_attr($id) . '-bottom" type="number"  min="' . esc_attr($arg['range'][$unit]['min']) . '" max="' . esc_attr($arg['range'][$unit]['max']) . '" step="' . esc_attr($arg['range'][$unit]['step']) . '" value="' . esc_attr($bottom) . '" default-value="' . esc_attr($bottom) . '" ' . esc_attr($unitvalue) . ' responsive="' . esc_attr($arg['responsive']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>
                       <label for="' . esc_attr($id) . '-bottom" class="shortcode-form-control-dimension-label">Bottom</label>
                    </li>
                    <li class="shortcode-form-control-dimension">
                        <input id="' . esc_attr($id) . '-left" input-id="' . esc_attr($id) . '" name="' . esc_attr($id) . '-left" type="number"  min="' . esc_attr($arg['range'][$unit]['min']) . '" max="' . esc_attr($arg['range'][$unit]['max']) . '" step="' . esc_attr(esc_attr($arg['range'][$unit]['step'])) . '" value="' . esc_attr($left) . '" default-value="' . esc_attr($left) . '" ' . esc_attr($unitvalue) . ' responsive="' . esc_attr($arg['responsive']) . '" retundata=\'' . esc_attr($retunvalue) . '\'>
                         <label for="' . esc_attr($id) . '-left" class="shortcode-form-control-dimension-label">Left</label>
                    </li>
                    <li class="shortcode-form-control-dimension">
                        <button type="button" class="shortcode-form-link-dimensions ' . esc_attr($unlink) . '"  data-tooltip="Link values together"></button>
                    </li>
                </ul>
            </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Typography.
     *
     * @since 3.3.0
     * Simple Interface Enable
     */

    public function typography_admin_group_control($id, array $data = [], array $arg = []) {
        $cond = $condition = '';
        if (array_key_exists('condition', $arg)) :
            $cond = 'condition';
            $condition = $arg['condition'];
        endif;

        $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
        $selector_key = $selector = $selectorvalue = $loader = $loadervalue = '';
        if (array_key_exists('selector', $arg)) :
            $selectorvalue = 'selector-value';
            $selector_key = 'selector';
            $selector = $arg['selector'];
        endif;
        if (array_key_exists('loader', $arg)) :
            $loader = 'loader';
            $loadervalue = $arg['loader'];
        endif;

        $this->start_popover_control(
                $id, [
            'label' => array_key_exists('label', $arg) ? esc_html($arg['label']) : 'Typography',
            $cond => $condition,
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            'description' => $arg['description'],
            'separator' => $separator,
                ]
        );
        $this->add_control(
                $id . '-font', $data, [
            'label' => esc_html__('Font Family', 'vc-tabs'),
            'type' => Controls::FONT,
            $selectorvalue => 'font-family:\'{{VALUE}}\';',
            $selector_key => $selector,
            $loader => $loadervalue
                ]
        );
        if (!array_key_exists('typo-font-size', $arg) || $arg['typo-font-size'] == true):
            $this->add_responsive_control(
                    $id . '-size', $data, [
                'label' => esc_html__('Size', 'vc-tabs'),
                'type' => Controls::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                $loader => $loadervalue,
                $selectorvalue => 'font-size: {{SIZE}}{{UNIT}};',
                $selector_key => $selector,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'vm' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                    ]
            );
        endif;

        $this->add_control(
                $id . '-weight', $data, [
            'label' => esc_html__('Weight', 'vc-tabs'),
            'type' => Controls::SELECT,
            $selectorvalue => 'font-weight: {{VALUE}};',
            $loader => $loadervalue,
            $selector_key => $selector,
            'options' => [
                '100' => esc_html__('100', 'vc-tabs'),
                '200' => esc_html__('200', 'vc-tabs'),
                '300' => esc_html__('300', 'vc-tabs'),
                '400' => esc_html__('400', 'vc-tabs'),
                '500' => esc_html__('500', 'vc-tabs'),
                '600' => esc_html__('600', 'vc-tabs'),
                '700' => esc_html__('700', 'vc-tabs'),
                '800' => esc_html__('800', 'vc-tabs'),
                '900' => esc_html__('900', 'vc-tabs'),
                '' => esc_html__('Default', 'vc-tabs'),
                'normal' => esc_html__('Normal', 'vc-tabs'),
                'bold' => esc_html__('Bold', 'vc-tabs')
            ],
                ]
        );
        $this->add_control(
                $id . '-transform', $data, [
            'label' => esc_html__('Transform', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'uppercase' => esc_html__('Uppercase', 'vc-tabs'),
                'lowercase' => esc_html__('Lowercase', 'vc-tabs'),
                'capitalize' => esc_html__('Capitalize', 'vc-tabs'),
                'none' => esc_html__('Normal', 'vc-tabs'),
            ],
            $loader => $loadervalue,
            $selectorvalue => 'text-transform: {{VALUE}};',
            $selector_key => $selector,
                ]
        );
        $this->add_control(
                $id . '-style', $data, [
            'label' => esc_html__('Style', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'normal' => esc_html__('normal', 'vc-tabs'),
                'italic' => esc_html__('Italic', 'vc-tabs'),
                'oblique' => esc_html__('Oblique', 'vc-tabs'),
            ],
            $loader => $loadervalue,
            $selectorvalue => 'font-style: {{VALUE}};',
            $selector_key => $selector,
                ]
        );
        $this->add_control(
                $id . '-decoration', $data, [
            'label' => esc_html__('Decoration', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'underline' => esc_html__('Underline', 'vc-tabs'),
                'overline' => esc_html__('Overline', 'vc-tabs'),
                'line-through' => esc_html__('Line Through', 'vc-tabs'),
                'none' => esc_html__('None', 'vc-tabs'),
            ],
            $loader => $loadervalue,
            $selectorvalue => 'text-decoration: {{VALUE}};',
            $selector_key => $selector,
                ]
        );
        if (array_key_exists('include', $arg)) :
            if ($arg['include'] == 'align_normal') :
                $this->add_responsive_control(
                        $id . '-align', $data, [
                    'label' => esc_html__('Text Align', 'vc-tabs'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'vc-tabs'),
                        'left' => esc_html__('Left', 'vc-tabs'),
                        'center' => esc_html__('Center', 'vc-tabs'),
                        'right' => esc_html__('Right', 'vc-tabs'),
                    ],
                    $loader => $loadervalue,
                    $selectorvalue => 'text-align: {{VALUE}};',
                    $selector_key => $selector,
                        ]
                );
            else :
                $this->add_responsive_control(
                        $id . '-justify', $data, [
                    'label' => esc_html__('Justify Content', 'vc-tabs'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'vc-tabs'),
                        'flex-start' => esc_html__('Flex Start', 'vc-tabs'),
                        'flex-end' => esc_html__('Flex End', 'vc-tabs'),
                        'center' => esc_html__('Center', 'vc-tabs'),
                        'space-around' => esc_html__('Space Around', 'vc-tabs'),
                        'space-between' => esc_html__('Space Between', 'vc-tabs'),
                    ],
                    $loader => $loadervalue,
                    $selectorvalue => 'justify-content: {{VALUE}};',
                    $selector_key => $selector,
                        ]
                );
                $this->add_responsive_control(
                        $id . '-align', $data, [
                    'label' => esc_html__('Align Items', 'vc-tabs'),
                    'type' => Controls::SELECT,
                    'default' => '',
                    'options' => [
                        '' => esc_html__('Default', 'vc-tabs'),
                        'stretch' => esc_html__('Stretch', 'vc-tabs'),
                        'baseline' => esc_html__('Baseline', 'vc-tabs'),
                        'center' => esc_html__('Center', 'vc-tabs'),
                        'flex-start' => esc_html__('Flex Start', 'vc-tabs'),
                        'flex-end' => esc_html__('Flex End', 'vc-tabs'),
                    ],
                    $loader => $loadervalue,
                    $selectorvalue => 'align-items: {{VALUE}};',
                    $selector_key => $selector,
                        ]
                );
            endif;
        endif;

        $this->add_responsive_control(
                $id . '-l-height', $data, [
            'label' => esc_html__('Line Height', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                ],
            ],
            $loader => $loadervalue,
            $selectorvalue => 'line-height: {{SIZE}}{{UNIT}};',
            $selector_key => $selector,
                ]
        );
        $this->add_responsive_control(
                $id . '-l-spacing', $data, [
            'label' => esc_html__('Letter Spacing', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 0.1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.01,
                ],
            ],
            $loader => $loadervalue,
            $selectorvalue => 'letter-spacing: {{SIZE}}{{UNIT}};',
            $selector_key => $selector,
                ]
        );
        $this->end_popover_control();
    }

    /*
     * Oxi Tabs Style Admin Panel Media Group Control.
     *
     * @since 3.3.0
     *
     * Works at any version
     */

    public function media_admin_group_control($id, array $data = [], array $arg = []) {
        $type = array_key_exists('default', $arg) ? $arg['default']['type'] : 'media-library';
        $value = array_key_exists('default', $arg) ? $arg['default']['link'] : '';
        $level = array_key_exists('label', $arg) ? esc_html($arg['label']) : 'Photo Source';
        $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
        echo '<div class="shortcode-form-control" style="padding: 0;" ' . $this->forms_condition($arg) . '>';
        $this->add_control(
                $id . '-select', $data, [
            'label' => esc_html__($level, 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'loader' => TRUE,
            'default' => $type,
            'separator' => $separator,
            'options' => [
                'media-library' => [
                    'title' => esc_html__('Media Library', 'vc-tabs'),
                    'icon' => 'fa fa-align-left',
                ],
                'custom-url' => [
                    'title' => esc_html__('Custom URL', 'vc-tabs'),
                    'icon' => 'fa fa-align-center',
                ]
            ],
                ]
        );
        $this->add_control(
                $id . '-image', $data, [
            'label' => esc_html__('Image', 'vc-tabs'),
            'type' => Controls::IMAGE,
            'loader' => TRUE,
            'default' => $value,
            'condition' => [
                $id . '-select' => 'media-library',
            ],
            'simpledescription' => $arg['description'],
            'description' => $arg['description'],
                ]
        );
        $this->add_control(
                $id . '-url', $data, [
            'label' => esc_html__('Image URL', 'vc-tabs'),
            'type' => Controls::TEXT,
            'default' => $value,
            'loader' => TRUE,
            'placeholder' => 'www.example.com/image.jpg',
            'condition' => [
                $id . '-select' => 'custom-url',
            ],
            'simpledescription' => $arg['description'],
            'description' => $arg['description'],
                ]
        );

        echo '</div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Box Shadow Control.
     *
     * @since 3.3.0
     * Only Works At Customizable Version
     */

    public function boxshadow_admin_group_control($id, array $data = [], array $arg = []) {

        $cond = $condition = $boxshadow = '';
        $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
        if (array_key_exists('condition', $arg)) :
            $cond = 'condition';
            $condition = $arg['condition'];
        endif;
        $true = TRUE;
        $selector_key = $selector = $selectorvalue = $loader = $loadervalue = '';
        if (!array_key_exists($id . '-shadow', $data)):
            $data[$id . '-shadow'] = 'yes';
        endif;
        if (!array_key_exists($id . '-blur-size', $data)):
            $data[$id . '-blur-size'] = 0;
        endif;
        if (!array_key_exists($id . '-horizontal-size', $data)):
            $data[$id . '-horizontal-size'] = 0;
        endif;
        if (!array_key_exists($id . '-vertical-size', $data)):
            $data[$id . '-vertical-size'] = 0;
        endif;

        if (array_key_exists($id . '-shadow', $data) && $data[$id . '-shadow'] == 'yes' && array_key_exists($id . '-color', $data) && array_key_exists($id . '-blur-size', $data) && array_key_exists($id . '-spread-size', $data) && array_key_exists($id . '-horizontal-size', $data) && array_key_exists($id . '-vertical-size', $data)) :
            $true = ($data[$id . '-blur-size'] == 0 || empty($data[$id . '-blur-size'])) && ($data[$id . '-spread-size'] == 0 || empty($data[$id . '-spread-size'])) && ($data[$id . '-horizontal-size'] == 0 || empty($data[$id . '-horizontal-size'])) && ($data[$id . '-vertical-size'] == 0 || empty($data[$id . '-vertical-size'])) ? TRUE : FALSE;
            $boxshadow = ($true == FALSE ? '-webkit-box-shadow:' . (array_key_exists($id . '-type', $data) ? $data[$id . '-type'] : '') . ' ' . $data[$id . '-horizontal-size'] . 'px ' . $data[$id . '-vertical-size'] . 'px ' . $data[$id . '-blur-size'] . 'px ' . $data[$id . '-spread-size'] . 'px ' . $data[$id . '-color'] . ';' : '');
            $boxshadow .= ($true == FALSE ? '-moz-box-shadow:' . (array_key_exists($id . '-type', $data) ? $data[$id . '-type'] : '') . ' ' . $data[$id . '-horizontal-size'] . 'px ' . $data[$id . '-vertical-size'] . 'px ' . $data[$id . '-blur-size'] . 'px ' . $data[$id . '-spread-size'] . 'px ' . $data[$id . '-color'] . ';' : '');
            $boxshadow .= ($true == FALSE ? 'box-shadow:' . (array_key_exists($id . '-type', $data) ? $data[$id . '-type'] : '') . ' ' . $data[$id . '-horizontal-size'] . 'px ' . $data[$id . '-vertical-size'] . 'px ' . $data[$id . '-blur-size'] . 'px ' . $data[$id . '-spread-size'] . 'px ' . $data[$id . '-color'] . ';' : '');
        endif;

        if (array_key_exists('selector', $arg)) :
            $selectorvalue = 'selector-value';
            $selector_key = 'selector';
            $selector = $arg['selector'];
            $boxshadow = array_key_exists($id . '-shadow', $data) && $data[$id . '-shadow'] == 'yes' ? $boxshadow : '';
            foreach ($arg['selector'] as $key => $val) {
                $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], esc_attr($key)) : esc_attr($key) );
                $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                $this->CSSDATA['laptop'][$class][$boxshadow] = $boxshadow;
            }
        endif;
        $this->start_popover_control(
                $id, [
            'label' => esc_html__('Box Shadow', 'vc-tabs'),
            $cond => $condition,
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            'separator' => $separator,
            'description' => $arg['description'],
                ]
        );
        $this->add_control(
                $id . '-shadow', $data, [
            'label' => esc_html__('Shadow', 'vc-tabs'),
            'type' => Controls::SWITCHER,
            'default' => '',
            'label_on' => esc_html__('Yes', 'vc-tabs'),
            'label_off' => esc_html__('None', 'vc-tabs'),
            'return_value' => 'yes',
                ]
        );
        $this->add_control(
                $id . '-type', $data, [
            'label' => esc_html__('Type', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'default' => '',
            'options' => [
                '' => [
                    'title' => esc_html__('Outline', 'vc-tabs'),
                    'icon' => 'fa fa-align-left',
                ],
                'inset' => [
                    'title' => esc_html__('Inset', 'vc-tabs'),
                    'icon' => 'fa fa-align-center',
                ],
            ],
            'condition' => [$id . '-shadow' => 'yes']
                ]
        );

        $this->add_control(
                $id . '-horizontal', $data, [
            'label' => esc_html__('Horizontal', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => -50,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'custom' => $id . '|||||box-shadow',
            $selectorvalue => '{{VALUE}}',
            $selector_key => $selector,
            'render' => FALSE,
            'condition' => [$id . '-shadow' => 'yes']
                ]
        );
        $this->add_control(
                $id . '-vertical', $data, [
            'label' => esc_html__('Vertical', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => -50,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'custom' => $id . '|||||box-shadow',
            $selectorvalue => '{{VALUE}}',
            $selector_key => $selector,
            'render' => FALSE,
            'condition' => [$id . '-shadow' => 'yes']
                ]
        );
        $this->add_control(
                $id . '-blur', $data, [
            'label' => esc_html__('Blur', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'custom' => $id . '|||||box-shadow',
            $selectorvalue => '{{VALUE}}',
            $selector_key => $selector,
            'render' => FALSE,
            'condition' => [$id . '-shadow' => 'yes']
                ]
        );
        $this->add_control(
                $id . '-spread', $data, [
            'label' => esc_html__('Spread', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => -50,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'custom' => $id . '|||||box-shadow',
            $selectorvalue => '{{VALUE}}',
            $selector_key => $selector,
            'render' => FALSE,
            'condition' => [$id . '-shadow' => 'yes']
                ]
        );
        $this->add_control(
                $id . '-color', $data, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'separator' => TRUE,
            'type' => Controls::COLOR,
            'oparetor' => 'RGB',
            'default' => '#CCC',
            'custom' => $id . '|||||box-shadow',
            $selectorvalue => '{{VALUE}}',
            $selector_key => $selector,
            'render' => FALSE,
            'condition' => [$id . '-shadow' => 'yes']
                ]
        );
        $this->end_popover_control();
    }

    /*
     * Oxi Tabs Style Admin Panel Text Shadow .
     *
     * @since 3.3.0
     * Only Works at Customizable Options
     */

    public function textshadow_admin_group_control($id, array $data = [], array $arg = []) {

        $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
        $cond = $condition = $textshadow = '';
        if (array_key_exists('condition', $arg)) :
            $cond = 'condition';
            $condition = $arg['condition'];
        endif;
        $true = TRUE;
        $selector_key = $selector = $selectorvalue = $loader = $loadervalue = '';
        if (array_key_exists($id . '-color', $data) && array_key_exists($id . '-blur-size', $data) && array_key_exists($id . '-horizontal-size', $data) && array_key_exists($id . '-vertical-size', $data)) :
            $true = ($data[$id . '-blur-size'] == 0 || empty($data[$id . '-blur-size'])) && ($data[$id . '-horizontal-size'] == 0 || empty($data[$id . '-horizontal-size'])) && ($data[$id . '-vertical-size'] == 0 || empty($data[$id . '-vertical-size'])) ? TRUE : FALSE;
            $textshadow = ($true == FALSE ? 'text-shadow: ' . $data[$id . '-horizontal-size'] . 'px ' . $data[$id . '-vertical-size'] . 'px ' . $data[$id . '-blur-size'] . 'px ' . $data[$id . '-color'] . ';' : '');
        endif;
        if (array_key_exists('selector', $arg)) :
            $selectorvalue = 'selector-value';
            $selector_key = 'selector';
            $selector = $arg['selector'];
            foreach ($arg['selector'] as $key => $val) {
                $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                $this->CSSDATA['laptop'][$class][$textshadow] = $textshadow;
            }
        endif;
        $this->start_popover_control(
                $id, [
            'label' => esc_html__('Text Shadow', 'vc-tabs'),
            $cond => $condition,
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            'separator' => $separator,
            'description' => $arg['description'],
                ]
        );
        $this->add_control(
                $id . '-color', $data, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'oparetor' => 'RGB',
            'default' => '#FFF',
            'custom' => $id . '|||||text-shadow',
            $selectorvalue => '{{VALUE}}',
            $selector_key => $selector,
            'render' => FALSE,
                ]
        );
        $this->add_control(
                $id . '-blur', $data, [
            'label' => esc_html__('Blur', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'separator' => TRUE,
            'custom' => $id . '|||||text-shadow',
            'render' => FALSE,
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => -50,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            $selectorvalue => '{{VALUE}}',
            $selector_key => $selector
                ]
        );
        $this->add_control(
                $id . '-horizontal', $data, [
            'label' => esc_html__('Horizontal', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'custom' => $id . '|||||text-shadow',
            'render' => FALSE,
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => -50,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            $selectorvalue => '{{VALUE}}',
            $selector_key => $selector
                ]
        );
        $this->add_control(
                $id . '-vertical', $data, [
            'label' => esc_html__('Vertical', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'custom' => $id . '|||||text-shadow',
            'render' => FALSE,
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => -50,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            $selectorvalue => '{{VALUE}}',
            $selector_key => $selector
                ]
        );

        $this->end_popover_control();
    }

    /*
     * Oxi Tabs Style Admin Panel Text Shadow .
     *
     * @since 3.3.0
     *
     * Simple Interface Enable
     */

    public function animation_admin_group_control($id, array $data = [], array $arg = []) {
        $cond = $condition = '';
        if (array_key_exists('condition', $arg)) :
            $cond = 'condition';
            $condition = $arg['condition'];
        endif;
        $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;

        $this->start_popover_control(
                $id, [
            'label' => esc_html__('Animation', 'vc-tabs'),
            $cond => $condition,
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            'separator' => $separator,
            'simpledescription' => 'Customize how long your animation will works',
            'description' => 'Customize animation with animation type, Animation Duration with Delay and Looping Options',
                ]
        );
        $this->add_control(
                $id . '-type', $data, [
            'label' => esc_html__('Type', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                'optgroup0' => [true, 'Attention Seekers'],
                '' => esc_html__('None', 'vc-tabs'),
                'optgroup1' => [false],
                'optgroup2' => [true, 'Attention Seekers'],
                'bounce' => esc_html__('Bounce', 'vc-tabs'),
                'flash' => esc_html__('Flash', 'vc-tabs'),
                'pulse' => esc_html__('Pulse', 'vc-tabs'),
                'rubberBand' => esc_html__('RubberBand', 'vc-tabs'),
                'shake' => esc_html__('Shake', 'vc-tabs'),
                'swing' => esc_html__('Swing', 'vc-tabs'),
                'tada' => esc_html__('Tada', 'vc-tabs'),
                'wobble' => esc_html__('Wobble', 'vc-tabs'),
                'jello' => esc_html__('Jello', 'vc-tabs'),
                'optgroup3' => [false],
                'optgroup4' => [true, 'Bouncing Entrances'],
                'bounceIn' => esc_html__('BounceIn', 'vc-tabs'),
                'bounceInDown' => esc_html__('BounceInDown', 'vc-tabs'),
                'bounceInLeft' => esc_html__('BounceInLeft', 'vc-tabs'),
                'bounceInRight' => esc_html__('BounceInRight', 'vc-tabs'),
                'bounceInUp' => esc_html__('BounceInUp', 'vc-tabs'),
                'optgroup5' => [false],
                'optgroup6' => [true, 'Fading Entrances'],
                'fadeIn' => esc_html__('FadeIn', 'vc-tabs'),
                'fadeInDown' => esc_html__('FadeInDown', 'vc-tabs'),
                'fadeInDownBig' => esc_html__('FadeInDownBig', 'vc-tabs'),
                'fadeInLeft' => esc_html__('FadeInLeft', 'vc-tabs'),
                'fadeInLeftBig' => esc_html__('FadeInLeftBig', 'vc-tabs'),
                'fadeInRight' => esc_html__('FadeInRight', 'vc-tabs'),
                'fadeInRightBig' => esc_html__('FadeInRightBig', 'vc-tabs'),
                'fadeInUp' => esc_html__('FadeInUp', 'vc-tabs'),
                'fadeInUpBig' => esc_html__('FadeInUpBig', 'vc-tabs'),
                'optgroup7' => [false],
                'optgroup8' => [true, 'Flippers'],
                'flip' => esc_html__('Flip', 'vc-tabs'),
                'flipInX' => esc_html__('FlipInX', 'vc-tabs'),
                'flipInY' => esc_html__('FlipInY', 'vc-tabs'),
                'optgroup9' => [false],
                'optgroup10' => [true, 'Lightspeed'],
                'lightSpeedIn' => esc_html__('LightSpeedIn', 'vc-tabs'),
                'optgroup11' => [false],
                'optgroup12' => [true, 'Rotating Entrances'],
                'rotateIn' => esc_html__('RotateIn', 'vc-tabs'),
                'rotateInDownLeft' => esc_html__('RotateInDownLeft', 'vc-tabs'),
                'rotateInDownRight' => esc_html__('RotateInDownRight', 'vc-tabs'),
                'rotateInUpLeft' => esc_html__('RotateInUpLeft', 'vc-tabs'),
                'rotateInUpRight' => esc_html__('RotateInUpRight', 'vc-tabs'),
                'optgroup13' => [false],
                'optgroup14' => [true, 'Sliding Entrances'],
                'slideInUp' => esc_html__('SlideInUp', 'vc-tabs'),
                'slideInDown' => esc_html__('SlideInDown', 'vc-tabs'),
                'slideInLeft' => esc_html__('SlideInLeft', 'vc-tabs'),
                'slideInRight' => esc_html__('SlideInRight', 'vc-tabs'),
                'optgroup15' => [false],
                'optgroup16' => [true, 'Zoom Entrances'],
                'zoomIn' => esc_html__('ZoomIn', 'vc-tabs'),
                'zoomInDown' => esc_html__('ZoomInDown', 'vc-tabs'),
                'zoomInLeft' => esc_html__('ZoomInLeft', 'vc-tabs'),
                'zoomInRight' => esc_html__('ZoomInRight', 'vc-tabs'),
                'zoomInUp' => esc_html__('ZoomInUp', 'vc-tabs'),
                'optgroup17' => [false],
                'optgroup18' => [true, 'Specials'],
                'hinge' => esc_html__('Hinge', 'vc-tabs'),
                'rollIn' => esc_html__('RollIn', 'vc-tabs'),
                'optgroup19' => [false],
            ],
                ]
        );
        $this->add_control(
                $id . '-duration', $data, [
            'label' => esc_html__('Duration (ms)', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 1000,
            ],
            'range' => [
                'px' => [
                    'min' => 00,
                    'max' => 10000,
                    'step' => 100,
                ],
            ],
            'condition' => [
                $id . '-type' => 'EMPTY',
            ],
                ]
        );
        $this->add_control(
                $id . '-delay', $data, [
            'label' => esc_html__('Delay (ms)', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => 00,
                    'max' => 10000,
                    'step' => 100,
                ],
            ],
            'condition' => [
                $id . '-type' => 'EMPTY',
            ],
                ]
        );
        $this->add_control(
                $id . '-offset', $data, [
            'label' => esc_html__('Offset', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 100,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'condition' => [
                $id . '-type' => 'EMPTY',
            ],
                ]
        );
        $this->add_control(
                $id . '-looping', $data, [
            'label' => esc_html__('Looping', 'vc-tabs'),
            'type' => Controls::SWITCHER,
            'default' => '',
            'loader' => TRUE,
            'label_on' => esc_html__('Yes', 'vc-tabs'),
            'label_off' => esc_html__('No', 'vc-tabs'),
            'return_value' => 'yes',
            'condition' => [
                $id . '-type' => 'EMPTY',
            ],
                ]
        );
        $this->end_popover_control();
    }

    /*
     * Oxi Tabs Style Admin Panel Border .
     *
     * @since 3.3.0
     * Complete Simple Version
     */

    public function border_admin_group_control($id, array $data = [], array $arg = []) {
        $cond = $condition = '';
        if (array_key_exists('condition', $arg)) :
            $cond = 'condition';
            $condition = $arg['condition'];
        endif;
        $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
        $selector_key = $selector = $selectorvalue = $loader = $loadervalue = $render = '';
        $rn = [];
        if (array_key_exists('selector', $arg)) :

            foreach ($arg['selector'] as $key => $value) {
                if ($value != ''):
                    $rn[$key] = $value;
                else:
                    $rn[$key] = 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};';
                endif;
            }
            $selectorvalue = 'selector-value';
            $selector_key = 'selector';
            $selector = $arg['selector'];
        endif;
        if (array_key_exists('loader', $arg)) :
            $loader = 'loader';
            $loadervalue = $arg['loader'];
        endif;
        if (array_key_exists($id . '-type', $data) && $data[$id . '-type'] == '') :
            $render = 'render';
        endif;

        $this->start_popover_control(
                $id, [
            'label' => esc_html__('Border', 'vc-tabs'),
            $cond => $condition,
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            'separator' => $separator,
            'description' => $arg['description'],
                ]
        );

        $this->add_control(
                $id . '-type', $data, [
            'label' => esc_html__('Type', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('None', 'vc-tabs'),
                'solid' => esc_html__('Solid', 'vc-tabs'),
                'dotted' => esc_html__('Dotted', 'vc-tabs'),
                'dashed' => esc_html__('Dashed', 'vc-tabs'),
                'double' => esc_html__('Double', 'vc-tabs'),
                'groove' => esc_html__('Groove', 'vc-tabs'),
                'ridge' => esc_html__('Ridge', 'vc-tabs'),
                'inset' => esc_html__('Inset', 'vc-tabs'),
                'outset' => esc_html__('Outset', 'vc-tabs'),
                'hidden' => esc_html__('Hidden', 'vc-tabs'),
            ],
            $loader => $loadervalue,
            $selectorvalue => 'border-style: {{VALUE}};',
            $selector_key => $selector,
                ]
        );
        $this->add_responsive_control(
                $id . '-width', $data, [
            'label' => esc_html__('Width', 'vc-tabs'),
            'type' => Controls::DIMENSIONS,
            $render => FALSE,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.01,
                ],
            ],
            'condition' => [
                $id . '-type' => 'EMPTY',
            ],
            $loader => $loadervalue,
            'selector' => $rn
                ]
        );
        $this->add_control(
                $id . '-color', $data, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            $render => FALSE,
            'default' => '#fff',
            $loader => $loadervalue,
            $selectorvalue => 'border-color: {{VALUE}};',
            $selector_key => $selector,
            'condition' => [
                $id . '-type' => 'EMPTY'
            ],
                ]
        );
        $this->end_popover_control();
    }

    /*
     * Oxi Tabs Style Admin Panel Border .
     *
     * @since 3.3.0
     * Complete Simple Version
     */

    public function singleborder_admin_group_control($id, array $data = [], array $arg = []) {
        //Render Value is {{SIZE}}, {{TYPE}}, {{COLOR}}
        $cond = $condition = '';
        if (array_key_exists('condition', $arg)) :
            $cond = 'condition';
            $condition = $arg['condition'];
        endif;
        $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
        $selector_key = $loader = $loadervalue = $render = '';
        $selector = [];
        if (array_key_exists('selector', $arg)) :
            $selector_key = 'selector';
            foreach ($arg['selector'] as $key => $value) {
                $v = str_replace('{{SIZE}}', '{{' . $id . '-width.SIZE}}', str_replace('{{TYPE}}', '{{' . $id . '-type.VALUE}}', str_replace('{{COLOR}}', '{{' . $id . '-color.VALUE}}', esc_html($value))));
                $selector[$key] = $v;
            }
        endif;

        if (array_key_exists('loader', $arg)) :
            $loader = 'loader';
            $loadervalue = $arg['loader'];
        endif;
        if (array_key_exists($id . '-type', $data) && $data[$id . '-type'] == '') :
            $render = 'render';
        endif;

        $this->start_popover_control(
                $id, [
            'label' => $arg['label'],
            $cond => $condition,
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            'separator' => $separator,
            'description' => $arg['description'],
                ],
                $data
        );
        $this->add_control(
                $id . '-type', $data, [
            'label' => esc_html__('Type', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('None', 'vc-tabs'),
                'solid' => esc_html__('Solid', 'vc-tabs'),
                'dotted' => esc_html__('Dotted', 'vc-tabs'),
                'dashed' => esc_html__('Dashed', 'vc-tabs'),
                'double' => esc_html__('Double', 'vc-tabs'),
                'groove' => esc_html__('Groove', 'vc-tabs'),
                'ridge' => esc_html__('Ridge', 'vc-tabs'),
                'inset' => esc_html__('Inset', 'vc-tabs'),
                'outset' => esc_html__('Outset', 'vc-tabs'),
                'hidden' => esc_html__('Hidden', 'vc-tabs'),
            ],
            $loader => $loadervalue,
            $selector_key => $selector,
                ]
        );
        $this->add_control(
                $id . '-width', $data, [
            'label' => esc_html__('Size', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 1,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 30,
                    'step' => 1,
                ],
            ],
            $loader => $loadervalue,
            $selector_key => $selector,
            'condition' => [
                $id . '-type' => 'EMPTY',
            ],
                ]
        );
        $this->add_control(
                $id . '-color', $data, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            $render => FALSE,
            'default' => '',
            $loader => $loadervalue,
            $selector_key => $selector,
            'condition' => [
                $id . '-type' => 'EMPTY',
            ],
                ]
        );
        $this->end_popover_control();
    }

    /*
     * Oxi Tabs Style Admin Panel Background .
     *
     * @since 3.3.0
     * Simple Interface Enable
     */

    public function background_admin_group_control($id, array $data = [], array $arg = []) {

        $backround = '';
        $render = FALSE;
        if (array_key_exists($id . '-color', $data)) :
            $color = $data[$id . '-color'];
            if (array_key_exists($id . '-img', $data) && $data[$id . '-img'] == 'yes') :
                if (strpos(strtolower($color), 'gradient') === FALSE) :
                    $color = 'linear-gradient(0deg, ' . $color . ' 0%, ' . $color . ' 100%)';
                endif;
                if ($data[$id . '-select'] == 'media-library') :
                    $backround .= 'background: ' . esc_attr($color) . ', url(\'' . esc_url($data[$id . '-image']) . '\') ' . esc_attr($data[$id . '-repeat']) . ' ' . esc_attr($data[$id . '-position']) . ';';
                else :
                    $backround .= 'background: ' . esc_attr($color) . ', url(\'' . esc_url($data[$id . '-url']) . '\') ' . esc_attr($data[$id . '-repeat']) . ' ' . esc_attr($data[$id . '-position']) . ';';
                endif;
            else :
                $backround .= 'background: ' . $color . ';';
            endif;
        endif;
        if (array_key_exists('selector', $arg)) :
            foreach ($arg['selector'] as $key => $val) {
                $key = (strpos($key, '{{KEY}}') ? str_replace('{{KEY}}', explode('saarsa', $id)[1], $key) : $key);
                $class = str_replace('{{WRAPPER}}', $this->CSSWRAPPER, $key);
                $this->CSSDATA['laptop'][$class][$backround] = $backround;
                $render = TRUE;
            }
        endif;

        $selector_key = $selector = $selectorvalue = $loader = $loadervalue = '';
        if (array_key_exists('selector', $arg)) :
            $selectorvalue = 'selector-value';
            $selector_key = 'selector';
            $selector = $arg['selector'];
        endif;
        if (array_key_exists('loader', $arg)) :
            $loader = 'loader';
            $loadervalue = $arg['loader'];
        endif;
        $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
        $this->start_popover_control(
                $id, [
            'label' => esc_html__('Background', 'vc-tabs'),
            'condition' => array_key_exists('condition', $arg) ? $arg['condition'] : '',
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            'separator' => $separator,
            'simpledescription' => $arg['simpledescription'],
            'description' => $arg['description'],
                ]
        );
        $this->add_control(
                $id . '-color', $data, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::GRADIENT,
            'gradient' => $id,
            'oparetor' => 'RGB',
            'render' => FALSE,
            $selectorvalue => '',
            $selector_key => $selector,
                ]
        );

        $this->add_control(
                $id . '-img', $data, [
            'label' => esc_html__('Image', 'vc-tabs'),
            'type' => Controls::SWITCHER,
            'loader' => TRUE,
            'label_on' => esc_html__('Yes', 'vc-tabs'),
            'label_off' => esc_html__('No', 'vc-tabs'),
            'return_value' => 'yes',
                ]
        );
        $this->add_control(
                $id . '-select', $data, [
            'label' => esc_html__('Photo Source', 'vc-tabs'),
            'separator' => TRUE,
            'loader' => TRUE,
            'type' => Controls::CHOOSE,
            'default' => 'media-library',
            'options' => [
                'media-library' => [
                    'title' => esc_html__('Media Library', 'vc-tabs'),
                    'icon' => 'fa fa-align-left',
                ],
                'custom-url' => [
                    'title' => esc_html__('Custom URL', 'vc-tabs'),
                    'icon' => 'fa fa-align-center',
                ]
            ],
            'condition' => [
                $id . '-img' => 'yes',
            ],
                ]
        );
        $this->add_control(
                $id . '-image', $data, [
            'label' => esc_html__('Image', 'vc-tabs'),
            'type' => Controls::IMAGE,
            'default' => '',
            'loader' => TRUE,
            'condition' => [
                $id . '-select' => 'media-library',
                $id . '-img' => 'yes',
            ],
                ]
        );
        $this->add_control(
                $id . '-url', $data, [
            'label' => esc_html__('Image URL', 'vc-tabs'),
            'type' => Controls::TEXT,
            'default' => '',
            'loader' => TRUE,
            'placeholder' => 'www.example.com/image.jpg',
            'condition' => [
                $id . '-select' => 'custom-url',
                $id . '-img' => 'yes',
            ],
                ]
        );
        $this->add_control(
                $id . '-position', $data, [
            'label' => esc_html__('Position', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => 'center center',
            'render' => $render,
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'top left' => esc_html__('Top Left', 'vc-tabs'),
                'top center' => esc_html__('Top Center', 'vc-tabs'),
                'top right' => esc_html__('Top Right', 'vc-tabs'),
                'center left' => esc_html__('Center Left', 'vc-tabs'),
                'center center' => esc_html__('Center Center', 'vc-tabs'),
                'center right' => esc_html__('Center Right', 'vc-tabs'),
                'bottom left' => esc_html__('Bottom Left', 'vc-tabs'),
                'bottom center' => esc_html__('Bottom Center', 'vc-tabs'),
                'bottom right' => esc_html__('Bottom Right', 'vc-tabs'),
            ],
            'loader' => TRUE,
            'condition' => [
                $id . '-img' => 'yes',
                '((' . esc_attr($id) . '-select === \'media-library\' && ' . esc_attr($id) . '-image !== \'\') || (' . esc_attr($id) . '-select === \'custom-url\' && ' . esc_attr($id) . '-url !== \'\'))' => 'COMPILED',
            ],
                ]
        );
        $this->add_control(
                $id . '-attachment', $data, [
            'label' => esc_html__('Attachment', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'render' => $render,
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'scroll' => esc_html__('Scroll', 'vc-tabs'),
                'fixed' => esc_html__('Fixed', 'vc-tabs'),
            ],
            $loader => $loadervalue,
            $selectorvalue => 'background-attachment: {{VALUE}};',
            $selector_key => $selector,
            'condition' => [
                $id . '-img' => 'yes',
                '((' . esc_attr($id) . '-select === \'media-library\' && ' . esc_attr($id) . '-image !== \'\') || (' . esc_attr($id) . '-select === \'custom-url\' && ' . esc_attr($id) . '-url !== \'\'))' => 'COMPILED',
            ],
                ]
        );
        $this->add_control(
                $id . '-repeat', $data, [
            'label' => esc_html__('Repeat', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => 'no-repeat',
            'render' => $render,
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'no-repeat' => esc_html__('No-Repeat', 'vc-tabs'),
                'repeat' => esc_html__('Repeat', 'vc-tabs'),
                'repeat-x' => esc_html__('Repeat-x', 'vc-tabs'),
                'repeat-y' => esc_html__('Repeat-y', 'vc-tabs'),
            ],
            'loader' => TRUE,
            'condition' => [
                $id . '-img' => 'yes',
                '((' . esc_attr($id) . '-select === \'media-library\' && ' . esc_attr($id) . '-image !== \'\') || (' . esc_attr($id) . '-select === \'custom-url\' && ' . esc_attr($id) . '-url !== \'\'))' => 'COMPILED',
            ],
                ]
        );
        $this->add_responsive_control(
                $id . '-size', $data, [
            'label' => esc_html__('Size', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => 'cover',
            'render' => $render,
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'auto' => esc_html__('Auto', 'vc-tabs'),
                'cover' => esc_html__('Cover', 'vc-tabs'),
                'contain' => esc_html__('Contain', 'vc-tabs'),
            ],
            $loader => $loadervalue,
            $selectorvalue => 'background-size: {{VALUE}};',
            $selector_key => $selector,
            'condition' => [
                $id . '-img' => 'yes',
                '((' . esc_attr($id) . '-select === \'media-library\' && ' . esc_attr($id) . '-image !== \'\') || (' . esc_attr($id) . '-select === \'custom-url\' && ' . esc_attr($id) . '-url !== \'\'))' => 'COMPILED',
            ],
                ]
        );
        $this->end_popover_control();
    }

    /*
     * Oxi Tabs Style Admin Panel Background .
     *
     * @since 3.3.0
     * Simple Interfaece Enable
     */

    public function url_admin_group_control($id, array $data = [], array $arg = []) {
        if (array_key_exists('condition', $arg)) :
            $cond = 'condition';
            $condition = $arg['condition'];
        else :
            $cond = $condition = '';
        endif;
        $form_condition = array_key_exists('form_condition', $arg) ? $arg['form_condition'] : '';
        $separator = array_key_exists('separator', $arg) ? $arg['separator'] : FALSE;
        $this->add_control(
                $id . '-url', $data, [
            'label' => esc_html__('Link', 'vc-tabs'),
            'type' => Controls::TEXT,
            'link' => TRUE,
            'separator' => $separator,
            'placeholder' => 'http://www.example.com/',
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            $cond => $condition
                ]
        );
        echo '<div class="shortcode-form-control-content shortcode-form-control-content-popover-body">';

        $this->add_control(
                $id . '-target', $data, [
            'label' => esc_html__('New Window?', 'vc-tabs'),
            'type' => Controls::SWITCHER,
            'default' => '',
            'label_on' => esc_html__('Yes', 'vc-tabs'),
            'label_off' => esc_html__('No', 'vc-tabs'),
            'return_value' => 'yes',
                ]
        );
        echo '</div>' . (array_key_exists('description', $arg) ? '<div class="shortcode-form-control-description">' . $arg['description'] . '</div>' : '') . '</div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Column Size.
     *
     * @since 3.3.0
     * Complete Simple Interface
     */

    public function column_admin_group_control($id, array $data = [], array $arg = []) {

        $selector = array_key_exists('selector', $arg) ? $arg['selector'] : '';
        $select = array_key_exists('selector', $arg) ? 'selector' : '';
        $cond = $condition = '';
        if (array_key_exists('condition', $arg)) :
            $cond = 'condition';
            $condition = $arg['condition'];
        endif;
        $this->add_control(
                $lap = $id . '-lap', $data, [
            'label' => esc_html__('Column Size', 'vc-tabs'),
            'type' => Controls::SELECT,
            'responsive' => 'laptop',
            'description' => $arg['description'],
            'default' => 'oxi-bt-col-lg-12',
            'options' => [
                'oxi-bt-col-lg-12' => esc_html__('Col 1', 'vc-tabs'),
                'oxi-bt-col-lg-6' => esc_html__('Col 2', 'vc-tabs'),
                'oxi-bt-col-lg-4' => esc_html__('Col 3', 'vc-tabs'),
                'oxi-bt-col-lg-3' => esc_html__('Col 4', 'vc-tabs'),
                'oxi-bt-col-lg-5' => esc_html__('Col 5', 'vc-tabs'),
                'oxi-bt-col-lg-2' => esc_html__('Col 6', 'vc-tabs'),
                'oxi-bt-col-lg-8' => esc_html__('Col 8', 'vc-tabs'),
                'oxi-bt-col-lg-1' => esc_html__('Col 12', 'vc-tabs'),
            ],
            'description' => 'Define how much column you want to show into single rows. Customize possible with desktop or tab or mobile Settings.',
            $select => $selector,
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            $cond => $condition
                ]
        );
        $this->add_control(
                $tab = $id . '-tab', $data, [
            'label' => esc_html__('Column Size', 'vc-tabs'),
            'type' => Controls::SELECT,
            'responsive' => 'tab',
            'default' => 'oxi-bt-col-md-12',
            'description' => $arg['description'],
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'oxi-bt-col-md-12' => esc_html__('Col 1', 'vc-tabs'),
                'oxi-bt-col-md-6' => esc_html__('Col 2', 'vc-tabs'),
                'oxi-bt-col-md-4' => esc_html__('Col 3', 'vc-tabs'),
                'oxi-bt-col-md-3' => esc_html__('Col 4', 'vc-tabs'),
                'oxi-bt-col-md-2' => esc_html__('Col 6', 'vc-tabs'),
                'oxi-bt-col-md-1' => esc_html__('Col 12', 'vc-tabs'),
            ],
            'description' => 'Define how much column you want to show into single rows. Customize possible with desktop or tab or mobile Settings.',
            $select => $selector,
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            $cond => $condition
                ]
        );
        $this->add_control(
                $mob = $id . '-mob', $data, [
            'label' => esc_html__('Column Size', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => 'oxi-bt-col-lg-12',
            'responsive' => 'mobile',
            'description' => $arg['description'],
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'oxi-bt-col-sm-12' => esc_html__('Col 1', 'vc-tabs'),
                'oxi-bt-col-sm-6' => esc_html__('Col 2', 'vc-tabs'),
                'oxi-bt-col-sm-4' => esc_html__('Col 3', 'vc-tabs'),
                'oxi-bt-col-sm-3' => esc_html__('Col 4', 'vc-tabs'),
                'oxi-bt-col-sm-5' => esc_html__('Col 5', 'vc-tabs'),
                'oxi-bt-col-sm-2' => esc_html__('Col 6', 'vc-tabs'),
                'oxi-bt-col-sm-1' => esc_html__('Col 12', 'vc-tabs'),
            ],
            'description' => 'Define how much column you want to show into single rows. Customize possible with desktop or tab or mobile Settings.',
            $select => $selector,
            'form_condition' => (array_key_exists('form_condition', $arg) ? $arg['form_condition'] : ''),
            $cond => $condition
                ]
        );
    }

    /*
     *
     *
     * Templates Substitute Data
     *
     *
     *
     *
     */
    /*
     * Oxi Tabs Style Admin Panel Template Substitute Control.
     *
     * @since 3.3.0
     */

    public function add_substitute_control($id, array $data = [], array $arg = []) {
        $fun = $arg['type'] . '_substitute_control';
        echo $this->$fun($id, $data, $arg);
    }

    /*
     * Oxi Tabs Style Admin Panel Template Substitute Modal Opener.
     *
     * @since 3.3.0
     */

    public function modalopener_substitute_control($id, array $data = [], array $arg = []) {
        $default = [
            'showing' => FALSE,
            'title' => 'Add New Items',
            'sub-title' => 'Add New Items'
        ];
        $arg = array_merge($default, $arg);
        /*
         * $arg['title'] = 'Add New Items';
         * $arg['sub-title'] = 'Add New Items 02';
         *
         */
        echo ' <div class="oxi-addons-item-form shortcode-addons-templates-right-panel ' . (($arg['showing']) ? '' : 'oxi-admin-head-d-none') . '">
                    <div class="oxi-addons-item-form-heading shortcode-addons-templates-right-panel-heading">
                        ' . esc_html($arg['title']) . '
                         <div class="oxi-head-toggle"></div>
                         </div>
                    <div class="oxi-addons-item-form-item shortcode-addons-templates-right-panel-body" id="oxi-addons-list-data-modal-open">
                        <span>
                            <i class="dashicons dashicons-plus-alt oxi-icons"></i>
                            ' . esc_html($arg['sub-title']) . '
                        </span>
                    </div>
                </div>';
    }

    public function shortcodename_substitute_control($id, array $data = [], array $arg = []) {
        $default = [
            'showing' => FALSE,
            'title' => 'Shortcode Name',
            'placeholder' => 'Set Your Shortcode Name'
        ];
        $arg = array_merge($default, $arg);
        /*
         * $arg['title'] = 'Add New Items';
         * $arg['sub-title'] = 'Add New Items 02';
         *
         */
        echo ' <div class="oxi-addons-shortcode  shortcode-addons-templates-right-panel ' . (($arg['showing']) ? '' : 'oxi-admin-head-d-none') . '">
                <div class="oxi-addons-shortcode-heading  shortcode-addons-templates-right-panel-heading">
                    ' . esc_html($arg['title']) . '
                    <div class="oxi-head-toggle"></div>
                </div>
                <div class="oxi-addons-shortcode-body  shortcode-addons-templates-right-panel-body">
                    <form method="post" id="shortcode-addons-name-change-submit">
                        <div class="input-group my-2">
                            <input type="hidden" class="form-control" name="addonsstylenameid" value="' . esc_attr($data['id']) . '">
                            <input type="text" class="form-control" name="addonsstylename" placeholder=" ' . esc_attr($arg['placeholder']) . '" value="' . esc_attr($data['name']) . '">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-success" id="addonsstylenamechange">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>';
    }

    /*
     * Oxi Tabs Style Admin Panel Template Shortcode Info.
     *
     * @since 3.3.0
     */

    public function shortcodeinfo_substitute_control($id, array $data = [], array $arg = []) {
        $default = [
            'showing' => FALSE,
            'title' => 'Shortcode',
        ];
        $arg = array_merge($default, $arg);
        /*
         * $arg['title'] = 'Add New Items';
         * $arg['sub-title'] = 'Add New Items 02';
         *
         */
        echo ' <div class="oxi-addons-shortcode shortcode-addons-templates-right-panel ' . (($arg['showing']) ? '' : 'oxi-admin-head-d-none') . '">
                <div class="oxi-addons-shortcode-heading  shortcode-addons-templates-right-panel-heading">
                    ' . esc_html($arg['title']) . '
                    <div class="oxi-head-toggle"></div>
                </div>
                <div class="oxi-addons-shortcode-body shortcode-addons-templates-right-panel-body">
                    <em>Shortcode for posts/pages/plugins</em>
                    <p>Copy &amp;
                    paste the shortcode directly into any WordPress post, page or Page Builder.</p>
                    <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="[ctu_ultimate_oxi id=&quot;' . esc_attr($id) . '&quot;]">
                    <span></span>
                    <em>Shortcode for templates/themes</em>
                    <p>Copy &amp;
                    paste this code into a template file to include the slideshow within your theme.</p>
                    <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="<?php echo do_shortcode(\'[ctu_ultimate_oxi  id=&quot;' . esc_attr($id) . '&quot;]\'); ?>">
                    <span></span>
                </div>
            </div>';
    }

    public function rearrange_substitute_control($id, array $data = [], array $arg = []) {
        $default = [
            'showing' => FALSE,
            'title' => 'Tabs Rearrange',
            'sub-title' => 'Tabs Rearrange'
        ];
        $arg = array_merge($default, $arg);
        /*
         * $arg['title'] = 'Add New Items';
         * $arg['sub-title'] = 'Add New Items 02';
         *
         */
        echo '  <div class="oxi-addons-item-form shortcode-addons-templates-right-panel ' . (($arg['showing']) ? '' : 'oxi-admin-head-d-none') . '">
                    <div class="oxi-addons-item-form-heading shortcode-addons-templates-right-panel-heading">
                        ' . esc_html($arg['title']) . '
                        <div class="oxi-head-toggle"></div>
                    </div>
                    <div class="oxi-addons-item-form-item shortcode-addons-templates-right-panel-body" id="oxi-addons-rearrange-data-modal-open">
                        <span>
                        <i class="dashicons dashicons-plus-alt oxi-icons"></i>
                        ' . esc_html($arg['sub-title']) . '
                        </span>
                    </div>
                </div>
                <div id="oxi-addons-list-rearrange-modal" class="modal fade bd-example-modal-sm" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <form id="oxi-addons-form-rearrange-submit">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tabs Rearrange</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 alert text-center" id="oxi-addons-list-rearrange-saving">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </div>
                                    <ul class="col-12 list-group" id="oxi-addons-modal-rearrange">
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" id="oxi-addons-list-rearrange-data">
                                    <button type="button" id="oxi-addons-list-rearrange-close" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <input type="submit" id="oxi-addons-list-rearrange-submit" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        </form>
                    <div id="modal-rearrange-store-file">
                        ' . esc_html($id) . '
                    </div>
                </div>
            </div>';
    }

}
