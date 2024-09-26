<?php
/**
 *
 * Full width blog page no sidebar
 *
 * */

global $post;

?>
<div class="container blog-container">

	<h1 class="page-title"><?php echo single_post_title(); ?> </h1>

	<div class="row blog-row">

		<?php

		$paged = get_query_var('paged') ? get_query_var('paged') : 1;
		$args = array(
			'paged' => $paged,
			'posts_per_page' => 12,
		);

		$query = new WP_Query($args);

		if ($query->have_posts()):
			while ($query->have_posts()):
				$query->the_post();

				$title = get_the_title()
					?>


				<article <?php post_class('post-content'); ?>>

					<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="bookmark"
							title="<?php the_title_attribute(); ?>"><?php echo mb_strimwidth($title, 0, 30, '...'); ?></a></h2>

					<figure class="featured-figure">

						<?php
						if (has_post_thumbnail()) {

							the_post_thumbnail('post-thumbnail', ['class' => 'featured', 'title' => '', 'alt' => '']);

						} else {

							echo high_thumb();

						} // thumbnails
				
						echo '</figure>';
						echo '<div class="post-entry"> 	';

						the_excerpt();
						?>

			</div>

			<footer class="entry-meta">
				<span class="meta-prep meta-prep-author small"><?php _e(' By  ', 'basic-high'); ?></span>
				<span class="author vcard"><?php echo get_avatar(get_the_author_meta('ID'), 32); ?> <a class="url fn n"
						href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"
						title="<?php printf(__(' View all articles by %s ', 'basic-high'), get_the_author_meta('display_name')); ?>">
						<?php the_author(); ?></a></span>
				<span class="tag-links"> This post is tagged as <?php echo get_the_tag_list('', ', ', ''); ?> . </span>

				<?php
				$categories_list = get_the_category_list(__(', ', 'basic-high'));
				if ($categories_list):
					?>
					<span class="cat-links"><?php printf(__('<span class="%1$s">Posted in</span> %2$s ', 'basic-high'), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list);
					$show_sep = true; ?></span>

				<?php endif; // End if categories ?>

			</footer>

			</article>


			<?php
			endwhile;

		endif;
		?>


</div>
<?php high_pagination(); ?>
</div> <!-- this is the blog -->