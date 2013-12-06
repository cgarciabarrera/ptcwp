<?php get_header(); ?>
<div id="content" class="grid_16 <?php echo of_get_option('blog_sidebar_pos') ?>">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
      <article class="single-post">
        <header>
          <h1><?php the_title(); ?></h1>
        </header>
        <?php if(has_post_thumbnail()) {
					echo '<div class="featured-thumbnail no-hover"><div class="img-wrap">'; the_post_thumbnail('portfolio-post-thumbnail'); echo '</div></div>';
					}
				?>
        <div class="post-content extra-wrap">
          <?php the_content(); ?>
        </div><!--.post-content-->
      </article>

    </div><!-- #post-## -->

  <?php endwhile; /* end loop */ ?>
</div><!--#content-->
<?php get_footer(); ?>