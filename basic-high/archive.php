<?php
/****
	*
	* Category Template
	*
****/
?>


<?php get_header(); ?>

<?php 
 
	$tag = get_queried_object();
	
 ?>
	
	<main id="<?php echo $tag->name; ?>" >
	
		<?php get_template_part( 'templates/content', 'archive-loop'); ?>
		
	</main>
	
<?php get_footer(); ?>