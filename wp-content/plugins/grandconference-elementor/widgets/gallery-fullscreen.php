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
class GrandConference_Gallery_Fullscreen extends Widget_Base {

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
		return 'grandconference-gallery-fullscreen';
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
		return __( 'Fullscreen Gallery', 'grandconference-elementor' );
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
		return 'eicon-slider-full-screen';
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
		return [ 'grandconference-elementor' ];
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
		
		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
					'unit' => 'vh'
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 2000,
						'step' => 5,
					]
				],
				'size_units' => [ 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .fullscreen-gallery-wrapper' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_image',
			array(
				'label'      => esc_html__( 'Image', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'size',
			[
				'label' => __( 'Image Size', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
			    'options' => [
			     	'contain' => __( 'Contain', 'grandconference-elementor' ),
			     	'cover' => __( 'Cover', 'grandconference-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
			'slideshow_content',
			[
				'label' => __( 'Image Content', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'title',
			    'options' => [
			     	'title' => __( 'Title', 'grandconference-elementor' ),
			     	'caption' => __( 'Caption', 'grandconference-elementor' ),
			     	'description' 	=> __( 'Description', 'grandconference-elementor' ),
			    ],
			    'multiple' => true
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_transition',
			array(
				'label'      => esc_html__( 'Transition', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'effect',
			[
				'label' => __( 'Transition Effect', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
			    'options' => [
			     	'slide' => __( 'Slide', 'grandconference-elementor' ),
			     	'fade' => __( 'Fade', 'grandconference-elementor' ),
			     	'cube' => __( 'Cube', 'grandconference-elementor' ),
			     	'coverflow' => __( 'Coverflow', 'grandconference-elementor' ),
			     	'flip' => __( 'Flip', 'grandconference-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
		    'transition_speed',
		    [
		        'label' => __( 'Transition Speed (in milli-seconds)', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 400,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 100,
		                'max' => 3000,
		                'step' => 100,
		            ]
		        ],
		        'size_units' => [ 'px' ]
		    ]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_navigation',
			array(
				'label'      => esc_html__( 'Navigation', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'show_navigation',
			[
				'label' => __( 'Show Navigation', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'hover',
			    'options' => [
			     	'hover' => __( 'On Hover', 'grandconference-elementor' ),
			     	'always' => __( 'Always', 'grandconference-elementor' ),
			     	'hide' => __( 'Hide', 'grandconference-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
		    'navigation_color',
		    [
		        'label' => __( 'Navigation Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .swiper-button-next i' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .swiper-button-prev i' => 'color: {{VALUE}}',
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
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .gallery-fullscreen-content .gallery-fullscreen-title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .swiper-slide .gallery-fullscreen-content .gallery-fullscreen-title',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_caption_style',
			array(
				'label'      => esc_html__( 'Caption', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'caption_color',
		    [
		        'label' => __( 'Caption Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .gallery-fullscreen-content .gallery-fullscreen-caption' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'label' => __( 'Caption Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .swiper-slide .gallery-fullscreen-content .gallery-fullscreen-caption',
			]
		);
		
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
		        'label' => __( 'Description Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .gallery-fullscreen-content .gallery-fullscreen-description' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
			'description_border_color',
			[
				'label' => __( 'Description Border Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .gallery-fullscreen-content .gallery-fullscreen-description' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Description Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .swiper-slide .gallery-fullscreen-content .gallery-fullscreen-description',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/gallery-fullscreen/index.php');
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
