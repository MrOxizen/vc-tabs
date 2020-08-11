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

    public function register_controls() {
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
                'oxi-tabs-wrapper', [
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
            'description' => 'Initial Opening, Which tabs will view at page load.',
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-opening', $this->style, [
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
                'oxi-tabs-gen-animation', $this->style, [
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

    public function register_gen_heading() {
        $this->start_controls_section(
                'oxi-tabs-wrapper', [
            'label' => esc_html__('Header Settings', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-alignment', $this->style, [
            'label' => __('Tabs Alignment', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => 'horizontal',
            'options' => [
                'horizontal' => [
                    'title' => __('Horizontal', OXI_TABS_TEXTDOMAIN),
                ],
                'vertical' => [
                    'title' => __('Vertical', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'description' => 'Set Your Tabs Alignment as Horizontal or Vertical.',
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-horizontal-position', $this->style, [
            'label' => __('Horizontal Position', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'condition' => [
                'oxi-tabs-gen-alignment' => 'horizontal'
            ],
            'default' => 'top',
            'options' => [
                'top' => [
                    'title' => __('Top', OXI_TABS_TEXTDOMAIN),
                ],
                'bottom' => [
                    'title' => __('Bottom', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'description' => 'Set Your Tabs Header Horizontal Position.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-gen-horizontal-width', $this->style, [
            'label' => __('Tabs Width', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'condition' => [
                'oxi-tabs-gen-alignment' => 'horizontal'
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
            //   '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li' => 'max-width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Customize heading Width with several options as Pixel, Percent or EM.',
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-vertical-position', $this->style, [
            'label' => __('Vertical Position', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'condition' => [
                'oxi-tabs-gen-alignment' => 'vertical'
            ],
            'default' => 'left',
            'options' => [
                'left' => [
                    'title' => __('Left', OXI_TABS_TEXTDOMAIN),
                ],
                'right' => [
                    'title' => __('Right', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'description' => 'Set Your Tabs Header Horizontal Position.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-gen-vertical-width', $this->style, [
            'label' => __('Tabs Width', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SLIDER,
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'condition' => [
                'oxi-tabs-gen-alignment' => 'vertical'
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
            //   '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li' => 'max-width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Customize heading Width with several options as Pixel, Percent or EM.',
                ]
        );
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
        $this->register_header_icon();
        $this->register_header_number();
        $this->register_header_image();
        $this->end_section_devider();
        $this->end_section_tabs();
    }

    public function register_header_general() {
        $this->start_controls_section(
                'oxi-tabs-wrapper', [
            'label' => esc_html__('Header General', OXI_TABS_TEXTDOMAIN),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-head-title', $this->style, [
            'label' => __('Title', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => '1',
            'options' => [
                '1' => [
                    'title' => __('Show', OXI_TABS_TEXTDOMAIN),
                ],
                '' => [
                    'title' => __('Hide', OXI_TABS_TEXTDOMAIN),
                ],
            ],
            'description' => 'Do You want to Show Heading Title?',
                ]
        );

        $this->add_control(
                'oxi-tabs-head-additional', $this->style, [
            'label' => __('Additional', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => __('Only Title', OXI_TABS_TEXTDOMAIN),
                'icon' => __('Icon', OXI_TABS_TEXTDOMAIN),
                'number' => __('Number', OXI_TABS_TEXTDOMAIN),
                'image' => __('Image', OXI_TABS_TEXTDOMAIN),
            ],
            'description' => 'Add Icon or Image or Number Beside Text.',
                ]
        );

        $this->add_responsive_control(
                'oxi-tabs-head-additional-position',
                $this->style,
                [
                    'label' => __('Additional Position', OXI_TABS_TEXTDOMAIN),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_ICON,
                    'default' => 'row',
                    'condition' => [
                        'oxi-tabs-head-additional' => ['icon', 'number', 'image']
                    ],
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
                    'description' => 'Allows you to set Additional Position as Left or Top or Bottom or Right.',
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
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header' => 'background: {{VALUE}};',
            ],
            'description' => 'Background property is used to set the Background of the Heading.',
                ]
        );


        $this->end_controls_tab();
        $this->start_controls_tab();


        $this->add_control(
                'oxi-tabs-head-ac-bg', $this->style, [
            'label' => __('Background', OXI_TABS_TEXTDOMAIN),
            'type' => Controls::GRADIENT,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li.active' => 'background: {{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li:hover' => 'background: {{VALUE}};',
            ],
            'description' => 'Background property is used to set the active or hover background of the heading.',
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
                        'oxi-tabs-gen-alignment' => 'horizontal',
                    ],
                    'selector' => [
                        '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li' => 'border-right: {{SIZE}}px {{TYPE}} {{COLOR}};'
                    ],
                    'description' => 'Border property is used to set the Border of the Heading.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header' => '',
            ],
            'description' => 'Allows you to attaches one or more shadows into Button.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-border',
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
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Allows you to add rounded corners to Button with options.',
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
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-header-li-title' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Padding used to generate space around heading include background color.',
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
                '{{WRAPPER}} .oxi-tabs-ultimate-template-1 .oxi-tabs-ultimate-header' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Margin properties are used to create space outside heading.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_header_title() {
        
        
    }
    public function register_header_icon() {
        
    }
    public function register_header_number() {
        
    }
    public function register_header_image() {
        
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
        $this->register_general();
        $this->register_descriptions();
        $this->end_section_devider();


        //Start Divider
        $this->start_section_devider();
        $this->register_heading();
        $this->register_icon();
        $this->end_section_devider();
        $this->end_section_tabs();
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
        $this->end_controls_section();
        $this->end_section_tabs();
    }

}
