<?php
/**
 * The template part for displaying single posts
 *
 * @package Divin
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php divin_posted_on(); ?>
			</div>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php divin_excerpt(); ?>

	<?php divin_content_image(); ?>

	<div class="entry-content">
		<?php
			the_content();

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

	<footer class="entry-footer">
		<?php divin_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
