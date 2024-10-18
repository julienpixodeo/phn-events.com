<?php
namespace GrandConferenceElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Search
 *
 * Elementor widget for search field
 *
 * @since 1.0.0
 */
class GrandConference_Search_Form extends Widget_Base {

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
		return 'grandconference-search-form';
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
		return __( 'Search Form', 'grandconference-elementor' );
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
		return 'eicon-search';
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
		
		$this->add_responsive_control(
		    'width',
		    [
		        'label' => __( 'Width', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 350,
		            'unit' => 'px',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 5,
		                'max' => 10000,
		                'step' => 5,
		            ]
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper input' => 'width: {{SIZE}}{{UNIT}}',
		        ],
		    ]
		);
		
		$this->add_responsive_control(
		    'height',
		    [
		        'label' => __( 'Height', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 44,
		            'unit' => 'px',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 200,
		                'step' => 51,
		            ]
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper .input-group input' => 'height: {{SIZE}}{{UNIT}}',
		            '{{WRAPPER}} .tg-search-wrapper .input-group .input-group-button button' => 'height: {{SIZE}}{{UNIT}}',
		        ],
		    ]
		);
		
		$this->add_responsive_control(
		    'icon_size',
		    [
		        'label' => __( 'Icon Size', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 16,
		            'unit' => 'px',
		        ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 50,
		                'step' => 1,
		            ]
		        ],
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper .input-group .input-group-button button' => 'font-size: {{SIZE}}{{UNIT}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'search_typography',
				'label' => __( 'Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .tg-search-wrapper input',
			]
		);
		
		$this->add_control(
			'placeholder',
			[
				'label' => __( 'Placeholder Text', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Search for anything', 'grandconference-elementor' ),
			]
		);
		
		$this->add_control(
			'search_event',
			[
				'label' => __( 'Search for Event Only', 'grandconference-elementor' ),
				'description' => 'Activate this option, if you want the search form to search for event post type only',
				'type' => Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'action',
			[
				'label' => __( 'Search Results Page', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'condition' => [
					'search_event' => 'yes',
				],
				'description' => 'By default, search form will redirect to the default search page but you can also create a custom search result page and adding event grid widget there.',
				'options' => grandconference_get_pages(),
				'multiple' => false,
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_autocomplete',
			[
				'label' => __( 'Auto Complete', 'grandconference-elementor' ),
			]
		);
		
		$this->add_control(
			'autocomplete',
			[
				'label' => __( 'Auto Complete', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style',
			array(
				'label'      => esc_html__( 'Styles', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'search_font_color',
		    [
		        'label' => __( 'Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper input' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'search_placeholder_font_color',
		    [
		        'label' => __( 'Placeholder Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#999999',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper input::placeholder' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'search_bg_color',
		    [
		        'label' => __( 'Search Input Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#F0F0F0',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'search_border_color',
		    [
		        'label' => __( 'Search Input Border Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#F0F0F0',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'icon_color',
		    [
		        'label' => __( 'Icon Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ff5722',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper .input-group .input-group-button button' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'search_box_shadow',
				'label' => __( 'Search Input Shadow', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .tg-search-wrapper',
			]
		);
		
		$this->add_control(
			'search_border_radius',
			[
				'label' => __( 'Search Input Border Radius', 'grandconference-elementor' ),
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
					'{{WRAPPER}} .tg-search-wrapper' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_hover_style',
			array(
				'label'      => esc_html__( 'Hover Styles', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'search_hover_font_color',
		    [
		        'label' => __( 'Font Hover Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper:hover input' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'search_hover_placeholder_font_color',
		    [
		        'label' => __( 'Placeholder Hover Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#999999',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper:hover input::placeholder' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'search_hover_bg_color',
		    [
		        'label' => __( 'Search Input Hover Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper:hover' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'search_hover_border_color',
		    [
		        'label' => __( 'Search Input Hover Border Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#F0F0F0',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper:hover' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => __( 'Icon Hover Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ff5722',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper:hover .input-group .input-group-button button' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'search_hover_box_shadow',
				'label' => __( 'Search Input Hover Shadow', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .tg-search-wrapper:hover',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_autocomplete_style',
			array(
				'label'      => esc_html__( 'Auto Complete Styles', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
		    'autocomplete_font_color',
		    [
		        'label' => __( 'Auto Complete Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .tg-search-wrapper .autocomplete li a' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'autocomplete_bg_color',
		    [
		        'label' => __( 'Auto Complete Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .autocomplete ul' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'autocomplete_border_color',
		    [
		        'label' => __( 'Auto Complete Border Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .autocomplete' => 'border-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'autocomplete_hover_font_color',
		    [
		        'label' => __( 'Auto Complete Hover Font Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .autocomplete li:hover a' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'autocomplete_hover_bg_color',
		    [
		        'label' => __( 'Auto Complete Hover Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#f9f9f9',
		        'selectors' => [
		            '{{WRAPPER}} .autocomplete li:hover a' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'autocomplete_box_shadow',
				'label' => __( 'Auto Complete Shadow', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .autocomplete ul ',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/search-form/index.php');
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
