<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$shortname = "theme1318";
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Logo type
	$logo_type = array("image_logo" => "Image Logo","text_logo" => "Text Logo");
	
	// Search box in the header
	$g_search_box = array("no" => "No","yes" => "Yes");
	
	// Background Defaults
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	// Superfish fade-in animation
	$sf_f_animation_array = array("show" => "Enable fade-in animation","false" => "Disable fade-in animation");
	
	// Superfish slide-down animation
	$sf_sl_animation_array = array("show" => "Enable slide-down animation","false" => "Disable slide-down animation");
	
	// Superfish animation speed
	$sf_speed_array = array("slow" => "Slow","normal" => "Normal", "fast" => "Fast");
	
	// Superfish arrows markup
	$sf_arrows_array = array("true" => "Yes","false" => "No");
	
	// Superfish shadows
	$sf_shadows_array = array("true" => "Yes","false" => "No");
	
	// Footer menu
	$footer_menu_array = array("true" => "Yes","false" => "No");
	
	// Featured image size on the blog.
	$post_image_size_array = array("normal" => "Normal size","large" => "Large size");
	
	// Featured image size on the single page.
	$single_image_size_array = array("normal" => "Normal size","large" => "Large size");
	
	// Meta for blog
	$post_meta_array = array("true" => "Yes","false" => "No");
	
	// Meta for blog
	$post_excerpt_array = array("true" => "Yes","false" => "No");
	
	
	
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';
		
	$options = array();
	
	$options[] = array( "name" => "General Settings",
						"type" => "heading");
	
	$options[] = array( "name" =>  "Body styling",
						"desc" => "Change the background style.",
						"id" => "body_background",
						"std" => $background_defaults, 
						"type" => "background");
	
	$options[] = array( "name" => "Header background color",
						"desc" => "Change the header background color.",
						"id" => "header_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Buttons and links color",
						"desc" => "Change the color of buttons and links.",
						"id" => "links_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Typography",
						"desc" => "Typography.",
						"id" => "body_typography",
						"std" => array('size' => '12px','face' => '','style' => '','color' => '#333'),
						"type" => "typography");
	
	$options[] = array( "name" => "Display search box?",
						"desc" => "Display search box in the header?",
						"id" => "g_search_box_id",
						"type" => "radio",
						"std" => "yes",
						"options" => $g_search_box);
	
	$options[] = array( "name" => "Custom CSS",
						"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
						"id" => "custom_css",
						"std" => "",
						"type" => "textarea");
	
	
	
	
	
	$options[] = array( "name" => "Logo",
						"type" => "heading");
	
	$options[] = array( "name" => "What kind of logo?",
						"desc" => "Select whether you want your main logo to be an image or text. If you select 'image' you can put in the image url in the next option, and if you select 'text' your Site Title will show instead.",
						"id" => "logo_type",
						"std" => "image_logo",
						"type" => "radio",
						"options" => $logo_type);
	
	$options[] = array( "name" => "Logo URL",
						"desc" => "Enter the link to your logo image.",
						"id" => "logo_url",
						"type" => "upload");
	
	
	$options[] = array( "name" => "Main Navigation",
						"type" => "heading");
	
	$options[] = array( "name" => "Delay",
						"desc" => "miliseconds delay on mouseout.",
						"id" => "sf_delay",
						"std" => "1000",
						"class" => "mini",
						"type" => "text");
	
	$options[] = array( "name" => "Fade-in animation",
						"desc" => "Fade-in animation.",
						"id" => "sf_f_animation",
						"std" => "show",
						"type" => "radio",
						"options" => $sf_f_animation_array);
	
	$options[] = array( "name" => "Slide-down animation",
						"desc" => "Slide-down animation.",
						"id" => "sf_sl_animation",
						"std" => "show",
						"type" => "radio",
						"options" => $sf_sl_animation_array);
	
	$options[] = array( "name" => "Speed",
						"desc" => "Animation speed.",
						"id" => "sf_speed",
						"type" => "select",
						"std" => "normal",
						"class" => "tiny", //mini, tiny, small
						"options" => $sf_speed_array);
	
	$options[] = array( "name" => "Arrows markup",
						"desc" => "Do you want to generate arrow mark-up?",
						"id" => "sf_arrows",
						"std" => "false",
						"type" => "radio",
						"options" => $sf_arrows_array);
	
	$options[] = array( "name" => "Drop shadows",
						"desc" => "Drop shadows (for submenu)",
						"id" => "sf_shadows",
						"std" => "false",
						"type" => "radio",
						"options" => $sf_shadows_array);
	
	
	$options[] = array( "name" => "Blog section",
						"type" => "heading");
	
	$options[] = array( "name" => "Sidebar position",
						"desc" => "Choose sidebar position.",
						"id" => "blog_sidebar_pos",
						"std" => "right",
						"type" => "images",
						"options" => array(
							'left' => $imagepath . '2cl.png',
							'right' => $imagepath . '2cr.png',)
						);
	
	$options[] = array( "name" => "Blog image size",
						"desc" => "Featured image size on the blog.",
						"id" => "post_image_size",
						"type" => "select",
						"std" => "normal",
						"class" => "small", //mini, tiny, small
						"options" => $post_image_size_array);
	
	$options[] = array( "name" => "Single post image size",
						"desc" => "Featured image size on the single page.",
						"id" => "single_image_size",
						"type" => "select",
						"std" => "normal",
						"class" => "small", //mini, tiny, small
						"options" => $single_image_size_array);
	
	$options[] = array( "name" => "Enable Meta for blog posts?",
						"desc" => "Enable or Disable meta information for blog posts.",
						"id" => "post_meta",
						"std" => "true",
						"type" => "radio",
						"options" => $post_meta_array);
	
	$options[] = array( "name" => "Enable excerpt for blog posts?",
						"desc" => "Enable or Disable excerpt for blog posts.",
						"id" => "post_excerpt",
						"std" => "true",
						"type" => "radio",
						"options" => $post_excerpt_array);
	
	
	
	
	$options[] = array( "name" => "Footer",
						"type" => "heading");
	
	$options[] = array( "name" => "Footer copyright text",
						"desc" => "Enter text used in the right side of the footer. It can be HTML.",
						"id" => "footer_text",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Google Analytics Code",
						"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
						"id" => "ga_code",
						"std" => "",
						"type" => "textarea");
	
	$options[] = array( "name" => "Feedburner URL",
						"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website.",
						"id" => "feed_url",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Display Footer menu?",
						"desc" => "Do you want to display footer menu?",
						"id" => "footer_menu",
						"std" => "true",
						"type" => "radio",
						"options" => $footer_menu_array);
	
	return $options;
}