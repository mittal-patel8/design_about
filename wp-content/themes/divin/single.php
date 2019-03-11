<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Divin
 */

get_header(); ?>

<div class="singular-content-wrapper site-content-wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content/content', 'single' );

			the_post_navigation();

			get_template_part( 'template-parts/content/content','comment' );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div><!-- .singular-content-wrapper -->

<?php get_footer();
