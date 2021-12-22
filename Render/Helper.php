<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OXI_TABS_PLUGINS\Render;

if (!defined('ABSPATH'))
    exit;

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
                'general-settings' => esc_html__('General Settings', 'vc-tabs'),
                'heading-settings' => esc_html__('Heading Settings', 'vc-tabs'),
                'description-settings' => esc_html__('Description Settings', 'vc-tabs'),
                'custom' => esc_html__('Custom CSS', 'vc-tabs'),
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
            'label' => esc_html__('General Settings', 'vc-tabs'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-trigger', $this->style, [
            'label' => esc_html__('Trigger', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'loader' => TRUE,
            'default' => '0',
            'options' => [
                '1' => [
                    'title' => esc_html__('True', 'vc-tabs'),
                ],
                '0' => [
                    'title' => esc_html__('False', 'vc-tabs'),
                ],
            ],
            'description' => 'Enable Trigger to close the tab’s content with a Second click into the Same Tabs.',
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-event', $this->style, [
            'label' => esc_html__('Activator Event', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => 'oxi-tabs-click-event',
            'loader' => TRUE,
            'options' => [
                'oxi-tabs-click-event' => [
                    'title' => esc_html__('Click', 'vc-tabs'),
                ],
                'oxi-tabs-hover-event' => [
                    'title' => esc_html__('Hover', 'vc-tabs'),
                ],
            ],
            'description' => 'Select either your Tabs will open on Click or Hover.',
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-opening', $this->style, [
            'label' => esc_html__('Initial Opening', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => ':eq(0)',
            'loader' => TRUE,
            'options' => $this->get_initial_opening_list(),
            'description' => 'Select which Tab will Open at Page Load.',
                ]
        );
        $this->add_control(
                'oxi-tabs-gen-animation', $this->style, [
            'label' => esc_html__('Animation', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'loader' => TRUE,
            'options' => [
                'optgroup0' => [true, 'Attention Seekers'],
                '' => esc_html__('No Animation', 'vc-tabs'),
                'animate__bounce' => esc_html__('Bounce', 'vc-tabs'),
                'animate__flash' => esc_html__('Flash', 'vc-tabs'),
                'animate__pulse' => esc_html__('Pulse', 'vc-tabs'),
                'animate__rubberBand' => esc_html__('Rubber Band', 'vc-tabs'),
                'animate__shakeX' => esc_html__('ShakeX', 'vc-tabs'),
                'animate__headShake' => esc_html__('Head Shake', 'vc-tabs'),
                'animate__swing' => esc_html__('Swing', 'vc-tabs'),
                'animate__tada' => esc_html__('Tada', 'vc-tabs'),
                'animate__wobble' => esc_html__('Wobble', 'vc-tabs'),
                'animate__jello' => esc_html__('Jello', 'vc-tabs'),
                'animate__heartBeat' => esc_html__('Heart Beat', 'vc-tabs'),
                'optgroup1' => [false],
                'optgroup2' => [true, 'Back Entrances'],
                'animate__backInDown' => esc_html__('Back In Down', 'vc-tabs'),
                'animate__backInLeft' => esc_html__('Back In Left', 'vc-tabs'),
                'animate__backInRight' => esc_html__('Back In Right', 'vc-tabs'),
                'animate__backInUp' => esc_html__('Back In Up', 'vc-tabs'),
                'optgroup3' => [false],
                'optgroup4' => [true, 'Bouncing Entrances'],
                'animate__bounceIn' => esc_html__('Bounce In', 'vc-tabs'),
                'animate__bounceInDown' => esc_html__('Bounce In Down', 'vc-tabs'),
                'animate__bounceInLeft' => esc_html__('Bounce In Left', 'vc-tabs'),
                'animate__bounceInRight' => esc_html__('Bounce In Right', 'vc-tabs'),
                'animate__bounceInUp' => esc_html__('Bounce In Up', 'vc-tabs'),
                'optgroup5' => [false],
                'optgroup6' => [true, 'Fading Entrances'],
                'animate__fadeIn' => esc_html__('Fade In', 'vc-tabs'),
                'animate__fadeInDown' => esc_html__('Fade In Down', 'vc-tabs'),
                'animate__fadeInDownBig' => esc_html__('Fade In Down Big', 'vc-tabs'),
                'animate__fadeInLeft' => esc_html__('Fade In Left', 'vc-tabs'),
                'animate__fadeInLeftBig' => esc_html__('Fade In Left Big', 'vc-tabs'),
                'animate__fadeInRight' => esc_html__('Fade In Right', 'vc-tabs'),
                'animate__fadeInRightBig' => esc_html__('Fade In Right Big', 'vc-tabs'),
                'animate__fadeInUp' => esc_html__('Fade In Up', 'vc-tabs'),
                'animate__fadeInUpBig' => esc_html__('Fade In Up Big', 'vc-tabs'),
                'animate__fadeInTopLeft' => esc_html__('Fade In Top Left', 'vc-tabs'),
                'animate__fadeInTopRight' => esc_html__('Fade In Top Right', 'vc-tabs'),
                'animate__fadeInBottomLeft' => esc_html__('Fade In Bottom Left', 'vc-tabs'),
                'animate__fadeInBottomRight' => esc_html__('Fade In Bottom Right', 'vc-tabs'),
                'optgroup7' => [false],
                'optgroup8' => [true, 'Flippers'],
                'animate__flip' => esc_html__('Flip', 'vc-tabs'),
                'animate__flipInX' => esc_html__('Flip In X', 'vc-tabs'),
                'animate__flipInY' => esc_html__('Flip In Y', 'vc-tabs'),
                'optgroup9' => [false],
                'optgroup10' => [true, 'Lightspeed'],
                'animate__lightSpeedInRight' => esc_html__('Light Speed In Right', 'vc-tabs'),
                'animate__lightSpeedInLeft' => esc_html__('Light Speed In Left', 'vc-tabs'),
                'optgroup11' => [false],
                'optgroup12' => [true, 'Rotating Entrances'],
                'animate__rotateIn' => esc_html__('Rotate In', 'vc-tabs'),
                'animate__rotateInDownLeft' => esc_html__('Rotate In Down Left', 'vc-tabs'),
                'animate__rotateInDownRight' => esc_html__('Rotate In Down Right', 'vc-tabs'),
                'animate__rotateInUpLeft' => esc_html__('Rotate In Up Left', 'vc-tabs'),
                'animate__rotateInUpRight' => esc_html__('Rotate In Up Right', 'vc-tabs'),
                'optgroup13' => [false],
                'optgroup14' => [true, 'Specials'],
                'animate__hinge' => esc_html__('Hinge', 'vc-tabs'),
                'animate__jackInTheBox' => esc_html__('Jack In The Box', 'vc-tabs'),
                'animate__rollIn' => esc_html__('Roll In', 'vc-tabs'),
                'optgroup15' => [false],
                'optgroup16' => [true, 'Zooming Entrances'],
                'animate__zoomIn' => esc_html__('Zoom In', 'vc-tabs'),
                'animate__zoomInDown' => esc_html__('Zoom In Down', 'vc-tabs'),
                'animate__zoomInLeft' => esc_html__('Zoom In Left', 'vc-tabs'),
                'animate__zoomInRight' => esc_html__('Zoom In Right', 'vc-tabs'),
                'animate__zoomInUp' => esc_html__('Zoom In Up', 'vc-tabs'),
                'optgroup17' => [false],
                'optgroup18' => [true, 'Sliding Entrances'],
                'animate__slideInDown' => esc_html__('Slide In Down', 'vc-tabs'),
                'animate__slideInLeft' => esc_html__('Slide In Left', 'vc-tabs'),
                'animate__slideInUp' => esc_html__('Slide In Up', 'vc-tabs'),
                'optgroup19' => [false],
            ],
            'description' => 'Add Animation Effect on Tabs opening.',
                ]
        );

        $this->add_responsive_control(
                'oxi-tabs-general-margin', $this->style, [
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Tabs Body.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_gen_heading() {
        $this->start_controls_section(
                'oxi-tabs-heading', [
            'label' => esc_html__('Header Settings', 'vc-tabs'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-alignment', $this->style, [
            'label' => esc_html__('Tabs Alignment', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                'oxi-tab-header-horizontal' => [
                    'title' => esc_html__('Horizontal', 'vc-tabs'),
                ],
                'oxi-tab-header-vertical' => [
                    'title' => esc_html__('Vertical', 'vc-tabs'),
                ],
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set the Tabs Alignment type.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-horizontal-position', $this->style, [
            'label' => esc_html__('Horizontal Position', 'vc-tabs'),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-horizontal'
            ],
            'options' => [
                'oxi-tab-header-top-left-position' => esc_html__('Top Left', 'vc-tabs'),
                'oxi-tab-header-top-right-position' => esc_html__('Top Right', 'vc-tabs'),
                'oxi-tab-header-top-center-position' => esc_html__('Top Center', 'vc-tabs'),
                'oxi-tab-header-top-compact-position' => esc_html__('Top Compact', 'vc-tabs'),
                'oxi-tab-header-bottom-left-position' => esc_html__('Bottom Left', 'vc-tabs'),
                'oxi-tab-header-bottom-right-position' => esc_html__('Bottom Right', 'vc-tabs'),
                'oxi-tab-header-bottom-center-position' => esc_html__('Bottom Center', 'vc-tabs'),
                'oxi-tab-header-bottom-compact-position' => esc_html__('Bottom Compact', 'vc-tabs'),
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set the Horizontal Position of Tab’s header.',
                ]
        );

        $this->add_control(
                'oxi-tabs-heading-vertical-position', $this->style, [
            'label' => esc_html__('Vertical Position', 'vc-tabs'),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-vertical'
            ],
            'options' => [
                'oxi-tab-header-left-top-position' => esc_html__('Left Top', 'vc-tabs'),
                'oxi-tab-header-left-center-position' => esc_html__('Left Center', 'vc-tabs'),
                'oxi-tab-header-left-bottom-position' => esc_html__('Left Bottom', 'vc-tabs'),
                'oxi-tab-header-right-top-position' => esc_html__('Right Top', 'vc-tabs'),
                'oxi-tab-header-right-center-position' => esc_html__('Right Center', 'vc-tabs'),
                'oxi-tab-header-right-bottom-position' => esc_html__('Right Bottom', 'vc-tabs'),
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set the Vertical Position of Tab’s header.',
                ]
        );

        $this->add_control(
                'oxi-tabs-gen-vertical-width', $this->style, [
            'label' => esc_html__('Header Width', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tab-header-vertical > .oxi-tabs-ultimate-header-wrap' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Customize the Header Width (Pixel, Percent or EM).',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-responsive-mode', $this->style, [
            'label' => esc_html__('Responsive Behavior', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                'oxi-tabs-heading-responsive-dynamic' => [
                    'title' => esc_html__('Dynamic', 'vc-tabs'),
                ],
                'oxi-tabs-heading-responsive-static' => [
                    'title' => esc_html__('Static', 'vc-tabs'),
                ],
            ],
            'default' => 'oxi-tabs-heading-responsive-dynamic',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set the Responsive Behavior of the Tab’s Header while Static will give you to set your custom settings.',
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-heading-renponsive-tabs',
                [
                    'options' => [
                        'tabs-settings' => esc_html__('Tabs Settings ', 'vc-tabs'),
                        'mobile-settings' => esc_html__('Mobile Settings', 'vc-tabs'),
                    ],
                    'condition' => [
                        'oxi-tabs-heading-responsive-mode' => 'oxi-tabs-heading-responsive-static'
                    ],
                ]
        );

        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-header-horizontal-tabs-alignment-horizontal', $this->style, [
            'label' => esc_html__('Horizontal Position', 'vc-tabs'),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-horizontal',
            ],
            'options' => [
                'oxi-tabs-header-horizontal-tabs-alignment-horizontal-horizontal' => esc_html__('Column', 'vc-tabs'),
                'oxi-tabs-header-horizontal-tabs-alignment-horizontal-vertical' => esc_html__('Row', 'vc-tabs'),
                'oxi-tabs-header-horizontal-tabs-alignment-horizontal-compact' => esc_html__('Compact', 'vc-tabs'),
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Horizontal Position of the Header either Column, Row, or Compact.',
                ]
        );

        $this->add_control(
                'oxi-tabs-header-vertical-tabs-alignment', $this->style, [
            'label' => esc_html__('Header Alignment', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-vertical'
            ],
            'options' => [
                'oxi-tabs-header-vertical-tabs-alignment-horizontal' => [
                    'title' => esc_html__('Horizontal', 'vc-tabs'),
                ],
                'oxi-tabs-header-vertical-tabs-alignment-vertical' => [
                    'title' => esc_html__('Vertical', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set the Tabs Alignment type for Medium Device.',
                ]
        );
        $this->add_control(
                'oxi-tabs-header-vertical-tabs-alignment-horizontal', $this->style, [
            'label' => esc_html__('Horizontal Position', 'vc-tabs'),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-vertical',
                'oxi-tabs-header-vertical-tabs-alignment' => 'oxi-tabs-header-vertical-tabs-alignment-horizontal'
            ],
            'options' => [
                'oxi-tabs-header-vertical-tabs-alignment-horizontal-horizontal' => esc_html__('Column', 'vc-tabs'),
                'oxi-tabs-header-vertical-tabs-alignment-horizontal-vertical' => esc_html__('Row', 'vc-tabs'),
                'oxi-tabs-header-vertical-tabs-alignment-horizontal-compact' => esc_html__('Compact', 'vc-tabs'),
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Header Alignment Horizontal Position as Colum row or Compact.',
                ]
        );

        $this->add_control(
                'oxi-tabs-header-tab-vertical-width', $this->style, [
            'label' => esc_html__('Header Width', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'customresponsive' => 'tab',
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-vertical',
                'oxi-tabs-header-vertical-tabs-alignment' => 'oxi-tabs-header-vertical-tabs-alignment-vertical'
            ],
            'default' => [
                'unit' => '%',
                'size' => 25,
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
                '{{WRAPPER}} > .oxi-tab-header-vertical.oxi-tabs-heading-responsive-static.oxi-tabs-header-vertical-tabs-alignment-vertical > .oxi-tabs-ultimate-header-wrap' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Customize the Header Width (Pixel, Percent or EM).',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-tabs-show-title', $this->style, [
            'label' => esc_html__('Title', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => esc_html__('Show', 'vc-tabs'),
                ],
                'oxi-tabs-heading-tabs-show-title-false' => [
                    'title' => esc_html__('Hide', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => '',
            ],
            'description' => 'Show/Hide the Title on Tabs Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-tabs-show-subtitle', $this->style, [
            'label' => esc_html__('Sub Title', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => esc_html__('Show', 'vc-tabs'),
                ],
                'oxi-tabs-heading-tabs-show-subtitle-false' => [
                    'title' => esc_html__('Hide', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => '',
            ],
            'description' => 'Show/Hide the Sub Title on Tabs Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-tabs-show-icon', $this->style, [
            'label' => esc_html__('Icon', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => esc_html__('Show', 'vc-tabs'),
                ],
                'oxi-tabs-heading-tabs-show-icon-false' => [
                    'title' => esc_html__('Hide', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => '',
            ],
            'description' => 'Show/Hide the header Icon on Tabs Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-tabs-show-number', $this->style, [
            'label' => esc_html__('Number', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => esc_html__('Show', 'vc-tabs'),
                ],
                'oxi-tabs-heading-tabs-show-number-false' => [
                    'title' => esc_html__('Hide', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => '',
            ],
            'description' => 'Show/Hide the header Number on Tabs Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-tabs-show-image', $this->style, [
            'label' => esc_html__('Image', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => esc_html__('Show', 'vc-tabs'),
                ],
                'oxi-tabs-heading-tabs-show-image-false' => [
                    'title' => esc_html__('Hide', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => '',
            ],
            'description' => 'Show/Hide the header Image on Tabs Mode.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-header-horizontal-mobile-alignment-horizontal', $this->style, [
            'label' => esc_html__('Horizontal Position', 'vc-tabs'),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-horizontal',
            ],
            'options' => [
                'oxi-tabs-header-horizontal-mobile-alignment-horizontal-horizontal' => esc_html__('Column', 'vc-tabs'),
                'oxi-tabs-header-horizontal-mobile-alignment-horizontal-vertical' => esc_html__('Row', 'vc-tabs'),
                'oxi-tabs-header-horizontal-mobile-alignment-horizontal-compact' => esc_html__('Compact', 'vc-tabs'),
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Horizontal Position of the Header either Column, Row, or Compact..',
                ]
        );
        $this->add_control(
                'oxi-tabs-header-vertical-mobile-alignment', $this->style, [
            'label' => esc_html__('Header Alignment', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-vertical'
            ],
            'options' => [
                'oxi-tabs-header-vertical-mobile-alignment-horizontal' => [
                    'title' => esc_html__('Horizontal', 'vc-tabs'),
                ],
                'oxi-tabs-header-vertical-mobile-alignment-vertical' => [
                    'title' => esc_html__('Vertical', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set the Tabs Alignment type for Small Device.',
                ]
        );

        $this->add_control(
                'oxi-tabs-header-vertical-mobile-alignment-horizontal', $this->style, [
            'label' => esc_html__('Horizontal Position', 'vc-tabs'),
            'type' => Controls::SELECT,
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-vertical',
                'oxi-tabs-header-vertical-mobile-alignment' => 'oxi-tabs-header-vertical-mobile-alignment-horizontal'
            ],
            'options' => [
                'oxi-tabs-header-vertical-mobile-alignment-horizontal-horizontal' => esc_html__('Column', 'vc-tabs'),
                'oxi-tabs-header-vertical-mobile-alignment-horizontal-vertical' => esc_html__('Row', 'vc-tabs'),
                'oxi-tabs-header-vertical-mobile-alignment-horizontal-compact' => esc_html__('Compact', 'vc-tabs'),
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style' => '',
            ],
            'description' => 'Set Header Alignment Horizontal Position as Colum row or Compact.',
                ]
        );
        $this->add_control(
                'oxi-tabs-header-mobile-vertical-width', $this->style, [
            'label' => esc_html__('Header Width', 'vc-tabs'),
            'type' => Controls::SLIDER,
            'customresponsive' => 'mobile',
            'condition' => [
                'oxi-tabs-heading-alignment' => 'oxi-tab-header-vertical',
                'oxi-tabs-header-vertical-mobile-alignment' => 'oxi-tabs-header-vertical-mobile-alignment-vertical'
            ],
            'default' => [
                'unit' => '%',
                'size' => 25,
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
                '{{WRAPPER}} > .oxi-tab-header-vertical.oxi-tabs-heading-responsive-static.oxi-tabs-header-vertical-mobile-alignment-vertical > .oxi-tabs-ultimate-header-wrap' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Customize the Header Width (Pixel, Percent or EM) for Small Device.',
                ]
        );

        $this->add_control(
                'oxi-tabs-heading-mobile-show-title', $this->style, [
            'label' => esc_html__('Title', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => esc_html__('Show', 'vc-tabs'),
                ],
                'oxi-tabs-heading-mobile-show-title-false' => [
                    'title' => esc_html__('Hide', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => '',
            ],
            'description' => 'Show/Hide the Title on Mobile Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-mobile-show-subtitle', $this->style, [
            'label' => esc_html__('Title', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => esc_html__('Show', 'vc-tabs'),
                ],
                'oxi-tabs-heading-mobile-show-subtitle-false' => [
                    'title' => esc_html__('Hide', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => '',
            ],
            'description' => 'Show/Hide the Sub Title on Mobile Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-mobile-show-icon', $this->style, [
            'label' => esc_html__('Icon', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => esc_html__('Show', 'vc-tabs'),
                ],
                'oxi-tabs-heading-mobile-show-icon-false' => [
                    'title' => esc_html__('Hide', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => '',
            ],
            'description' => 'Show/Hide the header Icon on Mobile Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-mobile-show-number', $this->style, [
            'label' => esc_html__('Number', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => esc_html__('Show', 'vc-tabs'),
                ],
                'oxi-tabs-heading-mobile-show-number-false' => [
                    'title' => esc_html__('Hide', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => '',
            ],
            'description' => 'Show/Hide the header Number on Mobile Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-heading-mobile-show-image', $this->style, [
            'label' => esc_html__('Image', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'options' => [
                '' => [
                    'title' => esc_html__('Show', 'vc-tabs'),
                ],
                'oxi-tabs-heading-mobile-show-image-false' => [
                    'title' => esc_html__('Hide', 'vc-tabs'),
                ],
            ],
            'default' => '',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap' => '',
            ],
            'description' => 'Show/Hide the header Image on Mobile Mode.',
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
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header .oxi-tabs-header-li.oxi-tab-header-aditional-left-position' => 'justify-content:{{VALUE}};',
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header .oxi-tabs-header-li.oxi-tab-header-aditional-right-position' => 'justify-content:{{VALUE}};',
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
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header .oxi-tabs-header-li.oxi-tab-header-aditional-top-position' => 'align-items:{{VALUE}};',
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header .oxi-tabs-header-li.oxi-tab-header-aditional-bottom-position' => 'align-items:{{VALUE}};',
            ],
            'description' => 'Set the Location of Title’s Alignment',
                ]
        );

        $this->start_controls_tabs(
                'oxi-tabs-head-start-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', 'vc-tabs'),
                        'active' => esc_html__('Active', 'vc-tabs'),
                    ]
                ]
        );

        $this->start_controls_tab();
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

        $this->end_controls_tab();
        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-head-ac-bg', $this->style, [
            'label' => esc_html__('Background', 'vc-tabs'),
            'type' => Controls::GRADIENT,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header .oxi-tabs-header-li.active' => 'background: {{VALUE}};',
            ],
            'description' => 'Set the Background of the Header.on Active Mode.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
                'oxi-tabs-head-inner-border',
                $this->style,
                [
                    'label' => esc_html__('Divider', 'vc-tabs'),
                    'type' => Controls::SINGLEBORDER,
                    'selector' => [
                        '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li' => 'border-right: {{SIZE}}px {{TYPE}} {{COLOR}};border-bottom: {{SIZE}}px {{TYPE}} {{COLOR}};'
                    ],
                    'description' => 'Customize Divider Border of the Header. Set Type, Size, and Color.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header' => '',
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
                        '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header' => ''
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-ultimate-header' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Header Section.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_header_title() {
        $this->start_controls_section(
                'oxi-tabs-head-title', [
            'label' => esc_html__('Title Settings', 'vc-tabs'),
            'showing' => TRUE,
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-title-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-main-title' => '',
            ],
            'description' => 'Customize the Typography options for the Tab’s Title.',
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-head-title-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', 'vc-tabs'),
                        'active' => esc_html__('Active', 'vc-tabs'),
                    ]
                ]
        );
        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-head-title-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-main-title' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Title Color on Normal Mode.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-title-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-main-title' => '',
            ],
            'description' => 'Add one or more shadows into Title Texts and customize other Text-Shadow Options.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-head-title-ac-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-tabs-main-title' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Title Color on Active Mode.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-title-ac-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-tabs-main-title' => '',
            ],
            'description' => 'Add one or more shadows into Title Texts and customize other Text-Shadow Options.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
                'oxi-tabs-head-title-margin', $this->style, [
            'label' => esc_html__('Margin', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-main-title' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Title.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_header_sub_title() {
        $this->start_controls_section(
                'oxi-tabs-head-sub-title', [
            'label' => esc_html__('Sub Title Settings', 'vc-tabs'),
            'showing' => false,
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-sub-title-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-sub-title' => '',
            ],
            'description' => 'Customize the Typography options for the Tab’s Sub Title.',
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-head-sub-title-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', 'vc-tabs'),
                        'active' => esc_html__('Active', 'vc-tabs'),
                    ]
                ]
        );
        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-head-sub-title-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-sub-title' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Sub Title Color on Normal Mode.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-sub-title-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-sub-title' => '',
            ],
            'description' => 'Add one or more shadows into Sub Title Texts and customize other Text-Shadow Options.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-head-sub-title-ac-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-tabs-sub-title' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Sub Title Color on Active Mode.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-head-sub-title-ac-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-tabs-sub-title' => '',
            ],
            'description' => 'Add one or more shadows into Sub Title Texts and customize other Text-Shadow Options.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
                'oxi-tabs-head-sub-title-margin', $this->style, [
            'label' => esc_html__('Margin', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-sub-title' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Sub Title.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_header_icon() {
        $this->start_controls_section(
                'oxi-tabs-head-icon', [
            'label' => esc_html__('Icon Settings', 'vc-tabs'),
            'showing' => false,
                ]
        );
        $this->add_control(
                'oxi-tabs-head-icon-position',
                $this->style,
                [
                    'label' => esc_html__('Customization Interface', 'vc-tabs'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_TEXT,
                    'toggle' => true,
                    'default' => 'simple',
                    'options' => [
                        'simple' => [
                            'title' => esc_html__('Simple', 'vc-tabs'),
                        ],
                        'customizable' => [
                            'title' => esc_html__('Customizable', 'vc-tabs'),
                        ],
                    ],
                    'description' => 'Set the Icon Customization Interface either Simple or fully Customizable.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-icon-width', $this->style, [
            'label' => esc_html__('Width', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li .oxi-icons' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Set the Icon’s Width.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-icon-height', $this->style, [
            'label' => esc_html__('Height', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li .oxi-icons' => 'height:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Set the Icon’s Height.',
                ]
        );

        $this->add_responsive_control(
                'oxi-tabs-head-icon-size', $this->style, [
            'label' => esc_html__('Icon Size', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li .oxi-icons' => 'font-size:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Set the Icon Size (PX, % or EM).',
                ]
        );

        $this->start_controls_tabs(
                'oxi-tabs-head-icon-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', 'vc-tabs'),
                        'active' => esc_html__('Active', 'vc-tabs'),
                    ]
                ]
        );
        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-head-icon-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li .oxi-icons' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Icon’s Color on Normal Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-head-icon-background', $this->style, [
            'type' => Controls::GRADIENT,
            'label' => esc_html__('Background', 'vc-tabs'),
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li .oxi-icons' => 'background: {{VALUE}};',
            ],
            'description' => 'Customize Icon Background with Color, Gradient or Image properties for Normal Mode.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-icon-border', $this->style, [
            'type' => Controls::BORDER,
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li .oxi-icons' => '',
            ],
            'description' => 'Customize Border of the Icon. Set Type, Width, and Color.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-head-icon-ac-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-icons' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Icon’s Color on Active Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-head-icon-ac-background', $this->style, [
            'type' => Controls::GRADIENT,
            'label' => esc_html__('Background', 'vc-tabs'),
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-icons' => 'background: {{VALUE}};',
            ],
            'description' => 'Customize Icon Background with Color, Gradient or Image properties for Active Mode.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-icon-ac-border', $this->style, [
            'type' => Controls::BORDER,
            'condition' => [
                'oxi-tabs-head-icon-position' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-icons' => '',
            ],
            'description' => 'Customize Border of the Icon. Set Type, Width, and Color for Active Mode.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
                'oxi-tabs-head-icon-border-radius', $this->style, [
            'label' => esc_html__('Border Radius', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li .oxi-icons' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Add rounded corners to the Icon’s  Section.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-icon-margin', $this->style, [
            'label' => esc_html__('Margin', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li .oxi-icons' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Icon.',
                ]
        );

        $this->end_controls_section();
    }

    public function register_header_number() {
        $this->start_controls_section(
                'oxi-tabs-head-number', [
            'label' => esc_html__('Number Settings', 'vc-tabs'),
            'showing' => false,
                ]
        );
        $this->add_control(
                'oxi-tabs-head-number-interface',
                $this->style,
                [
                    'label' => esc_html__('Customization Interface', 'vc-tabs'),
                    'type' => Controls::CHOOSE,
                    'operator' => Controls::OPERATOR_TEXT,
                    'toggle' => true,
                    'default' => 'simple',
                    'options' => [
                        'simple' => [
                            'title' => esc_html__('Simple', 'vc-tabs'),
                        ],
                        'customizable' => [
                            'title' => esc_html__('Customizable', 'vc-tabs'),
                        ],
                    ],
                    'description' => 'Set the Number Customization Interface either Simple or fully Customizable.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-number-width', $this->style, [
            'label' => esc_html__('Width', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li-number' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Set the Number’s Width.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-number-height', $this->style, [
            'label' => esc_html__('Height', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li-number' => 'height:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Set the Number’s Height.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-number-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li-number' => '',
            ],
            'description' => 'Customize the Typography options for the Number.',
                ]
        );

        $this->start_controls_tabs(
                'oxi-tabs-head-number-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', 'vc-tabs'),
                        'active' => esc_html__('Active', 'vc-tabs'),
                    ]
                ]
        );
        $this->start_controls_tab();

        $this->add_control(
                'oxi-tabs-head-number-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li-number' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Number’s Color on Normal Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-head-number-background', $this->style, [
            'type' => Controls::GRADIENT,
            'label' => esc_html__('Background', 'vc-tabs'),
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li-number' => 'background:{{VALUE}};',
            ],
            'description' => 'Customize Number Background with Color, Gradient or Image properties for Normal Mode.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-number-border', $this->style, [
            'type' => Controls::BORDER,
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li-number' => '',
            ],
            'description' => 'Customize Border of the Number. Set Type, Width, and Color.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-head-number-ac-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-tabs-header-li-number' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Number’s Color on Active Mode.',
                ]
        );
        $this->add_control(
                'oxi-tabs-head-number-ac-background', $this->style, [
            'type' => Controls::GRADIENT,
            'label' => esc_html__('Background', 'vc-tabs'),
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-tabs-header-li-number' => 'background:{{VALUE}};',
            ],
            'description' => 'Customize Number Background with Color, Gradient or Image properties for Active Mode.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-head-number-ac-border', $this->style, [
            'type' => Controls::BORDER,
            'condition' => [
                'oxi-tabs-head-number-interface' => 'customizable',
            ],
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-tabs-header-li-number' => '',
            ],
            'description' => 'Customize Border of the Number. Set Type, Width, and Color for Active Mode.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
                'oxi-tabs-head-number-border-radius', $this->style, [
            'label' => esc_html__('Border Radius', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li-number' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Add rounded corners to the Number’s border.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-number-margin', $this->style, [
            'label' => esc_html__('Margin', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li-number' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Number on the header.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_header_image() {
        $this->start_controls_section(
                'oxi-tabs-head-image', [
            'label' => esc_html__('Image Settings', 'vc-tabs'),
            'showing' => false,
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-image-width', $this->style, [
            'label' => esc_html__('Width', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li .oxi-tabs-header-li-image' => 'width:{{SIZE}}{{UNIT}};',
            ],
            'description' => 'Set the Image’s Width.',
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-head-number-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', 'vc-tabs'),
                        'active' => esc_html__('Active', 'vc-tabs'),
                    ]
                ]
        );
        $this->start_controls_tab();
        $this->add_group_control(
                'oxi-tabs-head-image-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li .oxi-tabs-header-li-image' => '',
            ],
            'description' => 'Customize Border of the Image. Set Type, Width, and Color.',
                ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_group_control(
                'oxi-tabs-head-image-ac-border', $this->style, [
            'type' => Controls::BORDER,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li.active .oxi-tabs-header-li-image' => '',
            ],
            'description' => 'Customize Border of the Image. Set Type, Width, and Color for Active Mode.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
                'oxi-tabs-head-image-border-radius', $this->style, [
            'label' => esc_html__('Border Radius', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li-image' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Add rounded corners to the Image’s Section.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-head-image-margin', $this->style, [
            'label' => esc_html__('Margin', 'vc-tabs'),
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-header-wrap .oxi-tabs-header-li-image' => 'margin:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Image on the header.',
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
        $this->register_desc_tags();
        $this->end_section_devider();

        //Start Divider
        $this->start_section_devider();
        $this->register_desc_content();
        $this->register_desc_popular();
        $this->register_desc_recent();
        $this->register_desc_comment();
        $this->end_section_devider();
        $this->end_section_tabs();
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content' => 'background: {{VALUE}};',
            ],
            'description' => 'Customize the Content’s Background with Color, Gradient or Image properties.',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-desc-general-boxshadow', $this->style, [
            'type' => Controls::BOXSHADOW,
            'selector' => [
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content' => '',
            ],
            'description' => 'Add one or more shadows into the Content body and customize other Box-Shadow Options.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-general-border',
                $this->style,
                [
                    'type' => Controls::BORDER,
                    'selector' => [
                        '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content' => ''
                    ],
                    'description' => 'Customize Border of the Content Body. Set Type, Width, and Color.',
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content' => 'border-radius:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Add rounded corners to the Content’s Section.',
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content > .oxi-tabs-body-tabs' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                '{{WRAPPER}} > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Create some Space outside of the Content Body.',
                ]
        );

        $this->end_controls_section();
    }

    public function register_desc_content() {
        $this->start_controls_section(
                'oxi-tabs-desc-content', [
            'label' => esc_html__('Content Settings', 'vc-tabs'),
            'showing' => TRUE,
                ]
        );

        $this->add_group_control(
                'oxi-tabs-desc-content-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            'include' => Controls::ALIGNNORMAL,
            'selector' => [
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content > .oxi-tabs-body-tabs' => '',
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content > .oxi-tabs-body-tabs p' => '',
            ],
            'description' => 'Customize the Typography options for the Tab’s Contents.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-content-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '#ffffff',
            'selector' => [
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content > .oxi-tabs-body-tabs' => 'color: {{VALUE}};',
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content >  .oxi-tabs-body-tabs p' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Color of Tab’s Contents.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-content-tx-shadow', $this->style, [
            'type' => Controls::TEXTSHADOW,
            'selector' => [
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content >  .oxi-tabs-body-tabs' => '',
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content >  .oxi-tabs-body-tabs p' => '',
            ],
            'description' => 'Add one or more shadows into the Content Texts and customize other Text-Shadow Options.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-content-padding', $this->style, [
            'label' => esc_html__('Content Padding', 'vc-tabs'),
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
                '{{WRAPPER}}  > .oxi-tabs-ultimate-style > .oxi-tabs-ultimate-content-wrap > .oxi-tabs-ultimate-content >  .oxi-tabs-body-tabs p' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Adjust Your Content Padding for Peragraph Tag.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_desc_popular() {
        $this->start_controls_section(
                'oxi-tabs-desc-popular', [
            'label' => esc_html__('Popular Post Settings', 'vc-tabs'),
            'showing' => false,
                ]
        );
        //content Section
        $this->add_control(
                'oxi-tabs-desc-popular-post', $this->style, [
            'label' => esc_html__('Max Post', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 5,
            'description' => 'Write the Maximum amount of Popular Posts.',
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-desc-popular-tabs',
                [
                    'options' => [
                        'image' => esc_html__('Image ', 'vc-tabs'),
                        'title' => esc_html__('Title', 'vc-tabs'),
                        'meta' => esc_html__('Meta', 'vc-tabs'),
                        'content' => esc_html__('Content', 'vc-tabs'),
                    ]
                ]
        );
        $this->start_controls_tab();
        //image Section
        $this->add_control(
                'oxi-tabs-desc-popular-thumb-condi', $this->style, [
            'label' => esc_html__('Show Image', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => '1',
            'options' => [
                '1' => [
                    'title' => esc_html__('True', 'vc-tabs'),
                ],
                '0' => [
                    'title' => esc_html__('False', 'vc-tabs'),
                ],
            ],
            'description' => 'Show/Hide the image under the Popular Post.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-popular-thumb-max', $this->style, [
            'label' => esc_html__('Image Size (px)', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 65,
            'condition' => [
                'oxi-tabs-desc-popular-thumb-condi' => '1'
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-popular-post .oxi-tabs-popular-avatar' => 'max-width:{{VALUE}}px;',
            ],
            'description' => 'Set the Image Size (PX).',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-popular-thumb', $this->style, [
            'label' => esc_html__('Image Size', 'vc-tabs'),
            'type' => Controls::SELECT,
            'loader' => TRUE,
            'options' => $this->thumbnail_sizes(),
            'condition' => [
                'oxi-tabs-desc-popular-thumb-condi' => '1'
            ],
            'description' => 'Select a Pre-defined Image Thumbnail Size.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        //title Section
        $this->add_group_control(
                'oxi-tabs-desc-popular-title-typo', $this->style, [
            'label' => 'Title Typography',
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-popular-body .oxi-tabs-popular-meta a' => '',
            ],
            'description' => 'Customize the Typography options for the Post’s Title.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-popular-title-color', $this->style, [
            'label' => esc_html__('Title Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-popular-body .oxi-tabs-popular-meta a' => 'color:{{VALUE}};',
            ],
            'description' => 'Set the Color of Post’s Title.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-popular-title-h-color', $this->style, [
            'label' => esc_html__('Title Hover Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-popular-body .oxi-tabs-popular-meta a:hover' => 'color:{{VALUE}};',
            ],
            'description' => 'Set the Color of Post’s Title in Hover view.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-popular-title-padding', $this->style, [
            'label' => esc_html__('Title Padding', 'vc-tabs'),
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
                '{{WRAPPER}} .oxi-tabs-popular-body .oxi-tabs-popular-meta' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around at Post Title from other Content.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        //meta Section
        $this->add_control(
                'oxi-tabs-desc-popular-meta-date', $this->style, [
            'label' => esc_html__('Show Date', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => '1',
            'options' => [
                '1' => [
                    'title' => esc_html__('True', 'vc-tabs'),
                ],
                '0' => [
                    'title' => esc_html__('False', 'vc-tabs'),
                ],
            ],
            'description' => 'Show/Hide Meta Date in the Post?',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-popular-meta-comment', $this->style, [
            'label' => esc_html__('Show Comment', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => '1',
            'options' => [
                '1' => [
                    'title' => esc_html__('True', 'vc-tabs'),
                ],
                '0' => [
                    'title' => esc_html__('False', 'vc-tabs'),
                ],
            ],
            'description' => 'Show/Hide Meta Comment in the Post?',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-desc-popular-meta-typo', $this->style, [
            'label' => 'Meta Typography',
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-popular-body .oxi-tabs-popular-postmeta' => '',
                '{{WRAPPER}} .oxi-tabs-popular-postmeta .oxi-tabs-popular-date' => '',
                '{{WRAPPER}} .oxi-tabs-popular-postmeta .oxi-tabs-popular-comment' => '',
            ],
            'description' => 'Customize the Typography options for the Post’s Meta.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-popular-meta-color', $this->style, [
            'label' => esc_html__('Meta Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-popular-body .oxi-tabs-popular-postmeta' => 'color:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-popular-postmeta .oxi-tabs-popular-date' => 'color:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-popular-postmeta .oxi-tabs-popular-comment' => 'color:{{VALUE}};',
            ],
            'description' => 'Add a custom Meta Color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-popular-meta-padding', $this->style, [
            'label' => esc_html__('Meta Padding', 'vc-tabs'),
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
                '{{WRAPPER}} .oxi-tabs-popular-body .oxi-tabs-popular-postmeta' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Meta.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        //content Section
        $this->add_control(
                'oxi-tabs-desc-popular-content-lenth', $this->style, [
            'label' => esc_html__('Content Lenth', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 90,
            'description' => 'Set the Max Content Length.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-popular-content-typo', $this->style, [
            'label' => 'Content Typography',
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-popular-body .oxi-tabs-popular-content' => '',
            ],
            'description' => 'Customize the Typography options for the Post’s Content.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-popular-content-color', $this->style, [
            'label' => esc_html__('Content Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-popular-body .oxi-tabs-popular-content' => 'color:{{VALUE}};',
            ],
            'description' => 'Add a custom Content Color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-popular-content-padding', $this->style, [
            'label' => esc_html__('Content Padding', 'vc-tabs'),
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
                '{{WRAPPER}} .oxi-tabs-popular-body .oxi-tabs-popular-content' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Content.',
                ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
                'oxi-tabs-desc-popular-padding', $this->style, [
            'label' => esc_html__('Content Padding', 'vc-tabs'),
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-popular-post' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Popular Post.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_desc_recent() {
        $this->start_controls_section(
                'oxi-tabs-desc-recent', [
            'label' => esc_html__('Recent Post Settings', 'vc-tabs'),
            'showing' => false,
                ]
        );
        //content Section
        $this->add_control(
                'oxi-tabs-desc-recent-post', $this->style, [
            'label' => esc_html__('Max Post', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 5,
            'description' => 'Write the Maximum amount of Recent Posts.',
                ]
        );
        $this->start_controls_tabs(
                'oxi-tabs-desc-recent-tabs',
                [
                    'options' => [
                        'image' => esc_html__('Image ', 'vc-tabs'),
                        'title' => esc_html__('Title', 'vc-tabs'),
                        'meta' => esc_html__('Meta', 'vc-tabs'),
                        'content' => esc_html__('Content', 'vc-tabs'),
                    ]
                ]
        );
        $this->start_controls_tab();
        //image Section
        $this->add_control(
                'oxi-tabs-desc-recent-thumb-condi', $this->style, [
            'label' => esc_html__('Show Image', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => '1',
            'options' => [
                '1' => [
                    'title' => esc_html__('True', 'vc-tabs'),
                ],
                '0' => [
                    'title' => esc_html__('False', 'vc-tabs'),
                ],
            ],
            'description' => 'Show/Hide the image under the Recent Post.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-recent-thumb-max', $this->style, [
            'label' => esc_html__('Image Size (px)', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 65,
            'condition' => [
                'oxi-tabs-desc-recent-thumb-condi' => '1'
            ],
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-recent-post .oxi-tabs-recent-avatar' => 'max-width:{{VALUE}}px;',
            ],
            'description' => 'Set the Image Size (PX).',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-recent-thumb', $this->style, [
            'label' => esc_html__('Image Size', 'vc-tabs'),
            'type' => Controls::SELECT,
            'loader' => TRUE,
            'options' => $this->thumbnail_sizes(),
            'condition' => [
                'oxi-tabs-desc-recent-thumb-condi' => '1'
            ],
            'description' => 'Select a Pre-defined Image Thumbnail Size.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        //title Section
        $this->add_group_control(
                'oxi-tabs-desc-recent-title-typo', $this->style, [
            'label' => 'Title Typography',
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-recent-body .oxi-tabs-recent-meta a' => '',
            ],
            'description' => 'Customize the Typography options for the Recent Post’s Title.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-recent-title-color', $this->style, [
            'label' => esc_html__('Title Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-recent-body .oxi-tabs-recent-meta a' => 'color:{{VALUE}};',
            ],
            'description' => 'Set the Color of Post’s Title.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-recent-title-h-color', $this->style, [
            'label' => esc_html__('Title Hover Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-recent-body .oxi-tabs-recent-meta a:hover' => 'color:{{VALUE}};',
            ],
            'description' => 'Set the Color of Post’s Title in Hover view.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-recent-title-padding', $this->style, [
            'label' => esc_html__('Title Padding', 'vc-tabs'),
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
                '{{WRAPPER}} .oxi-tabs-recent-body .oxi-tabs-recent-meta' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Title.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        //meta Section
        $this->add_control(
                'oxi-tabs-desc-recent-meta-date', $this->style, [
            'label' => esc_html__('Show Date', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => '1',
            'options' => [
                '1' => [
                    'title' => esc_html__('True', 'vc-tabs'),
                ],
                '0' => [
                    'title' => esc_html__('False', 'vc-tabs'),
                ],
            ],
            'description' => 'Show/Hide Meta Date in the Recent Post?',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-recent-meta-comment', $this->style, [
            'label' => esc_html__('Show Comment', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => '1',
            'options' => [
                '1' => [
                    'title' => esc_html__('True', 'vc-tabs'),
                ],
                '0' => [
                    'title' => esc_html__('False', 'vc-tabs'),
                ],
            ],
            'description' => 'Show/Hide Meta Comment in the Post?',
                ]
        );

        $this->add_group_control(
                'oxi-tabs-desc-recent-meta-typo', $this->style, [
            'label' => 'Meta Typography',
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-recent-body .oxi-tabs-recent-postmeta' => '',
                '{{WRAPPER}} .oxi-tabs-recent-postmeta .oxi-tabs-recent-date' => '',
                '{{WRAPPER}} .oxi-tabs-recent-postmeta .oxi-tabs-recent-comment' => '',
            ],
            'description' => 'Customize the Typography options for the Post’s Meta.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-recent-meta-color', $this->style, [
            'label' => esc_html__('Meta Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-recent-body .oxi-tabs-recent-postmeta' => 'color:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-recent-postmeta .oxi-tabs-recent-date' => 'color:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-recent-postmeta .oxi-tabs-recent-comment' => 'color:{{VALUE}};',
            ],
            'description' => 'Add a custom Meta Color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-recent-meta-padding', $this->style, [
            'label' => esc_html__('Meta Padding', 'vc-tabs'),
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
                '{{WRAPPER}} .oxi-tabs-recent-body .oxi-tabs-recent-postmeta' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Meta.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        //content Section
        $this->add_control(
                'oxi-tabs-desc-recent-content-lenth', $this->style, [
            'label' => esc_html__('Content Lenth', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 90,
            'description' => 'Set the Max Content Length.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-recent-content-typo', $this->style, [
            'label' => 'Content Typography',
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-recent-body .oxi-tabs-recent-content' => '',
            ],
            'description' => 'Customize the Typography options for the Post’s Content.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-recent-content-color', $this->style, [
            'label' => esc_html__('Content Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-recent-body .oxi-tabs-recent-content' => 'color:{{VALUE}};',
            ],
            'description' => 'Add a custom Content Color.',
                ]
        );
        $this->add_responsive_control(
                'oxi-tabs-desc-recent-content-padding', $this->style, [
            'label' => esc_html__('Content Padding', 'vc-tabs'),
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
                '{{WRAPPER}} .oxi-tabs-recent-body .oxi-tabs-recent-content' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Content.',
                ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
                'oxi-tabs-desc-recent-padding', $this->style, [
            'label' => esc_html__('Content Padding', 'vc-tabs'),
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-recent-post' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Recent Post.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_desc_comment() {
        $this->start_controls_section(
                'oxi-tabs-desc-tags', [
            'label' => esc_html__('Comment Settings', 'vc-tabs'),
            'showing' => false,
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-comment-max', $this->style, [
            'label' => esc_html__('Max Comment', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 5,
            'description' => 'Set the maximum amount of Comments.',
                ]
        );

        $this->add_control(
                'oxi-tabs-desc-comment-show-avatar', $this->style, [
            'label' => esc_html__('Show Avatar', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => 1,
            'options' => [
                '0' => [
                    'title' => esc_html__('False', 'vc-tabs'),
                ],
                '1' => [
                    'title' => esc_html__('True', 'vc-tabs'),
                ],
            ],
            'description' => 'Show/Hide the Avatar of comments.',
                ]
        );

        $this->add_control(
                'oxi-tabs-desc-comment-avatar-size', $this->style, [
            'label' => esc_html__('Avatar Size', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 65,
            'condition' => [
                'oxi-tabs-desc-comment-show-avatar' => '1',
            ],
            'description' => 'Set the Avatar Size.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-comment-comment-lenth', $this->style, [
            'label' => esc_html__('Comment Lenth', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 90,
            'description' => 'Customize the Comment’s Length.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-comment-typho', $this->style, [
            'label' => 'Title Typography',
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style span.oxi-tabs-comment-author' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-comment-meta a' => '',
                '{{WRAPPER}} .oxi-tabs-ultimate-style a span.oxi-tabs-comment-post' => '',
            ],
            'description' => ' Customize the Typography options for the Comment’s Title.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-comment-excerpt-typo', $this->style, [
            'label' => 'Comment Typography',
            'type' => Controls::TYPOGRAPHY,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-comment-body .oxi-tabs-comment-content' => '',
            ],
            'description' => 'Customize the Typography options for the Comment’s Content.',
                ]
        );

        $this->start_controls_tabs(
                'oxi-tabs-head-number-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', 'vc-tabs'),
                        'hover' => esc_html__('Hover', 'vc-tabs'),
                    ]
                ]
        );
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-desc-comment-title-color', $this->style, [
            'label' => esc_html__('Title Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style span.oxi-tabs-comment-author' => 'color:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-comment-meta a' => 'color:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style a span.oxi-tabs-comment-post' => 'color:{{VALUE}};',
            ],
            'description' => 'Add a custom Title Color.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-comment-comment-color', $this->style, [
            'label' => esc_html__('Comment Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-comment-body .oxi-tabs-comment-content' => 'color:{{VALUE}};',
            ],
            'description' => 'Add a custom Color to the Comment Content.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-desc-comment-title-hover-color', $this->style, [
            'label' => esc_html__('Title Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style span.oxi-tabs-comment-author:hover' => 'color:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-comment-meta a:hover' => 'color:{{VALUE}};',
                '{{WRAPPER}} .oxi-tabs-ultimate-style a span.oxi-tabs-comment-post:hover' => 'color:{{VALUE}};',
            ],
            'description' => 'Add a custom Title Color while Hover.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
                'oxi-tabs-desc-comment-padding', $this->style, [
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-comment' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'description' => 'Generate some Space around the Comment.',
                ]
        );
        $this->end_controls_section();
    }

    public function register_desc_tags() {
        $this->start_controls_section(
                'oxi-tabs-desc-tags', [
            'label' => esc_html__('Tags Settings', 'vc-tabs'),
            'showing' => false,
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-tags-max', $this->style, [
            'label' => esc_html__('Max Tags', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 20,
            'description' => 'Set the maximum amount of Tags.',
                ]
        );

        $this->add_control(
                'oxi-tabs-desc-tags-show-count', $this->style, [
            'label' => esc_html__('Show Count', 'vc-tabs'),
            'type' => Controls::CHOOSE,
            'operator' => Controls::OPERATOR_TEXT,
            'default' => 1,
            'options' => [
                '0' => [
                    'title' => esc_html__('False', 'vc-tabs'),
                ],
                '1' => [
                    'title' => esc_html__('True', 'vc-tabs'),
                ],
            ],
            'description' => 'Show/Hide the tags count.',
                ]
        );

        $this->add_control(
                'oxi-tabs-desc-tags-small', $this->style, [
            'label' => esc_html__('Small Size', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 12,
            'description' => 'Set the Small Size of the Tags.',
                ]
        );
        $this->add_control(
                'oxi-tabs-desc-tags-big', $this->style, [
            'label' => esc_html__('Big Size', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 25,
            'description' => 'Set the Big Size of the Tags.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-desc-tags-typho', $this->style, [
            'type' => Controls::TYPOGRAPHY,
            Controls::TYPO_FONTSIZE => false,
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs .tag-cloud-link' => '',
            ],
            'description' => 'Customize the Typography options for the Tag Text.',
                ]
        );

        $this->start_controls_tabs(
                'oxi-tabs-head-number-tabs',
                [
                    'options' => [
                        'normal' => esc_html__('Normal ', 'vc-tabs'),
                        'hover' => esc_html__('Hover', 'vc-tabs'),
                    ]
                ]
        );
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-desc-tags-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs .tag-cloud-link' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Color of Tab’s Tag in Normal view.',
                ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab();
        $this->add_control(
                'oxi-tabs-desc-tags-hover-color', $this->style, [
            'label' => esc_html__('Color', 'vc-tabs'),
            'type' => Controls::COLOR,
            'default' => '',
            'selector' => [
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs .tag-cloud-link:hover' => 'color: {{VALUE}};',
            ],
            'description' => 'Set the Color of Tab’s Tag in Hover view.',
                ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
                'oxi-tabs-desc-tags-padding', $this->style, [
            'label' => esc_html__('Content Padding', 'vc-tabs'),
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
                '{{WRAPPER}} .oxi-tabs-ultimate-style .oxi-tabs-body-tabs .tag-cloud-link' => 'padding:{{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};display: inline-block;',
            ],
            'description' => 'Generate some Space around the Tag’s Content including background color.',
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
            'label' => esc_html__('Custom CSS', 'vc-tabs'),
            'showing' => TRUE,
                ]
        );
        $this->add_control(
                'oxi-tabs-custom-css', $this->style, [
            'label' => esc_html__('', 'vc-tabs'),
            'type' => Controls::TEXTAREA,
            'default' => '',
            'description' => 'Custom CSS Section. You can add custom css into textarea.'
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
                'oxi-tabs-modal-title', [], [
            'label' => esc_html__('Title', 'vc-tabs'),
            'type' => Controls::TEXT,
            'default' => 'Lorem Ipsum',
            'description' => 'Add Title of your Tabs else Make it Blank.',
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-sub-title', [], [
            'label' => esc_html__('Sub Title', 'vc-tabs'),
            'type' => Controls::TEXT,
            'description' => 'Add Sub Title of your Tabs else Make it Blank.',
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-title-additional', [], [
            'label' => esc_html__('Title Additional', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__('None', 'vc-tabs'),
                'icon' => esc_html__('Icon', 'vc-tabs'),
                'number' => esc_html__('Number', 'vc-tabs'),
                'image' => esc_html__('Image', 'vc-tabs'),
            ],
            'description' => 'Add the Additional elements beside the Tab’s Title (Icon, Number or Image).',
                ]
        );

        $this->add_control(
                'oxi-tabs-modal-icon', [], [
            'label' => esc_html__('Icon', 'vc-tabs'),
            'type' => Controls::ICON,
            'default' => 'fab fa-facebook-f',
            'condition' => [
                'oxi-tabs-modal-title-additional' => 'icon',
            ],
            'description' => 'Select Icon from Font Awesome Icon list Panel.',
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-number', [], [
            'label' => esc_html__('Number', 'vc-tabs'),
            'type' => Controls::NUMBER,
            'default' => 1,
            'condition' => [
                'oxi-tabs-modal-title-additional' => 'number',
            ],
            'description' => 'Write the Number as Title Additionals.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-modal-image', [],
                [
                    'label' => esc_html__('Image', 'vc-tabs'),
                    'type' => Controls::MEDIA,
                    'condition' => [
                        'oxi-tabs-modal-title-additional' => 'image',
                    ],
                    'description' => 'Add an Image from Media Library or Input a custom Image URL.'
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-components-type', [], [
            'label' => esc_html__('Choose Components', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => 'wysiwyg',
            'options' => [
                'wysiwyg' => esc_html__('WYSIWYG Editor', 'vc-tabs'),
                'nested-tabs' => esc_html__('Nested Tabs', 'vc-tabs'),
                'link' => esc_html__('Custom Link', 'vc-tabs'),
                'popular-post' => esc_html__('Polular Post', 'vc-tabs'),
                'recent-post' => esc_html__('Recent Post', 'vc-tabs'),
                'recent-comment' => esc_html__('Recent Comment', 'vc-tabs'),
                'tag' => esc_html__('Post Tag', 'vc-tabs')
            ],
            'description' => 'Se the Tab’s Content type as Content or Custom Link.',
                ]
        );
        $this->add_group_control(
                'oxi-tabs-modal-link', [], [
            'label' => esc_html__('Link', 'vc-tabs'),
            'type' => Controls::URL,
            'condition' => [
                'oxi-tabs-modal-components-type' => 'link',
            ],
            'description' => 'Add Custom link with opening type.',
                ]
        );

        $this->add_control(
                'oxi-tabs-modal-desc', [], [
            'label' => esc_html__('Description', 'vc-tabs'),
            'type' => Controls::WYSIWYG,
            'default' => '',
            'condition' => [
                'oxi-tabs-modal-components-type' => 'wysiwyg',
            ],
            'description' => 'Add your Tab’s Description.',
                ]
        );
        $this->add_control(
                'oxi-tabs-modal-nested-tabs', [], [
            'label' => esc_html__('Select Tabs', 'vc-tabs'),
            'type' => Controls::SELECT,
            'default' => '',
            'options' => $this->Get_Nested_Tabs,
            'condition' => [
                'oxi-tabs-modal-components-type' => 'nested-tabs',
            ],
            'description' => 'Select Tabs to Create Nested.',
                ]
        );
        echo '</div>';
    }

}
