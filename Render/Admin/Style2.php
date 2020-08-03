<?php

namespace OXI_TABS_PLUGINS\Render\Admin;

/**
 * Description of Effects1
 *
 * @author biplo
 */
use OXI_TABS_PLUGINS\Render\Admin;
use OXI_TABS_PLUGINS\Render\Controls as Controls;

class Style2 extends Admin {

    public function register_controls() {
        $this->start_section_header(
                'shortcode-addons-start-tabs', [
            'options' => [
                'button-settings' => esc_html__('General Settings', OXI_TABS_TEXTDOMAIN),
                'custom' => esc_html__('Custom CSS', OXI_TABS_TEXTDOMAIN),
            ]
                ]
        );
        $this->start_section_tabs(
                'oxi-tabs-start-tabs', [
            'condition' => [
                'oxi-tabs-start-tabs' => 'button-settings'
            ]
                ]
        );
        $this->start_section_devider();
        $this->register_general();
        $this->register_descriptions();
        $this->end_section_devider();

        $this->start_section_devider();
        $this->register_heading();
        $this->register_icon();
        $this->end_section_devider();
        $this->end_section_tabs();

        $this->start_section_tabs(
                'oxi-tabs-start-tabs', [
            'condition' => [
                'oxi-tabs-start-tabs' => 'custom'
            ],
            'padding' => '10px'
                ]
        );

        $this->start_controls_section(
                'oxi-tabs-start-tabs-css', [
            'label' => esc_html__('Custom CSS', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-custom-css', $this->style, [
            'label' => __('', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::TEXTAREA,
            'default' => '',
            'description' => 'Custom CSS Section. You can add custom css into textarea.'
                ]
        );
        $this->end_controls_section();
        $this->end_section_tabs();
    }

    public function register_general() {
        $this->start_controls_section(
                'oxi-tabs-wrapper', [
            'label' => esc_html__('General Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-trigger', $this->style, [
            'label' => __('Trigger', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => '',
            'options' => [
                '1' => [
                    'title' => __('True', OXI_TABS_TEXTDOMAIN),
                ],
                '' => [
                    'title' => __('False', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'description' => 'Initial Opening, Which tabs will view at page load.',
                ]
        );
        $this->add_control(
                'oxi-tabs-opening', $this->style, [
            'label' => __('Initial Opening', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                ':eq(0)' => __('First', OXI_TABS_TEXTDOMAIN),
                ':eq(1)' => __('2nd', OXI_TABS_TEXTDOMAIN),
                ':eq(2)' => __('3rd', OXI_TABS_TEXTDOMAIN),
                ':eq(109)' => __('None', OXI_TABS_TEXTDOMAIN),
            ],
            'description' => 'Initial Opening, Which tabs will view at page load.',
                ]
        );
        $this->add_control(
                'oxi-tabs-animation', $this->style, [
            'label' => __('Animation', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => __('No Animation', OXI_TABS_TEXTDOMAIN),
                'fade' => __('fade', OXI_TABS_TEXTDOMAIN),
                'slide' => __('Slide', OXI_TABS_TEXTDOMAIN),
            ],
            'description' => 'Tabs Animation, Select Tabs in and out of visibility types.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_heading() {
        $this->start_controls_section(
                'oxi-tabs-wrapper', [
            'label' => esc_html__('Heading Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-align',
                $this->style,
                [
                    'label' => __('Alignment', OXI_TABS_TEXTDOMAIN),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_ICON,
                    'default' => '',
                    'toggle' => true,
                    'options' => [
                        'flex-start' => [
                            'title' => __('Left', OXI_TABS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __('Center', OXI_TABS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-center',
                        ],
                        'flex-end' => [
                            'title' => __('Right', OXI_TABS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header' => 'justify-content:{{VALUE}};',
                    ],
                    'description' => 'Allows you set heading align as Left, Center or Right.',
                ]
        );

        $this->add_responsive_control(
                'oxi-tabs-heading-width', $this->style, [
            'label' => __('Width', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 1900,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 1,
                    'max' => 200,
                    'step' => 0.1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li' => 'max-width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Customize heading Width with several options as Pixel, Percent or EM.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-heading-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNFLEX,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li-title' => '',
            ]
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-heading-start-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', OXI_TABS_TEXTDOMAIN),
                        'hover' => esc_html__('Active or Hover', OXI_TABS_TEXTDOMAIN),
                    ]
                ]
        );
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-heading-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li-title' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Heading.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-background', $this->style, [
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::GRADIENT,
            'default' => 'rgba(171, 0, 201, 1)',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header' => 'background: {{VALUE}};',
            ],
            'description' => 'Background property is used to set the Background of the Heading.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-heading-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li-title' => '',
            ],
            'description' => 'Text Shadow property adds shadow to Button.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-heading-active-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li.active .oxi-tabs-header-li-title' => 'color: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li:hover .oxi-tabs-header-li-title' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the active or hover color of the heading.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-active-background', $this->style, [
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::GRADIENT,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li.active' => 'background: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li:hover' => 'background: {{VALUE}};',
            ],
            'description' => 'Background property is used to set the active or hover background of the heading.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-heading-active-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li.active .oxi-tabs-header-li-title' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li:hover .oxi-tabs-header-li-title' => '',
            ],
            'description' => 'Text Shadow property add shadow to active or hover heading.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
                'oxi-tabs-heading-inner-border',
                $this->style,
                [
                    'label' => __('Inner Right Border', OXI_TABS_TEXTDOMAIN),
                    'type' => Controls::SINGLEBORDER,
                    'separator' => true,
                    'selector' => [
                        '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li' => 'border-right: {{SIZE}}px {{TYPE}} {{COLOR}};'
                    ],
                    'description' => 'Border property is used to set the Border of the Heading.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-heading-border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header' => ''
                    ],
                    'description' => 'Border property is used to set the Border of the Heading.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-heading-radius', $this->style, [
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
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Button with options.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-heading-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header' => '',
            ],
            'description' => 'Allows you to attaches one or more shadows into Button.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-heading-padding', $this->style, [
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
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li-title' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Padding used to generate space around heading include background color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-hover-heading-margin', $this->style, [
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
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space outside heading.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_icon() {
        $this->start_controls_section(
                'oxi-tabs-icon', [
            'label' => esc_html__('Heading Icon', OXI_TABS_TEXTDOMAIN),
            'showing' => FALSE,
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-icon-position',
                $this->style,
                [
                    'label' => __('Position', OXI_TABS_TEXTDOMAIN),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_ICON,
                    'toggle' => true,
                    'default' => 'center',
                    'options' => [
                        'row' => [
                            'title' => __('Left', OXI_TABS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-left',
                        ],
                        'column' => [
                            'title' => __('Top', OXI_TABS_TEXTDOMAIN),
                            'icon' => 'fas fa-sort-amount-up',
                        ],
                        'column-reverse' => [
                            'title' => __('Bottom', OXI_TABS_TEXTDOMAIN),
                            'icon' => 'fas fa-sort-amount-up-alt',
                        ],
                        'row-reverse' => [
                            'title' => __('Right', OXI_TABS_TEXTDOMAIN),
                            'icon' => 'fa fa-align-right',
                        ],
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li' => 'flex-direction:{{VALUE}};',
                    ],
                    'description' => 'Allows you to set Icon Position.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-icon-width', $this->style, [
            'label' => __('Width Height', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 2000,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 200,
                    'step' => .1,
                ],
                'rem' => [
                    'min' => 0,
                    'max' => 200,
                    'step' => 0.1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Icon Width Height.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-icon-size', $this->style, [
            'label' => __('Icon Size', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => 'px',
                'size' => 20,
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => 'font-size:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Icon Size.',
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-heading-start-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', OXI_TABS_TEXTDOMAIN),
                        'hover' => esc_html__('Active or Hover', OXI_TABS_TEXTDOMAIN),
                    ]
                ]
        );
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-icon-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'default' => '#b414c9',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Icon.',
                ]
        );
        $this->add_control(
                'oxi-tabs-icon-background', $this->style, [
            'type' => Controls::GRADIENT,
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => '',
            ],
            'description' => 'Customize Icon Background with Color or Gradient or Image properties.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-icon-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => '',
            ],
            'description' => 'Border property is used to set the Border of the Icon.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-icon-hover-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'default' => '#b414c9',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-icons' => 'color: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-icons' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Icon.',
                ]
        );
        $this->add_control(
                'oxi-tabs-icon-hover-background', $this->style, [
            'type' => Controls::GRADIENT,
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-icons' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-icons' => '',
            ],
            'description' => 'Customize Icon Background with Color or Gradient properties.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-icon-hover-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-icons' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-icons' => '',
            ],
            'description' => 'Border property is used to set the Border of the Icon.',
                ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
                'oxi-tabs-icon-border-radius', $this->style, [
            'label' => __('Border Radius', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'default' => [
                'unit' => 'px',
                'size' => '',
            ],
            'range' => [
                '%' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => .1,
                ],
                'px' => [
                    'min' => -200,
                    'max' => 200,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 10,
                    'step' => .1,
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Icon with 4 values.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-icon-margin', $this->style, [
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space around Icon.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_descriptions() {
        $this->start_controls_section(
                'oxi-tabs-wrapper', [
            'label' => esc_html__('Descriptions Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );

        $this->add_group_control(
                'oxi-tabs-desc-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-content .oxi-tabs-body-tabs' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-content .oxi-tabs-body-tabs p' => '',
            ]
                ]
        );

        $this->add_control(
                'oxi-tabs-desc-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-content .oxi-tabs-body-tabs' => 'color: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-content .oxi-tabs-body-tabs p' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Heading.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-background', $this->style, [
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::GRADIENT,
            'default' => 'rgba(255, 255, 255, 1)',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-content .oxi-tabs-body-tabs' => 'background: {{VALUE}};',
            ],
            'description' => 'Background property is used to set the Background of the Heading.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi-tabs-ultimate-content .oxi-tabs-body-tabs' => ''
                    ],
                    'description' => 'Border property is used to set the Border of the Heading.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-radius', $this->style, [
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
                '{{WRAPPER}} .oxi-tabs-ultimate-content .oxi-tabs-body-tabs' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Button with options.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-content .oxi-tabs-body-tabs' => '',
            ],
            'description' => 'Allows you to attaches one or more shadows into Button.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-padding', $this->style, [
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
                '{{WRAPPER}} .oxi-tabs-ultimate-content .oxi-tabs-body-tabs' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Padding used to generate space around heading include background color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-image-hover-desc-margin', $this->style, [
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
                '{{WRAPPER}} .oxi-tabs-ultimate-content' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space outside heading.',
                ]
        );
        $this->end_controls_section();
    }

    public function modal_form_data() {
        echo '<div class="modal-header">                    
                    <h4 class="modal-title">Tabs Modal Form</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">';
        $this->add_control(
                'oxi-tabs-modal-title', $this->style, [
            'label' => esc_html__('Title', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::TEXT,
            'default' => 'Lorem Ipsum',
            'description' => 'Text Shadow property adds shadow to Description.',
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-icon', $this->style, [
            'label' => esc_html__('Icon', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::ICON,
            'default' => '',
            'description' => 'Text Shadow property adds shadow to Description.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-modal-link', $this->style, [
            'label' => esc_html__('Link', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::URL,
            'description' => 'Text Shadow property adds shadow to Description.',
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-desc', $this->style, [
            'label' => __('Description', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::WYSIWYG,
            'default' => '<p>Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>',
                ]
        );
        echo '</div>';
    }

}
