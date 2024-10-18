<?php
namespace GrandConferenceElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor WooCommerce Grid
 *
 * Elementor widget for video posts
 *
 * @since 1.0.0
 */
class GrandConference_WooCommerce_Grid extends Widget_Base {

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
		return 'grandconference-woocommerce-grid';
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
		return __( 'Product Grid', 'grandconference-elementor' );
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
		return [ 'grandconference-elementor' ];
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
	public function get_product_categories() {
		//Get all Woocommerce product categories
		$taxonomy     = 'product_cat';
		$orderby      = 'name';  
		$show_count   = 0;      
		$pad_counts   = 0;      
		$hierarchical = 1;  
		$title        = '';  
		$empty        = 0;
		
		$args = array(
		       'taxonomy'     => $taxonomy,
		       'orderby'      => $orderby,
		       'show_count'   => $show_count,
		       'pad_counts'   => $pad_counts,
		       'hierarchical' => $hierarchical,
		       'title_li'     => $title,
		       'hide_empty'   => $empty
		);
		$categories_arr = get_categories( $args );
		$tg_categories_select = array(
			'' => __( 'All Products', 'grandconference-elementor' )
		);
		
		foreach ($categories_arr as $cat) {
			$tg_categories_select[$cat->term_id] = $cat->name; //Or use category_nicename
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
		                'max' => 3,
		                'step' => 1,
		            ]
		        ],
		    ]
		);
		
		$this->add_control(
		    'limit',
		    [
		        'label' => __( 'Items', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 6,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 300,
		                'step' => 1,
		            ]
		        ],
		    ]
		);
		
		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'popularity',
			    'options' => [
			     	'menu_order'  		=> __( 'Default', 'grandconference-elementor' ),
			     	'popularity' 		=> __( 'Popularity', 'grandconference-elementor' ),
			     	'date' 				=> __( 'Date', 'grandconference-elementor' ),
			     	'id' 				=> __( 'Product ID', 'grandconference-elementor' ),
			     	'rand'   			=> __( 'Random', 'grandconference-elementor' ),
			     	'rating'   			=> __( 'Rating', 'grandconference-elementor' ),
			     	'title'   			=> __( 'Title', 'grandconference-elementor' ),
			    ],
			]
		);
		
		$this->add_control(
			'category',
			[
				'label' => __( 'Category', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
			    'options' => $this->get_product_categories(),
			    'multiple' => true,
			]
		);
		
		$this->add_control(
			'on_sale',
			[
				'label' => __( 'Show On Sale Products only', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Image Border Radius', 'grandconference-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .woocommerce ul.products li.product a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} ul.products li.product h2.woocommerce-loop-product__title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} ul.products li.product h2.woocommerce-loop-product__title',
			]
		);
		
		$this->add_control(
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
		            '{{WRAPPER}} ul.products li.product' => 'text-align: {{VALUE}}',
		        ],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_price_style',
			array(
				'label'      => esc_html__( 'Price', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'price_color',
		    [
		        'label' => __( 'Price Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} ul.products li.product span.price' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __( 'Sub Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} ul.products li.product span.price',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_on_sale_style',
			array(
				'label'      => esc_html__( 'On Sale', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'on_sale_bg_color',
		    [
		        'label' => __( 'One Sale Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#D22226',
		        'selectors' => [
		            '{{WRAPPER}} ul.products li.product .onsale' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'on_sale_color',
		    [
		        'label' => __( 'One Sale Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} ul.products li.product .onsale' => 'color: {{VALUE}}',
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
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Button Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} ul.products li.product a.button',
			]
		);
		
		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => __( 'Button Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} ul.products li.product a.button' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_border_color',
		    [
		        'label' => __( 'Button Border Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} ul.products li.product a.button' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_color',
		    [
		        'label' => __( 'Button Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} ul.products li.product a.button' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => __( 'Button Hover Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} ul.products li.product a.button:hover' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_hover_border_color',
		    [
		        'label' => __( 'Button Hover Border Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} ul.products li.product a.button:hover' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_hover_color',
		    [
		        'label' => __( 'Button Hover Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} ul.products li.product a.button:hover' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __( 'Button Border Radius', 'grandconference-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} ul.products li.product a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/woocommerce-grid/index.php');
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
