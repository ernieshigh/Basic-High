<?php
/***
	*
	* Filter Datasheet function
	*
	*
***/




add_action('wp_ajax_high_filter_cats', 'high_filter_cats');
add_action('wp_ajax_nopriv_high_filter_cats', 'high_filter_cats');
function high_filter_cats() {
	global $post;
	global $wp_query;
	
	 if( !isset( $_POST['high_nonce'] ) || !wp_verify_nonce( $_POST['high_nonce'], 'high_nonce' ) ) die('wtf');
	
	$cats = [];
	
	if(isset($_POST['cat'])){
		$cats = $_POST['cat'];
	}
	$pcat = $_POST['pcat'];
	$sub = $_POST['sub'];
	$slug = array();
	$tag_count = 0;
	$tax_qry = [];
	$seal_tag = [];
	$total = 0;
	
	
	//menu
	
	$dcats = [];
	$cat_id = '';
	$cats_slug = array();
	$cat_parent = array();
	$dcats = array();
	$dncats = array();
	$terms= array();
	$i = 0;
	
	$output = '';
		
		foreach($cats as $cat){
			$slug = $cat['value'];
			$tax_qry[] = ['taxonomy' => "category",
					'field' => 'slug',
					'terms' =>  array($slug),
				];
			}; 
		
	
	  
	
	$args =  array(
		'post_type' => 'post',
		'post_status' => array( 'publish'),
		'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => "category",
						'field'    => 'slug',
						'terms'    => array($slug),
					),
					
					$tax_qry, 
			),
		
			'posts_per_page' => -1,
	);
	
	 if( !$cats) {
		unset( $args['tax_query'] );
	}
	
	
	$cat_query = new WP_Query($args);
	// get all categories for all download posts based on previous selection
	if( $cat_query->have_posts() ) : while ( $cat_query->have_posts() ) : $cat_query->the_post();
	
		$dncats = get_the_terms( get_the_ID(), 'category');
		
		if(! empty($dncats)){
		foreach($dncats as $dncat){
			$dcats[$i] = $dncat->term_id;
			$i++;
		}
		}
		endwhile;
	endif;
	
	
	$dcats = array_unique($dcats);
	foreach($dcats as $dcat){
			$pars[] = get_term( $dcat, 'category'); 	
			
	}
	
	
	foreach($pars as $par){
			$parent_ids[$i] = $par->parent;
			$cat_ids[$i] = $par->term_id;
			$i++;
	}
	
	$parent_ids = array_unique($parent_ids);
	$cat_ids = array_unique($cat_ids);
	
	
	// get parent term 
	foreach($parent_ids as $parent_id){
		$parents[] = get_term($parent_id, 'category'); 
		
	}  
	
	// category parent name eg Liner Type, Liner Construction, Backing Type
	foreach($parents as $parent){
		$parent_name[] = $parent->name;
	}
	
	
	// get child terms
	
	foreach($cat_ids as $cat_id){
		$down_cats[] = get_term($cat_id, 'category'); 
	}  
	foreach($down_cats as $down_cat){
		$cats_slug[] = $down_cat->slug;
	}
	
	
	$old_parent = get_terms('category', array('parent' => 0, 'orderby' => 'include','order' => 'ASC',  'hide_empty' => false)); 
		
	
	foreach ($old_parent as $pterm){
		
		$info = $pterm -> description;
		$cat_title = $pterm->name;
		$termID =  $pterm->term_id;
		
		$tax_image = get_term_meta($pterm->term_id, 'high_img', true);
		$catImg = wp_get_attachment_image ( $tax_image, array('50','50'), "", array( "class" => "img-responsive" ) );
		$terms = get_terms('category', array('parent' => $termID, 'orderby' => 'slug', 'hide_empty' => false));
		
		if(in_array($cat_title, $parent_name)){	
			$output .= '<ul id="cat-' .  $pterm->slug  . '" class="download-cat" >';	
		}else{
			$output .= '<ul id="cat-' .  $pterm->slug  . '" class="download-cat inactive" disable>';	
		}		
		
		$output .= '<li class="cat-icon" >';
		$output .= $catImg;
		$output .= '<h3 class="cat-title">' . $pterm->name . '</h3><i class="open-icon icon-tog"></i></li>';	
		$output .= '<li class="has-cats"><ul class="download-sub-cat">';
				
		foreach ($terms as $term){
			$sort = $term->slug;
		
			if(in_array($sort, $cats_slug)){
				$output .= '<li class="download-items ' . $term->slug . '"><input type="checkbox" class="sub-cats" data-pcat="' . $pterm->slug. '"  data-sub="' . $term->slug. '" value="' . $term->slug . '" name="cat[]" id="' . $term->slug . '"  />';
			}else{
				$output .= '<li class="download-items nada ' . $term->slug . '"><input type="checkbox" class="sub-cats"  data-pcat="' . $pterm->slug. '"   data-sub="' . $term->slug. '" value="' . $term->slug . '" name="cat[]" id="' . $term->slug . '"  disabled />';
			}
			
			$output .=  ' <label for="' . $term->slug . '">' . $term->name . '</label></li>';  
		} // end $terms foreach
								
		$output .=  '</ul></li></ul>';
					
	} //end $parents foreach 

   die(json_encode($output));
}