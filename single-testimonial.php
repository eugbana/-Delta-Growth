<?php
/**
 * The template for displaying single Testimonials
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

				<?php
				while ( have_posts() ) :
					the_post();
					$rating = delta_growth_get_testimonial_rating();
					$company = delta_growth_get_testimonial_company();
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'testimonial-single' ); ?>>
						<header class="entry-header">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="testimonial-photo-large">
									<?php the_post_thumbnail( 'medium' ); ?>
								</div>
							<?php endif; ?>

							<h1 class="entry-title"><?php the_title(); ?></h1>

							<?php if ( $company ) : ?>
								<p class="testimonial-company"><?php echo esc_html( $company ); ?></p>
							<?php endif; ?>

							<div class="testimonial-rating-large">
								<?php
								for ( $i = 1; $i <= 5; $i++ ) {
									if ( $i <= $rating ) {
										echo '<span class="star filled">★</span>';
									} else {
										echo '<span class="star">☆</span>';
									}
								}
								?>
								<span class="rating-text"><?php echo esc_html( $rating ); ?> / 5</span>
							</div>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<?php
							the_content();

							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'delta-growth' ),
									'after'  => '</div>',
								)
							);
							?>
						</div><!-- .entry-content -->

						<?php if ( get_edit_post_link() ) : ?>
							<footer class="entry-footer">
								<?php
								edit_post_link(
									sprintf(
										wp_kses(
											/* translators: %s: Name of current post. Only visible to screen readers */
											__( 'Edit <span class="screen-reader-text">%s</span>', 'delta-growth' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										wp_kses_post( get_the_title() )
									),
									'<span class="edit-link">',
									'</span>'
								);
								?>
							</footer><!-- .entry-footer -->
						<?php endif; ?>
					</article><!-- #post-<?php the_ID(); ?> -->

					<?php
					// Navigation to previous/next testimonial.
					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Testimonial:', 'delta-growth' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Testimonial:', 'delta-growth' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

				endwhile; // End of the loop.
				?>

			</div><!-- .content-area -->
		</div><!-- .site-container -->
	</main><!-- #primary -->

<?php
get_footer();

