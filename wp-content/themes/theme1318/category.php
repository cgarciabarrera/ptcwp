<?php get_header(); ?>

<div id="content" class="grid_12 categories_list <?php echo of_get_option('blog_sidebar_pos') ?>">
	<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');
	} ?>
  <h1><?php printf( __( 'Category Archives: %s' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
  <?php echo category_description(); /* displays the category's description from the Wordpress admin */ ?>
  
  <div class="clearfix">
  	<?php 
		$i=1;
		if (have_posts()) : while (have_posts()) : the_post();
		if(($i%2) == 0){ $addclass = "nomargin";	}	
		?>
			<article id="post-<?php the_ID(); ?>" class="<?php echo $addclass; ?>">
				<header>
					<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<?php $post_meta = of_get_option('post_meta'); ?>
					<?php if ($post_meta=='true' || $post_meta=='') { ?>
						<div class="post-meta">
							<div class="fleft">Posted: <time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time></div>
							<div class="fright"><?php comments_popup_link('No comments', 'One comment', '% comments', 'comments-link', 'Comments are closed'); ?></div>
						</div><!--.post-meta-->
					<?php } ?>		
				</header>
				<?php if(has_post_thumbnail()) {
					echo '<a href="'; the_permalink(); echo '">';
					echo '<div class="featured-thumbnail"><div class="img-wrap">'; the_post_thumbnail('small-post-thumbnail'); echo '</div></div>';
					echo '</a>';
					}
				?>
				
				<div class="post-content">
					<div class="excerpt"><?php $excerpt = get_the_excerpt(); echo my_string_limit_words($excerpt,16);?></div>
					<a href="<?php the_permalink() ?>" class="button">Read more</a>
				</div>
			</article>
		<?php $i++; $addclass = ""; endwhile; else: ?>
			<div class="no-results">
				<p><strong>There has been an error.</strong></p>
				<p>We apologize for any inconvenience, please <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>">return to the home page</a> or use the search form below.</p>
				<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
			</div><!--noResults-->
		<?php endif; ?>
  </div>
    
  <?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav class="oldernewer">
      <div class="older">
        <?php next_posts_link('&laquo; Older Entries') ?>
      </div><!--.older-->
      <div class="newer">
        <?php previous_posts_link('Newer Entries &raquo;') ?>
      </div><!--.newer-->
    </nav><!--.oldernewer-->
  <?php endif; ?>
	
</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>