<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Divin
 */

get_header(); ?>

<div class="singular-content-wrapper site-content-wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content/content', 'page' );

				get_template_part( 'template-parts/content/content','comment' );


			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div><!-- .singular-content-wrapper -->
<?php get_footer();
