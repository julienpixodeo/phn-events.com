<?php

/**
 * Class description
 *
 * @package   package_name
 * @author    ThemeG
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'GrandConference_Ext' ) ) {

	/**
	 * Define GrandConference_Ext class
	 */
	class GrandConference_Ext {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * Init Handler
		 */
		public function init() {
			add_action( 'elementor/element/column/section_advanced/after_section_end', [ $this, 'widget_tab_advanced_add_section' ], 10, 2 );
			add_action( 'elementor/element/common/_section_style/after_section_end', array( $this, 'widget_tab_advanced_add_section' ), 10, 2 );
			
			add_action( 'elementor/element/section/section_background/after_section_end', [ $this, 'widget_tab_styled_add_section' ], 10, 2 );
			add_action( 'elementor/element/image/section_style_image/after_section_end', [ $this, 'widget_image_tab_styled_add_section' ], 10, 2 );
			
			//Add support for container
			add_action( 'elementor/element/container/section_background/after_section_end', [ $this, 'widget_tab_styled_add_section' ], 10, 2 );
			add_action( 'elementor/element/container/section_layout/after_section_end', [ $this, 'widget_tab_advanced_add_section' ], 10, 2 );
		}
		
		public function widget_image_tab_styled_add_section( $element, $args ) {
			$element->start_controls_section(
				'grandconference_image_animation_section',
				[
					'label' => esc_html__( 'Image Animation', 'grandconference-elementor' ),
					'tab'   => Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			
			$element->add_control(
				'grandconference_image_is_animation',
				[
					'label'        => esc_html__( 'Animation Effect', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add animation effect to image when scrolling', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_image_animation_effect',
				[
					'label'       => esc_html__( 'Effect', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 'slide_down',
					'options' => [
						 'slide_down' => __( 'Slide Down', 'grandconference-elementor' ),
						 'slide_up' => __( 'Slide Up', 'grandconference-elementor' ),
						 'zoom_in' => __( 'Zoom In', 'grandconference-elementor' ),
						 'zoom_out' => __( 'Zoom Out', 'grandconference-elementor' ),
					],
					'condition' => [
						'grandconference_image_is_animation' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_image_animation_overlay_color',
				[
					'label' => __( 'Overlay Color', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::COLOR,
					'condition' => [
						'grandconference_image_is_animation' => 'true',
					],
					'default' => '#ffffff',
					'selectors' => [
						'{{WRAPPER}}:after' => 'border-color: {{VALUE}} !important',
					],
				]
			);
			
			$element->end_controls_section();
		}
		
		public function widget_tab_styled_add_section( $element, $args ) {
			$element->start_controls_section(
				'grandconference_ext_parallax_section',
				[
					'label' => esc_html__( 'Background Parallax', 'grandconference-elementor' ),
					'tab'   => Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			
			$element->add_control(
				'grandconference_ext_is_background_parallax',
				[
					'label'        => esc_html__( 'Background Parallax', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add parallax scrolling effect to background image', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
			    'grandconference_ext_is_background_parallax_speed',
			    [
			        'label' => __( 'Scroll Speed', 'grandconference-elementor' ),
			        'description' => __( 'factor that control speed of scroll animation', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0.8,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 1,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_background_parallax' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandconference_ext_is_background_backdrop',
				[
					'label'        => esc_html__( 'Backdrop Blur', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add a blur effect to the area behind an element:', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_ext_is_background_backdrop_blur',
				[
					'label' => __( 'Blur Effect', 'grandconference-elementor' ),
					'description' => __( 'Add factor that control a blur effect', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 12,
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 30,
							'step' => 1,
						]
					],
					'size_units' => [ 'px' ],
					'condition' => [
						'grandconference_ext_is_background_backdrop' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->end_controls_section();
			
			$element->start_controls_section(
				'grandconference_ext_background_on_scroll_section',
				[
					'label' => esc_html__( 'Background On Scroll', 'grandconference-elementor' ),
					'tab'   => Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			
			$element->add_control(
				'grandconference_ext_is_background_on_scroll',
				[
					'label'        => esc_html__( 'Background On Scroll', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add background color change on scroll', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_ext_background_on_scroll_color',
				[
					'label' => __( 'Background Color', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::COLOR,
					'condition' => [
						'grandconference_ext_is_background_on_scroll' => 'true',
					],
					'default' => '#000000',
					'frontend_available' => true,
				]
			);
			
			$element->end_controls_section();
		}
		
		/**
		 * [widget_tab_advanced_add_section description]
		 * @param  [type] $element [description]
		 * @param  [type] $args    [description]
		 * @return [type]          [description]
		 */
		public function widget_tab_advanced_add_section( $element, $args ) {

			$element->start_controls_section(
				'grandconference_ext_link_section',
				[
					'label' => esc_html__( 'Link Options', 'grandconference-elementor' ),
					'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
				]
			);
			
			$element->add_control(
				'grandconference_ext_link_sidemenu',
				[
					'label'        => esc_html__( 'Link to side menu', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add link to element to open side menu when clicking', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_ext_link_fullmenu',
				[
					'label'        => esc_html__( 'Link to fullscreen menu', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add link to element to open fullscreen menu when clicking', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_ext_link_closed_fullmenu',
				[
					'label'        => esc_html__( 'Link to closed fullscreen menu', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add link to element to close fullscreen menu when clicking', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			/*$element->add_control(
				'grandconference_ext_link_minicart',
				[
					'label'        => esc_html__( 'Link to WooCommerce mini cart', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add link to element to open WooCommerce mini cart popup when clicking', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);*/
			
			$element->end_controls_section();
			
			$element->start_controls_section(
				'grandconference_ext_sticky_section',
				[
					'label' => esc_html__( 'Sticky Options', 'grandconference-elementor' ),
					'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
				]
			);
			
			$element->add_control(
				'grandconference_ext_is_sticky',
				[
					'label'        => esc_html__( 'Enbale Sticky Effect', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Enbale this option to sticky this element to parent element', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_ext_sticky_top_spacing',
				[
					'label' => __( 'Top Spacing (px)', 'grandconference-elementor' ),
					'description' => __( 'Additional top spacing of the element when it becomes sticky', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 100,
					],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 2000,
							'step' => 5,
						]
					],
					'size_units' => [ 'px' ],
					'condition' => [
						'grandconference_ext_is_sticky' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->end_controls_section();

			$element->start_controls_section(
				'grandconference_ext_animation_section',
				[
					'label' => esc_html__( 'Custom Animation', 'grandconference-elementor' ),
					'tab'   => Elementor\Controls_Manager::TAB_ADVANCED,
				]
			);

			$element->add_control(
				'grandconference_ext_is_scrollme',
				[
					'label'        => esc_html__( 'Scroll Animation', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add animation to element when scrolling through page contents', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);

			$element->add_control(
				'grandconference_ext_scrollme_disable',
				[
					'label'       => esc_html__( 'Disable for', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 'mobile',
				    'options' => [
				     	'none' => __( 'None', 'grandconference-elementor' ),
				     	'tablet' => __( 'Mobile and Tablet', 'grandconference-elementor' ),
				     	'mobile' => __( 'Mobile', 'grandconference-elementor' ),
				    ],
					'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			/*$element->add_control(
				'grandconference_ext_scrollme_easing',
				[
					'label'       => esc_html__( 'Easing', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 'swing',
				    'options' => [
					    'swing' => __( 'swing', 'grandconference-elementor' ),
				     	'easeInQuad' => __( 'easeInQuad', 'grandconference-elementor' ),
				     	'easeInCubic' => __( 'easeInCubic', 'grandconference-elementor' ),
				     	'easeInQuart' => __( 'easeInQuart', 'grandconference-elementor' ),
				     	'easeInQuint' => __( 'easeInQuint', 'grandconference-elementor' ),
				     	'easeInSine' => __( 'easeInSine', 'grandconference-elementor' ),
				     	'easeInExpo' => __( 'easeInExpo', 'grandconference-elementor' ),
				     	'easeInCirc' => __( 'easeInCirc', 'grandconference-elementor' ),
				     	'easeInBack' => __( 'easeInBack', 'grandconference-elementor' ),
				     	'easeInElastic' => __( 'easeInElastic', 'grandconference-elementor' ),
				     	'easeInBounce' => __( 'easeInBounce', 'grandconference-elementor' ),
				     	'easeOutQuad' => __( 'easeOutQuad', 'grandconference-elementor' ),
				     	'easeOutCubic' => __( 'easeOutCubic', 'grandconference-elementor' ),
				     	'easeOutQuart' => __( 'easeOutQuart', 'grandconference-elementor' ),
				     	'easeOutQuint' => __( 'easeOutQuint', 'grandconference-elementor' ),
				     	'easeOutSine' => __( 'easeOutSine', 'grandconference-elementor' ),
				     	'easeOutExpo' => __( 'easeOutExpo', 'grandconference-elementor' ),
				     	'easeOutCirc' => __( 'easeOutCirc', 'grandconference-elementor' ),
				     	'easeOutBack' => __( 'easeOutBack', 'grandconference-elementor' ),
				     	'easeOutElastic' => __( 'easeOutElastic', 'grandconference-elementor' ),
				     	'easeOutBounce' => __( 'easeOutBounce', 'grandconference-elementor' ),
				     	'easeInOutQuad' => __( 'easeInOutQuad', 'grandconference-elementor' ),
				     	'easeInOutCubic' => __( 'easeInOutCubic', 'grandconference-elementor' ),
				     	'easeInOutQuart' => __( 'easeInOutQuart', 'grandconference-elementor' ),
				     	'easeInOutQuint' => __( 'easeInOutQuint', 'grandconference-elementor' ),
				     	'easeInOutSine' => __( 'easeInOutSine', 'grandconference-elementor' ),
				     	'easeInOutExpo' => __( 'easeInOutExpo', 'grandconference-elementor' ),
				     	'easeInOutCirc' => __( 'easeInOutCirc', 'grandconference-elementor' ),
				     	'easeInOutBack' => __( 'easeInOutBack', 'grandconference-elementor' ),
				     	'easeInOutElastic' => __( 'easeInOutElastic', 'grandconference-elementor' ),
				     	'easeInOutBounce' => __( 'easeInOutBounce', 'grandconference-elementor' ),
				    ],
					'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
				]
			);*/
			
			$element->add_control(
			    'grandconference_ext_scrollme_smoothness',
			    [
			        'label' => __( 'Smoothness', 'grandconference-elementor' ),
			        'description' => __( 'factor that slowdown the animation, the more the smoothier', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 30,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0,
			                'max' => 100,
			                'step' => 5,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			/*$element->add_control(
				'grandconference_ext_scrollme_duration',
				[
					'label' => __( 'Animation Duration (ms)', 'grandconference-elementor' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 5,
					'max' => 5000,
					'step' => 5,
					'default' => 400,
					'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => false,
					'selectors' => [
			            '.elementor-widget.elementor-element-{{ID}}' => 'transition-duration: {{VALUE}}ms !important',
			        ],
				]
			);*/
			
			$element->add_control(
			    'grandconference_ext_scrollme_scalex',
			    [
			        'label' => __( 'Scale X', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_scrollme_scaley',
			    [
			        'label' => __( 'Scale Y', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_scrollme_scalez',
			    [
			        'label' => __( 'Scale Z', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
		
			$element->add_control(
			    'grandconference_ext_scrollme_rotatex',
			    [
			        'label' => __( 'Rotate X', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_scrollme_rotatey',
			    [
			        'label' => __( 'Rotate Y', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_scrollme_rotatez',
			    [
			        'label' => __( 'Rotate Z', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_scrollme_translatex',
			    [
			        'label' => __( 'Translate X', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_scrollme_translatey',
			    [
			        'label' => __( 'Translate Y', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_scrollme_translatez',
			    [
			        'label' => __( 'Translate Z', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_scrollme' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandconference_ext_is_smoove',
				[
					'label'        => esc_html__( 'Entrance Animation', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add custom entrance animation to element', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);

			$element->add_control(
				'grandconference_ext_smoove_disable',
				[
					'label'       => esc_html__( 'Disable for', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 1,
				    'options' => [
				     	1 => __( 'None', 'grandconference-elementor' ),
				     	769 => __( 'Mobile and Tablet', 'grandconference-elementor' ),
				     	415 => __( 'Mobile', 'grandconference-elementor' ),
				    ],
					'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_ext_smoove_easing',
				[
					'label'       => esc_html__( 'Easing', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => '0.250, 0.250, 0.750, 0.750',
				    'options' => [
					    '0.250, 0.250, 0.750, 0.750' => __( 'linear', 'grandconference-elementor' ),
				     	'0.250, 0.100, 0.250, 1.000' => __( 'ease', 'grandconference-elementor' ),
				     	'0.420, 0.000, 1.000, 1.000' => __( 'ease-in', 'grandconference-elementor' ),
				     	'0.000, 0.000, 0.580, 1.000' => __( 'ease-out', 'grandconference-elementor' ),
				     	'0.420, 0.000, 0.580, 1.000' => __( 'ease-in-out', 'grandconference-elementor' ),
				     	'0.550, 0.085, 0.680, 0.530' => __( 'easeInQuad', 'grandconference-elementor' ),
				     	'0.550, 0.055, 0.675, 0.190' => __( 'easeInCubic', 'grandconference-elementor' ),
				     	'0.895, 0.030, 0.685, 0.220' => __( 'easeInQuart', 'grandconference-elementor' ),
				     	'0.755, 0.050, 0.855, 0.060' => __( 'easeInQuint', 'grandconference-elementor' ),
				     	'0.470, 0.000, 0.745, 0.715' => __( 'easeInSine', 'grandconference-elementor' ),
				     	'0.950, 0.050, 0.795, 0.035' => __( 'easeInExpo', 'grandconference-elementor' ),
				     	'0.600, 0.040, 0.980, 0.335' => __( 'easeInCirc', 'grandconference-elementor' ),
				     	'0.600, -0.280, 0.735, 0.045' => __( 'easeInBack', 'grandconference-elementor' ),
				     	'0.250, 0.460, 0.450, 0.940' => __( 'easeOutQuad', 'grandconference-elementor' ),
				     	'0.215, 0.610, 0.355, 1.000' => __( 'easeOutCubic', 'grandconference-elementor' ),
				     	'0.165, 0.840, 0.440, 1.000' => __( 'easeOutQuart', 'grandconference-elementor' ),
				     	'0.230, 1.000, 0.320, 1.000' => __( 'easeOutQuint', 'grandconference-elementor' ),
				     	'0.390, 0.575, 0.565, 1.000' => __( 'easeOutSine', 'grandconference-elementor' ),
				     	'0.190, 1.000, 0.220, 1.000' => __( 'easeOutExpo', 'grandconference-elementor' ),
				     	'0.075, 0.820, 0.165, 1.000' => __( 'easeOutCirc', 'grandconference-elementor' ),
				     	'0.175, 0.885, 0.320, 1.275' => __( 'easeOutBack', 'grandconference-elementor' ),
				     	'0.455, 0.030, 0.515, 0.955' => __( 'easeInOutQuad', 'grandconference-elementor' ),
				     	'0.645, 0.045, 0.355, 1.000' => __( 'easeInOutCubic', 'grandconference-elementor' ),
				     	'0.770, 0.000, 0.175, 1.000' => __( 'easeInOutQuart', 'grandconference-elementor' ),
				     	'0.860, 0.000, 0.070, 1.000' => __( 'easeInOutQuint', 'grandconference-elementor' ),
				     	'0.445, 0.050, 0.550, 0.950' => __( 'easeInOutSine', 'grandconference-elementor' ),
				     	'1.000, 0.000, 0.000, 1.000' => __( 'easeInOutExpo', 'grandconference-elementor' ),
				     	'0.785, 0.135, 0.150, 0.860' => __( 'easeInOutCirc', 'grandconference-elementor' ),
				     	'0.680, -0.550, 0.265, 1.550' => __( 'easeInOutBack', 'grandconference-elementor' ),
				    ],
					'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => false,
					'selectors' => [
			            '.elementor-element.elementor-element-{{ID}}' => 'transition-timing-function: cubic-bezier({{VALUE}}) !important',
			        ],
				]
			);
			
			$element->add_control(
				'grandconference_ext_smoove_delay',
				[
					'label' => __( 'Animation Delay (ms)', 'grandconference-elementor' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 0,
					'max' => 5000,
					'step' => 5,
					'default' => 0,
					'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => false,
					'selectors' => [
			            '.elementor-element.elementor-element-{{ID}}' => 'transition-delay: {{VALUE}}ms !important',
			        ],
				]
			);
			
			$element->add_control(
				'grandconference_ext_smoove_duration',
				[
					'label' => __( 'Animation Duration (ms)', 'grandconference-elementor' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 5,
					'max' => 5000,
					'step' => 5,
					'default' => 400,
					'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
					/*'selectors' => [
			            '.elementor-widget.elementor-element-{{ID}}' => 'transition-duration: {{VALUE}}ms !important',
			        ],*/
				]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_opacity',
			    [
			        'label' => __( 'Opacity', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0,
			                'max' => 1,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => false,
					'selectors' => [
			            '.elementor-widget.elementor-element-{{ID}}' => 'opacity: {{SIZE}}',
			        ],
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_scalex',
			    [
			        'label' => __( 'Scale X', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_scaley',
			    [
			        'label' => __( 'Scale Y', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_rotatex',
			    [
			        'label' => __( 'Rotate X', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_rotatey',
			    [
			        'label' => __( 'Rotate Y', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_rotatez',
			    [
			        'label' => __( 'Rotate Z', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -360,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_translatex',
			    [
			        'label' => __( 'Translate X', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_translatey',
			    [
			        'label' => __( 'Translate Y', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_translatez',
			    [
			        'label' => __( 'Translate Z', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => -1000,
			                'max' => 1000,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_skewx',
			    [
			        'label' => __( 'Skew X', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_skewy',
			    [
			        'label' => __( 'Skew Y', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0,
			                'max' => 360,
			                'step' => 1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandconference_ext_smoove_transform_originx',
				[
					'label' => __( 'Transform Origin X', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 50,
					],
					'range' => [
						'%' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						]
					],
					'size_units' => [ '%' ],
					'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_ext_smoove_transform_originy',
				[
					'label' => __( 'Transform Origin Y', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SLIDER,
					'default' => [
						'size' => 50,
					],
					'range' => [
						'%' => [
							'min' => 0,
							'max' => 100,
							'step' => 1,
						]
					],
					'size_units' => [ '%' ],
					'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
			    'grandconference_ext_smoove_perspective',
			    [
			        'label' => __( 'Perspective', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 1000,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 5,
			                'max' => 4000,
			                'step' => 5,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_smoove' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandconference_ext_is_parallax_mouse',
				[
					'label'        => esc_html__( 'Mouse Parallax', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add parallax to element when moving mouse position', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
			    'grandconference_ext_is_parallax_mouse_depth',
			    [
			        'label' => __( 'Depth', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0.2,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 2,
			                'step' => 0.05,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_parallax_mouse' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandconference_ext_is_infinite',
				[
					'label'        => esc_html__( 'Infinite Animation', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add custom infinite animation to element', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_ext_infinite_animation',
				[
					'label'       => esc_html__( 'Easing', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 'if_bounce',
				    'options' => [
					    'if_swing1' => __( 'Swing 1', 'grandconference-elementor' ),
					    'if_swing2' => __( 'Swing 2', 'grandconference-elementor' ),
				     	'if_wave' 	=> __( 'Wave', 'grandconference-elementor' ),
				     	'if_tilt' 	=> __( 'Tilt', 'grandconference-elementor' ),
				     	'if_bounce' => __( 'Bounce', 'grandconference-elementor' ),
				     	'if_scale' 	=> __( 'Scale', 'grandconference-elementor' ),
				     	'if_spin' 	=> __( 'Spin', 'grandconference-elementor' ),
				    ],
					'condition' => [
						'grandconference_ext_is_infinite' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_ext_infinite_easing',
				[
					'label'       => esc_html__( 'Easing', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => '0.250, 0.250, 0.750, 0.750',
				    'options' => [
					    '0.250, 0.250, 0.750, 0.750' => __( 'linear', 'grandconference-elementor' ),
				     	'0.250, 0.100, 0.250, 1.000' => __( 'ease', 'grandconference-elementor' ),
				     	'0.420, 0.000, 1.000, 1.000' => __( 'ease-in', 'grandconference-elementor' ),
				     	'0.000, 0.000, 0.580, 1.000' => __( 'ease-out', 'grandconference-elementor' ),
				     	'0.420, 0.000, 0.580, 1.000' => __( 'ease-in-out', 'grandconference-elementor' ),
				     	'0.550, 0.085, 0.680, 0.530' => __( 'easeInQuad', 'grandconference-elementor' ),
				     	'0.550, 0.055, 0.675, 0.190' => __( 'easeInCubic', 'grandconference-elementor' ),
				     	'0.895, 0.030, 0.685, 0.220' => __( 'easeInQuart', 'grandconference-elementor' ),
				     	'0.755, 0.050, 0.855, 0.060' => __( 'easeInQuint', 'grandconference-elementor' ),
				     	'0.470, 0.000, 0.745, 0.715' => __( 'easeInSine', 'grandconference-elementor' ),
				     	'0.950, 0.050, 0.795, 0.035' => __( 'easeInExpo', 'grandconference-elementor' ),
				     	'0.600, 0.040, 0.980, 0.335' => __( 'easeInCirc', 'grandconference-elementor' ),
				     	'0.600, -0.280, 0.735, 0.045' => __( 'easeInBack', 'grandconference-elementor' ),
				     	'0.250, 0.460, 0.450, 0.940' => __( 'easeOutQuad', 'grandconference-elementor' ),
				     	'0.215, 0.610, 0.355, 1.000' => __( 'easeOutCubic', 'grandconference-elementor' ),
				     	'0.165, 0.840, 0.440, 1.000' => __( 'easeOutQuart', 'grandconference-elementor' ),
				     	'0.230, 1.000, 0.320, 1.000' => __( 'easeOutQuint', 'grandconference-elementor' ),
				     	'0.390, 0.575, 0.565, 1.000' => __( 'easeOutSine', 'grandconference-elementor' ),
				     	'0.190, 1.000, 0.220, 1.000' => __( 'easeOutExpo', 'grandconference-elementor' ),
				     	'0.075, 0.820, 0.165, 1.000' => __( 'easeOutCirc', 'grandconference-elementor' ),
				     	'0.175, 0.885, 0.320, 1.275' => __( 'easeOutBack', 'grandconference-elementor' ),
				     	'0.455, 0.030, 0.515, 0.955' => __( 'easeInOutQuad', 'grandconference-elementor' ),
				     	'0.645, 0.045, 0.355, 1.000' => __( 'easeInOutCubic', 'grandconference-elementor' ),
				     	'0.770, 0.000, 0.175, 1.000' => __( 'easeInOutQuart', 'grandconference-elementor' ),
				     	'0.860, 0.000, 0.070, 1.000' => __( 'easeInOutQuint', 'grandconference-elementor' ),
				     	'0.445, 0.050, 0.550, 0.950' => __( 'easeInOutSine', 'grandconference-elementor' ),
				     	'1.000, 0.000, 0.000, 1.000' => __( 'easeInOutExpo', 'grandconference-elementor' ),
				     	'0.785, 0.135, 0.150, 0.860' => __( 'easeInOutCirc', 'grandconference-elementor' ),
				     	'0.680, -0.550, 0.265, 1.550' => __( 'easeInOutBack', 'grandconference-elementor' ),
				    ],
					'condition' => [
						'grandconference_ext_is_infinite' => 'true',
					],
					'frontend_available' => true
				]
			);
			
			$element->add_control(
				'grandconference_ext_infinite_duration',
				[
					'label' => __( 'Animation Duration (s)', 'grandconference-elementor' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 15,
					'step' => 1,
					'default' => 4,
					'condition' => [
						'grandconference_ext_is_infinite' => 'true',
					],
					'frontend_available' => true
				]
			);
			
			$element->add_control(
				'grandconference_ext_is_fadeout_animation',
				[
					'label'        => esc_html__( 'FadeOut Animation', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Add fadeout animation  to element when scrolling', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
			    'grandconference_ext_is_fadeout_animation_velocity',
			    [
			        'label' => __( 'Velocity', 'grandconference-elementor' ),
			        'type' => Elementor\Controls_Manager::SLIDER,
			        'default' => [
			            'size' => 0.7,
			        ],
			        'range' => [
			            'px' => [
			                'min' => 0.1,
			                'max' => 1,
			                'step' => 0.1,
			            ]
			        ],
			        'size_units' => [ 'px' ],
			        'condition' => [
						'grandconference_ext_is_fadeout_animation' => 'true',
					],
					'frontend_available' => true,
			    ]
			);
			
			$element->add_control(
				'grandconference_ext_is_fadeout_animation_direction',
				[
					'label'       => esc_html__( 'FadeOut Direction', 'grandconference-elementor' ),
					'type' => Elementor\Controls_Manager::SELECT,
					'default' => 'up',
				    'options' => [
					    'up' 		=> __( 'Up', 'grandconference-elementor' ),
					    'down' 		=> __( 'Down', 'grandconference-elementor' ),
				     	'still' 	=> __( 'Still', 'grandconference-elementor' ),
				    ],
					'condition' => [
						'grandconference_ext_is_fadeout_animation' => 'true',
					],
					'frontend_available' => true,
				]
			);
			
			$element->add_control(
				'grandconference_ext_mobile_static',
				[
					'label'        => esc_html__( 'Display Static Position on Mobile', 'grandconference-elementor' ),
					'description'  => esc_html__( 'Enbale this option to make the element display static position on mobile devices', 'grandconference-elementor' ),
					'type'         => Elementor\Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'grandconference-elementor' ),
					'label_off'    => esc_html__( 'No', 'grandconference-elementor' ),
					'return_value' => 'true',
					'default'      => 'false',
					'frontend_available' => true,
				]
			);

			$element->end_controls_section();
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

/**
 * Returns instance of GrandConference_Ext
 *
 * @return object
 */
function grandconference_ext() {
	return GrandConference_Ext::get_instance();
}
