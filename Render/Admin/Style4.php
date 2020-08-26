<?php

namespace OXI_TABS_PLUGINS\Render\Admin;

/**
 * Description of Effects1
 *
 * @author biplo
 */
use OXI_TABS_PLUGINS\Render\Helper;
use OXI_TABS_PLUGINS\Render\Controls as Controls;

class Style4 extends Helper {

    public function register_header_general() {
        $this->start_controls_section(
                'oxi-tabs-head', [
            'label' => esc_html__('Header General', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-head-aditional-location', $this->style, [
            'label' => __('Title Additional Location', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'options' => [
                'oxi-tab-header-aditional-left-position' => __('Left', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-aditional-top-position' => __('Top', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-aditional-right-position' => __('Right', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-aditional-bottom-position' => __('Bottom', OXI_TABS_TEXTDOMAIN),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-header-li' => '',
            ],
            'description' => 'Set the Location of Title’s Additionals (Icon, Image, or Number.)',
                ]
        );

        $this->add_control(
                'oxi-tabs-head-bg', $this->style, [
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::GRADIENT,
            'default' => 'rgba(171, 0, 201, 1)',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header-wrap' => 'background: {{VALUE}};',
            ],
            'description' => 'Set the Background of the Header on Normal Mode.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-header-shape', $this->style, [
            'label' => __('Active Shape', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SINGLEBORDER,
            'selector' => [
                '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-header-shape' => 'border-left: {{SIZE}}px {{TYPE}} {{COLOR}};border-top: {{SIZE}}px {{TYPE}} {{COLOR}};'
            ],
            'description' => 'Customize Header Shape of the Header which Overlay Header Border during Active. Set Type, Size, and Color.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-header-divider', $this->style, [
            'label' => __('Header Single Border', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SINGLEBORDER,
            'selector' => [
                '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header' => 'border: {{SIZE}}px {{TYPE}} {{COLOR}};;'
            ],
            'description' => 'Customize Header Single Border of the Header which divide with header. Set Type, Size, and Color.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-content-divider', $this->style, [
            'label' => __('Content Divider', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SINGLEBORDER,
            'selector' => [
                '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header-wrap' => 'border: {{SIZE}}px {{TYPE}} {{COLOR}};'
            ],
            'description' => 'Customize Content Divider of the Header which divide with content. Set Type, Size, and Color.',
                ]
        );

        $this->add_responsive_control(
                'oxi-tabs-head-padding', $this->style, [
            'label' => __('Padding', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-header-li' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Header Content including background color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-margin', $this->style, [
            'label' => __('Margin', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header-wrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Header Section.',
                ]
        );
        $this->end_controls_section();
    }
    
     public function register_desc_general() {
        $this->start_controls_section(
                'oxi-tabs-desc-general', [
            'label' => esc_html__('General Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-general-bg', $this->style, [
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::GRADIENT,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => 'background: {{VALUE}};',
            ],
            'description' => 'Customize the Tabs’s Background with Color, Gradient or Image properties.',
                ]
        );
        
//        $this->add_group_control(
//                'oxi-tabs-desc-general-shape', $this->style, [
//            'label' => __('Active Shape', OXI_TABS_TEXTDOMAIN),
//            'type' => Controls::SINGLESHAPE,
//            'selector' => [
//                '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-header-shape' => ''
//            ],
//            'description' => 'Customize Header Shape of the Header which Overlay Header Border during Active. Set Type, Size, and Color.',
//                ]
//        );

        $this->add_group_control(
                'oxi-tabs-desc-general-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Add one or more shadows into the Tabs body and customize other Box-Shadow Options.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-general-border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi-tabs-ultimate-style' => ''
                    ],
                    'description' => 'Customize Border of the Tabs Body. Set Type, Width, and Color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-general-radius', $this->style, [
            'label' => __('Border Radius', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Add rounded corners to the Tabs Body.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-general-padding', $this->style, [
            'label' => __('Padding', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Content Body including background color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-general-margin', $this->style, [
            'label' => __('Margin', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}}' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Tabs.',
                ]
        );

        $this->end_controls_section();
    }

}
