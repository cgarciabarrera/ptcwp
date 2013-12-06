<?php
/**
 *
 * HTML Shortcodes
 *
 */

// Frames

function frame_shortcode($atts, $content = null) {

    $output = '<div class="frame clearfix">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .frame (end) -->';

    return $output;

}

add_shortcode('frame', 'frame_shortcode');

function frame_left_shortcode($atts, $content = null) {

    $output = '<div class="frame alignleft">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .frame (end) -->';

    return $output;

}

add_shortcode('frame_left', 'frame_left_shortcode');

function frame_right_shortcode($atts, $content = null) {

    $output = '<div class="frame alignright">';
    $output .= do_shortcode($content);
    $output .= '</div><!-- .frame (end) -->';

    return $output;

}

add_shortcode('frame_right', 'frame_right_shortcode');


// Button

function button_shortcode($atts, $content = null) {

	extract(shortcode_atts(
        array(
            'link' => 'http://www.google.com',
            'text' => 'Button Text'
    ), $atts));
    
    $output =  '<a href="'.$link.'" title="'.$text.'" class="button">';
		$output .= '	<span class="left">';
		$output .= '		<span class="right">';
		$output .= '			<span class="middle">'.$text.'</span>';
		$output .= '		</span><!-- .right (end) -->';
		$output .= '	</span><!-- .left (end) -->';
		$output .= '</a><!-- .button (end) -->';

    return $output;

}

add_shortcode('button', 'button_shortcode');


// Dropcaps

function dropcap_shortcode($atts, $content = null) {

    $output = '<span class="dropcap">';
    $output .= do_shortcode($content);
    $output .= '</span><!-- .dropcap (end) -->';

    return $output;

}

add_shortcode('dropcap', 'dropcap_shortcode');


// Horizontal Rule

function hr_shortcode($atts, $content = null) {

    $output = '<div class="hr"><!-- --></div>';

    return $output;

}

add_shortcode('hr', 'hr_shortcode');


// Thin Horizontal Rule

function thr_shortcode($atts, $content = null) {

    $output = '<div class="thr"><!-- --></div>';

    return $output;

}

add_shortcode('thr', 'thr_shortcode');


// Blockquote

function blockquote_shortcode($atts, $content = null) {

    $output = '<blockquote>';
    $output .= do_shortcode($content);
    $output .= '</blockquote><!-- blockquote (end) -->';

    return $output;

}

add_shortcode('blockquote', 'blockquote_shortcode');



// Box

function box_shortcode($atts, $content = null) {
	
		$content = remove_invalid_tags($content, array('p'));
		
    $output = '<div class="s-box clearfix">';
    $output .= do_shortcode($content);
    $output .= '<div class="s-box-bottom"></div></div><!-- s-box (end) -->';

    return $output;

}

add_shortcode('box', 'box_shortcode');


// Clear
function shortcode_clear() {
	return '<div class="clear"></div>';
}

add_shortcode('clear', 'shortcode_clear');

?>