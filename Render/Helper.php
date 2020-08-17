<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OXI_TABS_PLUGINS\Render;

/**
 * Description of Helper
 *
 * @author Oxizen
 */
use OXI_TABS_PLUGINS\Render\Admin;
use OXI_TABS_PLUGINS\Render\Controls as Controls;

class Helper extends Admin {

    public function get_initial_opening_list() {
        $count = count($this->child);
        $r = [];
        for ($i = 0; $i < $count; $i++) {
            if ($i == 0):
                $r[':eq(' . $i . ')'] = 'First';
            elseif ($i == 1):
                $r[':eq(' . $i . ')'] = '2nd';
            elseif ($i == 2):
                $r[':eq(' . $i . ')'] = '3rd';
            else:
                $r[':eq(' . $i . ')'] = ($i + 1) . 'th';
            endif;
        }
        $r[':eq(100)'] = 'None';
        return $r;
    }

    public function register_controls() {
        $this->get_initial_opening_list();
        $this->start_section_header(
                'shortcode-addons-start-tabs', [
            'options' => [
                'general-settings' => esc_html__('General Settings', OXI_TABS_TEXTDOMAIN),
                'heading-settings' => esc_html__('Heading Settings', OXI_TABS_TEXTDOMAIN),
                'description-settings' => esc_html__('Description Settings', OXI_TABS_TEXTDOMAIN),
                'custom' => esc_html__('Custom CSS', OXI_TABS_TEXTDOMAIN),
            ]
                ]
        );
        // General Section
        $this->register_general_parent();

        // Heading Section
        $this->register_heading_parent();

        //Description Section
        $this->register_description_parent();

        //Custom CSS
        $this->register_custom_parent();
    }

    public function register_general_parent() {
        //General Section
        $this->start_section_tabs(
                'oxi-tabs-start-tabs', [
            'condition' => [
                'oxi-tabs-start-tabs' => 'general-settings'
            ]
                ]
        );
        //Start Divider
        $this->start_section_devider();
        $this->register_gen_general();
        $this->end_section_devider();


        //Start Divider
        $this->start_section_devider();
        $this->register_gen_heading();
        $this->end_section_devider();
        $this->end_section_tabs();
        //General Section End
        //
    }

    public function register_gen_general() {
        $this->start_controls_section(
                'oxi-tabs-gen', [
            'label' => esc_html__('General Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-trigger', $this->style, [
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
            'description' => 'Do You want to Close Tabs while Double click into Same Tabs.',
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-event', $this->style, [
            'label' => __('Activator Event', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => '',
            'options' => [
                'oxi-tabs-click-event' => [
                    'title' => __('Click', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-hover-event' => [
                    'title' => __('Hover', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'description' => 'Select an activator event for tabs.',
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-opening', $this->style, [
            'label' => __('Initial Opening', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'default' => ':eq(0)',
            'options' => $this->get_initial_opening_list(),
            'description' => 'Initial Opening, Which tab will Open at Page Load.',
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-animation', $this->style, [
            'label' => __('Animation', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => __('No Animation', OXI_TABS_TEXTDOMAIN),
                'fade' => __('fade', OXI_TABS_TEXTDOMAIN),
                'slide' => __('Slide', OXI_TABS_TEXTDOMAIN),
            ],
            'description' => 'Tabs Animation, Select Tabs Animation While clicking into Tabs.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_gen_heading() {
        $this->start_controls_section(
                'oxi-tabs-heading', [
            'label' => esc_html__('Header Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-alignment', $this->style, [
            'label' => __('Tabs Alignment', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                'oxi-tab-header-horizontal' => [
                    'title' => __('Horizontal', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tab-header-vertical' => [
                    'title' => __('Vertical', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Your Tabs Alignment as Horizontal or Vertical.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-horizontal-position', $this->style, [
            'label' => __('Horizontal Position', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-horizontal'
            ],
            'options' => [
                'oxi-tab-header-top-left-position' => __('Top Left', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-top-right-position' => __('Top Right', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-top-center-position' => __('Top Center', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-top-compact-position' => __('Top Compact', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-bottom-left-position' => __('Bottom Left', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-bottom-right-position' => __('Bottom Right', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-bottom-center-position' => __('Bottom Center', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-bottom-compact-position' => __('Bottom Compact', OXI_TABS_TEXTDOMAIN),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Your Tabs Header Horizontal Position.',
                ]
        );

        $this->add_control(
                'oxi-tabs-heading-vertical-position', $this->style, [
            'label' => __('Vertical Position', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-vertical'
            ],
            'options' => [
                'oxi-tab-header-left-top-position' => __('Left Top', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-left-center-position' => __('Left Center', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-left-bottom-position' => __('Left Bottom', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-right-right-position' => __('Right Top', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-right-center-position' => __('Right Center', OXI_TABS_TEXTDOMAIN),
                'oxi-tab-header-right-bottom-position' => __('Right Bottom', OXI_TABS_TEXTDOMAIN),
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Your Tabs Header Vertical Position.',
                ]
        );

        $this->add_responsive_control(
                'oxi-tabs-gen-vertical-width', $this->style, [
            'label' => __('Header Width', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-vertical'
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
                '{{WRAPPER}} .oxi-tab-header-vertical .oxi-tabs-ultimate-header-wrap' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Customize Header Width with several options as Pixel, Percent or EM.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-responsive-mode', $this->style, [
            'label' => __('Responsive Behavior', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                'oxi-tabs-heading-responsive-dynamic' => [
                    'title' => __('Dynamic', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-responsive-static' => [
                    'title' => __('Static', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => 'oxi-tabs-heading-responsive-dynamic',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Your Tabs Header Responsive Behavior while Static will give you to set as like as you want.',
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-heading-renponsive-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Tabs Settings ', OXI_TABS_TEXTDOMAIN),
                        'hover' => esc_html__('Mobile Settings', OXI_TABS_TEXTDOMAIN),
                    ],
                    'condition' => [
                        'oxi-tabs-heading-responsive-mode' => 'oxi-tabs-heading-responsive-static'
                    ],
                ]
        );

        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-heading-tabs-show-title', $this->style, [
            'label' => __('Show Title', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-tabs-show-title-false' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Title Showing Options for Tabs Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-tabs-show-sub-title', $this->style, [
            'label' => __('Show Title', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-tabs-show-subtitle-false' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Sub Title Showing Options for Tabs Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-tabs-show-icon', $this->style, [
            'label' => __('Show Icon', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-tabs-show-icon-false' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Header Icon Showing Options for Tabs Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-tabs-show-icon', $this->style, [
            'label' => __('Show Number', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-tabs-show-number-false' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Header Number Showing Options for Tabs Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-tabs-show-image', $this->style, [
            'label' => __('Show Image', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-tabs-show-image-false' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Header Image Showing Options for Tabs Mode.',
                ]
        );


        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-heading-mobile-show-title', $this->style, [
            'label' => __('Show Title', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-mobile-show-title-false' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Title Showing Options for Mobile Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-mobile-show-sub-title', $this->style, [
            'label' => __('Show Title', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-mobile-show-subtitle-false' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Sub Title Showing Options for Tabs Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-mobile-show-icon', $this->style, [
            'label' => __('Show Icon', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-mobile-show-icon-false' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Header Icon Showing Options for Mobile Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-mobile-show-icon', $this->style, [
            'label' => __('Show Number', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-mobile-show-number-false' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Header Number Showing Options for Mobile Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-mobile-show-image', $this->style, [
            'label' => __('Show Image', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                'oxi-tabs-heading-mobile-show-image-false' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Header Image Showing Options for Mobile Mode.',
                ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    public function register_heading_parent() {
        //Heading Section
        $this->start_section_tabs(
                'oxi-tabs-start-tabs', [
            'condition' => [
                'oxi-tabs-start-tabs' => 'heading-settings'
            ]
                ]
        );
        //Start Divider
        $this->start_section_devider();
        $this->register_header_general();
        $this->end_section_devider();

        //Start Divider
        $this->start_section_devider();
        $this->register_header_title();
        $this->register_header_sub_title();
        $this->register_header_icon();
        $this->register_header_number();
        $this->register_header_image();
        $this->end_section_devider();
        $this->end_section_tabs();
    }

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
            'description' => 'Set Your Tabs Header Title Additional Location like Icon or Image or Number.',
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-head-start-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', OXI_TABS_TEXTDOMAIN),
                        'hover' => esc_html__('Active or Hover', OXI_TABS_TEXTDOMAIN),
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
            'description' => 'Background property is used to set the Background of the Header.',
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header .oxi-tabs-header-li:hover' => 'background: {{VALUE}};',
            ],
            'description' => 'Background property is used to set the active or hover background of the Header.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
                'oxi-tabs-head-inner-border',
                $this->style,
                [
                    'label' => __('Inner Right Border', OXI_TABS_TEXTDOMAIN),
                    'type' => Controls::SINGLEBORDER,
                    'separator' => true,
                    'condition' => [
                        'oxi-tabs-heading-alignment' => 'oxi-tab-header-horizontal',
                    ],
                    'selector' => [
                        '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-header-li' => 'border-right: {{SIZE}}px {{TYPE}} {{COLOR}};'
                    ],
                    'description' => 'Inner Border property is used to set Border Right with Color of the Header.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header' => '',
            ],
            'description' => 'Allows you to attaches one or more shadows into Header Section.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header' => ''
                    ],
                    'description' => 'Border property is used to set the Border of the Header Section.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-radius', $this->style, [
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
                '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-ultimate-header' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Header Section with options.',
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
            'description' => 'Padding used to generate space around Header Content include background color.',
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
            'description' => 'Margin properties are used to create space outside Header Section.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_header_title() {
        $this->start_controls_section(
                'oxi-tabs-head-title', [
            'label' => esc_html__('Title Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-title-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-main-title' => '',
            ]
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-head-title-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', OXI_TABS_TEXTDOMAIN),
                        'hover' => esc_html__('Active or Hover', OXI_TABS_TEXTDOMAIN),
                    ]
                ]
        );
        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-head-title-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-main-title' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Title.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-title-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-main-title' => '',
            ],
            'description' => 'Text Shadow property adds shadow to Title.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-head-title-ac-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-tabs-main-title' => 'color: {{VALUE}};',
                '{{WRAPPER}}  .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-tabs-main-title' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the active or hover color of the Title.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-title-ac-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-tabs-main-title' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-tabs-main-title' => '',
            ],
            'description' => 'Text Shadow property add shadow to active or hover Title.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
                'oxi-tabs-head-title-margin', $this->style, [
            'label' => __('Margin', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'separator' => true,
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-main-title' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space outside Title.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_header_sub_title() {
        $this->start_controls_section(
                'oxi-tabs-head-sub-title', [
            'label' => esc_html__('Sub Title Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => false,
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-sub-title-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-sub-title' => '',
            ]
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-head-sub-title-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', OXI_TABS_TEXTDOMAIN),
                        'hover' => esc_html__('Active or Hover', OXI_TABS_TEXTDOMAIN),
                    ]
                ]
        );
        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-head-sub-title-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-sub-title' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of Sub Title.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-sub-title-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-sub-title' => '',
            ],
            'description' => 'Text Shadow property adds shadow to Sub Title.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-head-sub-title-ac-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-tabs-sub-title' => 'color: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-tabs-sub-title' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the active or hover color of Sub Title.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-sub-title-ac-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-tabs-sub-title' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-tabs-sub-title' => '',
            ],
            'description' => 'Text Shadow property add shadow to active or hover at Sub Title.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
                'oxi-tabs-head-sub-title-margin', $this->style, [
            'label' => __('Margin', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'separator' => true,
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-sub-title' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space outside Sub Title.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_header_icon() {
        $this->start_controls_section(
                'oxi-tabs-head-icon', [
            'label' => esc_html__('Icon Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => false,
                ]
        );
        $this->add_control(
                'oxi-tabs-head-icon-position',
                $this->style,
                [
                    'label' => __('Customization Interface', OXI_TABS_TEXTDOMAIN),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_TEXT,
                    'toggle' => true,
                    'default' => 'simple',
                    'options' => [
                        'simple' => [
                            'title' => __('Simple', OXI_TABS_TEXTDOMAIN),
                        ],
                        'customizable' => [
                            'title' => __('Customizable', OXI_TABS_TEXTDOMAIN),
                        ],
                    ],
                    'description' => 'Confirm Icon Interface As Simple or fully Customizable.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-icon-width', $this->style, [
            'label' => __('Width', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Icon Width.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-icon-height', $this->style, [
            'label' => __('Height', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => 'height:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Icon Height.',
                ]
        );

        $this->add_responsive_control(
                'oxi-tabs-head-icon-size', $this->style, [
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
                'oxi-tabs-head-icon-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', OXI_TABS_TEXTDOMAIN),
                        'hover' => esc_html__('Active or Hover', OXI_TABS_TEXTDOMAIN),
                    ]
                ]
        );
        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-head-icon-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Icon.',
                ]
        );
        $this->add_control(
                'oxi-tabs-head-icon-background', $this->style, [
            'type' => Controls::GRADIENT,
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => 'background: {{VALUE}};',
            ],
            'description' => 'Customize Icon Background with Color or Gradient or Image properties.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-icon-border', $this->style, [
            'type' => Controls::BORDER,
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-icons' => '',
            ],
            'description' => 'Border property is used to set the Border of the Icon.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-head-icon-ac-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-icons' => 'color: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-icons' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the active or hover color of the Icon.',
                ]
        );
        $this->add_control(
                'oxi-tabs-head-icon-ac-background', $this->style, [
            'type' => Controls::GRADIENT,
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-icons' => 'background: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-icons' => 'background: {{VALUE}};',
            ],
            'description' => 'Customize Icon Background with Color or Gradient or Image properties.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-icon-ac-border', $this->style, [
            'type' => Controls::BORDER,
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-icons' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-icons' => '',
            ],
            'description' => 'Border property is used to set the Border of the Icon.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
                'oxi-tabs-head-icon-border-radius', $this->style, [
            'label' => __('Border Radius', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
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
                'oxi-tabs-head-icon-margin', $this->style, [
            'label' => __('Margin', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'separator' => true,
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
            'description' => 'Margin properties are used to create space outside Icon.',
                ]
        );

        $this->end_controls_section();
    }

    public function register_header_number() {
        $this->start_controls_section(
                'oxi-tabs-head-number', [
            'label' => esc_html__('Number Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => false,
                ]
        );
        $this->add_control(
                'oxi-tabs-head-number-interface',
                $this->style,
                [
                    'label' => __('Customization Interface', OXI_TABS_TEXTDOMAIN),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_TEXT,
                    'toggle' => true,
                    'default' => 'simple',
                    'options' => [
                        'simple' => [
                            'title' => __('Simple', OXI_TABS_TEXTDOMAIN),
                        ],
                        'customizable' => [
                            'title' => __('Customizable', OXI_TABS_TEXTDOMAIN),
                        ],
                    ],
                    'description' => 'Allows you to set Number Customization Mode as Simple or Fully Customizable.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-number-width', $this->style, [
            'label' => __('Width', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li-number' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Number Body Width.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-number-height', $this->style, [
            'label' => __('Height', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li-number' => 'height:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Number Body Height.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-number-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li-number' => '',
            ]
                ]
        );

        $this->start_controls_tabs(
                'oxi-tabs-head-number-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', OXI_TABS_TEXTDOMAIN),
                        'hover' => esc_html__('Active or Hover', OXI_TABS_TEXTDOMAIN),
                    ]
                ]
        );
        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-head-number-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li-number' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Number.',
                ]
        );
        $this->add_control(
                'oxi-tabs-head-number-background', $this->style, [
            'type' => Controls::GRADIENT,
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li-number' => 'background:{{VALUE}};',
            ],
            'description' => 'Customize Number Background with Color or Gradient properties.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-number-border', $this->style, [
            'type' => Controls::BORDER,
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li-number' => '',
            ],
            'description' => 'Border property is used to set the Border of the Number Body.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-head-number-ac-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-tabs-header-li-number' => 'color: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-tabs-header-li-number' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the active or hover color of the Number.',
                ]
        );
        $this->add_control(
                'oxi-tabs-head-number-ac-background', $this->style, [
            'type' => Controls::GRADIENT,
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-tabs-header-li-number' => 'background:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-tabs-header-li-number' => 'background:{{VALUE}};',
            ],
            'description' => 'Customize Number Background with Color or Gradient properties.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-number-ac-border', $this->style, [
            'type' => Controls::BORDER,
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-tabs-header-li-number' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-tabs-header-li-number' => '',
            ],
            'description' => 'Border property is used to set the Border of the Number.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
                'oxi-tabs-head-number-border-radius', $this->style, [
            'label' => __('Border Radius', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li-number' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Number Body with 4 values.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-number-margin', $this->style, [
            'label' => __('Margin', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'separator' => true,
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li-number' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space outside Number.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_header_image() {
        $this->start_controls_section(
                'oxi-tabs-head-image', [
            'label' => esc_html__('Image Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => false,
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-image-width', $this->style, [
            'label' => __('Width', OXI_TABS_TEXTDOMAIN),
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-tabs-header-li-image' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Allows you to Set Image Width.',
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-head-number-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', OXI_TABS_TEXTDOMAIN),
                        'hover' => esc_html__('Active or Hover', OXI_TABS_TEXTDOMAIN),
                    ]
                ]
        );
        $this->start_controls_tab();
        $this->add_group_control(
                'oxi-tabs-head-image-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li .oxi-tabs-header-li-image' => '',
            ],
            'description' => 'Border property is used to set the Border of the Image.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_group_control(
                'oxi-tabs-head-image-ac-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li:hover .oxi-tabs-header-li-image' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li.active .oxi-tabs-header-li-image' => '',
            ],
            'description' => 'Border property is used to set the Border of the Image.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
                'oxi-tabs-head-image-border-radius', $this->style, [
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li-image' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Image with 4 values.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-image-margin', $this->style, [
            'label' => __('Margin', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::DIMENSIONS,
            'separator' => true,
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-header-li-image' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space outside Image.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_description_parent() {
        //Description Section
        $this->start_section_tabs(
                'oxi-tabs-start-tabs', [
            'condition' => [
                'oxi-tabs-start-tabs' => 'description-settings'
            ]
                ]
        );
        //Start Divider
        $this->start_section_devider();
        $this->register_desc_general();
        $this->end_section_devider();


        //Start Divider
        $this->start_section_devider();
        $this->register_desc_content();
        $this->end_section_devider();
        $this->end_section_tabs();
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-content' => 'background: {{VALUE}};',
            ],
            'description' => 'Background property is used to set background of Content.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-desc-general-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-content' => '',
            ],
            'description' => 'Allows you to attaches one or more shadows into Content Body.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-general-border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-content' => ''
                    ],
                    'description' => 'Border property is used to set the Border of Content Body.',
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-content' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Content Body with options.',
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
            'description' => 'Padding used to generate space around Content Body include background color.',
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-ultimate-content-wrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space outside Content Body.',
                ]
        );

        $this->end_controls_section();
    }

    public function register_desc_content() {
        $this->start_controls_section(
                'oxi-tabs-desc-content', [
            'label' => esc_html__('Content Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );

        $this->add_group_control(
                'oxi-tabs-desc-content-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs p' => '',
            ]
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-content-color', $this->style, [
            'label' => __('Color', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs' => 'color: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs p' => 'color: {{VALUE}};',
            ],
            'description' => 'Color property is used to set the color of the Heading.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-content-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs p' => '',
            ],
            'description' => 'Text Shadow property add shadow to active or hover heading.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-content-padding', $this->style, [
            'label' => __('Content Padding', OXI_TABS_TEXTDOMAIN),
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs p' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Adjust Your Content Padding with Peragraph Tag.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_custom_parent() {
        ///Custom CSS
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
        $this->add_control(
                'oxilab-preview-color', $this->style, [
            'type' => Controls::HIDDEN,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-sdgf, body.shortcode-addons-template-body' => 'background:{{VALUE}}',
            ],
                ]
        );
        $this->end_controls_section();
        $this->end_section_tabs();
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
            'description' => 'Add Title of your Tabs else Make it Blank.',
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-sub-title', $this->style, [
            'label' => esc_html__('Sub Title', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::TEXT,
            'description' => 'Add Sub Title of your Tabs else Make it Blank.',
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-title-additional', $this->style, [
            'label' => __('Title Additional', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => __('None', OXI_TABS_TEXTDOMAIN),
                'icon' => __('Icon', OXI_TABS_TEXTDOMAIN),
                'number' => __('Number', OXI_TABS_TEXTDOMAIN),
                'image' => __('Image', OXI_TABS_TEXTDOMAIN),
            ],
            'description' => 'Add Icon or Image or Number Beside Title.',
                ]
        );


        $this->add_control(
                'oxi-tabs-modal-icon', $this->style, [
            'label' => esc_html__('Icon', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::ICON,
            'default' => 'fab fa-facebook-f',
            'condition' => [
                'oxi-tabs-modal-title-additional' => 'icon',
            ],
            'description' => 'Select Icon from Font Awesome Icon list Panel.',
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-number', $this->style, [
            'label' => esc_html__('Number', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::NUMBER,
            'default' => 1,
            'condition' => [
                'oxi-tabs-modal-title-additional' => 'number',
            ],
            'description' => 'Write Your Number Beside Title.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-modal-image', $this->style,
                [
                    'label' => __('Image', OXI_TABS_TEXTDOMAIN),
                    'type' => Controls::MEDIA,
                    'condition' => [
                        'oxi-tabs-modal-title-additional' => 'image',
                    ],
                    'description' => 'Add or Modify Your Header Image.'
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-components-type', $this->style, [
            'label' => __('Choose Components', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'default' => 'wysiwyg',
            'options' => [
                'wysiwyg' => __('WYSIWYG Editor', OXI_TABS_TEXTDOMAIN),
                'link' => __('Custom Link', OXI_TABS_TEXTDOMAIN),
            ],
            'description' => 'Confirm Your Tabs Content Type as Content or Custom Link.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-modal-link', $this->style, [
            'label' => esc_html__('Link', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::URL,
            'condition' => [
                'oxi-tabs-modal-components-type' => 'link',
            ],
            'description' => 'Add Custom link with opening type.',
                ]
        );


        $this->add_control(
                'oxi-tabs-modal-desc', $this->style, [
            'label' => __('Description', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::WYSIWYG,
            'condition' => [
                'oxi-tabs-modal-components-type' => 'wysiwyg',
            ],
            'default' => '<p>Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged</p>',
                ]
        );
        echo '</div>';
    }

}
