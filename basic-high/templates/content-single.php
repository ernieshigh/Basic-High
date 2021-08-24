<?php
/**
 *  Display main content
 */
?>


	<div class="container">
		<div class="row"> 
	<?php if ( ! has_post_format() ) { ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						
						<div class="entry-meta">
							<span class="meta-prep meta-prep-author small"><?php _e(' By  ', 'basic-high'); ?></span>
						<span class="author vcard"><?php echo  get_avatar( get_the_author_meta( 'ID'), 32 ); ?> <a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php printf( __( ' View all articles by %s ', 'basic-high' ), the_author_meta( 'display_name', 25 ) ); ?>"> <?php the_author(); ?></a></span>
						| 
							<span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'basic-high'); ?></span>
							<span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
						</div>
						
					</header><!-- .entry-header -->

		<?php if ( is_search()): // Display Excerpts for Search ?>
				
					<div class="entry-summary">
						<?php 
							 the_post_thumbnail();  
							the_excerpt(); ?>
						
					</div><!-- .entry-summary -->
			
			<?php else : ?>
			
					<div class="entry-content">
						
						<?php the_post_thumbnail(); ?>
						
						<?php the_content(); ?>
				
					</div><!-- .entry-content -->
		
			<?php endif;  //end the loop ?>

					
		 
			
			<?php wp_link_pages(); ?>
			
				</article><!-- #post -->
				
	<?php } 
				// add comments stuff
				comments_template( '', true );
				
				echo '<div class="post-nav">';
				// add previus post link
				echo '<span class="prev-link" >';
				previous_post_link( '&laquo; %link', '%title' );
				echo '</span>';
				
				//add next post link
				echo '<span class="next-link" >'; 
				next_post_link( ' %link', '%title  &raquo;' );
				echo '</span>';
			
			
					echo '</div>';
			
			
			
			
				?>
		</div>
	</div>