<?php
/*
Template Name: Search Page
*/
?>
<?php get_header(); ?>
<div id="content" class="grid_12 <?php echo of_get_option('blog_sidebar_pos') ?>">
  <div class="aligncenter">
  	<h1>Searching form</h1>
    <p>To search my website, please use the form below.</p>
    <?php get_search_form(); ?>
  </div>

</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>