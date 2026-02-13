<?php
/**
 * The template for displaying the Pricing Plans archive
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
					<h1 class="page-title"><?php esc_html_e( 'Pricing Plans', 'delta-growth' ); ?></h1>
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

					<div class="pricing-plans-grid">
						<?php
						while ( have_posts() ) :
							the_post();
							$price = delta_growth_get_pricing_plan_price();
							$features = delta_growth_get_pricing_plan_features();
							$is_highlighted = delta_growth_is_pricing_plan_highlighted();
							$card_class = $is_highlighted ? 'pricing-card highlighted' : 'pricing-card';
							?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( $card_class ); ?>>
								<?php if ( $is_highlighted ) : ?>
									<div class="pricing-badge">
										<?php esc_html_e( 'Most Popular', 'delta-growth' ); ?>
									</div>
								<?php endif; ?>

								<header class="pricing-header">
									<h2 class="pricing-title"><?php the_title(); ?></h2>
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

							<?php
						endwhile;
						?>
					</div><!-- .pricing-plans-grid -->

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

					<p><?php esc_html_e( 'No pricing plans found.', 'delta-growth' ); ?></p>

				<?php endif; ?>

			</div><!-- .content-area -->
		</div><!-- .site-container -->
	</main><!-- #primary -->

<?php
get_footer();

