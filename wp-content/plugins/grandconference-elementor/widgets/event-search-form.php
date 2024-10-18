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
class GrandConference_Event_Search_Form extends Widget_Base {

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
		return 'grandconference-event-search-form';
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
		return __( 'Event Search Form', 'grandconference-elementor' );
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
		
		$this->add_control(
			'fields',
			[
				'label' => __( 'Search Fields', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'default' => ['keyword'],
				'options' => [
					 'keyword'  			=> __( 'Keyword', 'grandconference-elementor' ),
					 'category' 			=> __( 'Category', 'grandconference-elementor' ),
					 'location' 			=> __( 'Location', 'grandconference-elementor' ),
					 'date'   				=> __( 'Start Date', 'grandconference-elementor' ),
				],
				'multiple' => true,
			]
		);
		
		$this->add_control(
			'action',
			[
				'label' => __( 'Search Results Page (Optional)', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT2,
				'description' => 'By default, search form will redirect to the same page but you can also create a custom search result page and adding event grid widget there.',
				'options' => grandconference_get_pages(),
				'multiple' => false,
			]
		);
		
		$this->end_controls_section();
		
		/*$this->start_controls_section(
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
		
		
		$this->end_controls_section();*/
		
		$this->start_controls_section(
			'section_input',
			array(
				'label'      => esc_html__( 'Input', 'grandconference-elementor' ),
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
		            '{{WRAPPER}} .tg-event-search-wrapper input, {{WRAPPER}} .tg-event-search-wrapper select' => 'color: {{VALUE}}',
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
		            '{{WRAPPER}} .tg-event-search-wrapper input::placeholder' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'search_bg_color',
		    [
		        'label' => __( 'Search Input Background Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#ffffff',
		        'selectors' => [
		            '{{WRAPPER}} .tg-event-search-wrapper input, {{WRAPPER}} .tg-event-search-wrapper .tg-event-search-form  select' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_control(
		    'search_border_color',
		    [
		        'label' => __( 'Search Input Border Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#dce0e0',
		        'selectors' => [
		            '{{WRAPPER}} .tg-event-search-wrapper input, {{WRAPPER}} div.tg-event-search-wrapper select' => 'border-color: {{VALUE}}',
		        ],
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
					'{{WRAPPER}} .tg-event-search-wrapper input, {{WRAPPER}} .tg-event-search-wrapper select' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_button',
			array(
				'label'      => esc_html__( 'Button', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_control(
			'button_font_color',
			[
				'label' => __( 'Button Font Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tg-event-search-wrapper input[type=submit]' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_bg_color',
			[
				'label' => __( 'Button Background Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tg-event-search-wrapper input[type=submit]' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_border_color',
			[
				'label' => __( 'Button Border Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#',
				'selectors' => [
					'{{WRAPPER}} .tg-event-search-wrapper input[type=submit]' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_hover_font_color',
			[
				'label' => __( 'Button Hover Font Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tg-event-search-wrapper input[type=submit]:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => __( 'Button Hover Background Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tg-event-search-wrapper input[type=submit]:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __( 'Button Hover Border Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#',
				'selectors' => [
					'{{WRAPPER}} .tg-event-search-wrapper input[type=submit]:hover' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Button Border Radius', 'grandconference-elementor' ),
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
					'{{WRAPPER}} .tg-event-search-wrapper input[type=submit]' => 'border-radius: {{SIZE}}{{UNIT}};',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/event-search-form/index.php');
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
