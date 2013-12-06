<?php

add_action( 'after_setup_theme', 'my_setup' );

if ( ! function_exists( 'my_setup' ) ):

function my_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 220, 119, true ); // Normal post thumbnails
		add_image_size( 'post-thumbnail-xl', 692, 300, true ); // Portfolio Extra Large Thumbnail
		add_image_size( 'slider-post-thumbnail', 460, 238, true ); // Slider Thumbnail
		add_image_size( 'portfolio-post-thumbnail', 290, 150, true ); // Portfolio Thumbnail
		add_image_size( 'portfolio-post-thumbnail-small', 200, 120, true ); // Portfolio Small Thumbnail
		add_image_size( 'portfolio-post-thumbnail-large', 440, 240, true ); // Portfolio Large Thumbnail
		add_image_size( 'portfolio-post-thumbnail-xl', 600, 300, true ); // Portfolio Extra Large Thumbnail
		add_image_size( 'small-post-thumbnail', 100, 100, true ); // Small Thumbnail
		add_image_size( 'testi-thumbnail', 120, 120, true ); // Testimonial Thumbnail
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// custom menu support
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
	  		array(
	  		  'header_menu' => 'Header Menu',
	  		  'footer_menu' => 'Footer Menu'
	  		)
	  	);
	}
}
endif;


/* Slider */
function my_post_type_slider() {
	register_post_type( 'slider',
                array( 
				'label' => __('Slides'), 
				'singular_label' => __('Slide', 'theme1318'),
				'_builtin' => false,
				'exclude_from_search' => true, // Exclude from Search Results
				'capability_type' => 'page',
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'rewrite' => array(
					'slug' => 'slide-view',
					'with_front' => FALSE,
				),
				'query_var' => "slide", // This goes to the WP_Query schema
				'menu_icon' => get_template_directory_uri() . '/includes/images/icon_slides.png',
				'supports' => array(
						'title',
						'custom-fields',
            'thumbnail')
					) 
				);
}

add_action('init', 'my_post_type_slider');



/* Testimonial */
function my_post_type_testi() {
	register_post_type( 'testi',
                array( 
				'label' => __('Testimonial'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'menu_position' => 5,
				'rewrite' => array(
					'slug' => 'testimonial-view',
					'with_front' => FALSE,
				),
				'supports' => array(
						'title',
						'custom-fields',
						'thumbnail',
						'editor')
					) 
				);
}

add_action('init', 'my_post_type_testi');


/* Our Team */
function my_post_type_team() {
	register_post_type( 'team',
                array( 
				'label' => __('Editors'), 
				'singular_label' => __('Person', 'theme1318'),
				'_builtin' => false,
				'exclude_from_search' => true, // Exclude from Search Results
				'capability_type' => 'page',
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => false,
				'menu_position' => 5,
				'rewrite' => array(
					'slug' => 'team-view',
					'with_front' => FALSE,
				),
				'supports' => array(
						'title',
						'custom-fields',
						'editor',
						'excerpt',
            'thumbnail')
					) 
				);
}

add_action('init', 'my_post_type_team');



?>