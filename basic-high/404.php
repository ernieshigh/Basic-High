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
    
	<section id="page-header" class="full-width 404" role="header">

			<div class="row page-row" >
				<div class="page-head" role="header">
					<h1 class="search-title"><?php _e( '404 Not found', 'basic-high' ); ?></h1>
					
					<?php echo '<p class="page-blrp">' . __('This is somewhat embarrassing, isn’t it?', 'basic-high') . '</p>';?>
				</div>
			</div>
		</div>

	</section>

<section>
	
		<div class="container">
			
			<?php echo high_breadcrumbs(); ?>
			
			<div class="row  post-row row-eq-height">
				<p>
					<?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'basic-high' ); ?>
				</p>
			</div>
		</div>
		
		
	</section>
		
	</main>
	
<?php get_footer();