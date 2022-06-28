<?php /*Template Name: PageInteractiveMap */;?>
<?php get_header(); ?>
	<div id="container" >

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				<h1><?php the_title(); ?></h1>
				
				<?php the_content(); ?>

				
     
				<!------------>
			<?php endwhile; ?>
	


	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>