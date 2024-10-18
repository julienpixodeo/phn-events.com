<?php
namespace GrandConferenceElementor;

use GrandConferenceElementor\Widgets\GrandConference_Navigation_Menu;
use GrandConferenceElementor\Widgets\GrandConference_Blog_Posts;
use GrandConferenceElementor\Widgets\GrandConference_Speaker_Grid;
use GrandConferenceElementor\Widgets\GrandConference_Gallery_Grid;
use GrandConferenceElementor\Widgets\GrandConference_Gallery_Masonry;
use GrandConferenceElementor\Widgets\GrandConference_Gallery_Justified;
use GrandConferenceElementor\Widgets\GrandConference_Gallery_Horizontal;
use GrandConferenceElementor\Widgets\GrandConference_Gallery_Fullscreen;
use GrandConferenceElementor\Widgets\GrandConference_Gallery_Preview;
use GrandConferenceElementor\Widgets\GrandConference_Gallery_Animated;
use GrandConferenceElementor\Widgets\GrandConference_Distortion_Grid;
//use GrandConferenceElementor\Widgets\GrandConference_Slider_Vertical_Parallax;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Horizontal;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Animated_Frame;
//use GrandConferenceElementor\Widgets\GrandConference_Slider_Room;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Multi_Layouts;
//use GrandConferenceElementor\Widgets\GrandConference_Slider_Velo;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Split_Carousel;
//use GrandConferenceElementor\Widgets\GrandConference_Slider_Popout;
//use GrandConferenceElementor\Widgets\GrandConference_Slider_Clip_Path;
//use GrandConferenceElementor\Widgets\GrandConference_Slider_Split_Slick;
//use GrandConferenceElementor\Widgets\GrandConference_Slider_Transitions;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Property_Clip;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Slice;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Flip;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Parallax;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Animated;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Fade_UP;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Motion_Reveal;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Image_Carousel;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Synchronized_Carousel;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Zoom;
use GrandConferenceElementor\Widgets\GrandConference_Mouse_Drive_Vertical_Carousel;
use GrandConferenceElementor\Widgets\GrandConference_Slider_Glitch_Slideshow;
use GrandConferenceElementor\Widgets\GrandConference_Horizontal_Timeline;
use GrandConferenceElementor\Widgets\GrandConference_Portfolio_Classic;
use GrandConferenceElementor\Widgets\GrandConference_Portfolio_Contain;
use GrandConferenceElementor\Widgets\GrandConference_Portfolio_Grid;
use GrandConferenceElementor\Widgets\GrandConference_Portfolio_Grid_Overlay;
use GrandConferenceElementor\Widgets\GrandConference_Portfolio_3D_Overlay;
use GrandConferenceElementor\Widgets\GrandConference_Background_List;
use GrandConferenceElementor\Widgets\GrandConference_Testimonial_Card;
use GrandConferenceElementor\Widgets\GrandConference_Testimonial_Slider;
//use GrandConferenceElementor\Widgets\GrandConference_Video_Grid;
use GrandConferenceElementor\Widgets\GrandConference_Flip_Box;
use GrandConferenceElementor\Widgets\GrandConference_Search;
use GrandConferenceElementor\Widgets\GrandConference_Search_Form;
use GrandConferenceElementor\Widgets\GrandConference_Event_Search_Form;
use GrandConferenceElementor\Widgets\GrandConference_Team_Grid;
use GrandConferenceElementor\Widgets\GrandConference_Service_Grid;
use GrandConferenceElementor\Widgets\GrandConference_Pricing_Table;
use GrandConferenceElementor\Widgets\GrandConference_Timeline;
use GrandConferenceElementor\Widgets\GrandConference_WooCommerce_Grid;
use GrandConferenceElementor\Widgets\GrandConference_Animated_Text;
use GrandConferenceElementor\Widgets\GrandConference_Animated_Headline;
use GrandConferenceElementor\Widgets\GrandConference_Portfolio_Carousel;
use GrandConferenceElementor\Widgets\GrandConference_Marquee_Menu_Effect;
use GrandConferenceElementor\Widgets\GrandConference_Service_Carousel;
use GrandConferenceElementor\Widgets\GrandConference_Team_Carousel;
use GrandConferenceElementor\Widgets\GrandConference_Blog_Carousel;
use GrandConferenceElementor\Widgets\GrandConference_Cart_Icon;
use GrandConferenceElementor\Widgets\GrandConference_Countdown;
use GrandConferenceElementor\Widgets\GrandConference_Speaker_Carousel;
use GrandConferenceElementor\Widgets\GrandConference_Event_Grid;
use GrandConferenceElementor\Widgets\GrandConference_Event_Carousel;

use GrandConferenceElementor\Widgets\GrandConference_Classic_Session_Fullwidth;
use GrandConferenceElementor\Widgets\GrandConference_Classic_Session_Sidebar;
use GrandConferenceElementor\Widgets\GrandConference_Classic_Session_Tab;
use GrandConferenceElementor\Widgets\GrandConference_Classic_Speaker_Grid;
use GrandConferenceElementor\Widgets\GrandConference_Classic_Speaker;
use GrandConferenceElementor\Widgets\GrandConference_Classic_Team;
use GrandConferenceElementor\Widgets\GrandConference_Classic_Testimonials_Slider;
use GrandConferenceElementor\Widgets\GrandConference_Classic_Testimonials_Column;
use GrandConferenceElementor\Widgets\GrandConference_Classic_Ticket;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class GrandConference_Elementor {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
		
		add_action( 'init', array( $this, 'init' ), -999 );
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {
		add_action( 'elementor/init', [ $this, 'on_elementor_init' ] );
		add_action( 'elementor/widgets/register', [ $this, 'on_widgets_registered' ] );

		//Enqueue javascript files
		add_action( 'elementor/frontend/after_register_scripts', function() {
			
			//Check if enable lazy load image
			wp_enqueue_script('masonry');
			wp_enqueue_script( 'jquery-effects-core' );
			wp_enqueue_script('lazy', plugins_url( '/grandconference-elementor/assets/js/jquery.lazy.js' ), array(), false, true );
			//wp_enqueue_script('modulobox', plugins_url( '/grandconference-elementor/assets/js/modulobox.js' ), array(), false, true );
			wp_enqueue_script('parallax-scroll', plugins_url( '/grandconference-elementor/assets/js/jquery.parallax-scroll.js' ), array(), false, true );
			wp_enqueue_script('smoove', plugins_url( '/grandconference-elementor/assets/js/jquery.smoove.js' ), array(), false, true );
			wp_enqueue_script('parallax', plugins_url( '/grandconference-elementor/assets/js/parallax.js' ), array(), false, true );
			wp_enqueue_script('blast', plugins_url( '/grandconference-elementor/assets/js/jquery.blast.js' ), array(), false, true );
			
			//Add parallax script effect
			//wp_enqueue_script('parallaxator', plugins_url().'/grandconference-elementor/assets/js/parallaxator.js', false, '', true);
			wp_enqueue_script('jarallax', plugins_url().'/grandconference-elementor/assets/js/jarallax.js', false, '', true);
			
			//Registered scripts
			wp_register_script('lodash', plugins_url( '/grandconference-elementor/assets/js/lodash.core.min.js' ), array(), false, true );
			wp_register_script('anime', plugins_url( '/grandconference-elementor/assets/js/anime.min.js' ), array(), false, true );
			wp_register_script('anime-old', plugins_url( '/grandconference-elementor/assets/js/anime-old.js' ), array(), false, true );
			wp_register_script('hover', plugins_url( '/grandconference-elementor/assets/js/hover.js' ), array(), false, true );
			wp_register_script('three', plugins_url( '/grandconference-elementor/assets/js/three.min.js' ), array(), false, true );
			wp_register_script('mls', plugins_url( '/grandconference-elementor/assets/js/mls.js' ), array(), false, true );
			wp_register_script('velocity', plugins_url( '/grandconference-elementor/assets/js/velocity.js' ), array(), false, true );
			wp_register_script('velocity-ui', plugins_url( '/grandconference-elementor/assets/js/velocity.ui.js' ), array(), false, true );
			wp_register_script('slick', plugins_url( '/grandconference-elementor/assets/js/slick.min.js' ), array(), false, true );
			wp_register_script('mousewheel', plugins_url( '/grandconference-elementor/assets/js/jquery.mousewheel.min.js' ), array(), false, true );
			wp_register_script('tweenmax', plugins_url( '/grandconference-elementor/assets/js/tweenmax.min.js' ), array(), false, true );
			wp_register_script('flickity', plugins_url( '/grandconference-elementor/assets/js/flickity.pkgd.js' ), array(), false, true );
			wp_register_script('tilt', plugins_url( '/grandconference-elementor/assets/js/tilt.jquery.js' ), array(), false, true );
			wp_register_script('grandconference-album-tilt', plugins_url( '/grandconference-elementor/assets/js/album-tilt.js' ), array(), false, true );
			wp_register_script('justifiedGallery', plugins_url( '/grandconference-elementor/assets/js/justifiedGallery.js' ), array(), false, true );
			wp_register_script('touchSwipe', plugins_url( '/grandconference-elementor/assets/js/jquery.touchSwipe.js' ), array(), false, true );
			wp_register_script('momentum-slider', plugins_url( '/grandconference-elementor/assets/js/momentum-slider.js' ), array(), false, true );
			wp_register_script('animatedheadline', plugins_url( '/grandconference-elementor/assets/js/jquery.animatedheadline.js' ), array(), false, true );
			wp_register_script('owl-carousel', plugins_url( '/grandconference-elementor/assets/js/owl.carousel.min.js' ), array(), false, true );
			wp_register_script('switchery', plugins_url( '/grandconference-elementor/assets/js/switchery.js' ), array(), false, true );
			wp_register_script('modernizr', plugins_url( '/grandconference-elementor/assets/js/modernizr.js' ), array(), false, true );
			wp_register_script('gridrotator', plugins_url( '/grandconference-elementor/assets/js/jquery.gridrotator.js' ), array(), false, true );
			wp_register_script('sticky-sidebar', plugins_url( '/grandconference-elementor/assets/js/jquery.sticky-sidebar.js' ), array(), false, true );
			wp_register_script('flexslider', plugins_url( '/grandconference-elementor/assets/js/flexslider/jquery.flexslider-min.js' ), array(), false, true );
			wp_register_script('countdown', plugins_url( '/grandconference-elementor/assets/js/jquery.countdown.js' ), array(), false, true );
			wp_register_script('grandconference-elementor', plugins_url( '/grandconference-elementor/assets/js/grandconference-elementor.js' ), array('sticky-sidebar'), false, true );
			
			$params = array(
			  'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
			  'ajax_nonce' => wp_create_nonce('grandconference-post-contact-nonce'),
			);
			
			wp_localize_script("grandconference-elementor", 'tgAjax', $params );
			
			wp_enqueue_script('grandconference-elementor', plugins_url( '/grandconference-elementor/assets/js/grandconference-elementor.js' ), array('sticky-sidebar'), false, true );
		} );
		
		//Enqueue CSS style files
		add_action( 'elementor/frontend/after_enqueue_styles', function() {
			//wp_enqueue_style('modulobox', plugins_url( '/grandconference-elementor/assets/css/modulobox.css' ), false, false, 'all' );
			wp_enqueue_style('swiper', plugins_url( '/grandconference-elementor/assets/css/swiper.css' ), false, false, 'all' );
			wp_enqueue_style('animatedheadline', plugins_url( '/grandconference-elementor/assets/css/animatedheadline.css' ), false, false, 'all' );
			wp_enqueue_style('justifiedGallery', plugins_url( '/grandconference-elementor/assets/css/justifiedGallery.css' ), false, false, 'all' );
			wp_enqueue_style('flickity', plugins_url( '/grandconference-elementor/assets/css/flickity.css' ), false, false, 'all' );
			wp_enqueue_style('owl-carousel-theme', plugins_url( '/grandconference-elementor/assets/css/owl.theme.default.min.css' ), false, false, 'all' );
			wp_enqueue_style('switchery', plugins_url( '/grandconference-elementor/assets/css/switchery.css' ), false, false, 'all' );
			wp_enqueue_style('grandconference-elementor', plugins_url( '/grandconference-elementor/assets/css/grandconference-elementor.css' ), false, false, 'all' );
			wp_enqueue_style('grandconference-elementor-responsive', plugins_url( '/grandconference-elementor/assets/css/grandconference-elementor-responsive.css' ), false, false, 'all' );
		});
	}
	
	/**
	 * Manually init required modules.
	 *
	 * @return void
	 */
	public function init() {
		
		grandconference_templates_manager()->init();
		$this->register_extension();

	}
	
	/**
	 * On Elementor Init
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_elementor_init() {
		$this->register_category();
	}

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		require __DIR__ . '/widgets/navigation-menu.php';
		require __DIR__ . '/widgets/blog-posts.php';
		require __DIR__ . '/widgets/speaker-grid.php';
		require __DIR__ . '/widgets/gallery-grid.php';
		require __DIR__ . '/widgets/gallery-masonry.php';
		require __DIR__ . '/widgets/gallery-justified.php';
		require __DIR__ . '/widgets/gallery-fullscreen.php';
		require __DIR__ . '/widgets/gallery-horizontal.php';
		require __DIR__ . '/widgets/gallery-preview.php';
		require __DIR__ . '/widgets/gallery-animated.php';
		require __DIR__ . '/widgets/distortion-grid.php';
		//require __DIR__ . '/widgets/slider-vertical-parallax.php';
		require __DIR__ . '/widgets/slider-horizontal.php';
		require __DIR__ . '/widgets/slider-animated-frame.php';
		//require __DIR__ . '/widgets/slider-room.php';
		require __DIR__ . '/widgets/slider-multi-layouts.php';
		//require __DIR__ . '/widgets/slider-velo.php';
		require __DIR__ . '/widgets/slider-split-carousel.php';
		require __DIR__ . '/widgets/mouse-driven-vertical-carousel.php';
		//require __DIR__ . '/widgets/slider-popout.php';
		//require __DIR__ . '/widgets/slider-clip-path.php';
		//require __DIR__ . '/widgets/slider-split-slick.php';
		//require __DIR__ . '/widgets/slider-transitions.php';
		require __DIR__ . '/widgets/slider-property-clip.php';
		require __DIR__ . '/widgets/slider-slice.php';
		require __DIR__ . '/widgets/slider-flip.php';
		require __DIR__ . '/widgets/slider-parallax.php';
		require __DIR__ . '/widgets/slider-animated.php';
		require __DIR__ . '/widgets/slider-fade-up.php';
		require __DIR__ . '/widgets/slider-motion-reveal.php';
		require __DIR__ . '/widgets/slider-image-carousel.php';
		require __DIR__ . '/widgets/slider-synchronized-carousel.php';
		require __DIR__ . '/widgets/slider-glitch-slideshow.php';
		require __DIR__ . '/widgets/slider-zoom.php';
		require __DIR__ . '/widgets/horizontal-timeline.php';
		require __DIR__ . '/widgets/background-list.php';
		require __DIR__ . '/widgets/testimonial-card.php';
		require __DIR__ . '/widgets/testimonial-slider.php';
		//require __DIR__ . '/widgets/video-grid.php';
		require __DIR__ . '/widgets/flip-box.php';
		require __DIR__ . '/widgets/search.php';
		require __DIR__ . '/widgets/search-form.php';
		require __DIR__ . '/widgets/event-search-form.php';
		require __DIR__ . '/widgets/team-grid.php';
		require __DIR__ . '/widgets/service-grid.php';
		require __DIR__ . '/widgets/service-carousel.php';
		require __DIR__ . '/widgets/pricing-table.php';
		require __DIR__ . '/widgets/timeline.php';
		require __DIR__ . '/widgets/woocommerce-grid.php';
		require __DIR__ . '/widgets/animated-headline.php';
		require __DIR__ . '/widgets/animated-text.php';
		require __DIR__ . '/widgets/marquee-menu-effect.php';
		require __DIR__ . '/widgets/team-carousel.php';
		require __DIR__ . '/widgets/blog-carousel.php';
		require __DIR__ . '/widgets/cart-icon.php';
		require __DIR__ . '/widgets/countdown.php';
		require __DIR__ . '/widgets/speaker-carousel.php';
		require __DIR__ . '/widgets/event-grid.php';
		require __DIR__ . '/widgets/event-carousel.php';
		
		//Theme content builder classic widgets
		require __DIR__ . '/widgets/classic-session-fullwidth.php';
		require __DIR__ . '/widgets/classic-session-sidebar.php';
		require __DIR__ . '/widgets/classic-session-tab.php';
		require __DIR__ . '/widgets/classic-speaker-grid.php';
		require __DIR__ . '/widgets/classic-speaker.php';
		require __DIR__ . '/widgets/classic-team.php';
		require __DIR__ . '/widgets/classic-testimonials-slider.php';
		require __DIR__ . '/widgets/classic-testimonials-column.php';
		require __DIR__ . '/widgets/classic-ticket.php';
	}
	
	/**
	 * Register Category
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_category() {
		/*\Elementor\Plugin::instance()->elements_manager->add_category(
			'grandconference-theme-widgets-category-fullscreen',
			array(
				'title' => 'Theme Fullscreen Elements',
				'icon'  => 'fonts',
			),
			1
		);*/
		
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'grandconference-theme-widgets-category',
			array(
				'title' => 'Theme General Elements',
				'icon'  => 'fonts',
			),
			2
		);
		
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'grandconference-theme-classic-widgets-category',
			array(
				'title' => 'Theme Classic Elements',
				'icon'  => 'fonts',
			),
			2
		);
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Navigation_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Blog_Posts() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Speaker_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Gallery_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Gallery_Masonry() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Gallery_Justified() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Gallery_Fullscreen() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Gallery_Preview() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Gallery_Horizontal() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Gallery_Animated() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Distortion_Grid() );
		//\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Vertical_Parallax() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Horizontal() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Animated_Frame() );
		//\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Room() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Multi_Layouts() );
		//\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Velo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Split_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Mouse_Drive_Vertical_Carousel() );
		//\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Popout() );
		//\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Clip_Path() );
		//\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Split_Slick() );
		//\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Transitions() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Property_Clip() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Slice() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Flip() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Parallax() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Animated() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Motion_Reveal() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Fade_UP() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Image_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Synchronized_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Glitch_Slideshow() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Slider_Zoom() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Background_list() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Testimonial_Card() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Testimonial_Slider() );
		//\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Video_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Flip_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Search() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Search_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Event_Search_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Team_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Service_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Service_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Pricing_Table() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Timeline() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_WooCommerce_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Animated_Text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Animated_Headline() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Marquee_Menu_Effect() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Team_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Blog_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Cart_Icon() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Countdown() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Speaker_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Event_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Event_Carousel() );
			
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Classic_Session_Fullwidth() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Classic_Session_Sidebar() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Classic_Session_Tab() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Classic_Speaker_Grid() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Classic_Speaker() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Classic_Team() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Classic_Testimonials_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Classic_Testimonials_Column() );
		\Elementor\Plugin::instance()->widgets_manager->register( new GrandConference_Classic_Ticket() );
	}
	
	/**
	 * Register Extension
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_extension() {
		//Custom Elementor extensions
		require __DIR__ . '/extensions.php';
		
		grandconference_ext()->init();
	}
}

new GrandConference_Elementor();
