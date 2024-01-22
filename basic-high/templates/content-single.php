<?php
/**
 *  Display main content
 */
 
   $avatar = get_avatar_img_url();
   
  $user_email = get_the_author_meta( 'user_email' );
?>
							
						

	<div class="container single-container">
		<div class="row single-row">  
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
					<header class="single-entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						
						<div class="entry-meta">
							<span class="meta-prep meta-prep-author small"><?php _e(' By  ', 'basic-high'); ?></span>
						<span class="author vcard"><img src="<?php echo $avatar;?>"> <a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php printf( __( ' View all articles by %s ', 'basic-high' ), the_author_meta( 'display_name', 25 ) ); ?>"> <?php the_author(); ?></a></span>
						<span class="meta-prep meta-prep-entry-date"><?php _e('Published ', 'basic-high'); ?> </span><span class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></span>
						
						
						<?php
						 
							$categories_list = get_the_category_list( __( ', ', 'basic-high' ) );
							if ( $categories_list ):
						?>
							<span class="cat-links">
								<?php printf( __( '<span class="%1$s">Posted in</span> %2$s ', 'basic-high' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );$show_sep = true; ?>
							</span>
							
						<?php endif; // End if categories ?>
						</div>
						
					</header><!-- .entry-header -->
			
					<div class="entry-content single-entry">
						
						<?php the_post_thumbnail('large'); ?>
						
						<?php the_content(); ?>
				
					</div><!-- .entry-content -->
					
					<footer class=" single-foot-meta">
						<span class="tag-links"> This post is tagged as <?php echo get_the_tag_list('',', ',''); ?> . </span>
					 </footer>
				</article><!-- #post -->
				
				<?php wp_link_pages( 'before=<ul class="page-links">&after=</ul>&link_before=<li class="page-link">&link_after=</li>' ); ?>
				
			<?php comments_template( '', true ); ?>
				
				<div class="post-nav">
					<span class="prev-link"><?php previous_post_link( '&laquo; %link', '%title' ); ?></span>
					<span class="next-link" ><?php next_post_link( ' %link', '%title  &raquo;'); ?></span>
				</div>
		</div>
	</div>