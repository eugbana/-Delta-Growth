<?php
/**
 * The template for displaying the Services archive
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
					<h1 class="page-title"><?php esc_html_e( 'Our Services', 'delta-growth' ); ?></h1>
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

					<div class="services-grid">
						<?php
						while ( have_posts() ) :
							the_post();
							?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'service-card' ); ?>>
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="service-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'medium' ); ?>
										</a>
									</div>
								<?php endif; ?>

								<?php
								$icon_class = delta_growth_get_service_icon_class();
								if ( $icon_class ) :
									?>
									<div class="service-icon">
										<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
									</div>
								<?php endif; ?>

								<header class="entry-header">
									<h2 class="entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
								</header>

								<div class="service-short-description">
									<?php
									$short_description = delta_growth_get_service_short_description();
									if ( $short_description ) {
										echo '<p>' . esc_html( $short_description ) . '</p>';
									}
									?>
								</div>

								<footer class="entry-footer">
									<a href="<?php the_permalink(); ?>" class="read-more">
										<?php esc_html_e( 'Learn More', 'delta-growth' ); ?>
										<span class="screen-reader-text"> <?php esc_html_e( 'about', 'delta-growth' ); ?> <?php the_title(); ?></span>
									</a>
								</footer>
							</article>

							<?php
						endwhile;
						?>
					</div><!-- .services-grid -->

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

					<p><?php esc_html_e( 'No services found.', 'delta-growth' ); ?></p>

				<?php endif; ?>

			</div><!-- .content-area -->
		</div><!-- .site-container -->
	</main><!-- #primary -->

<?php
get_footer();

