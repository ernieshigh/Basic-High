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
					</div>
					<div class="footer-content">
						<p class="foot-text"> <?php high_copyright(); ?>  </p>
					</div>
				</div>
				
			</div>
			
			<?php wp_footer(); ?>
				
		</footer><!-- close footer -->
	</body>
</html>