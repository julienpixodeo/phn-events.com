<?php
namespace GrandConferenceElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Blog Posts
 *
 * Elementor widget for blog posts
 *
 * @since 1.0.0
 */
class GrandConference_Testimonial_Slider extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'grandconference-testimonial-slider';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Testimonial Slider', 'grandconference-elementor' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slider-vertical';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'grandconference-theme-widgets-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'owl-carousel', 'grandconference-elementor' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'grandconference-elementor' ),
			]
		);
		
		$this->add_control(
			'cat',
			[
				'label' => __( 'Filter by category', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'options' => grandconference_get_testimonial_cat(),
				'multiple' => false,
			]
		);
		
		$this->add_control(
			'items',
			[
				'label' => __( 'Items', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
						'step' => 1,
					]
				],
			]
		);
		
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Auto Play', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
		    'timer',
		    [
		        'label' => __( 'Timer (in seconds)', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 8,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 60,
		                'step' => 1,
		            ]
		        ],
		        'size_units' => [ 'px' ]
		    ]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_card_style',
			array(
				'label'      => esc_html__( 'Card', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_responsive_control(
			'card_padding',
			[
				'label' => __( 'Content Padding (in px)', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 80,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 150,
						'step' => 1,
					]
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .testimonial-block .inner-box' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
		    'card_bg_color',
		    [
		        'label' => __( 'Card Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .testimonial-block .inner-box' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
			'nav_sub_menu_border_radius',
			[
				'label' => __( 'Border Radius', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 25,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .testimonial-block .inner-box' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_box_shadow',
				'label' => __( 'Card Shadow', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .testimonial-block .inner-box',
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_name_style',
			array(
				'label'      => esc_html__( 'Client Name', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'name_color',
		    [
		        'label' => __( 'Client Name Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .testimonial-block .info-box .name' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'label' => __( 'Name Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .testimonial-block .info-box .name',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_position_style',
			array(
				'label'      => esc_html__( 'Client Position', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'position_color',
			[
				'label' => __( 'Client Position Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .testimonial-block .info-box .designation' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'position_typography',
				'label' => __( 'Position Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .testimonial-block .info-box .designation',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_style',
			array(
				'label'      => esc_html__( 'Description', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'description_color',
		    [
		        'label' => __( 'Description Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .testimonial-block .text' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Description Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .testimonial-block .text',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_navigation_style',
			array(
				'label'      => esc_html__( 'Navigation', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'navigation_background_color',
			[
				'label' => __( 'Navigation Background Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .testimonial-carousel .owl-next, .testimonial-carousel .owl-prev' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'navigation_color',
		    [
		        'label' => __( 'Navigation Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .owl-next .arrow-right' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonials-slider-wrapper .testimonial-carousel .owl-prev .arrow-left' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'navigation_hover_background_color',
		    [
		        'label' => __( 'Navigation Hover Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .testimonial-carousel .owl-next:hover, .testimonial-carousel .owl-prev:hover' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
			'navigation_hover_color',
			[
				'label' => __( 'Navigation Hover Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .testimonial-carousel .owl-next:hover .arrow-right:after, .testimonial-carousel .owl-prev:hover .arrow-left:after' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'navigation_position',
			[
				'label' => __( 'Navigation Position', 'grandconference-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .testimonial-carousel .owl-nav' => 'top: {{TOP}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-carousel .owl-nav' => 'right: {{RIGHT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-carousel .owl-nav' => 'left: {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-carousel .owl-nav' => 'bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/testimonial-slider/index.php');
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		return '';
	}
}
