<?php
/***
	*
	* Basic page for non-posts
	*
	*
***/

global $post;

get_header(); 

?>	
	
	<main>		
	
		<?php get_template_part( 'templates/content', 'content'); ?>	
		
	</main>
	
<?php get_footer();