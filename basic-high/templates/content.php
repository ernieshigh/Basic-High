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
			
			<?php wp_link_pages( 'before=<ul class="page-links">&after=</ul>&link_before=<li class="page-link">&link_after=</li>' ); ?>
		</div>
	</div>