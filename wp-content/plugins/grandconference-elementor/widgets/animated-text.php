<?php
namespace GrandConferenceElementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Animated Text
 *
 * Elementor widget for animated text
 *
 * @since 1.0.0
 */
class GrandConference_Animated_Text extends Widget_Base {

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
		return 'grandconference-animated-text';
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
		return __( 'Animated Text', 'grandconference-elementor' );
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
		return 'eicon-t-letter';
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
			'section_text',
			[
				'label' => __( 'Text', 'grandconference-elementor' ),
			]
		);
		
		$this->add_control(
			'title_content',
			[
				'label' => __( 'Title', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => '',
				'placeholder' => __( 'Type your title here', 'grandconference-elementor' ),
			]
		);
		
		$this->add_control(
			'title_link',
			[
				'label' => __( 'Link', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'Paste URL or type', 'grandconference-elementor' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		
		$this->add_control(
			'title_html_tag',
			[
				'label' => __( 'HTML Tag', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1'  => __( 'H1', 'grandconference-elementor' ),
					'h2'  => __( 'H2', 'grandconference-elementor' ),
					'h3'  => __( 'H3', 'grandconference-elementor' ),
					'h4'  => __( 'H4', 'grandconference-elementor' ),
					'h5'  => __( 'H5', 'grandconference-elementor' ),
					'h6'  => __( 'H6', 'grandconference-elementor' ),
					'div'  => __( 'div', 'grandconference-elementor' ),
					'span'  => __( 'span', 'grandconference-elementor' ),
					'p'  => __( 'p', 'grandconference-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'title_delimiter_type',
			[
				'label' => __( 'Delimiter Type', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'word',
				'options' => [
					'character'  => __( 'Character', 'grandconference-elementor' ),
					'word'  => __( 'Word', 'grandconference-elementor' ),
					'sentence'  => __( 'Sentence', 'grandconference-elementor' ),
				],
			]
		);
		
		$this->add_responsive_control(
			'title_alignment',
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
		            '{{WRAPPER}} .themegoods-animated-text' => 'text-align: {{VALUE}}',
		        ],
			]
		);
		
		$this->add_control(
		    'title_transition_speed',
		    [
		        'label' => __( 'Transition Speed (in milli-seconds)', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 100,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 100,
		                'max' => 2000,
		                'step' => 100,
		            ]
		        ],
		        'size_units' => [ 'px' ]
		    ]
		);
		
		$this->add_control(
		    'title_transition_duration',
		    [
		        'label' => __( 'Transition Duration (in milli-seconds)', 'grandconference-elementor' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 800,
		        ],
		        'range' => [
		            'px' => [
		                'min' => 100,
		                'max' => 10000,
		                'step' => 100,
		            ]
		        ],
		        'size_units' => [ 'px' ]
		    ]
		);
		
		$this->add_control(
			'title_transition_from',
			[
				'label' => __( 'Transition from', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left'  => __( 'Left', 'grandconference-elementor' ),
					'right'  => __( 'Right', 'grandconference-elementor' ),
					'top'  => __( 'Top', 'grandconference-elementor' ),
					'bottom'  => __( 'Bottom', 'grandconference-elementor' ),
					'zoomin'  => __( 'Zoom In', 'grandconference-elementor' ),
					'zoomout'  => __( 'Zoom Out', 'grandconference-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'title_transition_overflow',
			[
				'label' => __( 'Transition Overflow', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'visible',
				'options' => [
					'visible'  => __( 'Visible', 'grandconference-elementor' ),
					'hidden'  => __( 'Hidden', 'grandconference-elementor' ),
				],
			]
		);
		
		$this->add_control(
			'title_transition_delay',
			[
				'label' => __( 'Animation Delay (ms)', 'grandconference-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 5000,
				'step' => 5,
				'default' => 0,
				'frontend_available' => false,
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
		    'title_font_color',
		    [
		        'label' => __( 'Text Color', 'grandconference-elementor' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '#000000',
		        'selectors' => [
		            '{{WRAPPER}} .themegoods-animated-text h1' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .themegoods-animated-text h2' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .themegoods-animated-text h3' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .themegoods-animated-text h4' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .themegoods-animated-text h5' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .themegoods-animated-text h6' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .themegoods-animated-text div' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .themegoods-animated-text span' => 'color: {{VALUE}}',
		            '{{WRAPPER}} .themegoods-animated-text p' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .themegoods-animated-text h1, {{WRAPPER}} .themegoods-animated-text h2, {{WRAPPER}} .themegoods-animated-text h3, {{WRAPPER}} .themegoods-animated-text h4, {{WRAPPER}} .themegoods-animated-text h5, {{WRAPPER}} .themegoods-animated-text h6, {{WRAPPER}} .themegoods-animated-text div, {{WRAPPER}} .themegoods-animated-text span, {{WRAPPER}} .themegoods-animated-text p',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/animated-text/index.php');
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
