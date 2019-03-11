<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Divin
 */

get_header(); ?>

<div class="singular-content-wrapper site-content-wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if ( is_active_sidebar( 'sidebar-notfound' ) ) :
				dynamic_sidebar( 'sidebar-notfound' );
			else : ?>
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'divin' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'divin' ); ?></p>

						<?php
							get_search_form();

							the_widget( 'WP_Widget_Recent_Posts' );
						?>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			<?php endif; ?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .singular-content-wrapper -->

<?php
get_footer();
