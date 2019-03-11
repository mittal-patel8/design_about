<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Divin
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="archive-post-wrapper">
		<?php $content_layout = get_theme_mod( 'divin_content_layout', 'excerpt-image-top' ); ?>

		<?php if ( 'full-content' !== $content_layout ) : ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
		</a>
		<?php endif; ?>

		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php divin_entry_meta(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php
		if ( 'excerpt-image-top' === $content_layout ) { ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php
		} else {
		?>
			<div class="entry-content">
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'divin' ),
						get_the_title()
					) );

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'divin' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'divin' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php
		}
		?>

		<footer class="entry-footer">
			<?php divin_entry_category(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .archive-post-wrapper -->
</article><!-- #post-## -->
