<?php
namespace GrandConferenceElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Blog Posts
 *
 * Elementor widget for blog posts
 *
 * @since 1.0.0
 */
class GrandConference_Speaker_Grid extends Widget_Base {

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
		return 'grandconference-speaker-grid';
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
		return __( 'Grid Speaker', 'grandconference-elementor' );
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
		return 'eicon-posts-grid';
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
		return [ 'tilt', 'grandconference-elementor' ];
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
			'speakercat',
			[
				'label' => __( 'Filter by category', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'options' => grandconference_get_speaker_cat(),
				'multiple' => false,
			]
		);
		
		$this->add_control(
			'order',
			[
				'label' => __( 'Order By', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => array(
					'default' 	=> __( 'Default', 'grandconference-elementor' ),
					'newest'	=> __( 'Newest', 'grandconference-elementor' ),
					'oldest'	=> __( 'Oldest', 'grandconference-elementor' ),
					'title'		=> __( 'Title', 'grandconference-elementor' ),
					'random'	=> __( 'Random', 'grandconference-elementor' ),
				),
				'default' => 'default',
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
		    'columns',
		    [
		        'label' => __( 'Columns', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 3,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 5,
		                'step' => 1,
		            ]
		        ],
		    ]
		);
		
		$this->add_control(
			'spacing',
			[
				'label' => __( 'Column Spacing', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
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
			    ]
			]
		);
		
		$this->add_responsive_control(
			'thumbnail_border_radius',
			[
				'label' => __( 'Thumbnail Border Radius', 'grandconference-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .speaker-grid-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_name_style',
			array(
				'label'      => esc_html__( 'Name', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'name_typography',
					'label' => __( 'Name Typography', 'grandconference-elementor' ),
					'selector' => '{{WRAPPER}} .speaker-grid-content h3.speaker-grid-title',
				]
			);
		
		$this->add_control(
			'name_color',
			[
				'label' => __( 'Name Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .speaker-grid-content h3.speaker-grid-title a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'name_hover_color',
			[
				'label' => __( 'Name Hover Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FF2D55',
				'selectors' => [
					'{{WRAPPER}} .speaker-grid-content h3.speaker-grid-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'content_width',
			[
				'label' => __( 'Content Width', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 2000,
						'step' => 5,
					]
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .speaker-grid-content' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => __( 'Content Margin', 'grandconference-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .speaker-grid-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
				
		$this->start_controls_section(
			'section_position_style',
			array(
				'label'      => esc_html__( 'Position', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'position_typography',
				'label' => __( 'Position Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .speaker-grid-content .speaker-grid-subtitle',
			]
		);
		
		$this->add_control(
			'position_color',
			[
				'label' => __( 'Position Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .speaker-grid-content .speaker-grid-subtitle' => 'color: {{VALUE}}',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/speaker-grid/index.php');
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
