<?php
/**
 * Delta Growth Theme Functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Delta_Growth
 * @since Delta Growth 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Delta Growth 1.0
 *
 * @return void
 */
function delta_growth_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'delta-growth' ),
			'footer'  => esc_html__( 'Footer Menu', 'delta-growth' ),
		)
	);

	// Switch default core markup to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'delta_growth_setup' );

/**
 * Enqueue scripts and styles.
 *
 * @since Delta Growth 1.0
 *
 * @return void
 */
function delta_growth_enqueue_scripts() {
	// Get theme version for cache busting.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueue Google Fonts - Inter.
	wp_enqueue_style(
		'delta-growth-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
		array(),
		null // Google Fonts don't need version numbers.
	);

	// Enqueue Font Awesome.
	wp_enqueue_style(
		'font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
		array(),
		'6.5.1'
	);

	// Enqueue main theme stylesheet.
	wp_enqueue_style(
		'delta-growth-style',
		get_template_directory_uri() . '/style.css',
		array( 'delta-growth-google-fonts', 'font-awesome' ),
		$theme_version
	);

	// Enqueue main JavaScript file.
	wp_enqueue_script(
		'delta-growth-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array( 'jquery' ),
		$theme_version,
		true // Load in footer.
	);

	// Add comment reply script for threaded comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'delta_growth_enqueue_scripts' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @since Delta Growth 1.0
 *
 * @global int $content_width
 */
function delta_growth_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'delta_growth_content_width', 1200 );
}
add_action( 'after_setup_theme', 'delta_growth_content_width', 0 );

/**
 * Register widget areas.
 *
 * @since Delta Growth 1.0
 *
 * @return void
 */
function delta_growth_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'delta-growth' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'delta-growth' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'delta_growth_widgets_init' );

/**
 * Register Custom Post Types.
 *
 * @since Delta Growth 1.0
 *
 * @return void
 */
function delta_growth_register_post_types() {
	// Register Services CPT.
	register_post_type(
		'service',
		array(
			'labels'              => array(
				'name'                  => _x( 'Services', 'Post type general name', 'delta-growth' ),
				'singular_name'         => _x( 'Service', 'Post type singular name', 'delta-growth' ),
				'menu_name'             => _x( 'Services', 'Admin Menu text', 'delta-growth' ),
				'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'delta-growth' ),
				'add_new'               => __( 'Add New', 'delta-growth' ),
				'add_new_item'          => __( 'Add New Service', 'delta-growth' ),
				'new_item'              => __( 'New Service', 'delta-growth' ),
				'edit_item'             => __( 'Edit Service', 'delta-growth' ),
				'view_item'             => __( 'View Service', 'delta-growth' ),
				'all_items'             => __( 'All Services', 'delta-growth' ),
				'search_items'          => __( 'Search Services', 'delta-growth' ),
				'parent_item_colon'     => __( 'Parent Services:', 'delta-growth' ),
				'not_found'             => __( 'No services found.', 'delta-growth' ),
				'not_found_in_trash'    => __( 'No services found in Trash.', 'delta-growth' ),
				'featured_image'        => _x( 'Service Featured Image', 'Overrides the "Featured Image" phrase', 'delta-growth' ),
				'set_featured_image'    => _x( 'Set featured image', 'Overrides the "Set featured image" phrase', 'delta-growth' ),
				'remove_featured_image' => _x( 'Remove featured image', 'Overrides the "Remove featured image" phrase', 'delta-growth' ),
				'use_featured_image'    => _x( 'Use as featured image', 'Overrides the "Use as featured image" phrase', 'delta-growth' ),
				'archives'              => _x( 'Service archives', 'The post type archive label', 'delta-growth' ),
				'insert_into_item'      => _x( 'Insert into service', 'Overrides the "Insert into post" phrase', 'delta-growth' ),
				'uploaded_to_this_item' => _x( 'Uploaded to this service', 'Overrides the "Uploaded to this post" phrase', 'delta-growth' ),
				'filter_items_list'     => _x( 'Filter services list', 'Screen reader text for the filter links', 'delta-growth' ),
				'items_list_navigation' => _x( 'Services list navigation', 'Screen reader text for the pagination', 'delta-growth' ),
				'items_list'            => _x( 'Services list', 'Screen reader text for the items list', 'delta-growth' ),
			),
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array( 'slug' => 'service' ),
			'capability_type'     => 'post',
			'has_archive'         => true,
			'hierarchical'        => false,
			'menu_position'       => 20,
			'menu_icon'           => 'dashicons-admin-tools',
			'supports'            => array( 'title', 'editor', 'thumbnail' ),
			'show_in_rest'        => true,
		)
	);

	// Register Testimonials CPT.
	register_post_type(
		'testimonial',
		array(
			'labels'              => array(
				'name'                  => _x( 'Testimonials', 'Post type general name', 'delta-growth' ),
				'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'delta-growth' ),
				'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'delta-growth' ),
				'name_admin_bar'        => _x( 'Testimonial', 'Add New on Toolbar', 'delta-growth' ),
				'add_new'               => __( 'Add New', 'delta-growth' ),
				'add_new_item'          => __( 'Add New Testimonial', 'delta-growth' ),
				'new_item'              => __( 'New Testimonial', 'delta-growth' ),
				'edit_item'             => __( 'Edit Testimonial', 'delta-growth' ),
				'view_item'             => __( 'View Testimonial', 'delta-growth' ),
				'all_items'             => __( 'All Testimonials', 'delta-growth' ),
				'search_items'          => __( 'Search Testimonials', 'delta-growth' ),
				'parent_item_colon'     => __( 'Parent Testimonials:', 'delta-growth' ),
				'not_found'             => __( 'No testimonials found.', 'delta-growth' ),
				'not_found_in_trash'    => __( 'No testimonials found in Trash.', 'delta-growth' ),
				'featured_image'        => _x( 'Client Photo', 'Overrides the "Featured Image" phrase', 'delta-growth' ),
				'set_featured_image'    => _x( 'Set client photo', 'Overrides the "Set featured image" phrase', 'delta-growth' ),
				'remove_featured_image' => _x( 'Remove client photo', 'Overrides the "Remove featured image" phrase', 'delta-growth' ),
				'use_featured_image'    => _x( 'Use as client photo', 'Overrides the "Use as featured image" phrase', 'delta-growth' ),
				'archives'              => _x( 'Testimonial archives', 'The post type archive label', 'delta-growth' ),
				'insert_into_item'      => _x( 'Insert into testimonial', 'Overrides the "Insert into post" phrase', 'delta-growth' ),
				'uploaded_to_this_item' => _x( 'Uploaded to this testimonial', 'Overrides the "Uploaded to this post" phrase', 'delta-growth' ),
				'filter_items_list'     => _x( 'Filter testimonials list', 'Screen reader text for the filter links', 'delta-growth' ),
				'items_list_navigation' => _x( 'Testimonials list navigation', 'Screen reader text for the pagination', 'delta-growth' ),
				'items_list'            => _x( 'Testimonials list', 'Screen reader text for the items list', 'delta-growth' ),
			),
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array( 'slug' => 'testimonial' ),
			'capability_type'     => 'post',
			'has_archive'         => true,
			'hierarchical'        => false,
			'menu_position'       => 21,
			'menu_icon'           => 'dashicons-testimonial',
			'supports'            => array( 'title', 'editor', 'thumbnail' ),
			'show_in_rest'        => true,
		)
	);

	// Register Pricing Plans CPT.
	register_post_type(
		'pricing_plan',
		array(
			'labels'              => array(
				'name'                  => _x( 'Pricing Plans', 'Post type general name', 'delta-growth' ),
				'singular_name'         => _x( 'Pricing Plan', 'Post type singular name', 'delta-growth' ),
				'menu_name'             => _x( 'Pricing Plans', 'Admin Menu text', 'delta-growth' ),
				'name_admin_bar'        => _x( 'Pricing Plan', 'Add New on Toolbar', 'delta-growth' ),
				'add_new'               => __( 'Add New', 'delta-growth' ),
				'add_new_item'          => __( 'Add New Pricing Plan', 'delta-growth' ),
				'new_item'              => __( 'New Pricing Plan', 'delta-growth' ),
				'edit_item'             => __( 'Edit Pricing Plan', 'delta-growth' ),
				'view_item'             => __( 'View Pricing Plan', 'delta-growth' ),
				'all_items'             => __( 'All Pricing Plans', 'delta-growth' ),
				'search_items'          => __( 'Search Pricing Plans', 'delta-growth' ),
				'parent_item_colon'     => __( 'Parent Pricing Plans:', 'delta-growth' ),
				'not_found'             => __( 'No pricing plans found.', 'delta-growth' ),
				'not_found_in_trash'    => __( 'No pricing plans found in Trash.', 'delta-growth' ),
				'archives'              => _x( 'Pricing Plan archives', 'The post type archive label', 'delta-growth' ),
				'insert_into_item'      => _x( 'Insert into pricing plan', 'Overrides the "Insert into post" phrase', 'delta-growth' ),
				'uploaded_to_this_item' => _x( 'Uploaded to this pricing plan', 'Overrides the "Uploaded to this post" phrase', 'delta-growth' ),
				'filter_items_list'     => _x( 'Filter pricing plans list', 'Screen reader text for the filter links', 'delta-growth' ),
				'items_list_navigation' => _x( 'Pricing Plans list navigation', 'Screen reader text for the pagination', 'delta-growth' ),
				'items_list'            => _x( 'Pricing Plans list', 'Screen reader text for the items list', 'delta-growth' ),
			),
			'public'              => true,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'query_var'           => true,
			'rewrite'             => array( 'slug' => 'pricing-plan' ),
			'capability_type'     => 'post',
			'has_archive'         => true,
			'hierarchical'        => false,
			'menu_position'       => 22,
			'menu_icon'           => 'dashicons-cart',
			'supports'            => array( 'title', 'editor' ),
			'show_in_rest'        => true,
		)
	);
}
add_action( 'init', 'delta_growth_register_post_types' );

/**
 * Register ACF Field Groups for Custom Post Types.
 *
 * @since Delta Growth 1.0
 *
 * @return void
 */
function delta_growth_register_acf_fields() {
	// Check if ACF function exists.
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Services Custom Fields.
	acf_add_local_field_group(
		array(
			'key'                   => 'group_services',
			'title'                 => 'Service Details',
			'fields'                => array(
				array(
					'key'               => 'field_service_short_description',
					'label'             => 'Short Description',
					'name'              => 'short_description',
					'type'              => 'textarea',
					'instructions'      => 'Enter a brief description of the service (recommended: 100-150 characters)',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placeholder'       => 'Brief service description...',
					'maxlength'         => 200,
					'rows'              => 3,
					'new_lines'         => '',
				),
				array(
					'key'               => 'field_service_icon_class',
					'label'             => 'Icon Class',
					'name'              => 'icon_class',
					'type'              => 'text',
					'instructions'      => 'Enter the icon class (e.g., "fas fa-rocket" for Font Awesome or "dashicons-admin-tools" for Dashicons). Leave empty if not using an icon.',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placeholder'       => 'fas fa-rocket',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'service',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);

	// Testimonials Custom Fields.
	acf_add_local_field_group(
		array(
			'key'                   => 'group_testimonials',
			'title'                 => 'Testimonial Details',
			'fields'                => array(
				array(
					'key'               => 'field_testimonial_client_company',
					'label'             => 'Client Company',
					'name'              => 'client_company',
					'type'              => 'text',
					'instructions'      => 'Enter the client\'s company name',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placeholder'       => 'Company Name',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),
				array(
					'key'               => 'field_testimonial_rating',
					'label'             => 'Rating',
					'name'              => 'rating',
					'type'              => 'range',
					'instructions'      => 'Select a rating from 1 to 5 stars',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => 5,
					'min'               => 1,
					'max'               => 5,
					'step'              => 1,
					'prepend'           => '',
					'append'            => 'stars',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'testimonial',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);

	// Pricing Plans Custom Fields.
	acf_add_local_field_group(
		array(
			'key'                   => 'group_pricing_plans',
			'title'                 => 'Pricing Plan Details',
			'fields'                => array(
				array(
					'key'               => 'field_pricing_plan_price',
					'label'             => 'Price',
					'name'              => 'price',
					'type'              => 'text',
					'instructions'      => 'Enter the price (e.g., "N99/month" or "N1,999")',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placeholder'       => 'N99/month',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),
				array(
					'key'               => 'field_pricing_plan_features',
					'label'             => 'Features',
					'name'              => 'features',
					'type'              => 'textarea',
					'instructions'      => 'Enter one feature per line. Each line will be displayed as a separate feature with a checkmark.',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '',
					'placeholder'       => "Strategy session\nWebsite optimisation\n1 ad platform management\nMonthly reporting\nEmail support",
					'maxlength'         => '',
					'rows'              => 8,
					'new_lines'         => '',
				),
				array(
					'key'               => 'field_pricing_plan_highlight',
					'label'             => 'Highlight Plan',
					'name'              => 'highlight_plan',
					'type'              => 'true_false',
					'instructions'      => 'Enable this to highlight this plan (e.g., "Most Popular" or "Best Value")',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'message'           => 'Highlight this plan',
					'default_value'     => 0,
					'ui'                => 1,
					'ui_on_text'        => 'Yes',
					'ui_off_text'       => 'No',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'pricing_plan',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);
}
add_action( 'acf/init', 'delta_growth_register_acf_fields' );

/**
 * Register ACF Field Group for Front Page Hero Section.
 *
 * @since Delta Growth 1.0
 *
 * @return void
 */
function delta_growth_register_front_page_acf_fields() {
	// Check if ACF function exists.
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Front Page Hero Section Fields.
	acf_add_local_field_group(
		array(
			'key'                   => 'group_front_page_hero',
			'title'                 => 'Hero Section',
			'fields'                => array(
				array(
					'key'               => 'field_hero_headline',
					'label'             => 'Headline',
					'name'              => 'hero_headline',
					'type'              => 'text',
					'instructions'      => 'Enter the main headline for the hero section',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => 'Accelerate Your Business Growth',
					'placeholder'       => 'Your main headline...',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),
				array(
					'key'               => 'field_hero_subtext',
					'label'             => 'Subtext',
					'name'              => 'hero_subtext',
					'type'              => 'textarea',
					'instructions'      => 'Enter the supporting text for the hero section',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => 'We help businesses scale with data-driven strategies and innovative solutions.',
					'placeholder'       => 'Supporting text...',
					'maxlength'         => '',
					'rows'              => 3,
					'new_lines'         => '',
				),
				array(
					'key'               => 'field_hero_cta_text',
					'label'             => 'CTA Button Text',
					'name'              => 'hero_cta_text',
					'type'              => 'text',
					'instructions'      => 'Enter the call-to-action button text',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => 'Get Started',
					'placeholder'       => 'Button text...',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => 50,
				),
				array(
					'key'               => 'field_hero_cta_link',
					'label'             => 'CTA Button Link',
					'name'              => 'hero_cta_link',
					'type'              => 'url',
					'instructions'      => 'Enter the URL for the call-to-action button',
					'required'          => 1,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '50',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '#contact',
					'placeholder'       => 'https://...',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => 'Configure the hero section on the front page',
		)
	);

	// Front Page About Section Fields.
	acf_add_local_field_group(
		array(
			'key'                   => 'group_front_page_about',
			'title'                 => 'About Section',
			'fields'                => array(
				array(
					'key'               => 'field_about_title',
					'label'             => 'Section Title',
					'name'              => 'about_title',
					'type'              => 'text',
					'instructions'      => 'Enter the title for the about section',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => 'Why Choose Delta Growth',
					'placeholder'       => 'Section title...',
					'prepend'           => '',
					'append'            => '',
					'maxlength'         => '',
				),
				array(
					'key'               => 'field_about_content',
					'label'             => 'About Content',
					'name'              => 'about_content',
					'type'              => 'wysiwyg',
					'instructions'      => 'Enter the content for the about section',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'default_value'     => '<p>We are a team of experts dedicated to helping businesses achieve sustainable growth through innovative strategies and cutting-edge solutions.</p>',
					'tabs'              => 'all',
					'toolbar'           => 'basic',
					'media_upload'      => 0,
					'delay'             => 0,
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'            => 1,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => 'Configure the about section on the front page',
		)
	);
}
add_action( 'acf/init', 'delta_growth_register_front_page_acf_fields' );

/**
 * Helper function to get service short description.
 *
 * @since Delta Growth 1.0
 *
 * @param int $post_id Optional. Post ID. Default is current post.
 * @return string Service short description.
 */
function delta_growth_get_service_short_description( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	return function_exists( 'get_field' ) ? get_field( 'short_description', $post_id ) : '';
}

/**
 * Helper function to get service icon class.
 *
 * @since Delta Growth 1.0
 *
 * @param int $post_id Optional. Post ID. Default is current post.
 * @return string Service icon class.
 */
function delta_growth_get_service_icon_class( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	return function_exists( 'get_field' ) ? get_field( 'icon_class', $post_id ) : '';
}

/**
 * Helper function to get testimonial client company.
 *
 * @since Delta Growth 1.0
 *
 * @param int $post_id Optional. Post ID. Default is current post.
 * @return string Client company name.
 */
function delta_growth_get_testimonial_company( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	return function_exists( 'get_field' ) ? get_field( 'client_company', $post_id ) : '';
}

/**
 * Helper function to get testimonial rating.
 *
 * @since Delta Growth 1.0
 *
 * @param int $post_id Optional. Post ID. Default is current post.
 * @return int Rating value (1-5).
 */
function delta_growth_get_testimonial_rating( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	return function_exists( 'get_field' ) ? (int) get_field( 'rating', $post_id ) : 5;
}

/**
 * Helper function to get pricing plan price.
 *
 * @since Delta Growth 1.0
 *
 * @param int $post_id Optional. Post ID. Default is current post.
 * @return string Pricing plan price.
 */
function delta_growth_get_pricing_plan_price( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	return function_exists( 'get_field' ) ? get_field( 'price', $post_id ) : '';
}

/**
 * Helper function to get pricing plan features.
 *
 * @since Delta Growth 1.0
 *
 * @param int $post_id Optional. Post ID. Default is current post.
 * @return array Array of features.
 */
function delta_growth_get_pricing_plan_features( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	if ( ! function_exists( 'get_field' ) ) {
		return array();
	}

	$features = get_field( 'features', $post_id );

	// If features is a string (textarea), convert to array
	if ( is_string( $features ) ) {
		$features = explode( "\n", $features );
		$features = array_map( 'trim', $features );
		$features = array_filter( $features ); // Remove empty lines

		// Convert to format expected by templates: array of arrays with 'feature_text' key
		$formatted_features = array();
		foreach ( $features as $feature ) {
			$formatted_features[] = array( 'feature_text' => $feature );
		}
		return $formatted_features;
	}

	// If it's already an array (from repeater in ACF PRO), return as is
	if ( is_array( $features ) ) {
		return $features;
	}

	return array();
}

/**
 * Helper function to check if pricing plan is highlighted.
 *
 * @since Delta Growth 1.0
 *
 * @param int $post_id Optional. Post ID. Default is current post.
 * @return bool True if highlighted, false otherwise.
 */
function delta_growth_is_pricing_plan_highlighted( $post_id = 0 ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	return function_exists( 'get_field' ) ? (bool) get_field( 'highlight_plan', $post_id ) : false;
}

/**
 * Prints HTML with meta information for the current post-date/time.
 *
 * @since Delta Growth 1.0
 *
 * @return void
 */
function delta_growth_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'delta-growth' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the current author.
 *
 * @since Delta Growth 1.0
 *
 * @return void
 */
function delta_growth_posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'delta-growth' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 *
 * @since Delta Growth 1.0
 *
 * @return void
 */
function delta_growth_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'delta-growth' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'delta-growth' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'delta-growth' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'delta-growth' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'delta-growth' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'delta-growth' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post( get_the_title() )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
