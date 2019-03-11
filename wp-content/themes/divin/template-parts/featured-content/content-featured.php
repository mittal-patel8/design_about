<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Divin
 */
?>

<?php
$show_content = get_theme_mod( 'divin_featured_content_show', 'hide-content' );
$show_meta    = get_theme_mod( 'divin_featured_meta_show', 'show-meta' );
$type         = get_theme_mod( 'divin_featured_content_type', 'category' );
$layout       = get_theme_mod( 'divin_featured_content_layout', 'layout-three' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
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
			echo '<a href=' . esc_url( get_permalink() ) .'><img src="' .  trailingslashit( esc_url( get_template_directory_uri() ) ) . 'assets/images/no-thumb.jpg"/></a>';
		}
		?>
		</a>

		<div class="entry-container">
			<header class="entry-header">
				<?php if ( 'show-meta' === $show_meta  && ( 'post' === $type || 'category' === $type ) ) {
					echo divin_entry_category_date();
				} ?>
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
			</header>
			<?php
			if ( 'excerpt' === $show_content ) {
				$excerpt = get_the_excerpt();

				echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
			} elseif ( 'full-content' === $show_content ) {
				$content = apply_filters( 'the_content', get_the_content() );
				$content = str_replace( ']]>', ']]&gt;', $content );
				echo '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
			} ?>
		</div><!-- .entry-container -->
	</div><!-- .hentry-inner -->
</article>
