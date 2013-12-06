<?php
/**
 * Loads up all the widgets defined by this theme. Note that this function will not work for versions of WordPress 2.7 or lower
 *
 */


include_once (TEMPLATEPATH . '/includes/widgets/my-recent-posts.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-comment-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-requestquote-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-post-cycle-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-popular-posts-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-social-widget.php');
include_once (TEMPLATEPATH . '/includes/widgets/my-posts-type-widget.php');
add_action("widgets_init", "load_my_widgets");

function load_my_widgets() {
	register_widget("MY_PostWidget");
	register_widget("MY_CommentWidget");
	register_widget("MY_RequestQuoteWidget");
	register_widget("MY_CycleWidget");
	register_widget("MY_PopularPostsWidget");
	register_widget("My_SocialNetworksWidget");
	register_widget("MY_PostsTypeWidget");
}
?>