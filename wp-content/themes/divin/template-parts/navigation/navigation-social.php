<?php
/**
 * Displays Footer Navigation
 *
 * @package Divin
 */
?>

<?php if ( has_nav_menu( 'social' ) ) : ?>
	<div class="social-menu">
		<div class="wrapper">
			<nav id="social-footer-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'divin' ); ?>">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>' . divin_get_svg( array( 'icon' => 'chain' ) ),
					) );
				?>
			</nav><!-- .social-navigation -->
		</div><!-- .wrapper -->
	</div><!-- .social-menu -->
<?php endif; ?>
