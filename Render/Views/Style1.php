<?php

namespace OXI_TABS_PLUGINS\Render\Views;

if (!defined('ABSPATH')) {
    exit;
}

use OXI_TABS_PLUGINS\Render\Render;

class Style1 extends Render {
    public function default_render($style, $child, $admin) {
        ?>
     
        <?php
    }

    public function inline_public_css() {
        $data = '';
        return $data;
    }

}

//  public function public_css() {
//        if ($this->style['oxi-tabs-heading-width-tab-size'] == 100 && $this->style['oxi-tabs-heading-width-tab-choices'] == '%'):
//            $this->inline_css .= '@media only screen and (max-width: 993px) {
//                                   .' . $this->WRAPPER . ' .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header{
//                                        -webkit-box-orient: vertical;
//                                        -webkit-box-direction: normal;
//                                        -ms-flex-direction: column;
//                                        flex-direction: column;
//                                    }
//                                }';
//        endif;
//        if ($this->style['oxi-tabs-heading-width-mob-size'] == 100 && $this->style['oxi-tabs-heading-width-mob-choices'] == '%'):
//            $this->inline_css .= '@media only screen and (max-width: 668px) {
//                                    .' . $this->WRAPPER . ' .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header{
//                                          -webkit-box-orient: vertical;
//                                          -webkit-box-direction: normal;
//                                          -ms-flex-direction: column;
//                                          flex-direction: column;
//                                        }
//                                    }';
//        endif;
//    }


// <?php
//        $data = [
//            'header' => get_option('oxi_addons_fixed_header_size'),
//            'animation' => array_key_exists('oxi-tabs-animation', $style) ? $style['oxi-tabs-animation'] : '',
//            'initial' => array_key_exists('oxi-tabs-opening', $style) ? $style['oxi-tabs-opening'] : '',
//            'trigger' => array_key_exists('oxi-tabs-trigger', $style) ? $style['oxi-tabs-trigger'] : ''
//        ];
//        echo '  <div class=\'oxi-tabs-ultimate-style oxi-tabs-ultimate-template-1\' data-oxi-tabs=\'' . json_encode($data) . '\'>
//                    <div class="oxi-tabs-ultimate-header">';
//        foreach ($child as $key => $val) {
//            $value = json_decode(stripslashes($val['rawdata']), true);
//            echo '<div class=\'oxi-tabs-header-li oxi-tabs-header-li-' . $this->oxiid . '-' . $val['id'] . '\' ref=\'#oxi-tabs-trigger-' . $this->oxiid . '-' . $val['id'] . '\' ' . $this->data_js_url_render('oxi-tabs-modal-link', $value) . '>
//                       ' . $this->font_awesome_render($value['oxi-tabs-modal-icon']) . $this->title_special_charecter($value['oxi-tabs-modal-title']);
//            echo '</div>';
//        }
//
//        echo '      </div> 
//                    <div class="oxi-tabs-ultimate-content">';
//        foreach ($child as $key => $val) {
//            $value = json_decode(stripslashes($val['rawdata']), true);
//            if (!is_array($value)):
//                $value = $this->old_data_render($val);
//            endif;
//            echo '      <div class="oxi-tabs-body-tabs  ' . ($this->admin == 'admin' ? 'oxi-addons-admin-edit-list' : '') . '" id="oxi-tabs-body-' . $this->oxiid . '-' . $val['id'] . '">
//                            ' . $this->special_charecter($value['oxi-tabs-modal-desc']) . '
//                            ' . $this->admin_edit_panel($val['id']) . '     
//                        </div>';
//        }
//        echo '      </div>
//                </div>';