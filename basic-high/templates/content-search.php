
<?php
/**
	*
	* Get searcy results loop
	*
**/

global $query_string;

global $wp_query;
$total_results = $wp_query->found_posts;
wp_parse_str( $query_string, $search_query );

	$search = new WP_Query( $search_query );
	$results = $search->posts;
	
		if( $search->have_posts()): while( $search->have_posts()): $search->the_post(); 
			?>
       			
			
	<div class="news-grid">	
		<article  class="chanel-box flex-grid post-content">
			
			<div class="post-entry">
				<a href="<?php the_permalink() ?>"  target="_blank"><h4 class="post-title"><?php the_title(); ?></h4></a>
					
				<?php   
				
						the_excerpt() ?>
				
			</div>	
			
		</article>		

	</div>
	
	<?php 
	
		endwhile; 
		
	else: 
		 ?>
		 
	<div class="news-grid nada">	
		<article  class="chanel-box flex-grid post-content">
			
			<div class="post-entry">
				<h3 class="search-title">We were unable to find any results for your search: <span> <?php echo  get_search_query() ?> </span></h3>
				<p> Please try a new search query. </p>
				<?php echo get_search_form(); ?>
			</div>	
			
		</article>		

	</div>
	
<?php 


	wp_reset_query();  
	endif;