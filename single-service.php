<?php
/**
 * The template for displaying single Services
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
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<?php
							$icon_class = delta_growth_get_service_icon_class();
							if ( $icon_class ) :
								?>
								<div class="service-icon-large">
									<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
								</div>
							<?php endif; ?>

							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

							<?php
							$short_description = delta_growth_get_service_short_description();
							if ( $short_description ) :
								?>
								<div class="service-short-description">
									<p class="lead"><?php echo esc_html( $short_description ); ?></p>
								</div>
							<?php endif; ?>
						</header><!-- .entry-header -->

						<?php
						if ( has_post_thumbnail() ) :
							?>
							<div class="post-thumbnail">
								<?php the_post_thumbnail( 'large' ); ?>
							</div><!-- .post-thumbnail -->
							<?php
						endif;
						?>

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
					// Navigation to previous/next service.
					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Service:', 'delta-growth' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Service:', 'delta-growth' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

				endwhile; // End of the loop.
				?>

			</div><!-- .content-area -->
		</div><!-- .site-container -->
	</main><!-- #primary -->

<?php
get_footer();

