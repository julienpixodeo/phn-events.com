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
class GrandConference_Blog_Carousel extends Widget_Base {

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
		return 'grandconference-blog-carousel';
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
		return __( 'Blog Carousel', 'grandconference-elementor' );
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
	 * Retrieve blog post categories
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Blog categories
	 */
	public function get_blog_categories() {
		//Get all categories
		$categories_arr = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );
		$tg_categories_select = array();
		
		foreach ($categories_arr as $cat) {
			$tg_categories_select[$cat->term_id] = $cat->name;
		}

		return $tg_categories_select;
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
			'layout_style',
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
		
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'All Items', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 6,
				],
				'range' => [
					'px' => [
						'min' => -1,
						'max' => 100,
						'step' => 1,
					]
				],
			]
		);
		
		$this->add_control(
			'categories',
			[
				'label' => __( 'Categories', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $this->get_blog_categories(),
				'multiple' => true,
			]
		);
		
		$this->add_control(
			'show_categories',
			[
				'label' => __( 'Show Post Categories', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'show_featured_image',
			[
				'label' => __( 'Show Featured Image', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'show_date',
			[
				'label' => __( 'Show Post Date', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'show_date_block',
			[
				'label' => __( 'Show Post Date Block', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'text_display',
			[
				'label' => __( 'Text Display', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'excerpt',
				'options' => [
					 'excerpt' => __( 'Excerpt', 'grandconference-elementor' ),
					 'full_content' => __( 'Full Content', 'grandconference-elementor' ),
					 'no_text' => __( 'No text', 'grandconference-elementor' ),
				],
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
		
		$this->add_control(
			'strip_html',
			[
				'label' => __( 'Strip HTML from Post Content', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'show_continue',
			[
				'label' => __( 'Show Continue Reading', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
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
					'{{WRAPPER}} .post-featured-image-hover' => 'border-radius: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .post-background-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
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
				'label' => __( 'Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .blog-carousel-wrapper .post-header h5',
			]
		);
		
		$this->add_control(
		    'title_color',
		    [
		        'label' => __( 'Title Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#111111',
		        'selectors' => [
		            '{{WRAPPER}} .blog-carousel-wrapper .post-header h5 a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .blog-carousel-wrapper a.continue-reading:before, {{WRAPPER}} .blog-carousel-wrapper a.continue-reading:after' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_meta_style',
			array(
				'label'      => esc_html__( 'Post Meta', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => __( 'Post Meta Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .blog-carousel-wrapper .post-detail.single-post',
			]
		);
		
		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Post Meta Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#86868b',
				'selectors' => [
					'{{WRAPPER}} .blog-carousel-wrapper .post-detail.single-post a, {{WRAPPER}} .blog-carousel-wrapper .post-detail.single-post' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_desc_style',
			array(
				'label'      => esc_html__( 'Excerpt', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Excerpt Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .blog-carousel-wrapper .post-header-wrapper',
			]
		);
		
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Excerpt Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#86868B',
				'selectors' => [
					'{{WRAPPER}} .blog-carousel-wrapper .post-header-wrapper' => 'color: {{VALUE}}',
				],
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
		            '{{WRAPPER}} .blog-carousel-wrapper .owl-carousel .owl-dots .owl-dot span' => 'background: {{VALUE}}',
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
		            '{{WRAPPER}} .blog-carousel-wrapper .owl-carousel .owl-dots .owl-dot.active span' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_date_style',
			array(
				'label'      => esc_html__( 'Date & Month', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => __( 'Date & Month Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .post-featured-date-wrapper',
			]
		);
		
		$this->add_control(
			'date_border_radius',
			[
				'label' => __( 'Date & Month Border Radius', 'grandconference-elementor' ),
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
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}} .post-featured-date-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'date_bg_color',
			[
				'label' => __( 'Date & Month Background Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .post-featured-date-wrapper' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'date_color',
			[
				'label' => __( 'Date Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .post-featured-date' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'month_color',
			[
				'label' => __( 'Month Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .post-featured-month' => 'color: {{VALUE}}',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/blog-carousel/index.php');
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
