<?php
/**
 * The template for displaying portfolio items
 *
 * @package Divin
 */
?>

<?php
$enable = get_theme_mod( 'divin_portfolio_option', 'disabled' );

if ( ! divin_check_section( $enable ) ) {
	// Bail if portfolio section is disabled.
	return;
}

$headline    = get_option( 'jetpack_portfolio_title', esc_html__( 'Projects', 'divin' ) );
$subheadline = get_option( 'jetpack_portfolio_content' );

$classes[] = 'section';

$classes[] = get_theme_mod( 'divin_portfolio_content_layout', 'layout-three' );
?>
<div id="portfolio-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="section-wrapper">
		<?php if ( $headline || $subheadline ) : ?>
			<div class="section-heading-wrapper portfolio-section-headline">
			<?php if ( $headline ) : ?>
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo wp_kses_post( $headline ); ?></h2>
				</div><!-- .section-title-wrapper -->
			<?php endif; ?>

			<?php if ( $subheadline ) : ?>
				<div class="taxonomy-description-wrapper">
					<?php echo wp_kses_post( $subheadline ); ?>
				</div><!-- .taxonomy-description-wrapper -->
			<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper portfolio-content-wrapper <?php echo esc_attr( get_theme_mod( 'divin_portfolio_content_layout', 'layout-three' ) ); ?>">
			<?php get_template_part( 'template-parts/portfolio/post-types', 'portfolio' ); ?>
		</div><!-- .portfolio-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #portfolio-content-section -->
