<?php
namespace ElementorPressWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Text extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'press-text';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Text', 'elementor-press-widgets' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-align-left';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'press' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'elementor-press-widgets' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'elementor-press-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Text', 'elementor-press-widgets' ),
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' => __( 'HTML Tag', 'elementor-press-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'span', 'elementor-press-widgets' ),
			]
		);

		$this->add_control(
			'text_size',
			[
				'label' => __( 'Border Style', 'elementor-press-widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text-base',
				'options' => [
					'text-xs' => __( 'Extra Small', 'elementor-press-widgets' ),
					'text-sm' => __( 'Small', 'elementor-press-widgets' ),
					'text-base'  => __( 'Base', 'elementor-press-widgets' ),
					'text-lg' => __( 'Large', 'elementor-press-widgets' ),
					'text-xl' => __( 'Extra Large', 'elementor-press-widgets' ),
					'text-2xl' => __( '2x-Large', 'elementor-press-widgets' ),
					'text-3xl' => __( '3x-Large', 'elementor-press-widgets' ),
					'text-4xl' => __( '4x-Large', 'elementor-press-widgets' ),
					'text-5xl' => __( '5x-Large', 'elementor-press-widgets' ),
					'text-6xl' => __( '6x-Large', 'elementor-press-widgets' ),
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
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'text', 'basic' );
		$this->add_render_attribute( 'text', 'class', $settings['text_size'] );
		render("components.text", [
			'text' => $settings['text'],
			'text_attributes' => $this->get_render_attribute_string( 'text' ),
			'el' => $settings['html_tag'],
		]);
	}
}
