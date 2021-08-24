<?php
// footer template for Basic Theme
?> 		
		
		<footer id="footer">
		
			
					<div class="container widget-container">
						<div class="row widget-row">
							<?php if ( is_active_sidebar( 'left_foot' ) ) { ?>
								<div class="footer-widget-grid">
									<?php dynamic_sidebar( 'left_foot' ); ?>
								</div>
							<?php } if ( is_active_sidebar( 'center_foot' ) && !is_page(2025) ) { ?>
								<div class="footer-widget-grid">
									<?php dynamic_sidebar( 'center_foot' ); ?>
								</div>
							<?php } if ( is_active_sidebar( 'right_foot' )  && !is_page(2025)  && !is_page(2022) ) { ?>
								<div class="footer-widget-grid">
									<?php dynamic_sidebar( 'right_foot' ); ?>
								</div>
							<?php } 
						?>
			
						</div>
					</div>
			<div class="container foot-container">
				<div id="foot-text" class="row row-eq-height">
					<div class="footer-content">
						
						<ul class="social-icon">
							<li><a href=" "><i class="linkedin social-link"></i></a></li>
							<li><a href=""><i class="twit social-link"></i></a></li>
							<li><a href=""><i class="face social-link"></i></a></li>
						
						</ul>
					</div>
					
					<div class="footer-content">
						<p class="foot-text"> <?php _e('All Rights Reserved.&copy; Copyright' . date('Y'), 'basic-high'); ?>  </p>
					</div>
				</div>
				
			</div>
			
			<?php wp_footer(); ?>
				
		</footer><!-- close footer -->
	</body>
</html>