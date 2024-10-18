<?php
namespace GrandConferenceElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Event Grid
 *
 * Elementor widget for team member posts
 *
 * @since 1.0.0
 */
class GrandConference_Event_Grid extends Widget_Base {

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
		return 'grandconference-event-grid';
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
		return __( 'Event Grid', 'grandconference-elementor' );
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
		return [ 'imagesloaded', 'grandconference-elementor' ];
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
				'options' => grandconference_get_event_cat(),
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
					'size' => 9,
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
		                'min' => 2,
		                'max' => 4,
		                'step' => 1,
		            ]
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
			     	'large' => __( 'Original Dimension', 'grandconference-elementor' ),
			    ]
			]
		);
		
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Image Border Radius', 'grandconference-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .portfolio-classic-grid-wrapper .portfolio-classic-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .portfolio-classic-grid-wrapper .portfolio-classic-img .curl' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'label' => __( 'Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} div.portfolio-classic-content h3.portfolio-classic_title',
			]
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-classic-content h3.portfolio-classic_title' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .portfolio-classic-content h3.portfolio-classic_title a' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .portfolio-classic-content h3.portfolio-classic_title a:hover' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		/*$this->add_control(
			'title_text_align',
			[
				'label' => __( 'Alignment', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'grandconference-elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'grandconference-elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'grandconference-elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
		            '{{WRAPPER}} div.portfolio-classic-content h3.portfolio-classic_title' => 'text-align: {{VALUE}}',
		            '{{WRAPPER}} div.portfolio-classic-content .portfolio-classic-subtitle' => 'text-align: {{VALUE}}',
		            '{{WRAPPER}} .portfolio-classic-grid-wrapper' => 'text-align: {{VALUE}}',
		        ],
			]
		);*/
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_description_style',
			array(
				'label'      => esc_html__( 'Description', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'description_color',
		    [
		        'label' => __( 'Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-classic-grid-wrapper .portfolio-classic-content .portfolio-classic-description' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .portfolio-classic-grid-wrapper .portfolio-classic-content .portfolio-classic-description',
			]
		);
		
		$this->add_control(
			'excerpt_length',
			[
				'label' => __( 'Excerpt Length', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					]
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_meta_style',
			array(
				'label'      => esc_html__( 'Meta', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'meta_data_color',
			[
				'label' => __( 'Meta Data Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .portfolio-classic-grid-wrapper .portfolio-classic-content .portfolio-classic-meta-data' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_data_typography',
				'label' => __( 'Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .portfolio-classic-grid-wrapper .portfolio-classic-content .portfolio-classic-meta-data',
			]
		);
		
		$this->add_control(
			'meta_icon_color',
			[
				'label' => __( 'Meta Icon Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222222',
				'selectors' => [
					'{{WRAPPER}} .portfolio-classic-grid-wrapper .portfolio-classic-content span:not(.portfolio-classic-meta-data)' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'meta_icon_size',
			[
				'label' => __( 'Meta Icon Size', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-classic-grid-wrapper .portfolio-classic-content span:not(.portfolio-classic-meta-data)' => 'font-size: {{SIZE}}{{UNIT}};',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/event-grid/index.php');
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
