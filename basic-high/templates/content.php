<?php
/*
 *
 *
 * Basic page content 
 *
 *
*/
?>
	<div class="container page-container">
		<div class="row ">
		<?php 
			if(is_front_page() === false):
				echo '<h1 class="page-title">' . get_the_title() . '</h1>';
			endif;
		?>
			<article class="page-entry">
			<?php while(have_posts()):the_post(); ?>
			
					<?php the_content(); ?>
			
			<?php endwhile; ?>
					
			</article>
			
			<?php 
			if(is_front_page() === false):
				
				// add comments stuff
				comments_template( '', true );
				
			endif;
		?>
		</div>
	</div>