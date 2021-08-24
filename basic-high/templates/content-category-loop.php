<?php
/*
 *
 *
 * Category Page Loop
 *
 *
*/
?>
<?php 
	
	$category = get_queried_object();
	
	$cat_title = $category->name;
?>

	<div class="container page-container">
		<?php  echo '<h1 class="cat-title">' . $cat_title . '</h1>'; ?>
		<div class="row row-loop">
		
		<?php

			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(
			  'posts_per_page' => 5,
			  'paged'          => $paged
			);
			
			$cat_query = new WP_Query($args);

			if($cat_query->have_posts()): while ( $cat_query->have_posts() ): $cat_query->the_post(); ?>
	<article  <?php post_class('post-content'); ?>>
					<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					
					<?php the_post_thumbnail();?>
					<div class="post-entry">
						<?php  the_excerpt('high_excerpt_length', 'high_excerpt_more'); ?>
					</div>
					
					<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
				
					<footer class="entry-meta">
					<span class="meta-prep meta-prep-author"><?php _e('By ', 'basic-high'); ?></span>
							<span class="author vcard"><?php echo  get_avatar( get_the_author_meta( 'ID'), 32 ); ?><a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php printf( __( 'View all articles by %s', 'basic-high' ), $authordata->display_name ); ?>"><?php the_author(); ?></a></span>
							
						<span class="tag-links"> This post is tagged as <?php echo get_the_tag_list('',', ',''); ?> . </span>
							
						<?php
							$categories_list = get_the_category_list( __( ', ', 'basic-high' ) );
							if ( $categories_list ):
						?>
							<span class="cat-links">
								<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'basic-high' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );$show_sep = true; ?>
							</span>
							
						<?php endif; // End if categories ?>
						
					</footer>
				</article>		   					

			<?php endwhile; ?>
		<?php endif; ?>
		
		
		</div>
		<?php high_pagination(); ?>
	</div> <!-- this is the blog -->