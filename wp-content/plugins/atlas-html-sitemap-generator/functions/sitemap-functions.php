<?php
/**
 * HTML Sitemap Generator.
 *
 * @package HTML_Sitemap_Generator
 * @author Donal MacArthur
 * @copyright Copyright (c) 2011, Donal MacArthur
 * @link http://www.cranesandskyhooks.com/wordpress-plugins/html-sitemap-generator/
 */

/**
 * Generate the sitemap output.
 *
 * @since 1.0
 * @return string
 */
function dmac_html_sitemap() {

	/* Check for a cached version of the sitemap. */
	$cache = get_transient( 'dmac_html_sitemap' );
	if ( $cache )
		return $cache;
		
	/* Instantiate the DMAC_Plugin_Tools() class. */
	$plugin_tools = new DMAC_Plugin_Tools_1_0_00();

	/* Get option settings from the database. */
	$settings = get_option( 'dmac_html_sitemap' );

	$output = "<div class='html-sitemap sitemap'>\n";
	
		/* Feeds */
		if ( ( isset( $settings['sitemap-include-post-feed'] ) && $settings['sitemap-include-post-feed'] )  || ( isset( $settings['sitemap-include-comment-feed'] ) && $settings['sitemap-include-comment-feed'] ) ) {
			$output .= "<h2>Feeds</h2>\n";
			$output .= "<ul class='feeds'>\n";
				if ( $settings['sitemap-include-post-feed'] )
					$output .= "<li><a href='" . get_bloginfo( 'rss2_url' ) . "'>Post Feed</a></li>\n";
				if ( $settings['sitemap-include-comment-feed'] )
					$output .= "<li><a href='" . get_bloginfo( 'comments_rss2_url' ) . "'>Comment Feed</a></li>\n";
			$output .= "</ul>\n";
		}
		
		/* Authors */
		if ( isset( $settings['sitemap-include-authors'] ) && $settings['sitemap-include-authors'] ) {
			$output .= "<h2>Authors</h2>\n";
			$output .= "<ul class='authors'>\n";
				$output .= wp_list_authors( array( 'echo' => 0, 'optioncount' => $settings['sitemap-author-postcount'] ) );
			$output .= "</ul>\n";
		}
		
		/* Pages */
		if ( isset( $settings['sitemap-include-pages'] ) && $settings['sitemap-include-pages'] ) {
			$excludes = $settings['sitemap-excluded-pages'] ? $plugin_tools->exclude_page_trees( $settings['sitemap-excluded-pages'] ) : '';
			$output .= "<h2>Pages</h2>\n";
			$output .= "<ul class='pages'>\n";
				if ( $settings['sitemap-show-homelink'] )
					$output .= "<li><a href='" . get_home_url() . "'>Home</a></li>\n";
				$output .= wp_list_pages( array( 'title_li' => '', 'echo' => 0, 'exclude' => $excludes ) );
			$output .= "</ul>\n";
		}
		
		/* Categories */
		if ( isset ( $settings['sitemap-include-categories'] ) && $settings['sitemap-include-categories'] ) {
			$output .= "<h2>Categories</h2>\n";
			$output .= "<ul class='categories'>\n";
				$output .= wp_list_categories( array( 'title_li' => '', 'echo' => 0, 'exclude' => $settings['sitemap-excluded-categories'], 'show_count' => $settings['sitemap-category-postcount'] ) );
			$output .= "</ul>\n";		
		}
		
		/* Tags */
		if ( isset( $settings['sitemap-include-tags'] ) && $settings['sitemap-include-tags'] ) {
			$output .= "<h2>Tags</h2>\n";
			if ( $settings['sitemap-tags-as-cloud'] )
				$output .= "<p class='tag-cloud' style='line-height: 1.5;'>" . wp_tag_cloud( array( 'echo' => 0, 'exclude' => $settings['sitemap-excluded-tags'] ) ) . "</p>\n";
			else {
				$output .= "<ul class='tags'>\n";
					$output .= wp_list_categories( array( 'taxonomy' => 'post_tag', 'title_li' => '', 'echo' => 0, 'exclude' => $settings['sitemap-excluded-tags'], 'show_count' => $settings['sitemap-tag-postcount'] ) );
				$output .= "</ul>\n";
			}
		}
		
		/* Archives */
		if ( isset( $settings['sitemap-include-archives'] ) && $settings['sitemap-include-archives'] ) {
			$output .= "<h2>Archives</h2>\n";
			$output .= "<ul class='archives'>\n";
				$output .= wp_get_archives( array( 'type' => 'monthly', 'show_post_count' => $settings['sitemap-archive-postcount'], 'echo' => 0 ) );
			$output .= "</ul>\n";	
		}

		/* Posts */
		if ( isset( $settings['sitemap-include-posts'] ) && $settings['sitemap-include-posts'] ) {
			
			$output .= "<h2>Posts</h2>\n";
			$output .= "<ul class='posts'>\n";

				/* Get an array of top-level categories. */
				$categories = get_terms( 'category', array( 'parent' => 0, 'exclude' => $settings['sitemap-excluded-post-categories'], 'hide_empty' => false ) );	
		
				/* Loop through the top-level categories and process each in turn. */
				foreach ( $categories as $category )
					$output .= dmac_html_sitemap_process_category( $category, $settings );
		
			$output .= "</ul>";
		}
		
	$output .= "</div><!-- end .html-sitemap -->\n";
	
	/* Cache the output for up to one week. */
	set_transient( 'dmac_html_sitemap', $output, 60*60*24*7 );

	return $output;
}

/**
 * Process a single category. Print any posts the category contains, then check for sub-categories.
 * 
 * @since 1.2
 * @param object $category a WordPress term object
 * @param array $settings an array containing the user's saved settings
 * @return string 
 */
function dmac_html_sitemap_process_category( $category, $settings ) {
	
	/* Skip the 'Uncategorized' category. */
	if ( 'uncategorized' == $category->slug )
		return '';

	/* Print the category name. */
	$output = "<li><h3>" . $category->name . "</h3>\n";
		$output .= "<ul>";

			/* Print links to any posts the category contains. */
			$posts = get_posts( array( 'numberposts' => -1, 'category' => $category->term_id, 'exclude' => $settings['sitemap-excluded-posts'] ) );
			foreach ( $posts as $post ) {
				$post_categories = get_the_category( $post->ID );
				if ( $category->term_id == $post_categories[0]->term_id ) {
					$link = get_permalink( $post->ID );
					$title = $post->post_title;
					$comments = $settings['sitemap-post-commentcount'] ? ' (' . $post->comment_count . ')' : '';
					$output .= "<li><a href='{$link}'>{$title}</a>{$comments}</li>\n";
				}
			}
			unset( $posts );
			unset( $post_categories );

			/* Does the current category contain any subcategories? If so, rinse and repeat. */
			$sub_categories = get_terms( 'category', array( 'parent' => $category->term_id, 'exclude' => $settings['sitemap-excluded-post-categories'], 'hide_empty' => false ) );
			foreach ( $sub_categories as $sub_category )
				$output .= dmac_html_sitemap_process_category( $sub_category, $settings );

		$output .= "</ul>\n";
	$output .= "</li>\n";
	
	return $output;
}

/**
 * Delete the cached version of the sitemap.
 * 
 * @since 1.2
 */
function dmac_delete_html_sitemap_cache() {
	delete_transient( 'dmac_html_sitemap' );
}

/**
 * Returns the sitemap options as an array in standard Atlas/DMAC format.
 * 
 * @since 1.0
 * @return array
 */	
function dmac_html_sitemap_options_array() {

	$options = array(
	
		array(
			'type'    => 'info',
			'content' => "To create an HTML sitemap for your site, configure its settings below, then simply add the <code>[sitemap]</code> shortcode to the page where you want it to appear." ),
	
		array(
			'type'    => 'checkbox',
			'title'   => 'Feeds:',
			'id'      => 'sitemap-include-post-feed',
			'desc'    => "",
			'std'     => 1,
			'label'   => 'Include post feed' ),
	
		array(
			'type'    => 'checkbox',
			'title'   => ' ',
			'id'      => 'sitemap-include-comment-feed',
			'desc'    => "",
			'std'     => 1,
			'label'   => 'Include comment feed' ),
	
		array(
			'type'    => 'checkbox',
			'title'   => 'Authors:',
			'id'      => 'sitemap-include-authors',
			'desc'    => "",
			'std'     => 1,
			'label'   => 'Include authors' ),
	
		array(
			'type'    => 'checkbox',
			'title'   => ' ',
			'id'      => 'sitemap-author-postcount',
			'desc'    => "",
			'std'     => 0,
			'label'   => 'Display post count for authors' ),
	
		array(
			'type'    => 'checkbox',
			'title'   => 'Pages:',
			'id'      => 'sitemap-include-pages',
			'desc'    => "",
			'std'     => 1,
			'label'   => 'Include pages' ),
			
		array(
			'type'    => 'checkbox',
			'title'   => ' ',
			'id'      => 'sitemap-show-homelink',
			'desc'    => "",
			'std'     => 0,
			'label'   => "Add a 'Home' link to the page list" ),
			
		array(
			'type'    => 'text',
			'title'   => ' ',
			'id'      => 'sitemap-excluded-pages',
			'desc'    => 'Enter a comma-separated list of page IDs to exclude, e.g. 5,9,27',
			'std'     => '',
			'class'   => 'full' ),
		
		array(
			'type'    => 'checkbox',
			'title'   => 'Categories:',
			'id'      => 'sitemap-include-categories',
			'desc'    => "",
			'std'     => 1,
			'label'   => 'Include categories' ),
	
		array(
			'type'    => 'checkbox',
			'title'   => ' ',
			'id'      => 'sitemap-category-postcount',
			'desc'    => "",
			'std'     => 0,
			'label'   => 'Display post count for categories' ),
	
		array(
			'type'    => 'text',
			'title'   => ' ',
			'id'      => 'sitemap-excluded-categories',
			'desc'    => 'Enter a comma-separated list of category IDs to exclude, e.g. 5,9,27',
			'std'     => '',
			'class'   => 'full' ),
		
		array(
			'type'    => 'checkbox',
			'title'   => 'Tags:',
			'id'      => 'sitemap-include-tags',
			'desc'    => "",
			'std'     => 0,
			'label'   => 'Include tags' ),
	
		array(
			'type'    => 'checkbox',
			'title'   => ' ',
			'id'      => 'sitemap-tag-postcount',
			'desc'    => "",
			'std'     => 0,
			'label'   => 'Display post count for tags' ),
	
		array(
			'type'    => 'checkbox',
			'title'   => ' ',
			'id'      => 'sitemap-tags-as-cloud',
			'desc'    => "",
			'std'     => 0,
			'label'   => 'Display as tag cloud' ),
	
		array(
			'type'    => 'text',
			'title'   => ' ',
			'id'      => 'sitemap-excluded-tags',
			'desc'    => 'Enter a comma-separated list of tag IDs to exclude, e.g. 5,9,27',
			'std'     => '',
			'class'   => 'full' ),
		
		array(
			'type'    => 'checkbox',
			'title'   => 'Archives:',
			'id'      => 'sitemap-include-archives',
			'desc'    => "",
			'std'     => 1,
			'label'   => 'Include archives' ),
	
		array(
			'type'    => 'checkbox',
			'title'   => ' ',
			'id'      => 'sitemap-archive-postcount',
			'desc'    => "",
			'std'     => 0,
			'label'   => 'Display post count for archives' ),
	
		array(
			'type'    => 'checkbox',
			'title'   => 'Posts:',
			'id'      => 'sitemap-include-posts',
			'desc'    => "",
			'std'     => 1,
			'label'   => 'Include posts' ),
	
		array(
			'type'    => 'checkbox',
			'title'   => ' ',
			'id'      => 'sitemap-post-commentcount',
			'desc'    => "",
			'std'     => 0,
			'label'   => 'Display comment count for posts' ),
	
		array(
			'type'    => 'text',
			'title'   => ' ',
			'id'      => 'sitemap-excluded-posts',
			'desc'    => 'Enter a comma-separated list of post IDs to exclude, e.g. 5,9,27',
			'std'     => '',
			'class'   => 'full' ),
			
		array(
			'type'    => 'text',
			'title'   => ' ',
			'id'      => 'sitemap-excluded-post-categories',
			'desc'    => 'Enter a comma-separated list of category IDs to exclude, e.g. 5,9,27',
			'std'     => '',
			'class'   => 'full' )
	);
	
	return $options;
}