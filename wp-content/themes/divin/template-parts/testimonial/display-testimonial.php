<?php
/**
 * The template for displaying testimonial items
 *
 * @package Divin
 */
?>

<?php
$enable = get_theme_mod( 'divin_testimonial_option', 'disabled' );

if ( ! divin_check_section( $enable ) ) {
	// Bail if featured content is disabled
	return;
}

// Get Jetpack options for testimonial.
$jetpack_defaults = array(
	'page-title' => esc_html__( 'Testimonials', 'divin' ),
);

// Get Jetpack options for testimonial.
$jetpack_options = get_theme_mod( 'jetpack_testimonials', $jetpack_defaults );

$headline = isset( $jetpack_options['page-title'] ) ? $jetpack_options['page-title'] : esc_html__( 'Testimonials', 'divin' );

$subheadline = isset( $jetpack_options['page-content'] ) ? $jetpack_options['page-content'] : '';

$classes[] = 'section testimonial-wrapper';

if ( ! $headline && ! $subheadline ) {
	$classes[] = 'no-headline';
}

$layout = get_theme_mod( 'divin_testimonial_layout', 'layout-three' );

?>

<div id="testimonial-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="section-wrapper">

		<?php if ( $headline || $subheadline ) : ?>
			<div class="section-heading-wrapper testimonial-section-headline">
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

		<div class="section-content-wrapper testimonial-content-wrapper <?php echo esc_attr( $layout ); ?>">
			<?php $slider_select = get_theme_mod( 'divin_testimonial_slider' );

			if ( $slider_select ) : ?>
			<div class="cycle-slideshow"
				data-cycle-log="false"
				data-cycle-pause-on-hover="true"
				data-cycle-swipe="true"
				data-cycle-auto-height=container
				data-cycle-loader=false
				data-cycle-slides=".testimonial_slider_wrap"
				>
				<!-- prev/next links -->
				<button class="cycle-prev" aria-label="Previous">
					<span class="screen-reader-text"><?php esc_html_e( 'Previous Slide', 'divin' ); ?></span><?php echo divin_get_svg( array( 'icon' => 'angle-down' ) ); ?>
				</button>

				<button class="cycle-next" aria-label="Next">
					<span class="screen-reader-text"><?php esc_html_e( 'Next Slide', 'divin' ); ?></span><?php echo divin_get_svg( array( 'icon' => 'angle-down' ) ); ?>
				</button>


				<!-- empty element for pager links -->
				<div class="cycle-pager"></div>

				<div class="testimonial_slider_wrap">
			<?php endif; ?>

			<?php get_template_part( 'template-parts/testimonial/post-types', 'testimonial' ); ?>

			<?php if ( $slider_select ) : ?>
				</div><!-- .testimonial_slider_wrap -->
			</div><!-- .cycle-slideshow -->
			<?php endif; ?>
		</div><!-- .section-content-wrapper  -->

	</div><!-- .section-wrapper -->
</div><!-- #testimonial-content-section -->
