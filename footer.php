<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Delta_Growth
 * @since Delta Growth 1.0
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-container">
			<div class="footer-columns">
				<!-- Column 1: Logo & Tagline -->
				<div class="footer-column footer-branding">
					<?php
					// Display custom logo if set
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						?>
						<div class="footer-logo-text">
							<h3 class="footer-site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h3>
						</div>
						<?php
					}

					$delta_growth_description = get_bloginfo( 'description', 'display' );
					if ( $delta_growth_description || is_customize_preview() ) :
						?>
						<p class="footer-tagline"><?php echo $delta_growth_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				</div>

				<!-- Column 2: Quick Links -->
				<div class="footer-column footer-links">
					<h4 class="footer-column-title"><?php esc_html_e( 'Quick Links', 'delta-growth' ); ?></h4>
					<nav class="footer-navigation">
						<ul class="footer-menu">
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'delta-growth' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>"><?php esc_html_e( 'About', 'delta-growth' ); ?></a></li>
							<li><a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>"><?php esc_html_e( 'Services', 'delta-growth' ); ?></a></li>
							<li><a href="<?php echo esc_url( get_post_type_archive_link( 'testimonial' ) ); ?>"><?php esc_html_e( 'Testimonials', 'delta-growth' ); ?></a></li>
							<li><a href="<?php echo esc_url( get_post_type_archive_link( 'pricing_plan' ) ); ?>"><?php esc_html_e( 'Pricing', 'delta-growth' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"><?php esc_html_e( 'Contact', 'delta-growth' ); ?></a></li>
						</ul>
					</nav>
				</div>

				<!-- Column 3: Social Media -->
				<div class="footer-column footer-social">
					<h4 class="footer-column-title"><?php esc_html_e( 'Follow Us', 'delta-growth' ); ?></h4>
					<div class="social-links">
						<a href="#" class="social-link" aria-label="<?php esc_attr_e( 'Facebook', 'delta-growth' ); ?>" target="_blank" rel="noopener noreferrer">
							<i class="fab fa-facebook-f" aria-hidden="true"></i>
						</a>
						<a href="#" class="social-link" aria-label="<?php esc_attr_e( 'Twitter', 'delta-growth' ); ?>" target="_blank" rel="noopener noreferrer">
							<i class="fab fa-twitter" aria-hidden="true"></i>
						</a>
						<a href="#" class="social-link" aria-label="<?php esc_attr_e( 'LinkedIn', 'delta-growth' ); ?>" target="_blank" rel="noopener noreferrer">
							<i class="fab fa-linkedin-in" aria-hidden="true"></i>
						</a>
						<a href="#" class="social-link" aria-label="<?php esc_attr_e( 'Instagram', 'delta-growth' ); ?>" target="_blank" rel="noopener noreferrer">
							<i class="fab fa-instagram" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>

			<!-- Footer Bottom: Copyright -->
			<div class="footer-bottom">
				<div class="footer-copyright">
					<p>
						&copy; <?php echo esc_html( date( 'Y' ) ); ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>.
						<?php esc_html_e( 'All rights reserved.', 'delta-growth' ); ?>
					</p>
				</div>
			</div>
		</div><!-- .site-container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

