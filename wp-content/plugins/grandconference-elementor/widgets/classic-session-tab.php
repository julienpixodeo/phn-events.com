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
class GrandConference_Classic_Session_Tab extends Widget_Base {

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
		return 'grandconference-classic-session-tab';
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
		return __( 'Classic Session Tab', 'grandconference-elementor' );
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
		return 'eicon-table-of-contents';
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
		return [ 'grandconference-theme-classic-widgets-category' ];
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
		return array();
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
			'filterable',
			[
				'label' => __( 'Display filterable options', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_control(
			'expand',
			[
				'label' => __( 'Expand session detail by default', 'grandconference-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'grandconference-elementor' ),
				'label_off' => __( 'No', 'grandconference-elementor' ),
				'return_value' => 'yes',
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .scheduleday_wrapper',
			]
		);
		
		$this->add_control(
			'image_dimension',
			[
				'label'       => esc_html__( 'Speaker Thumbnail Size', 'grandconference-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'small',
				'options' => [
					 'small' => __( 'Small', 'grandconference-elementor' ),
					 'medium' => __( 'Medium', 'grandconference-elementor' ),
					 'large' => __( 'Large', 'grandconference-elementor' ),
				]
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_session_day_style',
			array(
				'label'      => esc_html__( 'Event Day', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'session_day_title_typography',
				'label' => __( 'Event Day Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li.scheduleday_title h4',
			]
		);
		
		$this->add_control(
			'session_day_title_color',
			[
				'label' => __( 'Event Day Title Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li.scheduleday_title h4, {{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li.scheduleday_title .scheduleday_title_icon span' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
				'session_day_title_bg_color',
				[
					'label' => __( 'Event Day Title Background Color', 'grandconference-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#007AFF',
					'selectors' => [
						'{{WRAPPER}} .scheduleday_wrapper li.scheduleday_title, {{WRAPPER}} .scheduleday_wrapper.tab' => 'background: {{VALUE}}',
					],
				]
			);
			
		$this->add_control(
			'session_day_title_border_color',
			[
				'label' => __( 'Event Day Title Border Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .scheduleday_wrapper li.scheduleday_title' => 'border-color: {{VALUE}}',
				],
			]
		);
			
		$this->add_control(
				'session_day_active_title_color',
				[
					'label' => __( 'Event Day Active Title Color', 'grandconference-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li.scheduleday_title.active h4, {{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li.scheduleday_title.active .scheduleday_title_icon span' => 'color: {{VALUE}}',
					],
				]
			);
			
			$this->add_control(
					'session_day_active_title_bg_color',
					[
						'label' => __( 'Event Day Active Title Background Color', 'grandconference-elementor' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#007AFF',
						'selectors' => [
							'{{WRAPPER}} .scheduleday_wrapper li.scheduleday_title.active' => 'background: {{VALUE}}',
						],
					]
				);
			
			$this->add_control(
				'session_day_active_title_border_color',
				[
					'label' => __( 'Event Day Active Title Border Color', 'grandconference-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => 'transparent',
					'selectors' => [
						'{{WRAPPER}} .scheduleday_wrapper.tab li.scheduleday_title.active' => 'border-color: {{VALUE}}',
					],
				]
			);
			
		$this->add_responsive_control(
				'session_day_title_border_radius',
				[
					'label' => __( 'Event Day Border Radius', 'grandconference-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .scheduleday_wrapper li.scheduleday_title, {{WRAPPER}} .scheduleday_wrapper, {{WRAPPER}} .scheduleday_wrapper li .session_content_wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		
		$this->add_responsive_control(
			'session_day_title_padding',
			[
				'label' => __( 'Event Day Padding', 'grandconference-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .scheduleday_wrapper li.scheduleday_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_session_style',
			array(
				'label'      => esc_html__( 'Session', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'session_typography',
					'label' => __( 'Session Title Typography', 'grandconference-elementor' ),
					'selector' => '{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li .session_content h6',
				]
			);
			
		$this->add_control(
			'session_bg_color',
			[
				'label' => __( 'Session Background Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li .expandable, {{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li .session_content_wrapper' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'session_border_color',
			[
				'label' => __( 'Session Border Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#e1e1e1',
				'selectors' => [
					'{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li .session_location' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'session_color',
			[
				'label' => __( 'Session Title Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li .session_content h6' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'session_detail_typography',
					'label' => __( 'Session Detail Typography', 'grandconference-elementor' ),
					'selector' => '{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li',
				]
			);
		
		$this->add_control(
				'session_detail_color',
				[
					'label' => __( 'Session Detail Color', 'grandconference-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#222222',
					'selectors' => [
						'{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li' => 'color: {{VALUE}}',
					],
				]
			);
			
		$this->add_control(
				'session_link_color',
				[
					'label' => __( 'Session Link Color', 'grandconference-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#FF2D55',
					'selectors' => [
						'{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li a' => 'color: {{VALUE}}',
					],
				]
			);
			
		$this->add_control(
				'session_hover_link_color',
				[
					'label' => __( 'Session Hover Link Color', 'grandconference-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#000000',
					'selectors' => [
						'{{WRAPPER}} .session-tab-wrapper .scheduleday_wrapper li a:hover' => 'color: {{VALUE}}',
					],
				]
			);
			
		$this->add_responsive_control(
				'session_speaker_thumb_border_radius',
				[
					'label' => __( 'Speaker Thumbnail Border Radius', 'grandconference-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .scheduleday_wrapper li .session_speaker_thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
		$this->add_responsive_control(
			'session_padding',
			[
				'label' => __( 'Session Padding', 'grandconference-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .session-tab-wrapper ul.tab_content li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_filterable_style',
			array(
				'label'      => esc_html__( 'Filterable', 'grandconference-elementor' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filterable_typography',
				'label' => __( 'Filterable Title Typography', 'grandconference-elementor' ),
				'selector' => '{{WRAPPER}} .session-tab-wrapper .session_filters li a, {{WRAPPER}} .session-tab-wrapper a.session_expand_all',
			]
		);
		
		$this->add_control(
			'filterable_color',
			[
				'label' => __( 'Filterable Title Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .session-tab-wrapper .session_filters li a, {{WRAPPER}} .session-tab-wrapper a.session_expand_all' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
				'filterable_hover_color',
				[
					'label' => __( 'Filterable Title Hover Color', 'grandconference-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .session-tab-wrapper .session_filters li a:hover' => 'color: {{VALUE}}',
					],
				]
			);
			
		$this->add_control(
				'filterable_hover_bg_color',
				[
					'label' => __( 'Filterable Title Hover Background Color', 'grandconference-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#FF2D55',
					'selectors' => [
						'{{WRAPPER}} .session-tab-wrapper .session_filters li a:hover' => 'background-color: {{VALUE}}',
					],
				]
			);
		
		$this->add_control(
			'filterable_active_color',
			[
				'label' => __( 'Filterable Title Active Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .session-tab-wrapper .session_filters li a.active' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'filterable_active_bg_color',
			[
					'label' => __( 'Filterable Title Active Background Color', 'grandconference-elementor' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#FF2D55',
					'selectors' => [
						'{{WRAPPER}} .session-tab-wrapper .session_filters li a.active' => 'background-color: {{VALUE}}',
					],
				]
		);
		
		$this->add_responsive_control(
				'filterable_button_border_radius',
				[
					'label' => __( 'Filterable Border Radius', 'grandconference-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .session-tab-wrapper .session_filters li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
		$this->add_responsive_control(
				'filterable_padding',
				[
					'label' => __( 'Filterable Padding', 'grandconference-elementor' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors' => [
						'{{WRAPPER}} .session-tab-wrapper .session_filters li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/classic-session-tab/index.php');
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
