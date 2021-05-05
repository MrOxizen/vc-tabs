<?php

namespace OXI_TABS_PLUGINS\Render\Accordions\Views;

if (!defined('ABSPATH')) {
    exit;
}

use OXI_TABS_PLUGINS\Render\Accordions\Render;

class Style1 extends Render {

    public function default_render($style, $child, $admin) {
        echo '<div class="oxi-accordions-ultimate-style oxi-accordions-ultimate-template-1 ' . $this->headerclass . '  oxi-accordions-clearfix" data-oxi-accordions=\'' . json_encode($this->attribute) . '\'>';
         $number = 1;
        foreach ($child as $key => $val) {
            if (!is_array($value)):
                $value = $this->defualt_value($val['id']);
            endif;
            $value = json_decode(stripslashes($val['rawdata']), true);
            echo '<div class="oxi-accordions-ultimate-wrap oxi-accordions-ultimate-wrap-' . $this->oxiid . '">';
            /*
             * Header Child Loop Start
             */

            echo '  <div class="oxi-accordions-header oxi-accordions-clearfix">';
            echo '<div class=\'oxi-accordions-header-li oxi-accordions-header-li-' . $this->oxiid . '-' . $number . '\' ref=\'#oxi-accordions-trigger-' . $this->oxiid . '-' . $number . '\' ' . $this->accordions_url_render($value) . '>';
           
            echo '</div>';
            echo '  </div>';

            /*
             * Content Child Loop Start
             */
            echo '  <div class="oxi-accordions-content oxi-accordions-clearfix">';

            echo '  </div>';

            echo '</div>';
            $number++;
        }

        echo '</div>';
    }

}
// if ($value['oxi-tabs-modal-title-additional'] == 'icon'):
//                echo $this->font_awesome_render($value['oxi-tabs-modal-icon']);
//            elseif ($value['oxi-tabs-modal-title-additional'] == 'number'):
//                echo $this->number_special_charecter($value['oxi-tabs-modal-number']);
//            elseif ($value['oxi-tabs-modal-title-additional'] == 'image'):
//                echo $this->image_special_render('oxi-tabs-modal-image', $value);
//            endif;
//            echo $this->title_special_charecter($value, 'oxi-tabs-modal-title', 'oxi-tabs-modal-sub-title');