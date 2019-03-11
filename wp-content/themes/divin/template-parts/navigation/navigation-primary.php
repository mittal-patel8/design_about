<?php
/**
 * Displays Primary Navigation
 *
 * @package Divin
 */
?>

<button id="primary-menu-toggle" class="menu-primary-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
	<?php
	echo divin_get_svg( array( 'icon' => 'bars' ) );
	echo divin_get_svg( array( 'icon' => 'close' ) );
	echo '<span class="menu-label-prefix">'. esc_attr__( 'Primary ', 'divin' ) . '</span><span class="menu-label">'. esc_attr__( 'Menu', 'divin' ) . '</span>';
	?>
</button>

<div id="site-header-right" class="site-header-menu">
	<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
		<nav id="site-navigation" class="main-navigation site-navigation custom-primary-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'divin' ); ?>">
			<?php wp_nav_menu( array(
				'theme_location'	=> 'menu-1',
				'container_class'	=> 'primary-menu-container',
				'menu_class'		=> 'primary-menu',
			) ); ?>
		</nav><!-- #site-navigation.custom-primary-menu -->
	<?php else : ?>
		<nav id="site-navigation" class="main-navigation site-navigation default-page-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'divin' ); ?>">
			<?php wp_page_menu(
				array(
					'menu_class' => 'primary-menu-container',
					'before'     => '<ul id="primary-page-menu" class="primary-menu">',
					'after'      => '</ul>',
				)
			); ?>
		</nav><!-- #site-navigation.default-page-menu -->
	<?php endif; ?>
</div><!-- #site-header-right.site-header-menu -->
