<?php

namespace OXI_TABS_PLUGINS\Render\Admin;

if (!defined('ABSPATH'))
    exit;

/**
 * Description of Effects1
 *
 * @author biplo
 */
use OXI_TABS_PLUGINS\Render\Helper;
use OXI_TABS_PLUGINS\Render\Controls as Controls;

class Style2 extends Helper {

    public function register_header_general() {
        $this->start_controls_section(
                'oxi-tabs-head', [
            'label' => esc_html__('Header General', 'vc-tabs'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-head-aditional-location', $this->style, [
            'label' => esc_html__('Title Additional Location', 'vc-tabs'),
            'type' => Controls::SELECT,
            'options' => [
                'oxi-tab-header-aditional-left-position' => esc_html__('Left', 'vc-tabs'),
                'oxi-tab-header-aditional-top-position' => esc_html__('Top', 'vc-tabs'),
                'oxi-tab-header-aditional-right-position' => esc_html__('Right', 'vc-tabs'),
                'oxi-tab-header-aditional-bottom-position' => esc_html__('Bottom', 'vc-tabs'),
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li' => '',
            ],
            'description' => 'Set the Location of Title’s Additionals (Icon, Image, or Number.)',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-alignment-left-right', $this->style, [
            'label' => esc_html__('Title Alignment', 'vc-tabs'),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-head-aditional-location' => ['oxi-tab-header-aditional-left-position', 'oxi-tab-header-aditional-right-position'],
            ],
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'flex-start' => esc_html__('Left', 'vc-tabs'),
                'center' => esc_html__('Center', 'vc-tabs'),
                'flex-end' => esc_html__('Right', 'vc-tabs'),
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header .oxi-tabs-header-li.oxi-tab-header-aditional-left-position' => 'justify-content:{{VALUE}};',
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header .oxi-tabs-header-li.oxi-tab-header-aditional-right-position' => 'justify-content:{{VALUE}};',
            ],
            'description' => 'Set the Location of Title’s Alignment',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-alignment-top-bottom', $this->style, [
            'label' => esc_html__('Title Alignment', 'vc-tabs'),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-head-aditional-location' => ['oxi-tab-header-aditional-top-position', 'oxi-tab-header-aditional-bottom-position'],
            ],
            'options' => [
                '' => esc_html__('Default', 'vc-tabs'),
                'flex-start' => esc_html__('Left', 'vc-tabs'),
                'center' => esc_html__('Center', 'vc-tabs'),
                'flex-end' => esc_html__('Right', 'vc-tabs'),
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header .oxi-tabs-header-li.oxi-tab-header-aditional-top-position' => 'align-items:{{VALUE}};',
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header .oxi-tabs-header-li.oxi-tab-header-aditional-bottom-position' => 'align-items:{{VALUE}};',
            ],
            'description' => 'Set the Location of Title’s Alignment',
                ]
        );
        $this->add_control(
                'oxi-tabs-head-bg', $this->style, [
            'label' => esc_html__('Background', 'vc-tabs'),
            'type' => Controls::GRADIENT,
            'default' => 'rgba(171, 0, 201, 1)',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header' => 'background: {{VALUE}};',
            ],
            'description' => 'Set the Background of the Header on Normal Mode.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-inner-border',
                $this->style,
                [
                    'label' => esc_html__('Divider', 'vc-tabs'),
                    'type' => Controls::SINGLEBORDER,
                    'selector' => [
                        '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li' => 'border-right: {{SIZE}}px {{TYPE}} {{COLOR}};border-bottom: {{SIZE}}px {{TYPE}} {{COLOR}};'
                    ],
                    'description' => 'Customize Divider Border of the Header. Set Type, Size, and Color.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-triangle-shape',
                $this->style,
                [
                    'label' => esc_html__('Triangle Shape', 'vc-tabs'),
                    'type' => Controls::SINGLEBORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi-tabs-header-triangle-shape' => 'border-style: {{TYPE}}; border-width: {{SIZE}}px; border-color: {{COLOR}};'
                    ],
                    'description' => 'Customize Triangle Shape of the Header. Set Type, Size, and Color.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header' => '',
            ],
            'description' => 'Add one or more shadows into Header Section and customize other Box-Shadow Options.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header' => ''
                    ],
                    'description' => 'Customize Border of the Header. Set Type, Width, and Color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-radius', $this->style, [
            'label' => esc_html__('Border Radius', 'vc-tabs'),
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
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Add rounded corners to the Header’s Section.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-padding', $this->style, [
            'label' => esc_html__('Padding', 'vc-tabs'),
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
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Header Content including background color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-margin', $this->style, [
            'label' => esc_html__('Margin', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style.oxi-tab-header-horizontal > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header .oxi-tabs-header-li' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} > .oxi-tabs-ultimate-style.oxi-tab-header-vertical > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '@media only screen and (min-width: 994px){ {{WRAPPER}} > .oxi-tabs-ultimate-template-2.oxi-tab-header-horizontal.oxi-tab-header-top-left-position .oxi-tabs-header-triangle-shape, {{WRAPPER}} > .oxi-tabs-ultimate-template-2.oxi-tab-header-horizontal.oxi-tab-header-top-right-position .oxi-tabs-header-triangle-shape, {{WRAPPER}} > .oxi-tabs-ultimate-template-2.oxi-tab-header-horizontal.oxi-tab-header-top-compact-position .oxi-tabs-header-triangle-shape, {{WRAPPER}} > .oxi-tabs-ultimate-template-2.oxi-tab-header-horizontal.oxi-tab-header-top-center-position .oxi-tabs-header-triangle-shape ' => ' bottom:-{{BOTTOM}}{{UNIT}};}',
                '@media only screen and (min-width: 994px){ {{WRAPPER}} > .oxi-tabs-ultimate-template-2.oxi-tab-header-horizontal.oxi-tab-header-bottom-left-position .oxi-tabs-header-triangle-shape, {{WRAPPER}} > .oxi-tabs-ultimate-template-2.oxi-tab-header-horizontal.oxi-tab-header-bottom-right-position .oxi-tabs-header-triangle-shape, {{WRAPPER}} > .oxi-tabs-ultimate-template-2.oxi-tab-header-horizontal.oxi-tab-header-bottom-center-position .oxi-tabs-header-triangle-shape, {{WRAPPER}} > .oxi-tabs-ultimate-template-2.oxi-tab-header-horizontal.oxi-tab-header-bottom-compact-position .oxi-tabs-header-triangle-shape ' => ' top:-{{TOP}}{{UNIT}};}',
            ],
            'description' => 'Create some Space outside of the Header Section.',
                ]
        );
        $this->end_controls_section();
    }

}
