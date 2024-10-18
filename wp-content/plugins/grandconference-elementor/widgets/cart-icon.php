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
class GrandConference_Cart_Icon extends Widget_Base {

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
		return 'grandconference-cart-icon';
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
		return __( 'WooCommerce Cart Icon', 'grandconference-elementor' );
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
		return 'eicon-product-add-to-cart';
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
			'cart_icon',
			[
				'label' => __( 'Cart Icon', 'grandconference-elementor' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 18,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					]
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .grandconference-cart-icon .grandconference-cart-icon-image' => 'width: {{SIZE}}{{UNIT}}',
				],
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
			'cart_counter_bg_color',
			[
				'label' => __( 'Cart Counter Background Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#A6FF00',
				'selectors' => [
					'{{WRAPPER}} .grandconference-cart-wrapper .grandconference-cart-counter' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'cart_counter_font_color',
			[
				'label' => __( 'Cart Counter Font Color', 'grandconference-elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .grandconference-cart-wrapper .grandconference-cart-counter' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'cart_counter_bg_size',
			[
				'label' => __( 'Cart Counter Background Size', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					]
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .grandconference-cart-wrapper .grandconference-cart-counter' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .grandconference-cart-wrapper div.grandconference-cart-counter' => 'height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} div.grandconference-cart-wrapper .grandconference-cart-counter' => 'line-height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_responsive_control(
			'cart_counter_font_size',
			[
				'label' => __( 'Cart Counter Font Size', 'grandconference-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 9,
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					]
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .grandconference-cart-wrapper .grandconference-cart-counter' => 'font-size: {{SIZE}}{{UNIT}}',
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
		include(GRANDCONFERENCE_ELEMENTOR_PATH.'templates/cart-icon/index.php');
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
