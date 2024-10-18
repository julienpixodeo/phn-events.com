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
class GrandConference_Slider_Multi_Layouts extends Widget_Base {

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
		return 'grandconference-slider-multi-layouts';
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
		return __( 'Multi Layouts Slider', 'grandconference-elementor' );
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
		return 'eicon-post-slider';
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
		return [ 'anime', 'imagesloaded', 'mls', 'grandconference-elementor' ];
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
				'label' => __( 'Image', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'image_size', [
				'label' => __( 'Image Size', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'full',
				'options' => [
					 'medium_large' => __( 'Medium (default 768px x 768px max)', 'grandconference-elementor' ),
					 'large' => __( 'Large (default 1024px x 1024px max)', 'grandconference-elementor' ),
					 'full' => __( 'Original image resolution', 'grandconference-elementor' ),
				],
			]
		);
		
		$repeater->add_control(
			'slide_layout', [
				'label' => __( 'Layout', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 1,
				'options' => [
					 1 => __( 'Layout 1', 'grandconference-elementor' ),
					 2 => __( 'Layout 2', 'grandconference-elementor' ),
					 3 => __( 'Layout 3', 'grandconference-elementor' ),
					 4 => __( 'Layout 4', 'grandconference-elementor' ),
					 5 => __( 'Layout 5', 'grandconference-elementor' ),
					 6 => __( 'Layout 6', 'grandconference-elementor' ),
					 7 => __( 'Layout 7', 'grandconference-elementor' ),
				 ],
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
				'label' => __( 'Slides', 'grandconference-elementor' ),
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
		    'width',
		    [
		        'label' => __( 'Width', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 100,
		            'unit' => '%',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 100,
		                'max' => 1600,
		                'step' => 5,
		            ],
		            '%' => [
		                'min' => 10,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .multi-layouts-slider-wrapper.slideshow' => 'width: {{SIZE}}{{UNIT}} !important',
		        ],
		    ]
		);
		
		$this->add_control(
		    'height',
		    [
		        'label' => __( 'Height', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 800,
		            'unit' => 'px',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 100,
		                'max' => 1000,
		                'step' => 5,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'size_units' => [ 'px', '%' ],
		    ]
		);
		
		$this->add_control(
		    'opacity',
		    [
		        'label' => __( 'Images Opacity', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 0.5,
		            'unit' => 'px',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0.1,
		                'max' => 1,
		                'step' => 0.1,
		            ],
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .multi-layouts-slider-wrapper .slide-imgwrap' => 'opacity: {{SIZE}}',
		        ],
		    ]
		);
		
		$this->add_control(
			'align',
			[
				'label' => __( 'Alignment', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center',
			    'options' => [
			     	'left' => __( 'Left', 'grandconference-elementor' ),
			     	'center' => __( 'Center', 'grandconference-elementor' ),
			     	'right' => __( 'Right', 'grandconference-elementor' ),
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
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .multi-layouts-slider-wrapper .slide-title-main' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .multi-layouts-slider-wrapper h2.slide-title-main',
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
		    'description_color',
		    [
		        'label' => __( 'Description Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .multi-layouts-slider-wrapper .slide-title-sub' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __( 'Description Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .multi-layouts-slider-wrapper p.slide-title-sub',
			]
		);
		
		$this->add_control(
		    'link_font_color',
		    [
		        'label' => __( 'Link Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#1C58F6',
		        'selectors' => [
		            '{{WRAPPER}} .multi-layouts-slider-wrapper .slide-title .slide-title-sub .tg_multi_layouts_slide_link' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .multi-layouts-slider-wrapper .slide-title p.slide-title-sub .tg_multi_layouts_slide_link' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'label' => __( 'Link Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} div.multi-layouts-slider-wrapper .slide-title .slide-title-sub .tg_multi_layouts_slide_link',
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
		    'nav_color',
		    [
		        'label' => __( 'Navigation Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#222222',
		        'selectors' => [
		            '{{WRAPPER}} .multi-layouts-slider-wrapper .btn' => 'color: {{VALUE}}',
		            '.js {{WRAPPER}} .multi-layouts-slider-wrapper::after' => 'border-top-color: {{VALUE}}',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/slider-multi-layouts/index.php');
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
