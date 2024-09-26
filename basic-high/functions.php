<?php

// Setup basic-high Theme

include get_theme_file_path('/inc/high-walker.php');
include get_theme_file_path('/inc/high-functions.php');
include get_theme_file_path('/inc/high-blocks.php');
include get_theme_file_path('/inc/high-filter.php');
include get_theme_file_path('/inc/high-cat-filter.php');


if (!function_exists('wp_body_open')) {
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
}

add_action('init', 'stop_heartbeat', 1);
function stop_heartbeat()
{
	wp_deregister_script('heartbeat');
}

add_action('after_setup_theme', 'high_name_setup');
function high_name_setup()
{
	// theme text domain
	load_theme_textdomain('basic-high', get_template_directory() . '/languages');

	//add post format
	add_theme_support('post-formats', array('aside', 'gallery', ));

	//adds title in head
	add_theme_support("title-tag");

	// add feed
	add_theme_support('automatic-feed-links');

	// add thumbnail
	add_theme_support('post-thumbnails');
	add_image_size('feature-thumb', 300, 9999);
	add_theme_support('html5', array('search-form'));
	add_theme_support('category-thumbnails');

	//register  menu option
	add_action('init', 'basic_high_register_menus');
	// add editor styles 
	add_theme_support("responsive-embeds");
	add_theme_support("align-wide");
	add_editor_style();
	// block support
	add_theme_support("wp-block-styles");
	add_theme_support("responsive-embeds");
	add_theme_support("align-wide");
	add_editor_style();



	// set content width
	if (!isset($content_width))
		$content_width = 1280;
	add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));// add custom header
	$header = array(
		'random-default' => false,
		'height' => 100,
		'flex-height' => true,
		'flex-width' => true,
		'default-text-color' => '#5f9ea0',
		'header-text' => true,
		'uploads' => true,
		'wp-head-callback' => 'high_header_style',
	);
	add_theme_support("custom-header", $header);

	// add custom background
	$background = array(
		'default-color' => '#fff',
		'default-image' => '',
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => ''
	);
	add_theme_support("custom-background", $background);

	// set header defaults
	if (!function_exists('high_header_style')) {
		function high_header_style()
		{
			$header_text_color = get_header_textcolor();
			$header_image = get_header_image();

			if ($header_image): ?>
				<style type="text/css">
					header {
						background-image: url(<?php echo esc_url($header_image); ?>);
					}
				</style>
				<?php
			endif;
		}
	}

	add_theme_support("title-tag");

}

add_filter('wp_get_attachment_image_attributes', function ($attr) {
	$attr['alt'] = get_the_title();
	$attr['title'] = get_the_title();
	return $attr;
});


// display logo 
// 
add_action('after_setup_theme', 'high_display_logo');
function high_display_logo()
{
	$defaults = array(
		'height' => 220,
		'width' => 220,
		'flex-height' => false,
		'flex-width' => false,
		'header-text' => array('site-title', 'site-description'),

	);
	add_theme_support('custom-logo', $defaults);

}

add_action('after_setup_theme', 'basic_high_register_menus', 0);
function basic_high_register_menus()
{
	register_nav_menus(array(
		'primary_menu' => __('Primary Menu', 'basic-high'),
		'footer_menu' => __('Footer Menu', 'basic-high'),
	));
}

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

	global $wp_version;
	if ($wp_version !== '4.7.1') {
		return $data;
	}

	$filetype = wp_check_filetype($filename, $mimes);

	return [
		'ext' => $filetype['ext'],
		'type' => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];

}, 10, 4);

// allow SVG media in theme							   
add_action('admin_head', 'fix_svg');
function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

function fix_svg()
{
	echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}


// add preloac to enqueue stylesheets
add_filter('style_loader_tag', 'high_preload_styles', 10, 2);
function high_preload_styles($html, $handle)
{
	if (strcmp($handle, 'preload-style') == 0) {
		$html = str_replace("rel='stylesheet'", "rel='preload' as='style' ", $html);
	}
	return $html;
}



// enqueue add custom scripts and styles if needed
add_action('wp_enqueue_scripts', 'high_scripts');
function high_scripts()
{
	// styles 
	// remove unuseded block styles
	//wp_dequeue_style( 'wp-block-library' );
	//wp_dequeue_style( 'wp-block-library-theme' );
	//wp_dequeue_style( 'wc-blocks-style' ); // Remove WooCommerce block CSS	

	// theme styles
	wp_enqueue_style('default', get_stylesheet_directory_uri() . '/assets/css/fallback.css');
	wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css2?family=Open+Sans&display=swap', false);
	wp_enqueue_style('high-style', get_stylesheet_uri());

	// scripts	
	if (!is_admin()) {
		wp_dequeue_script('jquery');
		wp_deregister_script('jquery');
	}

	if (is_page_template('template-filter.php')) {
		wp_register_script('jquery', '/wp-includes/js/jquery/jquery.js');
		wp_enqueue_script('jquery');
		wp_enqueue_script('filter', get_stylesheet_directory_uri() . '/assets/js/high-filter.js', array('jquery'));

		wp_localize_script(
			'filter',
			'high_filter',
			array(
				// Use a nanme that explain what the property contains
				'ajax_url' => admin_url('admin-ajax.php'),
				'high_nonce' => wp_create_nonce('high_nonce')
			)
		);

	}
}
// defer stylesheets                                                        
add_filter('style_loader_tag', 'high_defer_styles', 10, 2);
function high_defer_styles($html, $handle)
{
	$handles = array('wpb-google-fonts', 'default', 'icons', 'high-team', 'contact-form-7');
	if (in_array($handle, $handles)) {
		$html = str_replace('media=\'all\'', 'media=\'print\' onload="this.onload=null;this.media=\'all\'"', $html);
	}
	return $html;
}

function disable_emoji_feature()
{

	// Prevent Emoji from loading on the front-end
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	// Remove from admin area also
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('admin_print_styles', 'print_emoji_styles');

	// Remove from RSS feeds also
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');

	// Remove from Embeds
	remove_filter('embed_head', 'print_emoji_detection_script');

	// Remove from emails
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

	// Disable from TinyMCE editor. Currently disabled in block editor by default
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');

	/** Finally, prevent character conversion too
	 ** without this, emojis still work 
	 ** if it is available on the user's device
	 */

	add_filter('option_use_smilies', '__return_false');

}

function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		$plugins = array_diff($plugins, array('wpemoji'));
	}
	return $plugins;
}

add_action('init', 'disable_emoji_feature');

// add sidebar and widget areas
add_action('widgets_init', 'high_sidebar');
function high_sidebar()
{

	register_sidebar(array(
		'name' => __('The Sidebar', 'basic-high'),
		'id' => 'right_sidebar',
		'description' => __('This sidebar uses the right sidebar template.', 'basic-high'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('The Other Sidebar', 'basic-high'),
		'id' => 'left_sidebar',
		'description' => __('This sidebar uses the left sidebar template.', 'basic-high'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __('Left Foot', 'basic-high'),
		'id' => 'left_foot',
		'description' => __('Add a widget to left footer', 'basic-high'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __('Center Foot', 'basic-high'),
		'id' => 'center_foot',
		'description' => __('Add widget to center foot.', 'basic-high'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => __('Right Foot', 'basic-high'),
		'id' => 'right_foot',
		'description' => __('Add widget to right foot', 'basic-high'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

// high excerpts
add_filter('excerpt_length', 'high_excerpt_length', 999);
function high_excerpt_length($length)
{
	return 35;
}

add_filter('get_the_excerpt', 'new_excerpt_more');
function new_excerpt_more($excerpt)
{
	return $excerpt . '<a class="read-more" href="' . get_the_permalink() . '" rel="nofollow"> Read More<span class="icons"> >> </span></a>';
}

add_filter('excerpt_more', '__return_false');





// add pagination to blog pages
function high_pagination()
{


	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ($wp_query->max_num_pages <= 1)
		return;

	$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
	$max = intval($wp_query->max_num_pages);

	/** Add current page to the array */
	if ($paged >= 1)
		$links[] = $paged;

	/** Add the pages around the current page to the array */
	if ($paged >= 3) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if (($paged + 2) <= $max) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="page-navigation"><ul class="">' . "\n";

	/** Previous Post Link */
	if (get_previous_posts_link())
		printf('<li>%s</li>' . "\n", get_previous_posts_link());

	/** Link to first page, plus ellipses if necessary */
	if (!in_array(1, $links)) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

		if (!in_array(2, $links))
			echo '<li>&hellip;</li>';
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort($links);
	foreach ((array) $links as $link) {
		$class = $paged == $link ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
	}

	/** Link to last page, plus ellipses if necessary */
	if (!in_array($max, $links)) {
		if (!in_array($max - 1, $links))
			echo '<li>&hellip;</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
	}

	/** Next Post Link */
	if (get_next_posts_link())
		printf('<li>%s</li>' . "\n", get_next_posts_link());

	echo '</ul></div>' . "\n";
}


function mail_failure($wp_error)
{
	error_log('Mailing Error Found: ');
	error_log(print_r($wp_error, true));
}
add_action('wp_mail_failed', 'mail_failure', 10, 1);