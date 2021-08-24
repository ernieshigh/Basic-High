<?php
/**
 * Content for displaying 404/Not found page
 *
 * Basic High
 */
?>

	<div class="nada container">
		<h1 class="page-title"><?php _e( 'Nothing Here', 'basic-high' ); ?></h1>
		<div class="nada-content">
			<?php if ( is_search() ) : ?>

				<p class="not-found"><?php _e( "I've searched everywhere, sorry I just can't find what you're asking. Please try searching for something else, maybe it's in here.", 'basic-high' ); ?></p>
			
				<?php get_search_form(); ?>

			<?php else : ?>

				<p class="not-found"><?php _e( "I've looked everywhere, sorry I just can't find what you're wanting. Perhaps you want to try for something else", 'basic-high' ); ?></p>
			
				<?php get_search_form(); ?>

			<?php endif; ?>
		</div>
		
		<figure class="nada-img aligncenter">
			<img src="<?php  echo get_stylesheet_directory_uri(); ?>/images/404.png">
		</figure>
		
		
	</div><!-- nada -->
