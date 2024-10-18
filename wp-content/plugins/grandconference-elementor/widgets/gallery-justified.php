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
class GrandConference_Gallery_Justified extends Widget_Base {

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
		return 'grandconference-gallery-justified';
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
		return __( 'Justified Gallery', 'grandconference-elementor' );
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
		return 'eicon-gallery-justified';
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
		return [ 'tilt', 'justifiedGallery', 'grandconference-elementor' ];
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
		    'row_height',
		    [
		        'label' => __( 'Row Height', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 150,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 20,
		                'max' => 300,
		                'step' => 5,
		            ]
		        ],
		        'size_units' => [ 'px' ]
		    ]
		);
		
		$this->add_control(
		    'margin',
		    [
		        'label' => __( 'Margin', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 5,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 80,
		                'step' => 1,
		            ]
		        ],
		        'size_units' => [ 'px' ]
		    ]
		);
		
		$this->add_control(
		    'border',
		    [
		        'label' => __( 'Border Width', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 0,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 40,
		                'step' => 1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .grandconference-gallery-grid-content-wrapper .gallery-grid-item' => 'border-width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_control(
			'border_radius',
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
					'{{WRAPPER}} .grandconference-gallery-grid-content-wrapper .gallery-grid-item' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
		    'border_color',
		    [
		        'label' => __( 'Border Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .grandconference-gallery-grid-content-wrapper div.gallery-grid-item' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
			'justify_last_row',
			[
				'label' => __( 'Justify Last Row', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'hover_effect',
			[
				'label' => __( 'Hover Effect', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'show_title',
			[
				'label' => __( 'Show Title on Hover', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'lightbox',
			[
				'label' => __( 'Image Lightbox', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'lightbox_content',
			[
				'label' => __( 'Lightbox Content', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'title',
			    'options' => [
			     	'title' => __( 'Title', 'grandconference-elementor' ),
			     	'title_caption' => __( 'Title and Caption', 'grandconference-elementor' ),
			     	'none' 	=> __( 'None', 'grandconference-elementor' ),
			    ],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_style',
			array(
				'label'      => esc_html__( 'Content', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'background_overlay',
		    [
		        'label' => __( 'Background Overlay', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => 'rgba(0,0,0,0.2)',
		        'selectors' => [
		            '{{WRAPPER}} .grandconference-gallery-grid-content-wrapper .gallery-grid-item:hover .bg-overlay' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .grandconference-gallery-grid-content-wrapper .gallery-grid-item:hover .gallery-grid-title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .grandconference-gallery-grid-content-wrapper .gallery-grid-item .gallery-grid-title',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/gallery-justified/index.php');
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
