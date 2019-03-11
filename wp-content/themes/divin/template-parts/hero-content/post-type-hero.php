<?php
/**
 * The template used for displaying hero content
 *
 * @package Divin
 */
?>

<?php

$id = get_theme_mod( 'divin_hero_content' );

$args['page_id'] = absint( $id );

// If $args is empty return false
if ( 'publish' !== get_post_status( $args['page_id'] ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$hero_query = new WP_Query( $args );
if ( $hero_query->have_posts() ) :
	while ( $hero_query->have_posts() ) :
		$hero_query->the_post();

		$thumb = get_the_post_thumbnail_url( get_the_ID() );

		?>
		<div id="hero-content-section" class="section">
			<div class="section-content-wrapper hero-content-wrapper">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="post-thumbnail" style="background-image: url( '<?php echo esc_url( $thumb ); ?>' )">
							<a class="cover-link" href="<?php the_permalink(); ?>"></a>
						</div><!-- .post-thumbnail -->
						<div class="entry-container">
					<?php else : ?>
						<div class="entry-container full-width">
					<?php endif; ?>
						<?php if ( ! get_theme_mod( 'divin_disable_hero_content_title' ) ) : ?>
						<header class="entry-header section-title-wrapper">
							<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>
						</header><!-- .entry-header -->
						<?php endif; ?>

						<div class="entry-content">
							<?php

								$show_content = get_theme_mod( 'divin_hero_content_show', 'excerpt' );

								if ( 'full-content' === $show_content ) {
									the_content();
								} elseif ( 'excerpt' === $show_content ) {
									the_excerpt();
								}

								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'divin' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span class="page-number">',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'divin' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
							?>
						</div><!-- .entry-content -->

						<?php if ( get_edit_post_link() ) : ?>
							<footer class="entry-footer">
								<?php
									edit_post_link(
										sprintf(
											/* translators: %s: Name of current post */
											esc_html__( 'Edit %s', 'divin' ),
											the_title( '<span class="screen-reader-text">"', '"</span>', false )
										),
										'<span class="edit-link">',
										'</span>'
									);
								?>
							</footer><!-- .entry-footer -->
						<?php endif; ?>
					</div><!-- .entry-container -->
				</article><!-- #post-## -->
			</div><!-- .section-content-wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
