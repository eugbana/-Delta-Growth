<?php
/**
 * The template for displaying the Testimonials archive
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Delta_Growth
 * @since Delta Growth 1.0
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="site-container">
			<div class="content-area">

				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Client Testimonials', 'delta-growth' ); ?></h1>
					<?php
					$archive_description = get_the_archive_description();
					if ( $archive_description ) :
						?>
						<div class="archive-description"><?php echo wp_kses_post( wpautop( $archive_description ) ); ?></div>
						<?php
					endif;
					?>
				</header><!-- .page-header -->

				<?php if ( have_posts() ) : ?>

					<div class="testimonials-grid">
						<?php
						while ( have_posts() ) :
							the_post();
							$rating = delta_growth_get_testimonial_rating();
							$company = delta_growth_get_testimonial_company();
							?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'testimonial-card' ); ?>>
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

								<footer class="testimonial-footer">
									<div class="testimonial-author">
										<?php if ( has_post_thumbnail() ) : ?>
											<div class="author-photo">
												<?php the_post_thumbnail( 'thumbnail' ); ?>
											</div>
										<?php endif; ?>

										<div class="author-info">
											<h3 class="author-name"><?php the_title(); ?></h3>
											<?php if ( $company ) : ?>
												<p class="author-company"><?php echo esc_html( $company ); ?></p>
											<?php endif; ?>
										</div>
									</div>
								</footer>
							</article>

							<?php
						endwhile;
						?>
					</div><!-- .testimonials-grid -->

					<?php
					the_posts_pagination(
						array(
							'mid_size'  => 2,
							'prev_text' => __( 'Previous', 'delta-growth' ),
							'next_text' => __( 'Next', 'delta-growth' ),
						)
					);

				else :
					?>

					<p><?php esc_html_e( 'No testimonials found.', 'delta-growth' ); ?></p>

				<?php endif; ?>

			</div><!-- .content-area -->
		</div><!-- .site-container -->
	</main><!-- #primary -->

<?php
get_footer();

