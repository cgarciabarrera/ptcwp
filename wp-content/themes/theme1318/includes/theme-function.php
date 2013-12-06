<?php

// The excerpt based on words
function my_string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words).'... ';
}


// The excerpt based on character
function my_string_limit_char($excerpt, $substr=0)
{

	$string = strip_tags(str_replace('...', '...', $excerpt));
	if ($substr>0) {
		$string = substr($string, 0, $substr);
	}
	return $string;
		}


add_action( 'after_setup_theme', 'my_setup' );


// Remove invalid tags
function remove_invalid_tags($str, $tags) 
{
    foreach($tags as $tag)
    {
    	$str = preg_replace('#^<\/'.$tag.'>|<'.$tag.'>$#', '', trim($str));
    }

    return $str;
}


// Generates a random string (for embedding flash)
function theme1318_random($length){

	srand((double)microtime()*1000000 );
	
	$random_id = "";
	
	$char_list = "abcdefghijklmnopqrstuvwxyz";
	
	for($i = 0; $i < $length; $i++) {
		$random_id .= substr($char_list,(rand()%(strlen($char_list))), 1);
	}
	
	return $random_id;
}


// Time age
function time_ago( $type = 'post' ) {
	$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
	return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');
}




// For embedding video file
function mytheme_video($file, $image, $width, $height, $color){

	//Template URL
	$template_url = get_template_directory_uri();
	
	//Unique ID
	$id = "video-".theme1318_random(15);
	
	$object_height = $height + 39;

	//JS
	$output  = '<script type="text/javascript">'."\n";
	$output .= 'var flashvars = {};'."\n";
	$output .= 'flashvars.player_width="'.$width.'";'."\n";
	$output .= 'flashvars.player_height="'.$height.'"'."\n";
	$output .= 'flashvars.player_id="'.$id.'";'."\n";
	$output .= 'flashvars.thumb="'.$image.'";'."\n";
	$output .= 'flashvars.colorTheme="'.$color.'";'."\n";
	$output .= 'var params = { "wmode": "transparent" };'."\n";
	$output .= 'params.wmode = "transparent";'."\n";
	$output .= 'params.quality = "high";';
	$output .= 'params.allowFullScreen = "true";'."\n";
	$output .= 'params.allowScriptAccess = "always";'."\n";
	$output .= 'params.quality="high";'."\n";
	$output .= 'var attributes = {};'."\n";
	$output .= 'attributes.id = "'.$id.'";'."\n";
	$output .= 'swfobject.embedSWF("'.$template_url.'/flash/video.swf?fileVideo='.$file.'", "'.$id.'", "'.$width.'", "'.$object_height.'", "9.0.0", false, flashvars, params, attributes);'."\n";
	$output .= '</script>'."\n\n";
	
	$output .= '<div class="video-bg" style="width:'.$width.'px; height:'.$height.'px; background-image:url('.$image.')">'."\n";
	$output .= '</div>'."\n";
	
	//HTML
	$output .= '<div id="'.$id.'">'."\n";
			$output .= '<a href="http://www.adobe.com/go/getflashplayer">'."\n";
					$output .= '<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />'."\n";
			$output .= '</a>'."\n";
	$output .= '</div>';

	return $output;
    
}



// Add Thumb Column
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
// for post and page
add_theme_support('post-thumbnails', array( 'post', 'page' ) );
function fb_AddThumbColumn($cols) {
$cols['thumbnail'] = __('Thumbnail');
return $cols;
}
function fb_AddThumbValue($column_name, $post_id) {
$width = (int) 35;
$height = (int) 35;
if ( 'thumbnail' == $column_name ) {
// thumbnail of WP 2.9
$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
// image from gallery
$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
if ($thumbnail_id)
$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
elseif ($attachments) {
foreach ( $attachments as $attachment_id => $attachment ) {
$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
}
}
if ( isset($thumb) && $thumb ) {
echo $thumb;
} else {
echo __('None');
}
}
}
// for posts
add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
// for pages
add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}




?>