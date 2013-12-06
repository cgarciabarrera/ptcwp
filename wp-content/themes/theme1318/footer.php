  		<div class="clear"></div>
      <div id="widget-footer" class="clearfix">
      	<div class="hr"></div>
        <div class="grid_4">
          <?php if ( ! dynamic_sidebar( 'First Footer Area' ) ) : ?>
            <!--Widgetized First Footer Area-->
          <?php endif ?>
        </div>
        <div class="grid_4">
          <?php if ( ! dynamic_sidebar( 'Second Footer Area' ) ) : ?>
            <!--Widgetized Second Footer Area-->
          <?php endif ?>
        </div>
        <div class="grid_8">
          <?php if ( ! dynamic_sidebar( 'Third Footer Area' ) ) : ?>
            <!--Widgetized Third Footer Area-->
          <?php endif ?>
        </div>
      </div>
    </div><!--.container_16-->
  </div><!--.primary_content_wrap-->
	<footer id="footer">
		<div class="container_16 clearfix">
			<div class="grid_16">
        <?php $myfooter_text = of_get_option('footer_text'); ?>
          
          <?php if($myfooter_text){?>
            <?php echo of_get_option('footer_text'); ?>
          <?php } else { ?>
            &copy; <?php echo date("Y") ?> <?php bloginfo('name'); ?> is proudly powered by <a href="http://wordpress.org">Wordpress</a> | <a href="<?php bloginfo('url'); ?>/privacy-policy/" title="Privacy Policy">Privacy Policy</a> | <a href="#">Terms of Use</a> | <a href="#">Website Feedback</a><br />¡<a rel="nofollow" href="http://www.templatemonster.com/es/temas-wordpress.htm" title="Temas de WordPress" target="_blank">Temas de WordPress </a> - son realmente los mejores!<br />
            
          <?php } ?>
          
        <?php if ( of_get_option('footer_menu') == 'true') { ?>  
          <nav class="footer">
						<?php wp_nav_menu( array(
              'container'       => 'ul', 
              'menu_class'      => 'footer-nav', 
              'depth'           => 0,
              'theme_location' => 'footer_menu' 
              )); 
            ?>
          </nav>
        <?php } ?>
      </div>
		</div><!--.container-->
	</footer>
</div><!--#main-->
<?php wp_footer(); ?> <!-- this is used by many Wordpress features and for plugins to work proporly -->
<?php echo stripslashes(of_get_option('ga_code')); ?><!-- Show Google Analytics -->
</body>
</html>