	<?php
/***
	*
	* Template Name: Right Sidebar
	*
	* Template for sidebar content
	*
	*
***/

global $post;

?>

<?php get_header(); ?>
	
	<div class="main">
		<div class="container page-container">
			<?php echo '<h1 class="page-title">' . get_the_title() . '</h1>'; ?>
			<div class="row aside-row">
					<?php get_template_part( 'templates/content', 'sidebar'); ?>
				
				
			
				<?php get_sidebar(); ?>
		
			</div>
		
		</div>
	</div>	
	
<?php get_footer();