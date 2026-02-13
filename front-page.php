<?php
/**
 * The front page template file
 *
 * This template is used for displaying the front page of the site.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Delta_Growth
 * @since Delta Growth 1.0
 */

get_header();

// Get ACF fields for hero and about sections.
$hero_headline  = function_exists( 'get_field' ) ? get_field( 'hero_headline' ) : 'Accelerate Your Business Growth';
$hero_subtext   = function_exists( 'get_field' ) ? get_field( 'hero_subtext' ) : 'We help businesses scale with data-driven strategies and innovative solutions.';
$hero_cta_text  = function_exists( 'get_field' ) ? get_field( 'hero_cta_text' ) : 'Get Started';
$hero_cta_link  = function_exists( 'get_field' ) ? get_field( 'hero_cta_link' ) : '#contact';
$about_title    = function_exists( 'get_field' ) ? get_field( 'about_title' ) : 'Why Choose Delta Growth';
$about_content  = function_exists( 'get_field' ) ? get_field( 'about_content' ) : '<p>We are a team of experts dedicated to helping businesses achieve sustainable growth through innovative strategies and cutting-edge solutions.</p>';
?>

	<main id="primary" class="site-main front-page">

		<!-- Hero Section -->
		<section class="hero-section">
			<!-- Hero Background SVG -->
			<div class="hero-bg-decoration" aria-hidden="true">
				<svg viewBox="0 0 1200 600" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
					<defs>
						<linearGradient id="heroGradient1" x1="0%" y1="0%" x2="100%" y2="100%">
							<stop offset="0%" style="stop-color:#38BDF8;stop-opacity:0.1" />
							<stop offset="100%" style="stop-color:#0F172A;stop-opacity:0.05" />
						</linearGradient>
					</defs>
					<!-- Geometric shapes -->
					<circle cx="900" cy="100" r="150" fill="url(#heroGradient1)" />
					<circle cx="1000" cy="400" r="100" fill="none" stroke="#38BDF8" stroke-width="2" opacity="0.2" />
					<circle cx="200" cy="500" r="80" fill="none" stroke="#38BDF8" stroke-width="2" opacity="0.15" />
					<path d="M 0,300 Q 300,200 600,300 T 1200,300" fill="none" stroke="#38BDF8" stroke-width="3" opacity="0.1" />
				</svg>
			</div>

			<div class="hero-container">
				<div class="hero-content">
					<h1 class="hero-headline"><?php echo esc_html( $hero_headline ); ?></h1>
					<p class="hero-subtext"><?php echo esc_html( $hero_subtext ); ?></p>
					<a href="<?php echo esc_url( $hero_cta_link ); ?>" class="button hero-cta"><?php echo esc_html( $hero_cta_text ); ?></a>
				</div>
			</div>
		</section>

		<!-- About Section -->
		<section class="about-section">
			<div class="site-container">
				<div class="about-content">
					<h2 class="section-title"><?php echo esc_html( $about_title ); ?></h2>
					<div class="about-text">
						<?php echo wp_kses_post( $about_content ); ?>
					</div>
				</div>

				<!-- Latest 3 Services as Highlights -->
				<?php
				$services_args = array(
					'post_type'      => 'service',
					'posts_per_page' => 3,
					'orderby'        => 'date',
					'order'          => 'DESC',
				);
				$services_query = new WP_Query( $services_args );

				if ( $services_query->have_posts() ) :
					?>
					<div class="about-services-grid">
						<?php
						while ( $services_query->have_posts() ) :
							$services_query->the_post();
							$icon_class = delta_growth_get_service_icon_class();
							?>
							<div class="about-service-card">
								<?php if ( $icon_class ) : ?>
									<div class="service-icon">
										<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
									</div>
								<?php endif; ?>
								<h3><?php the_title(); ?></h3>
								<p><?php echo esc_html( delta_growth_get_service_short_description() ); ?></p>
							</div>
						<?php endwhile; ?>
					</div>
					<?php
					wp_reset_postdata();
				endif;
				?>
			</div>

			<!-- Wave Divider SVG -->
			<div class="wave-divider" aria-hidden="true">
				<svg viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0,60 C300,100 900,20 1200,60 L1200,120 L0,120 Z" fill="#f8fafc" opacity="0.5"/>
					<path d="M0,80 C300,40 900,100 1200,80 L1200,120 L0,120 Z" fill="#f8fafc"/>
				</svg>
			</div>
		</section>

		<!-- Services Section -->
		<section class="services-section">
			<div class="site-container">
				<h2 class="section-title"><?php esc_html_e( 'Our Services', 'delta-growth' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'Comprehensive solutions to drive your business forward', 'delta-growth' ); ?></p>

				<?php
				$services_args = array(
					'post_type'      => 'service',
					'posts_per_page' => 4,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				);
				$services_query = new WP_Query( $services_args );

				if ( $services_query->have_posts() ) :
					?>
					<div class="services-grid">
						<?php
						while ( $services_query->have_posts() ) :
							$services_query->the_post();
							$short_description = delta_growth_get_service_short_description();
							?>
							<article class="service-card">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="service-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'medium' ); ?>
										</a>
									</div>
								<?php endif; ?>

								<div class="service-card-content">
									<h3 class="service-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>

									<?php if ( $short_description ) : ?>
										<p class="service-description"><?php echo esc_html( $short_description ); ?></p>
									<?php endif; ?>

									<a href="<?php the_permalink(); ?>" class="service-link">
										<?php esc_html_e( 'Learn More', 'delta-growth' ); ?> &rarr;
									</a>
								</div>
							</article>
						<?php endwhile; ?>
					</div>

					<div class="section-cta">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>" class="button button-outline">
							<?php esc_html_e( 'View All Services', 'delta-growth' ); ?>
						</a>
					</div>
					<?php
					wp_reset_postdata();
				endif;
				?>
			</div>
		</section>

		<!-- Featured Products Section -->
		<section class="featured-products-section">
			<div class="site-container">
				<h2 class="section-title"><?php esc_html_e( 'Featured Products', 'delta-growth' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'Discover our latest offerings', 'delta-growth' ); ?></p>

				<?php
				// Check if WooCommerce is active
				if ( class_exists( 'WooCommerce' ) ) :
					$products_args = array(
						'post_type'      => 'product',
						'posts_per_page' => 3,
						'orderby'        => 'date',
						'order'          => 'DESC',
						'post_status'    => 'publish',
					);
					$products_query = new WP_Query( $products_args );

					if ( $products_query->have_posts() ) :
						?>
						<div class="products-grid">
							<?php
							while ( $products_query->have_posts() ) :
								$products_query->the_post();
								global $product;
								?>
								<article class="product-card">
									<div class="product-image">
										<a href="<?php the_permalink(); ?>">
											<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail( 'woocommerce_thumbnail', array(
													'class' => 'product-thumbnail',
													'loading' => 'lazy'
												) );
											} else {
												echo '<img src="' . esc_url( wc_placeholder_img_src() ) . '" alt="' . esc_attr__( 'Placeholder', 'delta-growth' ) . '" class="product-thumbnail" loading="lazy" width="300" height="300" />';
											}
											?>
										</a>
									</div>

									<div class="product-content">
										<h3 class="product-title">
											<a href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
											</a>
										</h3>

										<div class="product-price">
											<?php echo $product->get_price_html(); ?>
										</div>

										<div class="product-excerpt">
											<?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
										</div>

										<div class="product-actions">
											<?php
											// Add to Cart button
											if ( $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() ) {
												echo sprintf(
													'<a href="%s" data-quantity="1" class="button product-add-to-cart" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow">%s</a>',
													esc_url( $product->add_to_cart_url() ),
													esc_attr( $product->get_id() ),
													esc_attr( $product->get_sku() ),
													esc_attr( $product->add_to_cart_description() ),
													esc_html( $product->add_to_cart_text() )
												);
											} else {
												echo '<a href="' . esc_url( get_permalink() ) . '" class="button product-view-button">' . esc_html__( 'View Product', 'delta-growth' ) . '</a>';
											}
											?>
										</div>
									</div>
								</article>
							<?php endwhile; ?>
						</div>

						<div class="section-cta">
							<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="button button-outline">
								<?php esc_html_e( 'View All Products', 'delta-growth' ); ?>
							</a>
						</div>
						<?php
						wp_reset_postdata();
					else :
						?>
						<div class="no-products-message">
							<p><?php esc_html_e( 'No products found. Please add some products to your shop.', 'delta-growth' ); ?></p>
						</div>
						<?php
					endif;
				else :
					?>
					<div class="woocommerce-not-active">
						<p><?php esc_html_e( 'WooCommerce is not active. Please install and activate WooCommerce to display products.', 'delta-growth' ); ?></p>
					</div>
					<?php
				endif;
				?>
			</div>
		</section>

		<!-- Testimonials Section -->
		<section class="testimonials-section">
			<div class="site-container">
				<h2 class="section-title"><?php esc_html_e( 'What Our Clients Say', 'delta-growth' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'Trusted by businesses worldwide', 'delta-growth' ); ?></p>

				<?php
				$testimonials_args = array(
					'post_type'      => 'testimonial',
					'posts_per_page' => 5,
					'orderby'        => 'rand',
				);
				$testimonials_query = new WP_Query( $testimonials_args );

				if ( $testimonials_query->have_posts() ) :
					?>
					<div class="testimonials-slider">
						<div class="testimonials-track">
							<?php
							while ( $testimonials_query->have_posts() ) :
								$testimonials_query->the_post();
								$rating = delta_growth_get_testimonial_rating();
								$company = delta_growth_get_testimonial_company();
								?>
								<div class="testimonial-slide">
									<div class="testimonial-content">
										<p class="quote-text">"<?php echo wp_kses_post( get_the_content() ); ?>"</p>
									</div>

									<div class="testimonial-rating">
										<?php
										for ( $i = 1; $i <= 5; $i++ ) {
											if ( $i <= $rating ) {
												echo '<span class="star filled">★</span>';
											} else {
												echo '<span class="star">☆</span>';
											}
										}
										?>
									</div>

									<div class="testimonial-author">
										<?php if ( has_post_thumbnail() ) : ?>
											<div class="author-photo">
												<?php the_post_thumbnail( 'thumbnail' ); ?>
											</div>
										<?php endif; ?>

										<div class="author-info">
											<h4 class="author-name"><?php the_title(); ?></h4>
											<?php if ( $company ) : ?>
												<p class="author-company"><?php echo esc_html( $company ); ?></p>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endwhile; ?>
						</div>

						<!-- Slider Controls -->
						<button class="slider-btn slider-prev" aria-label="<?php esc_attr_e( 'Previous testimonial', 'delta-growth' ); ?>">
							<span>&larr;</span>
						</button>
						<button class="slider-btn slider-next" aria-label="<?php esc_attr_e( 'Next testimonial', 'delta-growth' ); ?>">
							<span>&rarr;</span>
						</button>

						<!-- Slider Dots -->
						<div class="slider-dots"></div>
					</div>
					<?php
					wp_reset_postdata();
				endif;
				?>
			</div>
		</section>

		<!-- Pricing Section -->
		<section class="pricing-section">
			<div class="site-container">
				<h2 class="section-title"><?php esc_html_e( 'Simple, Transparent Pricing', 'delta-growth' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'Choose the plan that fits your needs', 'delta-growth' ); ?></p>

				<?php
				$pricing_args = array(
					'post_type'      => 'pricing_plan',
					'posts_per_page' => 3,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				);
				$pricing_query = new WP_Query( $pricing_args );

				if ( $pricing_query->have_posts() ) :
					?>
					<div class="pricing-plans-grid">
						<?php
						while ( $pricing_query->have_posts() ) :
							$pricing_query->the_post();
							$price = delta_growth_get_pricing_plan_price();
							$features = delta_growth_get_pricing_plan_features();
							$is_highlighted = delta_growth_is_pricing_plan_highlighted();
							$card_class = $is_highlighted ? 'pricing-card highlighted' : 'pricing-card';
							?>
							<article class="<?php echo esc_attr( $card_class ); ?>">
								<?php if ( $is_highlighted ) : ?>
									<div class="pricing-badge">
										<?php esc_html_e( 'Most Popular', 'delta-growth' ); ?>
									</div>
								<?php endif; ?>

								<header class="pricing-header">
									<h3 class="pricing-title"><?php the_title(); ?></h3>
									<?php if ( $price ) : ?>
										<div class="pricing-price"><?php echo esc_html( $price ); ?></div>
									<?php endif; ?>
								</header>

								<div class="pricing-description">
									<?php the_content(); ?>
								</div>

								<?php if ( $features ) : ?>
									<ul class="pricing-features">
										<?php foreach ( $features as $feature ) : ?>
											<li>
												<span class="feature-icon">✓</span>
												<?php echo esc_html( $feature['feature_text'] ); ?>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>

								<footer class="pricing-footer">
									<a href="<?php the_permalink(); ?>" class="button pricing-button">
										<?php esc_html_e( 'Choose Plan', 'delta-growth' ); ?>
									</a>
								</footer>
							</article>
						<?php endwhile; ?>
					</div>

					<div class="section-cta">
						<a href="<?php echo esc_url( get_post_type_archive_link( 'pricing_plan' ) ); ?>" class="button button-outline">
							<?php esc_html_e( 'View All Plans', 'delta-growth' ); ?>
						</a>
					</div>
					<?php
					wp_reset_postdata();
				endif;
				?>
			</div>
		</section>

		<!-- Contact Section -->
		<section class="contact-section" id="contact">
			<div class="site-container">
				<h2 class="section-title"><?php esc_html_e( 'Get In Touch', 'delta-growth' ); ?></h2>
				<p class="section-subtitle"><?php esc_html_e( 'Ready to accelerate your growth? Let\'s talk.', 'delta-growth' ); ?></p>

				<div class="contact-wrapper">
					<!-- Contact Information -->
					<div class="contact-info">
						<h3 class="contact-info-title"><?php esc_html_e( 'Contact Information', 'delta-growth' ); ?></h3>
						<p class="contact-info-text"><?php esc_html_e( 'Reach out to us and we\'ll respond as soon as possible.', 'delta-growth' ); ?></p>

						<div class="contact-details">
							<div class="contact-item">
								<div class="contact-icon">
									<i class="fas fa-envelope" aria-hidden="true"></i>
								</div>
								<div class="contact-content">
									<h4 class="contact-label"><?php esc_html_e( 'Email', 'delta-growth' ); ?></h4>
									<a href="mailto:hello@deltagrowth.com" class="contact-link">hello@deltagrowth.com</a>
								</div>
							</div>

							<div class="contact-item">
								<div class="contact-icon">
									<i class="fas fa-phone" aria-hidden="true"></i>
								</div>
								<div class="contact-content">
									<h4 class="contact-label"><?php esc_html_e( 'Phone', 'delta-growth' ); ?></h4>
									<a href="tel:+442071234567" class="contact-link">+234 (0) 20 7123 4567</a>
								</div>
							</div>

							<div class="contact-item">
								<div class="contact-icon">
									<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
								</div>
								<div class="contact-content">
									<h4 class="contact-label"><?php esc_html_e( 'Address', 'delta-growth' ); ?></h4>
									<p class="contact-text">
										123 Business Street<br>
										London, UK<br>
										EC1A 1BB
									</p>
								</div>
							</div>
						</div>

						<!-- Decorative SVG -->
						<div class="contact-decoration" aria-hidden="true">
							<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
								<defs>
									<linearGradient id="contactGradient" x1="0%" y1="0%" x2="100%" y2="100%">
										<stop offset="0%" style="stop-color:#38BDF8;stop-opacity:0.2" />
										<stop offset="100%" style="stop-color:#0F172A;stop-opacity:0.1" />
									</linearGradient>
								</defs>
								<circle cx="100" cy="100" r="80" fill="url(#contactGradient)" />
								<circle cx="100" cy="100" r="60" fill="none" stroke="#38BDF8" stroke-width="2" opacity="0.3" />
								<circle cx="100" cy="100" r="40" fill="none" stroke="#38BDF8" stroke-width="2" opacity="0.2" />
							</svg>
						</div>
					</div>

					<!-- Contact Form -->
					<div class="contact-form">
						<?php
						// Display WPForms contact form
						if ( function_exists( 'wpforms_display' ) ) {
							echo do_shortcode( '[wpforms id="10"]' );
						} else {
							?>
							<div class="contact-form-placeholder">
								<p><?php esc_html_e( 'Contact form will appear here.', 'delta-growth' ); ?></p>
								<p><small><?php esc_html_e( 'Please install and activate WPForms plugin to display the contact form.', 'delta-growth' ); ?></small></p>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</section>

	</main><!-- #primary -->

<?php
get_footer();

