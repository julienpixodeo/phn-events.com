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
class GrandConference_Gallery_Animated extends Widget_Base {

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
		return 'grandconference-gallery-animated';
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
		return __( 'Animated Gallery', 'grandconference-elementor' );
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
		return 'eicon-gallery-grid';
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
		return [ 'modernizr', 'gridrotator', 'grandconference-elementor' ];
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
			'gallery_content_type',
			[
				'label' => __( 'Gallery Content Type', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'media_library',
				'options' => [
					 'media_library' => __( 'Media Library', 'grandconference-elementor' ),
					 'gallery_post' => __( 'Gallery Post Type', 'grandconference-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'gallery',
			 [
				'label' => __( 'Add Images', 'grandconference-elementor' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
				'condition' => [
					'gallery_content_type' => 'media_library',
				],
			]
		);
		
		$this->add_control(
			'gallery_id',
			[
				'label' => __( 'Gallery', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'options' => grandconference_get_galleries(),
				'multiple' => false,
				'condition' => [
					'gallery_content_type' => 'gallery_post',
				],
			]
		);
		
		$this->add_control(
			'sort',
			[
				'label'       => esc_html__( 'Images Sorting', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'drag',
				'options' => [
					 'drag' => __( 'Default Gallery Images', 'grandconference-elementor' ),
					 'post_date' => __( 'Newest', 'grandconference-elementor' ),
					 'post_date_old' => __( 'Oldest', 'grandconference-elementor' ),
					 'rand' => __( 'Random', 'grandconference-elementor' ),
					 'title' => __( 'Title', 'grandconference-elementor' ),
				],
				'condition' => [
					'gallery_content_type' => 'gallery_post',
				],
			]
		);

		$this->add_control(
		    'columns',
		    [
		        'label' => __( 'Columns', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 7,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 15,
		                'step' => 1,
		            ]
		        ],
		    ]
		);
		
		$this->add_control(
			'rows',
			[
				'label' => __( 'Rows', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 30,
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
				'default' => 'grandconference-gallery-list',
			    'options' => [
			     	'grandconference-gallery-list' => __( 'Square', 'grandconference-elementor' ),
					 'medium_large' => __( 'Original', 'grandconference-elementor' ),
			    ]
			]
		);
		
		$this->add_control(
			'animation_type',
			[
				'label'       => esc_html__( 'Animation Type', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'random',
				'options' => [
					 'random' => __( 'Random', 'grandconference-elementor' ),
					 'showHide' => __( 'Show Hide', 'grandconference-elementor' ),
					 'fadeInOut' => __( 'Fade In/Out', 'grandconference-elementor' ),
					 'slideLeft' => __( 'Slide Left', 'grandconference-elementor' ),
					 'slideRight' => __( 'Slide Right', 'grandconference-elementor' ),
					 'slideTop' => __( 'Slide Top', 'grandconference-elementor' ),
					 'slideBottom' => __( 'Slide Bottom', 'grandconference-elementor' ),
					 'rotateLeft' => __( 'Rotate Left', 'grandconference-elementor' ),
					 'rotateRight' => __( 'Rotate Right', 'grandconference-elementor' ),
					 'rotateTop' => __( 'Rotate Top', 'grandconference-elementor' ),
					 'rotateBottom' => __( 'Rotate Bottom', 'grandconference-elementor' ),
					 'scale' => __( 'Scale', 'grandconference-elementor' ),
					 'rotate3d' => __( 'Rotate 3D', 'grandconference-elementor' ),
					 'rotateLeftScale' => __( 'Rotate Left Scale', 'grandconference-elementor' ),
					 'rotateRightScale' => __( 'Rotate Right Scale', 'grandconference-elementor' ),
					 'rotateTopScale' => __( 'Rotate Top Scale', 'grandconference-elementor' ),
					 'rotateBottomScale' => __( 'Rotate Bottom Scale', 'grandconference-elementor' ),
				]
			]
		);
		
		$this->add_control(
			'animation_speed',
			[
				'label' => __( 'Animation Speed (in milliseconds)', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 8000,
						'step' => 100,
					]
				],
				'size_units' => [ 'px' ],

			]
		);
		
		$this->add_control(
			'interval_time',
			[
				'label' => __( 'Interval Time (in milliseconds)', 'grandconference-elementor' ),
				'description' => __( 'Images will be replaced every selected interval time', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 3000,
				],
				'range' => [
					'px' => [
						'min' => 500,
						'max' => 20000,
						'step' => 100,
					]
				],
				'size_units' => [ 'px' ],

			]
		);
		
		$this->add_control(
		    'background_color',
		    [
		        'label' => __( 'Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .grandconference-gallery-animated-content-wrapper.ri-grid ul li a, {{WRAPPER}} .grandconference-gallery-animated-content-wrapper.ri-grid ul li' => 'background: {{VALUE}}',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/gallery-animated/index.php');
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
