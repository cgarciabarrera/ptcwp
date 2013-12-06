<?php get_header(); ?>
<div id="content" class="grid_12 <?php echo of_get_option('blog_sidebar_pos') ?>">
	<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');
	} ?>
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
      <article class="single-post">
        <header>
          <h1><?php the_title(); ?></h1>
        </header>
        <?php $single_image_size = of_get_option('single_image_size'); ?>
				<?php if($single_image_size=='' || $single_image_size=='normal'){ ?>
          <?php if(has_post_thumbnail()) {
            echo '<div class="featured-thumbnail">'; the_post_thumbnail(); echo '</div>';
            }
          ?>
        <?php } else { ?>
          <?php if(has_post_thumbnail()) {
            echo '<div class="featured-thumbnail large"><div class="img-wrap"><div class="f-thumb-wrap">'; the_post_thumbnail('post-thumbnail-xl'); echo '</div></div></div>';
            }
          ?>
        <?php } ?>
        <div class="post-content">
          <?php the_content(); ?>
          <?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
        </div><!--.post-content-->
      </article>

        

			<?php /* If a user fills out their bio info, it's included here */ ?>
      <div id="post-author">
        <h3>Written by <?php the_author_posts_link() ?></h3>
        <p class="gravatar"><?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_email(), '80' ); /* This avatar is the user's gravatar (http://gravatar.com) based on their administrative email address */  } ?></p>
        <div id="author-description">
          <?php the_author_meta('description') ?> 
          <div id="author-link">
            <p>View all posts by: <?php the_author_posts_link() ?></p>
          </div><!--#author-link-->
        </div><!--#author-description -->
      </div><!--#post-author-->

    </div><!-- #post-## -->
    
    
    <nav class="oldernewer">
      <div class="older">
        <?php previous_post_link('%link', '&laquo; Previous post') ?>
      </div><!--.older-->
      <div class="newer">
        <?php next_post_link('%link', 'Next Post &raquo;') ?>
      </div><!--.newer-->
    </nav><!--.oldernewer-->

    <?php comments_template( '', true ); ?>

  <?php endwhile; /* end loop */ ?>
</div><!--#content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>