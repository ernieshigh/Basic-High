<?php
/***
	*
	* Filter Datasheet function
	*
	*
***/


add_action('wp_ajax_high_filter_posts', 'high_filter_posts');
add_action('wp_ajax_nopriv_high_filter_posts', 'high_filter_posts');
function high_filter_posts() {
	
	global $post;
	global $wp_query;
	
 	
if( !isset( $_POST['high_nonce'] ) || !wp_verify_nonce( $_POST['high_nonce'], 'high_nonce' ) ) die('You do not belong here');
	
	
	$cats = [];
	
	if(isset($_POST['cat'])){
		$cats = $_POST['cat'];
	}
	$pcat = $_POST['pcat'];
	$sub = $_POST['sub'];
	$slug = '';
	$tag_count = 0;
	$tax_qry = [];
	$seal_tag = [];
	$total = 0;
	
	
	$output = '';
	$output .= '<div class="filter-content"></div>';
	
	
	if(! empty($cats)):
	foreach($cats as $cat){
		$slug = $cat['value'];
		$tax_qry[] = ['taxonomy' => "category",
				'field' => 'slug',
				'terms' =>  array($slug),
			];
	};  
		
	
	$terms = get_terms( array('taxonomy' => 'category','orderby' => 'name',  'hide_empty'=> false));


	
	foreach($terms as $term){
		$seal = $term->slug;
		$termID =$term->term_id;
		$name = $term->name;
		$description = $term->description; 
	
	$tag_query = array(
			  'taxonomy' => 'category',
			  'field' => 'slug',
			  'terms' => $seal,
			  'operator' => 'AND', //narrows results, use 'IN' to expand
		   
		);
		 
		
		
	$args = array(
			'post_type' => array('post'),
			'post_status' => array( 'publish'),
			'tax_query' => array(
					'relation' => 'AND',
				array(
					'relation' => 'AND',
					array(
						'taxonomy' => "category",
						'field'    => 'slug',
						'terms'    => $slug,
					),
					
					$tax_qry, 
				),
				$tag_query,
			),
				  
			'orderby' => 'title',
			'order'=> 'ASC',
			'posts_per_page' => -1,
			'no_found_rows' => true,
		);
		
	 if( !$cats) {
		unset( $args['tax_query'] );
	  }
	
	$filter_query = new WP_Query($args);
	
 
	if( $filter_query->have_posts() ) : 
	
	$seal_tag[] = $term;
	//$tax_image = get_term_meta($term->term_id, 'high_img', true);
	 
	
	$output .= '<section class="filter-wrap">';
	
	$output .= '<div  id="' . $seal . '" class="result-box">';
	$output .= '<div class="tag-intro">';
	   
	  
	 
	$output .= '<h3><a href="' .  get_tag_link($term->term_id) . '">' . sprintf( __( ' %s ', 'basic-high' ), $name) . ' ' . __('Articles ','basic-high') . '</a></h3>';
	
	if($description){
		$output .= '<p>' . $description . '</p>';
	}
	
	$output .= '</div> <!-- end tag-intro -->';
	  
	
	while ( $filter_query->have_posts() ) : $filter_query->the_post();

	 
		$title = $post->post_title;
		$link =   get_post_permalink();	
		$thumb = '';
		$excerpt = get_the_excerpt();
		$excerpt = substr($excerpt, 0, 120);
		$result = substr($excerpt, 0, strrpos($excerpt, ' '));
		
		$author_id = get_the_author_meta( 'ID' );
		$author = get_the_author_meta( 'display_name', $author_id );

		$output  .= '<div class="filtered-content">';
		$output .= '<figure>';
		$output .= get_the_post_thumbnail($post->ID, array('70', '70'), array( 'class' => 'alignleft' ) );
		$output .= '</figure>';
		$output .= '<div class="entry-meta">';
		$output .= '<a href="'. get_permalink($post->ID) . '" class="readmore"> <h4 class="' . $pcat . ' ' . $sub . '">' . $title . '</h4>';
		$output .= '<span class="meta-prep meta-prep-author">By </span> ' . $author . '</a>';
		$output .= '<p>';
		$output  .= $result;
		$output .= '</p></div><!-- end meta -->';
		$output .= '</div> <!-- end content -->';
	
	endwhile;  
	
	$output .= '</div></section>';
	
	
	endif;
	
	
	
	$total = $filter_query->post_count + $total;
	
	
	} // terms
	
	
	$tag_count = count($seal_tag);
	
	$output .= '<div class="found"><div class="filter-text">';
	
	$output .= '<p class="filter-count"><strong>' .  __('Your search returned a total of ' , 'basic-high')   . $total . ' articles.</strong></p>';
	$output .= '<p>' . __('PLEASE NOTE: Each time you click on an option, the list will be updated with a group of articles that match your criteria.' , 'basic-high') . '</p></div>';
	$output .= '<ul class="seal-list">';
	foreach($seal_tag as $st){
		$output .=  '<li><a href="#' . $st->slug . '">' . $st->name . '</a></li>';
	}
	$output .= '</ul>';
	$output .= '</div> </div>';
	
	
	else:
		
		$output .= '<div class="reset-filter-content">
						<article class="filter-content">
							<div class="filter-text">
								<p class="filter-notice">' . __('PLEASE NOTE: Each time you click on an option, the display will show an updated list of articles.', 'basic-high') . '</p>
							</div>
						</article>

					</div>';
	
	endif; //if cats
	
   die(json_encode($output));

} //this is it

