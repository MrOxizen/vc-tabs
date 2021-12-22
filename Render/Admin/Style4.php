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

class Style4 extends Helper {

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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => 'background: {{VALUE}};',
            ],
            'description' => 'Set the Background of the Header on Normal Mode.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-header-shape', $this->style, [
            'label' => esc_html__('Active Shape', 'vc-tabs'),
            'type' => Controls::SINGLEBORDER,
            'selector' => [
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-shape' => 'border-left: {{SIZE}}px {{TYPE}} {{COLOR}};border-top: {{SIZE}}px {{TYPE}} {{COLOR}};'
            ],
            'description' => 'Customize Header Shape of the Header which Overlay Header Border during Active. Set Type, Size, and Color.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-header-divider', $this->style, [
            'label' => esc_html__('Header Single Border', 'vc-tabs'),
            'type' => Controls::SINGLEBORDER,
            'selector' => [
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header' => 'border: {{SIZE}}px {{TYPE}} {{COLOR}};;'
            ],
            'description' => 'Customize Header Single Border of the Header which divide with header. Set Type, Size, and Color.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-content-divider', $this->style, [
            'label' => esc_html__('Content Divider', 'vc-tabs'),
            'type' => Controls::SINGLEBORDER,
            'selector' => [
                '{{WRAPPER}}  .oxi-tabs-ultimate-style' => 'border: {{SIZE}}px {{TYPE}} {{COLOR}};'
            ],
            'description' => 'Customize Content Divider of the Header which divide with content. Set Type, Size, and Color.',
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Header Section.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_desc_general() {
        $this->start_controls_section(
                'oxi-tabs-desc-general', [
            'label' => esc_html__('General Settings', 'vc-tabs'),
            'showing' => TRUE,
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-content-height', $this->style, [
            'label' => esc_html__('Content Height', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'toggle' => true,
            'options' => [
                'yes' => [
                    'title' => esc_html__('Equal', 'vc-tabs'),
                ],
                'no' => [
                    'title' => esc_html__('Dynamic', 'vc-tabs'),
                ],
            ],
            'description' => 'Select Content Height as Equal or Dynamic.',
                ]
        );

        $this->add_control(
                'oxi-tabs-desc-general-bg', $this->style, [
            'label' => esc_html__('Background', 'vc-tabs'),
            'type' => Controls::GRADIENT,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => 'background: {{VALUE}};',
            ],
            'description' => 'Customize the Tabs’s Background with Color, Gradient or Image properties.',
                ]
        );
        $this->start_popover_control(
                'oxi-tabs-desc-general-popover', [
            'label' => 'Single Shape',
            'description' => 'Customize the Tabs’s Content Upper Shape.',
                ],
                $this->style
        );
        $this->add_control(
                'oxi-tabs-desc-general-shape-type', $this->style, [
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
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style .oxi-tabs-body-content-shape span' => 'border-style: {{VALUE}};',
            ],
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-general-shape-position', $this->style, [
            'label' => esc_html__('Shape Location', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                'flex-start' => esc_html__('Left', 'vc-tabs'),
                'center' => esc_html__('Center', 'vc-tabs'),
                'flex-end' => esc_html__('Right', 'vc-tabs'),
            ],
            'condition' => [
                'oxi-tabs-desc-general-shape-type' => 'EMPTY',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style .oxi-tabs-body-content-shape' => 'justify-content: {{VALUE}};',
            ],
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-general-shape-width', $this->style, [
            'label' => esc_html__('Width', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 50,
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'condition' => [
                'oxi-tabs-desc-general-shape-type' => 'EMPTY',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style .oxi-tabs-body-content-shape span' => 'width: {{SIZE}}{{UNIT}};',
            ],
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-general-shape-height', $this->style, [
            'label' => esc_html__('Height', 'vc-tabs'),
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
            'condition' => [
                'oxi-tabs-desc-general-shape-type' => 'EMPTY',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style .oxi-tabs-body-content-shape span' => 'border-width: {{SIZE}}px 0 0 0;',
            ],
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-general-shape-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'condition' => [
                'oxi-tabs-desc-general-shape-type' => 'EMPTY',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style .oxi-tabs-body-content-shape span' => 'border-top-color: {{VALUE}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'oxi-tabs-desc-general-shape-padding', $this->style, [
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
            'condition' => [
                'oxi-tabs-desc-general-shape-type' => 'EMPTY',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style .oxi-tabs-body-content-shape' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
                ]
        );
        $this->end_popover_control();

        $this->add_group_control(
                'oxi-tabs-desc-general-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
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
                        '{{WRAPPER}} > .oxi-tabs-ultimate-style' => ''
                    ],
                    'description' => 'Customize Border of the Tabs Body. Set Type, Width, and Color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-general-radius', $this->style, [
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Add rounded corners to the Tabs Body.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-general-padding', $this->style, [
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style .oxi-tabs-body-tabs' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Content Body including background color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-general-margin', $this->style, [
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
                '{{WRAPPER}}' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Tabs.',
                ]
        );

        $this->end_controls_section();
    }

}
