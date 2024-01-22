<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="profile" href="http://gmpg.org/xfn/11">
		 
		<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
		
		<?php wp_head(); ?>
		
	</head>
	
	<body <?php body_class(); ?>>
		<header class="main-head">
			<div class="container head-container">
				<div class="row head-row">
					
					<div class="site-branding">
						<?php  if ( function_exists( 'the_custom_logo' ) ) {the_custom_logo();} ?>
					</div>
					<nav class="navbar" role="navigation">
					
						<!-- css mobile menu breakpoint 920-->
						<div class="navbar-toggler">
							<input type="checkbox" />
							<span></span>
							<span></span>
							<span></span>
	 
							<?php  
								wp_nav_menu( array(
									'theme_location'  => 'primary_menu',
									'depth'	          => 8,
									'container'       => '',
									'container_class' => '',
									'menu_class'      => 'nav-menu',
									'walker'         => new High_Walker_Nav(),
									'fallback_cb'    => true
								) );
							 ?>
							 
							 </div>
						
							<?php  
								// standard deskktop menu 
								wp_nav_menu( array(
									'theme_location'  => 'primary_menu',
									'depth'	          => 8,
									'container'       => 'div',
									'container_class' => 'hide-mobile',
									'menu_class'      => 'nav-menu',
									'walker'         => new High_Walker_Nav(),
									'fallback_cb'    => true
								) );
							 ?>
						
					</nav><!-- Navigation -->
				
				<?php echo get_search_form(); ?>
				
				
				</div>
		
			</div>
		</header>
					<div class="page-content">