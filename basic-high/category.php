<?php
/****
	*
	* Category Template
	*
****/
?>


<?php get_header(); ?>

<?php 
 
	$category = get_queried_object();
	
	$cat_id = $category->term_id;
	
	
 ?>
	
	<main id="cat-<?php echo $cat_id; ?>" >
	
		<?php get_template_part( 'templates/content', 'category-loop'); ?>
		
	</main>
	
<?php get_footer(); ?>