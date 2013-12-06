<?php
/**
 * Slider
 *
 */
function shortcode_slider($atts, $content = null) {

		extract(shortcode_atts(array(
				'type' => 'slider',
				'num' => '5',
				'thumb_size' => 'slider-post-thumbnail'
		), $atts));

		$slides = get_posts('post_type='.$type.'&orderby=post_date&order=desc&numberposts='.$num);

		$output = '<ul id="slider-cycle">';
		
		global $post;
		foreach($slides as $post){
				
				setup_postdata($post);
				
				$custom = get_post_custom($post->ID);
				$sliderurl = $custom["slider-url"][0];
			
				$output .= '<li>';
						if ( has_post_thumbnail($post->ID) ){
								$output .= '<a href="'.$sliderurl.'" title="'.get_the_title($post->ID).'"><div class="thumb-wrap">';
								$output .= get_the_post_thumbnail($post->ID, "$thumb_size", array( "class" => "thumb" ));
								$output .= '</div></a>';
						}
						$output .= '<h1><a href="'.$sliderurl.'" title="'.get_the_title($post->ID).'">';
								$output .= get_the_title($post->ID);
						$output .= '</a></h1>';
						
						
						$output .= '<span class="author-wrap">';
						$output .= 'by ';
						
						$output .= '<span class="author-link">';
						$output .= get_the_author_link($post->ID);
						$output .= '</span></span>';
				$output .= '</li>';

		}

		$output .= '</ul>';
		
		
		$output .= '<div id="slider-controls"><ul id="nav-slider"></ul></div>';

		return $output;

}

add_shortcode('slider', 'shortcode_slider');
?>