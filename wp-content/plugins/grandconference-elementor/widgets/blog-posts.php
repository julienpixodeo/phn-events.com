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
class GrandConference_Blog_Posts extends Widget_Base {

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
		return 'grandconference-blog-posts';
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
		return __( 'Blog Posts', 'grandconference-elementor' );
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
		return 'eicon-post-list';
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
		return [ 'sticky', 'masonry', 'grandconference-elementor' ];
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
			'layout',
			[
				'label' => __( 'Layout', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'classic',
			    'options' => [
			     	'classic'  			=> __( 'Classic', 'grandconference-elementor' ),
			     	'grid' 				=> __( 'Grid', 'grandconference-elementor' ),
			     	'grid_no_space' 	=> __( 'Grid Overlay', 'grandconference-elementor' ),
			     	'masonry' 			=> __( 'Masonry', 'grandconference-elementor' ),
			     	'list'   			=> __( 'List', 'grandconference-elementor' ),
			     	'metro'   			=> __( 'Metro', 'grandconference-elementor' ),
			     	'metro_no_space'   	=> __( 'Metro Overlay', 'grandconference-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
		    'posts_per_page',
		    [
		        'label' => __( 'Posts Per Page', 'grandconference-elementor' ),
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
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_options',
			[
				'label' => __( 'Options', 'grandconference-elementor' ),
			]
		);
		
		$this->add_control(
			'show_categories',
			[
				'label' => __( 'Show Post Meta Data', 'grandconference-elementor' ),
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
		
		$this->add_control(
			'show_pagination',
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
		    'text_align',
		    [
		        'label' => __( 'Text Alignment', 'grandconference-elementor' ),
		        'type' => Controls_Manager::CHOOSE,
		        'options' => [
		            'left'    => [
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
					'{{WRAPPER}} .post-featured-image-hover, {{WRAPPER}} .type-post.blog-posts-grid_no_space, {{WRAPPER}} .type-post.blog-posts-metro_no_space' => 'border-radius: {{SIZE}}{{UNIT}};',
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
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .post-header h5 a' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .post-header h5',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_cat_style',
			array(
				'label'      => esc_html__( 'Post Meta Data', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'cat_color',
		    [
		        'label' => __( 'Post Meta Data Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .post-info-cat a' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cat_typography',
				'label' => __( 'Post Meta Data Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .post-detail.single-post',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_excerpt_style',
			array(
				'label'      => esc_html__( 'Excerpt', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'excerpt_color',
		    [
		        'label' => __( 'Excerpt Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .post-header-wrapper > p' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => __( 'Excerpt Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .post-header-wrapper > p',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_link_style',
			array(
				'label'      => esc_html__( 'Link', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'link_color',
		    [
		        'label' => __( 'Link Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} a.continue-reading' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'label' => __( 'Link Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} a.continue-reading',
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
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_navigation_style',
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
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .pagination a, {{WRAPPER}} .pagination-detail' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'pagination_hover_color',
			[
				'label' => __( 'Pagination Hover Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .pagination a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'pagination_hover_bg_color',
			[
				'label' => __( 'Pagination Hover Background Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FF2D55',
				'selectors' => [
					'{{WRAPPER}} .pagination a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'pagination_active_color',
			[
				'label' => __( 'Pagination Active Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .pagination span.current' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'pagination_active_bg_color',
			[
				'label' => __( 'Pagination Active Background Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#FF2D55',
				'selectors' => [
					'{{WRAPPER}} .pagination span.current' => 'background-color: {{VALUE}}',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/blog-posts/index.php');
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
