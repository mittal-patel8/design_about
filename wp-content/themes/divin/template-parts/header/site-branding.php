<?php
/**
 * Displays header site branding
 *
 * @package Divin
 */
?>

<div class="site-branding">
	<?php divin_the_custom_logo(); ?>

    <div class="site-identity">
    	<?php if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif; ?>
	</div><!-- .side-header -->
</div><!-- .side-branding -->
