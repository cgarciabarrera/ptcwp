<?php
// =============================== My Social Networks Widget ====================================== //
class My_SocialNetworksWidget extends WP_Widget {

	function My_SocialNetworksWidget() {
		$widget_ops = array('classname' => 'social_networks_widget', 'description' => __('Link to your social networks.'));
		$this->WP_Widget('social_networks', __('My - Social Networks'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$desc = apply_filters('widget_description', $instance['desc']);
		
		$networks['Vimeo'] = $instance['vimeo'];
		$networks['Twitter'] = $instance['twitter'];
		$networks['Facebook'] = $instance['facebook'];
		$networks['Flickr'] = $instance['flickr'];
		$networks['Feed'] = $instance['feed'];
		$networks['Linkedin'] = $instance['linkedin'];
		$networks['Delicious'] = $instance['delicious'];
		$networks['Youtube'] = $instance['youtube'];

		$display = $instance['display'];
		

		echo $before_widget;
		if ( $title )
    echo $before_title . $title . $after_title;
		?>
			
      <?php if($desc) { ?>
				<div class="desc"><?php echo $desc; ?></div>
			<?php } ?>
      
			<ul class="social-networks">
				
					<?php foreach(array("Vimeo", "Facebook", "Twitter", "Flickr", "Feed", "Linkedin", "Delicious", "Youtube") as $network) : ?>
			    <?php if (!empty($networks[$network])) : ?><li><a rel="external" title="<?php echo strtolower($network);?>" href="<?php echo $networks[$network] ?>"><?php if (($display == "both") or ($display =="icons")) { ?><img src="<?php bloginfo('stylesheet_directory'); ?>/images/icons/<?php echo strtolower($network);?>.png" alt=""><?php } if (($display == "labels") or ($display == "both")) {?> <?php echo $network; ?><?php } ?></a></li><?php endif; ?>
					<?php endforeach; ?>
			      
      </ul>
      
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['desc'] = strip_tags($new_instance['desc']);
		$instance['vimeo'] = $new_instance['vimeo'];
		$instance['twitter'] = $new_instance['twitter'];
		$instance['facebook'] = $new_instance['facebook'];
		$instance['flickr'] = $new_instance['flickr'];
		$instance['feed'] = $new_instance['feed'];
		$instance['linkedin'] = $new_instance['linkedin'];
		$instance['delicious'] = $new_instance['delicious'];
		$instance['youtube'] = $new_instance['youtube'];

		$instance['display'] = $new_instance['display'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);	
		$desc = strip_tags($instance['desc']);
		$vimeo = $instance['vimeo'];
		$twitter = $instance['twitter'];		
		$facebook = $instance['facebook'];
		$flickr = $instance['flickr'];		
		$feed = $instance['feed'];
		$linkedin = $instance['linkedin'];	
		$delicious = $instance['delicious'];
		$youtube = $instance['youtube'];

		$display = $instance['display'];		


		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
    <p><label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Description:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" type="text" value="<?php echo esc_attr($desc); ?>" /></p>
    
    <p><label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>" /></p>
    
		<p><label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e('Flickr URL:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" type="text" value="<?php echo esc_attr($flickr); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('feed'); ?>"><?php _e('RSS feed:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('feed'); ?>" name="<?php echo $this->get_field_name('feed'); ?>" type="text" value="<?php echo esc_attr($feed); ?>" /></p>
    
    <p><label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" /></p>
    
    <p><label for="<?php echo $this->get_field_id('delicious'); ?>"><?php _e('Delicious:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('delicious'); ?>" name="<?php echo $this->get_field_name('delicious'); ?>" type="text" value="<?php echo esc_attr($delicious); ?>" /></p>
    
    <p><label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('Youtube:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" /></p>


		<p>Display:</p>
		<label for="<?php echo $this->get_field_id('icons'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="icons" id="<?php echo $this->get_field_id('icons'); ?>" <?php checked($display, "icons"); ?>></input>  Icons</label>
		<label for="<?php echo $this->get_field_id('labels'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="labels" id="<?php echo $this->get_field_id('labels'); ?>" <?php checked($display, "labels"); ?>></input> Labels</label>
		<label for="<?php echo $this->get_field_id('both'); ?>"><input type="radio" name="<?php echo $this->get_field_name('display'); ?>" value="both" id="<?php echo $this->get_field_id('both'); ?>" <?php checked($display, "both"); ?>></input> Both</label>

    
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("My_SocialNetworksWidget");'));


?>