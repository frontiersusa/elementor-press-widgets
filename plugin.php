<?php
namespace Elementor;
namespace ElementorPressWidgets;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	private static $_instance = null;

	public function __construct() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		add_action('elementor/init', [$this, 'register_categories']);
	}

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/hello-world.php' );
		require_once( __DIR__ . '/widgets/text.php' );
	}

	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Hello_World() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Text() );
	}

	public function register_categories() {
		// This entire block is hacky & messy, but it works 😕
		$elements_manager = \Elementor\Plugin::instance()->elements_manager;
		$elements_manager->add_category(
				'press',
				[
						'title'  => 'Press',
						'icon' => 'font'
				],
				1
		);
		$reorder_cats = function() {
			// Needs to match the top
			$new = [
				'press' => [
					'title'  => 'Press',
					'icon' => 'font'
				],
			];
			$result = array_merge($new, $this->categories);
			$this->categories = $result;
		};
		$reorder_cats->call($elements_manager);
	}
}

// Instantiate Plugin Class
Plugin::instance();
