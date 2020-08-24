<?php

namespace OXI_TABS_PLUGINS\Render\Views;

if (!defined('ABSPATH')) {
    exit;
}

use OXI_TABS_PLUGINS\Render\Render;

class Style2 extends Render {

    public function default_render($style, $child, $admin) {
        $data = [
            'header' => get_option('oxi_addons_fixed_header_size'),
            'animation' => array_key_exists('oxi-tabs-gen-animation', $style) ? $style['oxi-tabs-gen-animation'] : '',
            'initial' => array_key_exists('oxi-tabs-gen-opening', $style) ? $style['oxi-tabs-gen-opening'] : '',
            'trigger' => array_key_exists('oxi-tabs-gen-trigger', $style) ? $style['oxi-tabs-gen-trigger'] : '',
            'type' => array_key_exists('oxi-tabs-gen-event', $style) ? $style['oxi-tabs-gen-event'] : ''
        ];
        $responsive = ' ';
        if ($style['oxi-tabs-heading-responsive-mode'] == 'oxi-tabs-heading-responsive-static'):
            $responsive .= $style['oxi-tabs-header-horizontal-tabs-alignment-column'] . ' ' . $style['oxi-tabs-header-horizontal-mobile-alignment-column'] . ' ';
            $responsive .= $style['oxi-tabs-header-vertical-tabs-alignment'] . '  ' . $style['oxi-tabs-header-vertical-tabs-alignment-column'] . ' ';
            $responsive .= $style['oxi-tabs-header-vertical-mobile-alignment'] . '  ' . $style['oxi-tabs-header-vertical-mobile-alignment-column'] . ' ';
        endif;
        $heading = $style['oxi-tabs-heading-responsive-mode'] . ' ' . $style['oxi-tabs-heading-alignment'] . ' ' . $style['oxi-tabs-heading-horizontal-position'] . ' ' . $style['oxi-tabs-heading-vertical-position'];



        echo '<div class="oxi-tabs-ultimate-style oxi-tabs-ultimate-template-2 ' . $heading . ' ' . $responsive . '  ' . $style['oxi-tabs-gen-event'] . '  oxi-tab-clearfix" data-oxi-tabs=\'' . json_encode($data) . '\'>';

        /*
         * Header Child Loop Start
         */
        echo '   <div class="oxi-tabs-ultimate-header-wrap ' . ($style['oxi-tabs-heading-responsive-mode'] == 'oxi-tabs-heading-responsive-static' ? $this->header_responsive_static_render($style, ['title', 'subtitle', 'icon', 'number', 'image']) : '') . '">';
        echo '        <div class="oxi-tabs-ultimate-header oxi-tab-clearfix">';
        foreach ($child as $key => $val) {
            $value = json_decode(stripslashes($val['rawdata']), true);
            if (!is_array($value)):
                $value = $this->defualt_value($val['id']);
            endif;
            echo '<div class=\'oxi-tabs-header-li ' . $style['oxi-tabs-head-aditional-location'] . ' oxi-tabs-header-li-' . $this->oxiid . '-' . $val['id'] . '\' ref=\'#oxi-tabs-trigger-' . $this->oxiid . '-' . $val['id'] . '\' ' . $this->tabs_url_render($value) . '>';
            if ($value['oxi-tabs-modal-title-additional'] == 'icon'):
                echo $this->font_awesome_render($value['oxi-tabs-modal-icon']);
            elseif ($value['oxi-tabs-modal-title-additional'] == 'number'):
                echo $this->number_special_charecter($value['oxi-tabs-modal-number']);
            elseif ($value['oxi-tabs-modal-title-additional'] == 'image'):
                echo $this->image_special_render('oxi-tabs-modal-image', $value);
            endif;
            echo $this->title_special_charecter($value, 'oxi-tabs-modal-title', 'oxi-tabs-modal-sub-title');
             echo '<div class="oxi-tabs-header-triangle-shape"></div>';
            echo '</div>';
        }
        echo '      </div> ';
        echo '  </div> ';

        /*
         * Header Child Loop End 
         */
        /*
         * Content Body Loop Start
         */
        echo '  <div class="oxi-tabs-ultimate-content-wrap">';
        echo '      <div class="oxi-tabs-ultimate-content">';

        foreach ($child as $key => $val) {
            $value = json_decode(stripslashes($val['rawdata']), true);
            if (!is_array($value)):
                $value = $this->defualt_value($val['id']);
            endif;
            echo '      <div class="oxi-tabs-body-tabs animate__animated ' . ($this->admin == 'admin' ? 'oxi-addons-admin-edit-list' : '') . '" id="oxi-tabs-body-' . $this->oxiid . '-' . $val['id'] . '">
                            ' . $this->tabs_content_render($style, $value) . '
                            ' . $this->admin_edit_panel($val['id']) . '     
                        </div>';
        }
        echo '      </div>';
        echo '  </div>';
        /*
         * Content Body Loop End
         */
        echo '</div>';
    }

}
