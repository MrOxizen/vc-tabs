<?php

namespace OXI_TABS_PLUGINS\Modules;

if (!defined('ABSPATH'))
    exit;

class Tabs_Widget extends \WP_Widget {

    function __construct() {
        parent::__construct(
                'responsive_tabs_with_accordions_widget', esc_html__('Responsive Tabs with Accordions', 'vc-tabs'), array('description' => esc_html__('Responsive Tabs with Accordions Widget', 'vc-tabs'),)
        );
    }

    public function tabs_register_tabswidget() {
        register_widget($this);
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        echo \OXI_TABS_PLUGINS\Classes\Bootstrap::instance()->shortcode_render($title, 'user');
        echo $args['after_widget'];
    }

    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = esc_html__('1', 'vc-tabs');
        }
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html('Style ID:'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr(esc_attr($title)); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? sanitize_text_field($new_instance['title']) : '';
        return $instance;
    }

}
