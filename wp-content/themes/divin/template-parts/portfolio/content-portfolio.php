<?php
/**
 * The template used for displaying projects on index view
 *
 * @package Divin
 */
?>

<?php
$layout       = get_theme_mod( 'divin_portfolio_content_layout', 'layout-three' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="hentry">
	<div class="hentry-inner">
		<div class="portfolio-thumbnail post-thumbnail">
			<a class="post-thumbnail" href="<?php the_permalink(); ?>">
				<?php
				// Output the featured image.
				if ( has_post_thumbnail() ) {

					if ( 'layout-one' === $layout ) {
						$thumbnail = 'post-thumbnail';
					}
					else {
						$thumbnail = 'divin-featured-square';
					}

					the_post_thumbnail( $thumbnail );
				} else {
					echo '<img src="' .  trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb.jpg"/>';
				}
				?>
			</a>
		</div><!-- .portfolio-thumbnail -->

		<div class="entry-container">
			<header class="entry-header portfolio-entry-header">
				<?php echo divin_entry_category_date(); ?>

				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			</header>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
