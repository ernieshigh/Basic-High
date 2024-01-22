<?php
/***
	*
	* Custom functions 
	*
****/



function high_breadcrumbs() {
    // Set variables for later use
    $here_text        = '';
    $home_link        = home_url('/');
    $home_text        = __( 'Homepage', 'basic-high' );
    $link_before      = '<span typeof="v:Breadcrumb">';
    $link_after       = '</span>';
    $link_attr        = ' rel="v:url" property="v:title"';
    $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter        = '<img src="' . get_template_directory_uri() . '/assets/images/breadcrumb.svg" class="separator">';             // Delimiter between crumbs
    $before           = '<span class="current">'; // Tag before the current crumb
    $after            = '</span>';                // Tag after the current crumb
    $page_addon       = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links   = '';

    /** 
     * Set our own $wp_the_query variable. Do not use the global variable version due to 
     * reliability
     */
    $wp_the_query   = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();

    // Handle single post requests which includes single pages, posts and attatchments
    if ( is_singular() ) 
    {
        /** 
         * Set our own $post variable. Do not use the global variable version due to 
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post( $queried_object );

        // Set variables 
        $title          = apply_filters( 'the_title', $post_object->post_title );
        $parent         = $post_object->post_parent;
        $post_type      = $post_object->post_type;
        $post_id        = $post_object->ID;
        $post_link      = $before . $title . $after;
        $parent_string  = '';
        $post_type_link = '';
		
		

        if ( 'post' === $post_type ) 
        {
            // Get the post categories
            $categories = get_the_category( $post_id );
            if ( $categories ) {
                // Lets grab the first category
                $category  = $categories[0];

                $category_links = get_category_parents( $category, true, $delimiter );
                $category_links = str_replace( '<a',   $link_before . '<a' . $link_attr, $category_links );
                $category_links = str_replace( '</a>', '</a>' . $link_after,             $category_links );
            }
        }

        if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) ){
            
			$post_type_object = get_post_type_object( $post_type );
			
			
            $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );
			
			$label = sprintf($post_type_object->labels->singular_name, 'basic-high');
			
			

            $post_type_link   = sprintf( $link, $archive_link, $label);
        }

        // Get post parents if $parent !== 0
        if ( 0 !== $parent ) 
        {
            $parent_links = [];
            while ( $parent ) {
                $post_parent = get_post( $parent );

                $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                $parent = $post_parent->post_parent;
            }

            $parent_links = array_reverse( $parent_links );

            $parent_string = implode( $delimiter, $parent_links );
        }

        // Lets build the breadcrumb trail
		
        if ( $parent_string ) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link ;
        } else {
			
			
            $breadcrumb_trail = $post_link ;
        }

        if ( $post_type_link )
            $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;

        if ( $category_links )
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
    }

    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if( is_archive() )
    {
        if (    is_category()
             || is_tag()
             || is_tax()
        ) {
            // Set the variables for this section
            $term_object        = get_term( $queried_object );
            $taxonomy           = $term_object->taxonomy;
            $term_id            = $term_object->term_id;
            $term_name          = $term_object->name;
            $term_parent        = $term_object->parent;
            $taxonomy_object    = get_taxonomy( $taxonomy );
            $current_term_link  = $before . $term_name . $after;
            $parent_term_string = '';
			$seal = '';

            if ( 0 !== $term_parent )
            {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ( $term_parent ) {
                    $term = get_term( $term_parent, $taxonomy );

                    $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                    $term_parent = $term->parent;
                }

                $parent_term_links  = array_reverse( $parent_term_links );
                $parent_term_string = implode( $delimiter, $parent_term_links );
            }
			
			if($taxonomy == 'seal_type'){
				
				$seal = '<a href="/product-datasheet/?lang=' . ICL_LANGUAGE_CODE .'">' . __('Product Datasheets', 'basic-high' ) . '</a>';
			}

            if ( $parent_term_string ) {
				if($seal != ''){
					$breadcrumb_trail = $seal . $delimiter .  $parent_term_string . $delimiter . $current_term_link;
				}else{
					 $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
				}
               
            } else {
				
				if($seal != ''){
                $breadcrumb_trail =  $seal . $delimiter .  $current_term_link;
				}else{
					
                $breadcrumb_trail = $current_term_link;
				}
            }

        } elseif ( is_author() ) {

            $breadcrumb_trail = __( 'Author archive for ', 'basic-high') .  $before . $queried_object->data->display_name . $after;

        } elseif ( is_date() ) {
            // Set default variables
            $year     = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day      = $wp_the_query->query_vars['day'];

            // Get the month name if $monthnum has a value
            if ( $monthnum ) {
                $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                $month_name = $date_time->format( 'F' );
            }

            if ( is_year() ) {

                $breadcrumb_trail = $before . $year . $after;

            } elseif( is_month() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );

                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

            } elseif( is_day() ) {

                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }

        } elseif ( is_post_type_archive() ) {

            $post_type        = $wp_the_query->query_vars['post_type'];
            $post_type_object = get_post_type_object( $post_type );

            $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;

        }
    }   

    // Handle the search page
    if ( is_search() ) {
        $breadcrumb_trail = __( 'Search query for: ' , 'basic-high') . $before . get_search_query() . $after;
    }

    // Handle 404's
    if ( is_404() ) {
        $breadcrumb_trail = $before . __( 'Error 404', 'basic-high') . $after;
    }

    // Handle paged pages
    if ( is_paged() ) {
        $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
        $page_addon   = $before . sprintf( __( ' ( Page %s )' , 'basic-high' ), number_format_i18n( $current_page )) . $after;
    }

    $breadcrumb_output_link  = '';
    $breadcrumb_output_link .= '<div class="breadcrumb-box">';
    if (    is_home()
         || is_front_page()
    ) {
        // Do not show breadcrumbs on page one of home and frontpage
        if ( is_paged() ) {
           // $breadcrumb_output_link .= $here_text . $delimiter;
            $breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
            $breadcrumb_output_link .= $page_addon;
        }
    } else {
        //$breadcrumb_output_link .= $here_text . $delimiter;
        $breadcrumb_output_link .= '<a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a>';
        $breadcrumb_output_link .= $delimiter;
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    $breadcrumb_output_link .= '</div><!-- .breadcrumbs -->';

    return $breadcrumb_output_link;
}



//add_filter( 'wp_nav_menu_items','add_search_box', 10, 2 );
function add_search_box( $items ) {
		$items .= '<li class="search-container">' . get_search_form(false) . '</li>';
    return $items;
}

//get gravatar
function get_avatar_img_url() {
  $user_email = get_the_author_meta( 'user_email' );
 
  $url = 'http://gravatar.com/avatar/' . md5( $user_email );
  $url = add_query_arg( array(
    's' => 80,
    'd' => 'mm',
  ), $url );
  return esc_url_raw( $url );
}


// copyright
function high_copyright() {
	$all_posts = get_posts( 
	'post_status=publish&order=ASC' );
	$first_post = $all_posts[0];
	$first_date = $first_post->post_date_gmt;
	_e( 'Copyright &copy; ' , 'basic-high');
	if ( substr( $first_date, 0, 4 ) == date( 'Y' ) ) {
	echo date( 'Y' );
	} else {
	echo substr( $first_date, 0, 4 ) . "-" . date( 'Y' );
	}
	echo '<a href="' . esc_url( __( 'https://ernieshigh.dev/', 'basic-high' ) ) . '">';
	echo ' <strong>' . get_bloginfo( 'name' ) . '</strong> </a>';
	_e( 'All rights reserved.'  , 'basic-high');
}
 