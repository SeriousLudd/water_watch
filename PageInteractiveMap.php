<?php 

/* Template Name: PageInteractiveMap */ 
header( 'content-type: text/html; charset=utf-8' );

get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

	<h1><?php the_title(); ?></h1>
    <div class="content">
    	<?php the_content(); ?>
		<div class="entry-content">

	</div>
    </div>

	

<?php
	endwhile; endif;
	get_footer();
?>