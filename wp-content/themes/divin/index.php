<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Divin
 */

get_header(); ?>

	<div class="archive-content-wrapper site-content-wrapper">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php
				if ( have_posts() ) : ?>
					<div class="section-heading-wrapper">
						<h2 class="section-title"><?php echo esc_html( get_theme_mod( 'divin_recent_posts_heading', esc_html__( 'Recent Posts', 'divin' ) ) ); ?></h1>
					</div><!-- .archive-heading-wrapper -->

					<div id="infinite-post-wrap">
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content/content', get_post_format() );

						endwhile;
						?>
					</div><!-- .archive-post-wrap -->

					<?php
					divin_content_nav();

				else :

					get_template_part( 'template-parts/content/content', 'none' );

				endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
			get_sidebar();
		?>

</div><!-- .archive-content-wrapper -->

<?php get_footer();
