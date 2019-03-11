<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Divin
 */

?>

				</div><!-- site-content -->

				<?php
				$featured_content_position = get_theme_mod( 'divin_featured_content_position' );

				if ( $featured_content_position ) {
					get_template_part( 'template-parts/featured-content/display', 'featured' );
				}
				?>

				<?php
				$testimonial_position = get_theme_mod( 'divin_testimonial_position' );

				if ( ! $testimonial_position ) {
					get_template_part( 'template-parts/testimonial/display', 'testimonial' );
				}
				?>

			</div><!-- .wrapper -->
		</div><!-- .below-site-header -->

		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>

			<div id="below-footer-widget" class="footer-area">
				<?php get_template_part( 'template-parts/navigation/navigation', 'social' ); ?>

				<?php get_template_part( 'template-parts/footer/site', 'info' ); ?>
			</div> <!-- #below-footer-widget -->

		</footer><!-- #colophon -->

	</div><!-- .site-inner -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
