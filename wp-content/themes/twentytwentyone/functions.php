<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twenty_twenty_one_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Twenty-One, use a find and replace
		 * to change 'twentytwentyone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentytwentyone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
				'footer'  => __( 'Secondary menu', 'twentytwentyone' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		if ( 127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'twentytwentyone' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'twentytwentyone' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'twentytwentyone' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'twentytwentyone' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'twentytwentyone' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'twentytwentyone' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'twentytwentyone' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Black', 'twentytwentyone' ),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__( 'Dark gray', 'twentytwentyone' ),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__( 'Gray', 'twentytwentyone' ),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__( 'Green', 'twentytwentyone' ),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__( 'Blue', 'twentytwentyone' ),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__( 'Purple', 'twentytwentyone' ),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__( 'Red', 'twentytwentyone' ),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__( 'Orange', 'twentytwentyone' ),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__( 'Yellow', 'twentytwentyone' ),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__( 'White', 'twentytwentyone' ),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__( 'Purple to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__( 'Green to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to green', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__( 'Red to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__( 'Purple to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__( 'Red to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', twenty_twenty_one_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );
	}
}
add_action( 'after_setup_theme', 'twenty_twenty_one_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twenty_twenty_one_content_width', 750 );
}
add_action( 'after_setup_theme', 'twenty_twenty_one_content_width', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'twenty-twenty-one-style', 'rtl', 'replace' );

	// Print styles.
	wp_enqueue_style( 'twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'twenty-twenty-one-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'twenty-twenty-one-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_scripts' );

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script() {

	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwentyone_block_editor_script' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	}

	// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix' );

/** Enqueue non-latin language styles
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
	$custom_css = twenty_twenty_one_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twenty-twenty-one-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'twentytwentyone_customize_preview_init' );

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts' );

/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
	$classes = apply_filters( 'twentytwentyone_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_ie_class' );
function custom_login() {
	if (!empty( $_POST['ema']))
	{
		  $user['user_login'] = $_POST['ema'];
    $user['user_password'] = $_POST['pas'];
    $user['remember'] = true;
    $signon = wp_signon($user, false);
    if (is_wp_error($signon))  $signon->get_error_message();
    //print_r($signon);
	}
  
}

add_action( 'after_setup_theme', 'custom_login' );


add_filter('user_contactmethods', 'my_user_contactmethods');



function my_user_contactmethods($user_contactmethods){

  $user_contactmethods['fio'] = 'Circle Name';
  $user_contactmethods['coun'] = 'Country';
   $user_contactmethods['cit'] = 'City';
     $user_contactmethods['type'] = 'Type of Events';
   $user_contactmethods['conper'] = 'Contact Person';
     $user_contactmethods['conema'] = 'Contact Email';

		 $user_contactmethods['often'] = 'How often do you organize events?';
		 
		  $user_contactmethods['insta'] = 'Instagram';
   $user_contactmethods['web'] = 'Web';
     $user_contactmethods['twi'] = 'Twitter';
		 
		  $user_contactmethods['ban'] = 'Banner';
		$user_contactmethods['follow'] = 'Follows';
		  $user_contactmethods['cont'] = 'Country';
		$user_contactmethods['goro'] = 'City';
		$user_contactmethods['inta'] = 'Intrests';
			$user_contactmethods['pho'] = 'User phone';
		$user_contactmethods['idu'] = 'User id';
		$user_contactmethods['mainidu'] = 'Circle master id for user';
			$user_contactmethods['mainidu1'] = 'Circle master id for contributor';
		$user_contactmethods['pas'] = 'Password create circle';
	  $user_contactmethods['acce'] = 'Type of Access';
		$user_contactmethods['buytik'] = 'Id by ticket';
		
	  $user_contactmethods['ema100'] = 'Email blockchain';
	  $user_contactmethods['pas100'] = 'Password blockchain';
	  $user_contactmethods['adr100'] = 'Adress blockchain';
		
  return $user_contactmethods;
}

add_action( 'woocommerce_product_options_general_product_data', 'art_woo_add_custom_fields' );
function art_woo_add_custom_fields() {
	global $product, $post;
	echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_text_locat',
   'label'             => __( 'Location', 'woocommerce' ),
   'placeholder'       => 'Location',
   'desc_tip'          => 'true',
   'custom_attributes' => array(),
   'description'       => __( 'Введите здесь значение поля', 'woocommerce' ),
) );
	echo '</div>';
	
	
	
	echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_text_asset',
   'label'             => __( 'AssetID', 'woocommerce' ),
   'placeholder'       => 'AssetID',
   'desc_tip'          => 'true',
   'custom_attributes' => array(),
   'description'       => __( 'Введите здесь значение поля', 'woocommerce' ),
) );
	echo '</div>';
	
	
	echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_text_tx',
   'label'             => __( 'TxID', 'woocommerce' ),
   'placeholder'       => 'TxID',
   'desc_tip'          => 'true',
   'custom_attributes' => array(),
   'description'       => __( 'Введите здесь значение поля', 'woocommerce' ),
) );
	echo '</div>';
	
	
	
	
	
	
	
	echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_text_dat',
   'label'             => __( 'Date start', 'woocommerce' ),
   'placeholder'       => 'Date',
   'desc_tip'          => 'true',
   'custom_attributes' => array(),
   'description'       => __( 'Введите здесь значение поля', 'woocommerce' ),
) );
	echo '</div>';
	
		echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_text_dat1',
   'label'             => __( 'Date end', 'woocommerce' ),
   'placeholder'       => 'Date',
   'desc_tip'          => 'true',
   'custom_attributes' => array(),
   'description'       => __( 'Введите здесь значение поля', 'woocommerce' ),
) );
	echo '</div>';
		echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_text_time1',
   'label'             => __( 'Time start', 'woocommerce' ),
   'placeholder'       => '',
   'desc_tip'          => 'true',
   'custom_attributes' => array(),
   'description'       => __( 'Введите здесь значение поля', 'woocommerce' ),
) );
	echo '</div>';
	
	
		echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_text_time2',
   'label'             => __( 'Time end', 'woocommerce' ),
   'placeholder'       => '',
   'desc_tip'          => 'true',
   'custom_attributes' => array(),
   'description'       => __( 'Введите здесь значение поля', 'woocommerce' ),
) );
	echo '</div>';
	
	echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_text_hash',
   'label'             => __( 'Hashtags', 'woocommerce' ),
   'placeholder'       => '',
   'desc_tip'          => 'true',
   'custom_attributes' => array(),
   'description'       => __( 'Введите здесь значение поля', 'woocommerce' ),
) );
	echo '</div>';
	
	

	
	
	
	echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_number_cir',
   'label'             => __( 'Circle', 'woocommerce' ),
   'placeholder'       => '',
   'description'       => __( 'Вводятся только числа', 'woocommerce' ),
   'type'              => 'number',
   'custom_attributes' => array(
      'step' => 'any',
      'min'  => '0',
   ),
) );
	echo '</div>';
	
	
	
		echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_number_tov',
   'label'             => __( 'Event', 'woocommerce' ),
   'placeholder'       => '',
   'description'       => __( 'Вводятся только числа', 'woocommerce' ),
   'type'              => 'number',
   'custom_attributes' => array(
      'step' => 'any',
      'min'  => '0',
   ),
) );
	echo '</div>';
	
	
	
	
	
	
	
	
	
		echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_number_cop',
   'label'             => __( 'Number of Copies', 'woocommerce' ),
   'placeholder'       => '',
   'description'       => __( 'Вводятся только числа', 'woocommerce' ),
   'type'              => 'number',
   'custom_attributes' => array(
      'step' => 'any',
      'min'  => '0',
   ),
) );
	echo '</div>';
	
	
		echo '<div class="options_group">';// Группировка полей 
	woocommerce_wp_text_input( array(
   'id'                => '_text_fea',
   'label'             => __( 'Features', 'woocommerce' ),
   'placeholder'       => '',
   'desc_tip'          => 'true',
   'custom_attributes' => array(),
   'description'       => __( 'Введите здесь значение поля', 'woocommerce' ),
) );
	echo '</div>';
	
	
	
	
	
}



add_action( 'woocommerce_process_product_meta', 'art_woo_custom_fields_save', 10 );
function art_woo_custom_fields_save( $post_id ) {
   // Сохранение текстового поля
   $woocommerce_text_field = $_POST['_text_field'];
   if ( !empty($woocommerce_text_field) ) {
   update_post_meta( $post_id, '_text_field', esc_attr( $woocommerce_text_field ) );
}

$woocommerce_text_field = $_POST['_number_tov'];
   if ( !empty($woocommerce_text_field) ) {
   update_post_meta( $post_id, '_number_tov', esc_attr( $woocommerce_text_field ) );
}
$woocommerce_text_field = $_POST['_number_cir'];
   if ( !empty($woocommerce_text_field) ) {
   update_post_meta( $post_id, '_number_cir', esc_attr( $woocommerce_text_field ) );
}


 $woocommerce_number_field = $_POST['_number_cop'];
   if ( !empty($woocommerce_number_field)) {
      update_post_meta( $post_id, '_number_cop', esc_attr( $woocommerce_number_field ) );
   }
$woocommerce_text_field = $_POST['_text_fea'];
   if ( !empty($woocommerce_text_field) ) {
   update_post_meta( $post_id, '_text_fea', esc_attr( $woocommerce_text_field ) );
}
$woocommerce_text_field = $_POST['_text_dat'];
   if ( !empty($woocommerce_text_field) ) {
   update_post_meta( $post_id, '_text_dat', esc_attr( $woocommerce_text_field ) );
}
$woocommerce_text_field = $_POST['_text_hash'];
   if ( !empty($woocommerce_text_field) ) {
   update_post_meta( $post_id, '_text_hash', esc_attr( $woocommerce_text_field ) );
}



   // Сохранение цифрового поля
   $woocommerce_number_field = $_POST['_number_field'];
   if ( !empty($woocommerce_number_field)) {
      update_post_meta( $post_id, '_number_field', esc_attr( $woocommerce_number_field ) );
   }
   // Сохранение области тектса
   $woocommerce_textarea = $_POST['textarea-field'];
   if ( ! empty( $woocommerce_textarea ) ) {
      update_post_meta( $post_id, '_textarea', esc_html( $woocommerce_textarea ) );
   }
   // Сохранение выпадающего списка
   $woocommerce_select = $_POST['_select'];
   if ( ! empty($woocommerce_select )) {
      update_post_meta( $post_id, '_select', esc_attr( $woocommerce_select ) );
   }
   
    $woocommerce_select = $_POST['_text_locat'];
   if ( ! empty($woocommerce_select )) {
      update_post_meta( $post_id, '_text_locat', esc_attr( $woocommerce_select ) );
   }
   
   
   // Сохранение радиокнопок
   $woocommerce_radio = $_POST['radio-field'];
   if ( ! empty( $woocommerce_radio )) {
   update_post_meta( $post_id, '_radiobutton', esc_attr( $woocommerce_radio ) );
   }
   // Сохранение чекбоксов
   $woocommerce_checkbox = isset( $_POST['_checkbox'] ) ? 'yes' : 'no';
   update_post_meta( $post_id, '_checkbox', $woocommerce_checkbox );
   // Сохранение группы произвольных полей
   $woocommerce_pack_length = $_POST['_pack_length'];
   if ( ! empty( $woocommerce_pack_length )) {
      update_post_meta( $post_id, '_pack_length', esc_attr( $woocommerce_pack_length ) );
   }
   $woocommerce_pack_width = $_POST['_pack_width'];
   if ( ! empty( $woocommerce_pack_width )) {
      update_post_meta( $post_id, '_pack_width', esc_attr( $woocommerce_pack_width ) );
   }
   $woocommerce_pack_height = $_POST['_pack_height'];
   if ( ! empty( $woocommerce_pack_height )) {
      update_post_meta( $post_id, '_pack_height', esc_attr( $woocommerce_pack_height ) );
   }
   // Hidden Field
   $woocommerce_hidden_field = $_POST['_hidden_field'];
   if ( ! empty( $woocommerce_hidden_field )) {
      update_post_meta( $post_id, '_hidden_field', esc_attr( $woocommerce_hidden_field ) );
   }
   // Сохранение произвольного поля по выбору товаров с поиском
   if (  isset( $_POST['product_field_type'] ) && !empty($_POST['product_field_type'] ) ) {
      // Проверяем данные, если они существуют и не пустые, то записываем данные в поле
      update_post_meta( $post_id, '_product_field_type_ids',  array_map( 'absint', (array) $_POST['product_field_type'] ));
   } else {
      // Иначе удаляем созданное поле из бд
      delete_post_meta( $post_id, '_product_field_type_ids');
   }
}


add_action( 'after_setup_theme', 'custom_registration' );
function custom_registration() {
	if(isset($_POST["ema1"])) {
		$userdata = array(
			'user_login' => $_POST['ema1'],
			'user_pass'  => $_POST['pas1'],
			'user_email' => $_POST['ema1'],
			'role' => 'circle'
		);

		$user_id = wp_insert_user( $userdata );
update_user_meta( $user_id, 'pas',  $_POST['pas1']);
		$login_data = array();
		$login_data['user_login'] = $_POST['ema1'];
		$login_data['user_password'] =$_POST['pas1'] ;

		$user = wp_signon( $login_data, false );




		wp_clear_auth_cookie();
		wp_set_current_user($user->ID);
		wp_set_auth_cookie($user->ID, true);
		$cuser = wp_get_current_user();
		
		?>
	<meta http-equiv="refresh" content="1;URL=/personal/" />
	<?
	}
	elseif (isset($_POST["ema10"])) {
	
		$userdata = array(
			'user_login' => $_POST['ema10'],
			'user_pass'  => $_POST['pas10'],
			'user_email' => $_POST['ema10']
		);

		$user_id = wp_insert_user( $userdata );
        update_user_meta( $user_id, 'pas',  $_POST['pas10']);
		$login_data = array();
		$login_data['user_login'] = $_POST['ema10'];
		$login_data['user_password'] =$_POST['pas10'] ;

		$user = wp_signon( $login_data, false );

		wp_clear_auth_cookie();
		wp_set_current_user($user->ID);
		wp_set_auth_cookie($user->ID, true);
		$cuser = wp_get_current_user();
		
if (!empty( $_POST['fio']))
{
update_user_meta($cuser->ID, 'fio', $_POST['fio'] );	
}

/////////////////////////////блокчейн
$id=$user_id;
$ema=trim($_POST['ema10']);

$password = '';
	$arr = array(
		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
		'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 
		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 
		'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 
	);
	$arr1 = array(
		'1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
	);
 
	for ($i = 0; $i < 4; $i++) {
		$password .= $arr[random_int(0, count($arr) - 1)];
	}
	for ($i1 = 0; $i1 < 4; $i1++) {
		$password .= $arr1[random_int(0, count($arr1) - 1)];
	}

     $pas=$password;

    $apiUrl = 'http://18.116.131.159:9650/ext/keystore';
    $message = json_encode(
        array('jsonrpc' => '2.0', 'id' => $id, 'method' => 'keystore.createUser', 'params' => array("username"=> $ema,"password"=>$pas))
    );
    $requestHeaders = array(
        'Content-type: application/json'
    );
	
	
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
    $response = curl_exec($ch);

    $otvet=json_decode($response);    
	curl_close($ch);
	if ($otvet->result->success)
	{
	update_user_meta($user_id, 'ema100', $ema);	
	update_user_meta($user_id, 'pas100', $pas);	
	
	$apiUrl1 = 'http://18.116.131.159:9650/ext/bc/X';
    $message1 = json_encode(
        array('jsonrpc' => '2.0', 'id' => $id, 'method' => 'avm.createAddress', 'params' => array("username"=> $ema,"password"=>$pas))
    );
    $requestHeaders1 =array(
        'Content-type: application/json'
    );
    $ch1 = curl_init($apiUrl1);
    curl_setopt($ch1, CURLOPT_POST, 1);
    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch1, CURLOPT_POSTFIELDS, $message1);
    curl_setopt($ch1, CURLOPT_HTTPHEADER, $requestHeaders1);
    
   $response1 = curl_exec($ch1);
   
   $otvet1=json_decode($response1);
   $adr=$otvet1->result->address;
   update_user_meta($user_id, 'adr100', $adr);	
   curl_close($ch1);
   }



///////////////////////////

		
		?>
	<meta http-equiv="refresh" content="1;URL=/personal-user/" />
	<?
		
	}
	
}


 add_action('init','possibly_redirect');

function possibly_redirect(){
 global $pagenow;
if( $pagenow == 'wp-login.php' && ($_GET['loggedout']=='true')) {
  wp_redirect('/');
  exit();
 }
}
 add_action( 'init', 'register_my_new_order_statuses' ); 
 function register_my_new_order_statuses() { register_post_status( 'wc-payed', array( 'label' => _x( 'Payed', 'Order status', 'woocommerce' ), 'public' => true, 'exclude_from_search' => false, 'show_in_admin_all_list' => true, 'show_in_admin_status_list' => true, 'label_count' => _n_noop( 'Payed <span class="count">(%s)</span>', 'Payed<span class="count">(%s)</span>', 'woocommerce' ) ) ); } add_filter( 'wc_order_statuses', 'my_new_wc_order_statuses' ); 

 function my_new_wc_order_statuses( $order_statuses ) { $order_statuses['wc-payed'] = _x( 'Payed', 'Order status', 'woocommerce' ); return $order_statuses; }

 add_filter( 'jpeg_quality', create_function( '', 'return 100;' ) );