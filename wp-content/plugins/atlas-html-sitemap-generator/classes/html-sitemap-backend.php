<?php 
/**
 * HTML Sitemap Generator Backend Class
 * 
 * This class handles all the backend functionality for the plugin. It sets up
 * the plugin's admin page on the WordPress dashboard and saves the user's option
 * settings to the database. 
 *
 * @package HTML_Sitemap_Generator
 * @version 1.1
 * @author Donal MacArthur
 * @copyright Copyright (c) 2011, Donal MacArthur
 * @link http://www.cranesandskyhooks.com/wordpress-plugins/html-sitemap-generator/
 */
class DMAC_HTML_Sitemap_Backend {

	/**
	 * Stores the page hook for the plugin's admin page.
	 *
	 * @var string
	 * @since 1.0
	 */
	var $pagehook;
	
	/**
	 * PHP4 constructor method. This provides backwards compatibility for users with setups
	 * on older versions of PHP. Once WordPress no longer supports PHP4, this method will be removed.
	 *
	 * @since 1.0
	 */
	function DMAC_HTML_Sitemap_Backend() {
		$this->__construct();
	}

	/**
	 * Constructor method for the DMAC_HTML_Sitemap_Backend class.  
	 *
	 * @since 1.0
	 */
	function __construct() {

		/* Add support for two layout columns. */
		add_filter( 'screen_layout_columns', array( &$this, 'layout_columns' ), 10, 2 );

		/* Register the plugin's initialization function on the 'admin_menu' hook. */
		add_action( 'admin_menu', array( &$this, 'on_admin_menu' ), 20 );
	}
	
	/**
	 * Required filter for dual column support. This enables WordPress's column switching mechanism.
	 *
	 * @since 1.0
	 */
	function layout_columns ( $columns, $screen ) {
	
		if ( $screen == $this->pagehook )
			$columns[$this->pagehook] = 2;
			
		return $columns;
	}
	
	/**
	 * Initialize the plugin's backend functionality. Called on the 'admin_menu' hook.
	 *
	 * @since 1.0
	 */
	function on_admin_menu() {
	
		/* Register the plugin's admin page. */
		$this->pagehook = add_options_page( 'HTML Sitemap Generator', 'HTML Sitemap', 'manage_options', 'html-sitemap-generator', array( &$this, 'on_show_page' ) );
		
		/* Set up all the necessary page elements when the admin page loads. */
		add_action( 'load-' . $this->pagehook, array( &$this, 'on_load_page' ) );
		
		/* Register a WordPress option to hold the user's icon settings. */
		register_setting( 'dmac-html-sitemap', 'dmac_html_sitemap', array( &$this, 'validate_settings' ) );
	}

	/**
	 * Set up the plugin's admin page. Fired if WordPress detects that the page is about to be rendered.
	 * 
	 * The add_meta_box call takes the format ( $id, $title, $callback, $page, $context, $priority, $callback_args ).
	 * Adding metaboxes at this point means they can be shown/hidden using the screen options tab.
	 * 
	 * @link http://codex.wordpress.org/Function_Reference/add_meta_box
	 * @since 1.0
	 */
	function on_load_page() {
	
		/* Instantiate the DMAC_Admin_Tools() class. */
		$this->admin_tools = new DMAC_Admin_Tools_1_0_00();
		
		/* Instantiate the DMAC_Plugin_Tools() class. */
		$this->plugin_tools = new DMAC_Plugin_Tools_1_0_00();
		
		/* Load the bundled DMAC admin stylesheet. */
		wp_enqueue_style( 'dmac-admin-styles', trailingslashit( DMAC_HTML_SITEMAP_URL ) . 'styles/dmac-admin-styles.css' );

		/* Load the postbox scripts. */
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
	
		/* Print the postbox initialization functions to the page head. */ 
		add_action( 'admin_head-' . $this->pagehook, array( &$this, 'on_admin_head' ) );

		/* Register the admin page's metaboxes. */
		add_meta_box( 'dmac-html-sitemap-options', 'Sitemap Options', array( &$this, 'sitemap_options_content' ), $this->pagehook, 'normal' );
		
		/* Register the admin page's side metaboxes. */
		add_meta_box( 'dmac-sidebox-like', 'Like This Plugin?', array( &$this, 'like_box_content' ), $this->pagehook, 'side' );
		add_meta_box( 'dmac-sidebox-donate', 'Make A Donation!', array( &$this, 'donate_box_content' ), $this->pagehook, 'side' );
		add_meta_box( 'dmac-sidebox-support', 'Need Support?', array( &$this, 'support_box_content' ), $this->pagehook, 'side' );
		add_meta_box( 'dmac-sidebox-styling', 'Styling Issues?', array( &$this, 'styling_issues_box_content' ), $this->pagehook, 'side' );
	}
	
	/**
	 * Print scripts and styles directly to the plugin's admin page head.
	 * 
	 * @since 1.0
	 */	
	function on_admin_head() {
?>
		<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				// Close postboxes that should be closed.
				$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
				// Set up postboxes.
				postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');
			});
			//]]>
		</script>
<?php	
	}
	
	/**
	 * Print the plugin's admin page.
	 * 
	 * @since 1.0
	 */
	function on_show_page() {
	
		/* We need the global columns variable to enable dual column support. */
		global $screen_layout_columns;
	
		/* Check the user has permission to be on this page. */
		if ( !current_user_can( 'manage_options' ) )
			wp_die( __('You do not have sufficient permissions to access this page.') );
			
		/* Set up a page data array to pass to each meta box. */
		$data = array();
		$data['wp-repo-link']  = 'http://wordpress.org/extend/plugins/atlas-html-sitemap-generator/';
		$data['wp-forum-link'] = 'http://wordpress.org/tags/atlas-html-sitemap-generator';
		$data['donate-link']   = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=53RPL36YFD9P2';
		$data['homepage-link'] = 'http://cranesandskyhooks.com/wordpress-plugins/html-sitemap-generator/';
	
		/* Print the page header. */
		echo "<div class='wrap dmac dmac-html-sitemap'>\n";
			screen_icon();
			echo "<h2>HTML Sitemap Generator</h2>\n";
			
			/* If the settings have been updated, fire the update hook. */
			if ( isset( $_GET['settings-updated'] ) || isset( $_GET['updated'] ) )
				do_action( 'dmac_html_sitemap_updated' );
			
			/* Else, if the default settings button has been clicked, reset the options and fire the update hook. */
			elseif ( isset( $_GET['reset'] ) && !( isset( $_GET['settings-updated'] ) || isset( $_GET['updated'] ) ) ) {
				$this->reset_defaults();
				do_action( 'dmac_html_sitemap_updated' );
				echo "<div class='updated'><p><strong>Default Settings Restored</strong></p></div>\n";
			}
			
			/* Add metabox nonce fields. */
			wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false );
			wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false );
		
			/* Print the metabox container div. */
			$hasSidebar = $screen_layout_columns == 2 ? ' has-right-sidebar' : '';
			echo "<div id='poststuff' class='metabox-holder{$hasSidebar}'>\n";
		
				/* Print the sidebar metaboxes. */
				echo "<div id='side-info-column' class='inner-sidebar'>\n";
					do_meta_boxes( $this->pagehook, 'side', $data );
				echo "</div>\n";
		
				/* Print the main content metaboxes. */
				echo "<div id='post-body' class='has-sidebar'>\n";
					echo "<div id='post-body-content' class='has-sidebar-content'>\n";
						echo "<form method='post' action='options.php'>\n";
						
							do_meta_boxes( $this->pagehook, 'normal', $data );

							/* WordPress option validation fields. */
							settings_fields( 'dmac-html-sitemap' );
		
							/* Add the submit and restore buttons for the form. */
							echo "<p style='margin: 20px 0;'>";
								echo "<input class='button-primary' type='submit' value='Save Settings' />";
								echo "<a class='button-primary' style='margin-left: 5px;' href='?page=html-sitemap-generator&amp;reset=true'>Restore Defaults</a>";
							echo "</p>\n";
							
						echo "</form>\n";
				echo "</div>\n";
				echo "</div>\n";
		
			echo "</div><!-- end .metabox-holder -->\n";
		echo "</div>\n";
	}
	
	/**
	 * Print the content of the 'options' postbox.
	 * 
	 * @since 1.0
	 */	
	function sitemap_options_content() {
	
		/* Wrap the postbox content in an .dmac-postbox div for styling purposes. */
		echo "<div class='dmac-postbox'>\n";
			
			/* Get the option settings from the database. */
			$settings = get_option( 'dmac_html_sitemap' );
			
			/* If the settings option is empty, get the default settings. */
			if ( !$settings ) {
				$this->reset_defaults();
				do_action( 'dmac_html_sitemap_updated' );
				$settings = $this->plugin_tools->get_default_settings( dmac_html_sitemap_options_array(), 'options' );
			}
		
			/* Get the options array. */
			$options = dmac_html_sitemap_options_array();
			
			/* Print the postbox content. */
			$this->admin_tools->build_option_table( 'dmac_html_sitemap', $options, $settings );
			
		echo "</div>\n";
	}

	/**
	 * Validate the user's settings.
	 * 
	 * @since 1.0
	 */	
	function validate_settings( $input ) {
	
		/* Get the options array. */
		$options = dmac_html_sitemap_options_array();

		/* Loop through the options array. */
		foreach ( $options as $option ) {

			/* If the element is a checkbox, we want the value to be either 1 or 0. */
			if ( $option['type'] == 'checkbox' )
				$input[$option['id']] = isset( $input[$option['id']] ) && $input[$option['id']] == 1 ? 1 : 0;
		}
		
		return $input;
	}
	
	/**
	 * Reset the default settings.
	 * 
	 * @since 1.0
	 */	
	function reset_defaults() {
		$settings = $this->plugin_tools->get_default_settings( dmac_html_sitemap_options_array(), 'options' );
		update_option( 'dmac_html_sitemap', $settings );
	}
		
	/**
	 * Print the 'Like this plugin?' side box content.
	 * 
	 * @since 1.0
	 */
	function like_box_content( $data ) {
		echo $this->admin_tools->like_box_content( $data );
	}
	
	/**
	 * Print the 'Support' side box content.
	 * 
	 * @since 1.0
	 */
	function support_box_content( $data ) {
		echo $this->admin_tools->support_box_content( $data );
	}
	
	/**
	 * Print the 'Make a donation' side box content.
	 * 
	 * @since 1.0
	 */
	function donate_box_content() {
	
		$form = '<form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="hosted_button_id" value="53RPL36YFD9P2"><input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" style="max-width: 100%;"><img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>';
	
		echo $this->admin_tools->donate_box_content( $form );
	}
	
	/**
	 * Print the 'Styling Issues?' side box content.
	 * 
	 * @since 1.0
	 */
	function styling_issues_box_content( $data ) {
			
		$content = array( "The sitemap is displayed using your theme's own default styles, so it should blend seamlessly into the rest of your site.", "If you're unhappy with the way your theme is displaying the sitemap, however, you can find tips on tweaking its formatting on the <a href='{$data['homepage-link']}'>plugin's homepage</a>." );
		
		echo $this->admin_tools->side_box_content( $content );
	}
}