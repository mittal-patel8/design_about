<?php
/**
 * The template used for displaying testimonial on front page
 *
 * @package Divin
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="testimonial-thumbnail post-thumbnail">
			<?php the_post_thumbnail( 'divin-testimonial' ); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

	<?php $position = get_post_meta( get_the_id(), 'ect_testimonial_position', true ); ?>

	<?php if ( get_theme_mod( 'divin_testimonial_enable_title', 1 ) || $position ) : ?>
		<header class="entry-header">
			<?php
			if ( get_theme_mod( 'divin_testimonial_enable_title', 1 ) ) {
				the_title( '<h2 class="entry-title">', '</h2>' );
			}
			?>

			<?php if ( $position ) : ?>
				<p class="entry-meta"><span class="position"><?php echo esc_html( $position ); ?></span></p>
			<?php endif; ?>
		</header>
	<?php endif;?>
</article>
