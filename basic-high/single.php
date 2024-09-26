<?php
/**
	*
	* Template for standard single post 
	*
	*
**/

?>

<?php get_header(); ?>
	
	<main  id="post-<?php echo $post->ID; ?>" class="single-main">
	
		<?php 
		
			while ( have_posts() ) : the_post(); 
			
				get_template_part( 'templates/content', 'single' );
				
			endwhile;
			
		?>
	</main>
		
		
<?php get_footer(); ?>