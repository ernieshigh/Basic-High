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
					<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 32, '...'); ?></a></h2>
					
					<div class="post-entry"> 
					
					<?php if ( has_post_thumbnail() ){ ?>
						<figure class="featured-figure">
							<?php the_post_thumbnail('post-thumbnail', ['class' => 'featured', 'title' => '' , 'alt' => '']); ?>
						</figure>
						
				<?php	}else{
						
						echo '<figure class="featured-figure">';
							echo high_thumb();
						echo '</figure>';
						
						} // thumbnails 
						
						the_excerpt('high_excerpt_length', 'high_excerpt_more'); ?>
					</div>
					
				
					<footer class="entry-meta">
						<span class="meta-prep meta-prep-author small"><?php _e(' By  ', 'basic-high'); ?></span>
						<span class="author vcard"><?php echo  get_avatar( get_the_author_meta( 'ID'), 32 ); ?> <a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php printf( __( ' View all articles by %s ', 'basic-high' ), the_author_meta( 'display_name', 25 ) ); ?>"> <?php the_author(); ?></a></span>
						<br><span class="tag-links"> This post is tagged as <?php echo get_the_tag_list('',', ',''); ?> . </span>
							
						<?php
							$categories_list = get_the_category_list( __( ', ', 'basic-high' ) );
							if ( $categories_list ):
						?>
							<span class="cat-links">
								<?php printf( __( '<span class="%1$s">Posted in</span> %2$s ', 'basic-high' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );$show_sep = true; ?>
							</span>
							
						<?php endif; // End if categories ?>
						
					</footer>
				</article>		   					

			<?php endwhile; ?>
		<?php endif; ?>
		
		
		</div>
		<?php high_pagination(); ?>
	</div> <!-- this is the blog -->