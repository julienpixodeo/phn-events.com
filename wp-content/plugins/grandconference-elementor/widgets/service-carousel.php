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
class GrandConference_Service_Carousel extends Widget_Base {

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
		return 'grandconference-service-carousel';
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
		return __( 'Service Carousel', 'grandconference-elementor' );
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
		return 'eicon-slider-3d';
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
		
		/**
		*
		*	Begin slides repeat list
		*
		**/
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'slide_image', [
				'label' => __( 'Featured Image', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slide_title', [
				'label' => __( 'Title', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_description', [
				'label' => __( 'Description', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_link_title', [
				'label' => __( 'Link Title', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_link', [
				'label' => __( 'Link URL', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			]
		);
		
		$this->add_control(
			'slides',
			[
				'label' => __( 'Services', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ slide_title }}}',
			]
		);
		
		/**
		*
		*	End slides repeat list
		*
		**/
		
		$this->add_control(
			'ini_item',
			[
				'label' => __( 'Initials Items', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 4,
				],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 5,
						'step' => 1,
					]
				],
				'size_units' => [ 'px' ]
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_options',
			[
				'label' => __( 'Options', 'grandconference-elementor' ),
			]
		);
		
		$this->add_control(
			'service_style',
			[
				'label' => __( 'Layout Style', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1'  => __( 'Style 1', 'grandconference-elementor' ),
					'style2' => __( 'Style 2', 'grandconference-elementor' ),
				],
			]
		);
		
		$this->add_responsive_control(
			'grid_height',
			[
				'label' => __( 'Height', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'selectors' => [
					'{{WRAPPER}} .service-carousel-wrapper.style2 .item' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'service_style' => 'style2',
				],
			]
		);
		
		$this->add_control(
			'image_dimension',
			[
				'label'       => esc_html__( 'Image Dimension', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grandconference-gallery-grid',
				'options' => [
					 'grandconference-gallery-grid' => __( 'Landscape', 'grandconference-elementor' ),
					 'grandconference-gallery-list' => __( 'Square', 'grandconference-elementor' ),
					 'grandconference-album-grid' => __( 'Portrait', 'grandconference-elementor' ),
					 'medium_large' => __( 'Original', 'grandconference-elementor' ),
				]
			]
		);
		
		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Image Border Radius', 'grandconference-elementor' ),
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
					'{{WRAPPER}} .service-carousel-wrapper .service-carousel-image .service-carousel-image-overflow' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .service-carousel-wrapper.style2 .item' => 'border-radius: {{SIZE}}{{UNIT}};',
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
		
		$this->add_control(
			'pagination',
			[
				'label' => __( 'Show Pagination', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'stage_padding',
			[
				'label' => __( 'Stage Padding', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 5,
					]
				],
				'size_units' => [ 'px' ]
			]
		);
		
		$this->add_control(
			'item_margin',
			[
				'label' => __( 'Item Margin', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 5,
					]
				],
				'size_units' => [ 'px' ]
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_title_style',
			array(
				'label'      => esc_html__( 'Title', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .service-carousel-wrapper .service-carousel-title',
			]
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#111111',
		        'selectors' => [
		            '{{WRAPPER}} .service-carousel-wrapper .service-carousel-title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_title',
				'label' => __( 'Title Background Hover', 'grandconference-elementor' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .service-carousel-wrapper.style2 .item:hover:before',
				'condition' => [
					'service_style' => 'style2',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_desc_style',
			array(
				'label'      => esc_html__( 'Description', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Description Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .service-carousel-wrapper .service-carousel-desc',
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#86868B',
				'selectors' => [
					'{{WRAPPER}} .service-carousel-wrapper .service-carousel-desc' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_button_style',
			array(
				'label'      => esc_html__( 'Button', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'button_bg_color',
			[
				'label' => __( 'Button Background Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .service-carousel-wrapper .service-carousel-link-button' => 'background: {{VALUE}}',
					'{{WRAPPER}} .service-carousel-wrapper.style2 .item:hover .item-content .button' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Button Border Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .service-carousel-wrapper .service-carousel-link-button' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .service-carousel-wrapper.style2 .item:hover .item-content .button' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_font_color',
			[
				'label' => __( 'Button Font Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .service-carousel-wrapper .service-carousel-link-button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .service-carousel-wrapper.style2 .item:hover .item-content .button' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Button Hover Border Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1C58F6',
				'selectors' => [
					'{{WRAPPER}} .service-carousel-wrapper .service-carousel-link-button:before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .service-carousel-wrapper.style2 .item:hover .item-content .button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => __( 'Button Hover Background Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1C58F6',
				'selectors' => [
					'{{WRAPPER}} .service-carousel-wrapper .service-carousel-link-button:before' => 'background: {{VALUE}}',
					'{{WRAPPER}} .service-carousel-wrapper.style2 .item:hover .item-content .button:hover' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_hover_font_color',
			[
				'label' => __( 'Button Hover Font Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .service-carousel-wrapper .item:hover .service-carousel-link-button .service-carousel-link-label' => 'color: {{VALUE}}',
					'{{WRAPPER}} .service-carousel-wrapper.style2 .item:hover .item-content .button:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Button Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .service-carousel-wrapper .item .service-carousel-link-button .service-carousel-link-label, {{WRAPPER}} .service-carousel-wrapper.style2 .item .item-content .button'
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_pagination_style',
			array(
				'label'      => esc_html__( 'Pagination', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'pagination_color',
		    [
		        'label' => __( 'Pagination Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#cccccc',
		        'selectors' => [
		            '{{WRAPPER}} .service-carousel-wrapper .owl-carousel .owl-dots .owl-dot span' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'pagination_active_color',
		    [
		        'label' => __( 'Pagination Active Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .service-carousel-wrapper .owl-carousel .owl-dots .owl-dot.active span' => 'background: {{VALUE}}',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/service-carousel/index.php');
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
