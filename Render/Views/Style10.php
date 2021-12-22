<?php

namespace OXI_TABS_PLUGINS\Render\Views;

if (!defined('ABSPATH')) {
    exit;
}

use OXI_TABS_PLUGINS\Render\Render;

class Style10 extends Render {

    public function inline_public_jquery() {
        return '(function ($) {
                        var H = 0, CLS = "#oxi-tabs-wrapper-' . $this->oxiid . ' .oxi-tabs-header-li";
                            $(CLS).each(function () {
                                if ($(this).height() > H) {
                                    H = $(this).height();

                                }
                            });
                            $(CLS).height(H);
                            var New =  $(CLS).first().outerHeight(),
                            A = (New * New), B = A / 2, C = Math.sqrt(B), D = C/2;
                            $("#oxi-tabs-wrapper-' . $this->oxiid . '").append("<style>#oxi-tabs-wrapper-' . $this->oxiid . ' .oxi-tabs-header-li .oxi-tabs-header-triangle-shape{width: "+C+"px; height: "+C+"px; left:-"+D+"px;  right:-"+D+"px;}< /style>");
                        })(jQuery)';
    }

    public function default_render($style, $child, $admin) {
        $content = '<div class="oxi-tabs-ultimate-style oxi-tabs-ultimate-template-10 ' . $this->headerclass . '  oxi-tab-clearfix" data-oxi-tabs=\'' . json_encode($this->attribute) . '\'>';

        /*
         * Header Child Loop Start
         */
        $content .= '   <div class="oxi-tabs-ultimate-header-wrap oxi-tabs-ultimate-header-' . $this->oxiid . ' ' . ($style['oxi-tabs-heading-responsive-mode'] == 'oxi-tabs-heading-responsive-static' ? $this->header_responsive_static_render($style, ['title', 'subtitle', 'icon', 'number', 'image']) : '') . '">';
        $content .= '        <div class="oxi-tabs-ultimate-header oxi-tab-clearfix">';
        $number = 1;
        foreach ($child as $key => $val) {
            $this->childkeys = $key;
            $value = json_decode(stripslashes($val['rawdata']), true);
            if (!is_array($value)):
                $value = $this->defualt_value($val['id']);
            endif;
            $content .= '<div class=\'oxi-tabs-header-li ' . $style['oxi-tabs-head-aditional-location'] . ' oxi-tabs-header-li-' . $this->oxiid . '-' . $number . '\' ref=\'#oxi-tabs-trigger-' . $this->oxiid . '-' . $number . '\' ' . $this->tabs_url_render($value) . '>';
            if ($value['oxi-tabs-modal-title-additional'] == 'icon'):
                $content .= $this->font_awesome_render($value['oxi-tabs-modal-icon']);
            elseif ($value['oxi-tabs-modal-title-additional'] == 'number'):
                $content .= $this->number_special_charecter($value['oxi-tabs-modal-number']);
            elseif ($value['oxi-tabs-modal-title-additional'] == 'image'):
                $content .= $this->image_special_render('oxi-tabs-modal-image', $value);
            endif;
            $content .= $this->title_special_charecter($value, 'oxi-tabs-modal-title', 'oxi-tabs-modal-sub-title');
            $content .= '<div class="oxi-tabs-header-triangle-shape"></div>';
            $content .= '</div>';
            $number++;
        }
        $content .= '      </div> ';
        $content .= '  </div> ';

        /*
         * Header Child Loop End
         */
        /*
         * Content Body Loop Start
         */
        $content .= '  <div class="oxi-tabs-ultimate-content-wrap">';
        $content .= '      <div class="oxi-tabs-ultimate-content">';
        $number = 1;
        foreach ($child as $key => $val) {
            $this->childkeys = $key;
            $value = json_decode(stripslashes($val['rawdata']), true);
            if (!is_array($value)):
                $value = $this->defualt_value($val['id']);
            endif;
            $content .= '      <div class="oxi-tabs-body-tabs oxi-tabs-body-' . $this->oxiid . '  animate__animated ' . ($this->admin == 'admin' ? 'oxi-addons-admin-edit-list' : '') . '" id="oxi-tabs-body-' . $this->oxiid . '-' . $number . '">
                            ' . $this->tabs_content_render($style, $value) . '
                            ' . $this->admin_edit_panel($val['id']) . '
                        </div>';
            $number++;
        }
        $content .= '      </div>';
        $content .= '  </div>';
        /*
         * Content Body Loop End
         */


        $content .= '</div>';

        echo wp_kses($content, $this->database->allowed_tags());
    }

}
