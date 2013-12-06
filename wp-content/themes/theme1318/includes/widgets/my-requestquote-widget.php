<?php
// =============================== My Request Quote Widget ======================================
class MY_RequestQuoteWidget extends WP_Widget {
    /** constructor */
    function MY_RequestQuoteWidget() {
        parent::WP_Widget(false, $name = 'My - Request a Quote');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
				$txt1 = apply_filters('widget_txt1', $instance['txt1']);
				$imageurl = apply_filters('widget_imageurl', $instance['imageurl']);
        ?>
            
						<?php echo $before_widget; ?>
            <?php if($imageurl!=""){ ?>
              <img src="<?php echo $imageurl; ?>" alt="" class="img-indent"/>
            <?php } ?>
            <?php if($title!=""){ ?>
            <div class="box-text <?php echo $class; ?>">
              <h3><?php echo $title; ?></h3>
              <?php echo $txt1; ?>
            </div><!-- end 'with title' -->
            <?php } else { ?>
            <div class="box-text <?php echo $class; ?>">
              <?php echo $txt1; ?>
            </div><!-- end 'without title' -->
            <?php } ?>
            
            <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
				$txt1 = esc_attr($instance['txt1']);
				$imageurl = esc_attr($instance['imageurl']);
        ?>
       <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'theme1318'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			 <p><label for="<?php echo $this->get_field_id('txt1'); ?>"><?php _e('Text:', 'theme1318'); ?><textarea rows="5"  class="widefat" id="<?php echo $this->get_field_id('txt1'); ?>" name="<?php echo $this->get_field_name('txt1'); ?>"><?php echo $txt1; ?></textarea></label></p>
			 <p><label for="<?php echo $this->get_field_id('imageurl'); ?>"><?php _e('Imgage URL:', 'theme1318'); ?> <input class="widefat" id="<?php echo $this->get_field_id('imageurl'); ?>" name="<?php echo $this->get_field_name('imageurl'); ?>" type="text" value="<?php echo $imageurl; ?>" /></label></p>
        <?php 
    }

} // class Request Quote Widget

?>