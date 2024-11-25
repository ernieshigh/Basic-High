<?php
/*
 *
 *
 * Basic page content 
 *
 *
*/

			
?>		
<div class="sidebar-content" role="main">
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