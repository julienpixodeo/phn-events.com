<?php
namespace GrandConferenceElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Portfolio Classic
 *
 * Elementor widget for portfolio posts
 *
 * @since 1.0.0
 */
class GrandConference_Pricing_Table extends Widget_Base {

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
		return 'grandconference-pricing-table';
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
		return __( 'Pricing Table', 'grandconference-elementor' );
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
		return 'eicon-price-table';
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
		return [ 'switchery', 'grandconference-elementor' ];
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
			'slide_title', [
				'label' => __( 'Title', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_price_month', [
				'label' => __( 'Price', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( '$10' , 'grandconference-elementor' ),
			]
		);
		
		$repeater->add_control(
			'slide_features', [
				'label' => __( 'Features', 'grandconference-elementor' ),
				'description' => __( 'Enter each feature seperate by enter (new line)', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_button_title', [
				'label' => __( 'Button Title', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'slide_button_link', [
				'label' => __( 'Button Link URL', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
			]
		);
		
		$repeater->add_control(
			'slide_featured', [
				'label' => __( 'Mark as Featured Plan', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'slides',
			[
				'label' => __( 'Plans', 'grandconference-elementor' ),
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
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_plan_style',
			array(
				'label'      => esc_html__( 'Plan', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_responsive_control(
		    'plan_padding',
		    [
		        'label' => __( 'Plan Content Padding', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 60,
		            'unit' => 'px',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 200,
		                'step' => 5,
		            ]
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper .inner-wrap .overflow-inner' => 'padding: {{SIZE}}{{UNIT}}',
		        ],
		    ]
		);
		
		$this->add_responsive_control(
			'plan_border_radius',
			[
				'label' => __( 'Plan Border Radius', 'grandconference-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-table-wrapper .inner-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
		    'plan_bg_color',
		    [
		        'label' => __( 'Plan Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper .inner-wrap' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'plan_border_color',
		    [
		        'label' => __( 'Plan Border Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper .inner-wrap' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'plan_hover_bg_color',
		    [
		        'label' => __( 'Plan Hover Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper .inner-wrap:hover' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'plan_hover_border_color',
		    [
		        'label' => __( 'Plan Hover Border Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper .inner-wrap:hover' => 'border-color: {{VALUE}}',
		            '{{WRAPPER}} .pricing-table-wrapper .inner-wrap:hover .overflow-inner' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'plan_featured_bg_color',
		    [
		        'label' => __( 'Featured Plan Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper.featured-pricing-plan .inner-wrap' => 'background: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'plan_featured_border_color',
		    [
		        'label' => __( 'Featured Plan Border Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper.featured-pricing-plan .inner-wrap' => 'border-color: {{VALUE}}',
		             '{{WRAPPER}} .pricing-table-wrappe.featured-pricing-planr .inner-wrap .overflow-inner' => 'border-color: {{VALUE}}',
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
		            '{{WRAPPER}} .pricing-table-wrapper h2.pricing-plan-title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => __( 'Title Hover Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper:hover h2.pricing-plan-title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'title_featured_color',
		    [
		        'label' => __( 'Featured Plan Title Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper.featured-pricing-plan h2.pricing-plan-title' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .pricing-table-wrapper h2.pricing-plan-title',
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
		            '{{WRAPPER}} .pricing-plan-price-wrap h3.pricing-plan-price' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .pricing-plan-price-wrap' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'price_hover_color',
		    [
		        'label' => __( 'Price Hover Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper:hover h3.pricing-plan-price' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'price_featured_color',
		    [
		        'label' => __( 'Featured Plan Price Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper.featured-pricing-plan h3.pricing-plan-price' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .pricing-table-wrapper.featured-pricing-plan .pricing-plan-unit-month' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .pricing-table-wrapper.featured-pricing-plan .pricing-plan-unit-year' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __( 'Price Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .pricing-plan-price-wrap h3.pricing-plan-price',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_features_style',
			array(
				'label'      => esc_html__( 'Features', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'features_color',
		    [
		        'label' => __( 'Features Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper .pricing-plan-content-list' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'features_icon_color',
		    [
		        'label' => __( 'Check Icon Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-plan-content ul.pricing-plan-content-list li:before' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'features_hover_color',
		    [
		        'label' => __( 'Features Hover Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper:hover .pricing-plan-content-list' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'features_featured_color',
		    [
		        'label' => __( 'Featured Plan Features Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-table-wrapper.featured-pricing-plan .pricing-plan-content-list' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_typography',
				'label' => __( 'Features Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .pricing-table-wrapper .pricing-plan-content-list',
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
		    'button_color',
		    [
		        'label' => __( 'Button Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-plan-content .pricing-plan-button' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => __( 'Button Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-plan-content .pricing-plan-button' => 'background: {{VALUE}}',
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
		            '{{WRAPPER}} .pricing-plan-content .pricing-plan-button' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_hover_color',
		    [
		        'label' => __( 'Button Hover Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-plan-content .pricing-plan-button:hover' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => __( 'Button Hover Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .pricing-plan-content .pricing-plan-button:hover' => 'background: {{VALUE}}',
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
		            '{{WRAPPER}} .pricing-plan-content .pricing-plan-button:hover' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Button Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .pricing-plan-content .pricing-plan-button',
			]
		);
		
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __( 'Button Border Radius', 'grandconference-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-content .pricing-plan-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/pricing-table/index.php');
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
