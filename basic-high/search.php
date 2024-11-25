<?php
/*
 *
 *
 *  Get search results
 *
 *
*/
	
get_header(); 


?>

 
 <main>
    
	<section id="page-header" class="full-width" role="header">

		<div >
			<div class="row page-row" >
				<div class="page-head" role="header">
					<h1 class="search-title"><?php printf( __( 'Search Results for: %s', 'basic-high' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<?php echo '<p class="page-blrp">' . html_entity_decode(get_bloginfo('description')) . '</p>';?>
				</div>
			</div>
		</div>

	</section>

<section>
	
		<div class="container">
			
			<?php echo high_breadcrumbs(); ?>
			
			<div class="row  post-row row-eq-height">
				<?php get_template_part('templates/content', 'search'); ?>
			</div>
		</div>
		
		<?php high_pagination(); ?>
		
	</section>
		
	</main>
	
<?php get_footer();