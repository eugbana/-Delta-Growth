<?php
/**
 * The template for displaying single Pricing Plans
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
					$price = delta_growth_get_pricing_plan_price();
					$features = delta_growth_get_pricing_plan_features();
					$is_highlighted = delta_growth_is_pricing_plan_highlighted();
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'pricing-plan-single' ); ?>>
						<?php if ( $is_highlighted ) : ?>
							<div class="pricing-badge-large">
								<?php esc_html_e( 'Most Popular Plan', 'delta-growth' ); ?>
							</div>
						<?php endif; ?>

						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>

							<?php if ( $price ) : ?>
								<div class="pricing-price-large"><?php echo esc_html( $price ); ?></div>
							<?php endif; ?>
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

						<?php if ( $features ) : ?>
							<div class="pricing-features-section">
								<h2><?php esc_html_e( 'What\'s Included', 'delta-growth' ); ?></h2>
								<ul class="pricing-features-list">
									<?php foreach ( $features as $feature ) : ?>
										<li>
											<span class="feature-icon">✓</span>
											<span class="feature-text"><?php echo esc_html( $feature['feature_text'] ); ?></span>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						<?php endif; ?>

						<div class="pricing-cta">
							<a href="#contact" class="button pricing-button-large">
								<?php esc_html_e( 'Get Started', 'delta-growth' ); ?>
							</a>
						</div>

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
					// Navigation to previous/next pricing plan.
					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Plan:', 'delta-growth' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Plan:', 'delta-growth' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

				endwhile; // End of the loop.
				?>

			</div><!-- .content-area -->
		</div><!-- .site-container -->
	</main><!-- #primary -->

<?php
get_footer();

