<?php

namespace OXI_TABS_PLUGINS\Render\Admin;

/**
 * Description of Effects1
 *
 * @author biplo
 */
use OXI_TABS_PLUGINS\Render\Helper;
use OXI_TABS_PLUGINS\Render\Controls as Controls;

class Style6 extends Helper {

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
        $this->add_responsive_control(
                'oxi-tabs-head-alignment-left-right', $this->style, [
            'label' => __('Title Alignment', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-head-aditional-location' => ['oxi-tab-header-aditional-left-position', 'oxi-tab-header-aditional-right-position'],
            ],
            'options' => [
                '' => __('Default', OXI_TABS_TEXTDOMAIN),
                'flex-start' => __('Left', OXI_TABS_TEXTDOMAIN),
                'center' => __('Center', OXI_TABS_TEXTDOMAIN),
                'flex-end' => __('Right', OXI_TABS_TEXTDOMAIN),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-header-li.oxi-tab-header-aditional-left-position' => 'justify-content:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-header-li.oxi-tab-header-aditional-right-position' => 'justify-content:{{VALUE}};',
            ],
            'description' => 'Set the Location of Title’s Alignment',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-alignment-top-bottom', $this->style, [
            'label' => __('Title Alignment', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-head-aditional-location' => ['oxi-tab-header-aditional-top-position', 'oxi-tab-header-aditional-bottom-position'],
            ],
            'options' => [
                '' => __('Default', OXI_TABS_TEXTDOMAIN),
                'flex-start' => __('Left', OXI_TABS_TEXTDOMAIN),
                'center' => __('Center', OXI_TABS_TEXTDOMAIN),
                'flex-end' => __('Right', OXI_TABS_TEXTDOMAIN),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-header-li.oxi-tab-header-aditional-top-position' => 'align-items:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-header-li.oxi-tab-header-aditional-bottom-position' => 'align-items:{{VALUE}};',
            ],
            'description' => 'Set the Location of Title’s Alignment',
                ]
        );





        $this->start_controls_tabs(
                'oxi-tabs-head-start-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', OXI_TABS_TEXTDOMAIN),
                        'active' => esc_html__('Active', OXI_TABS_TEXTDOMAIN),
                    ]
                ]
        );

        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-head-bg', $this->style, [
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::GRADIENT,
            'default' => 'rgba(171, 0, 201, 1)',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header' => 'background: {{VALUE}};',
            ],
            'description' => 'Set the Background of the Header on Normal Mode.',
                ]
        );


        $this->end_controls_tab();
        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-head-ac-bg', $this->style, [
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::GRADIENT,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header .oxi-tabs-header-li.active' => 'background: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-tabs-header-extend' => 'background: {{VALUE}};',
            ],
            'description' => 'Set the Background of the Header.on Active Mode.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
                'oxi-tabs-head-general-width-extend', $this->style, [
            'label' => __('Width or Height Extend', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 10,
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
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-tabs-header-extend' => 'width: {{SIZE}}{{UNIT}};height:  {{SIZE}}{{UNIT}};',
            ],
            'description' => 'Horizontal will extend height & Vertical will be width .',
                ]
        );





        $this->start_popover_control(
                'oxi-tabs-head-general-popover', [
            'label' => 'Inner Border',
            'description' => 'Customize the Tabs’s Header Inner Broder.',
                ],
                $this->style
        );
        $this->add_control(
                'oxi-tabs-head-general-inner-border-type', $this->style, [
            'label' => __('Type', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => __('None', OXI_TABS_TEXTDOMAIN),
                'solid' => __('Solid', OXI_TABS_TEXTDOMAIN),
                'dotted' => __('Dotted', OXI_TABS_TEXTDOMAIN),
                'dashed' => __('Dashed', OXI_TABS_TEXTDOMAIN),
                'double' => __('Double', OXI_TABS_TEXTDOMAIN),
                'groove' => __('Groove', OXI_TABS_TEXTDOMAIN),
                'ridge' => __('Ridge', OXI_TABS_TEXTDOMAIN),
                'inset' => __('Inset', OXI_TABS_TEXTDOMAIN),
                'outset' => __('Outset', OXI_TABS_TEXTDOMAIN),
                'hidden' => __('Hidden', OXI_TABS_TEXTDOMAIN),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-tabs-header-shape' => 'border-style:{{VALUE}};',
            ],
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-general-inner-border-size', $this->style, [
            'label' => __('Size', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 3,
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
                'oxi-tabs-head-general-inner-border-type' => 'EMPTY',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-tabs-header-shape' => 'border-width: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}};',
            ],
                ]
        );

        $this->add_responsive_control(
                'oxi-tabs-head-general-inner-border-width', $this->style, [
            'label' => __('Width', OXI_TABS_TEXTDOMAIN),
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
                'oxi-tabs-head-general-inner-border-type' => 'EMPTY',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-tabs-header-shape' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
            ],
                ]
        );
        $this->add_control(
                'oxi-tabs-head-general-inner-border-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'condition' => [
                'oxi-tabs-head-general-inner-border-type' => 'EMPTY',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-tabs-header-shape' => 'border-color: {{VALUE}};',
            ],
                ]
        );

        $this->end_popover_control();


        $this->add_group_control(
                'oxi-tabs-head-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header' => '',
            ],
            'description' => 'Add one or more shadows into Header Section and customize other Box-Shadow Options.',
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Header Section.',
                ]
        );
        $this->end_controls_section();
    }

}
