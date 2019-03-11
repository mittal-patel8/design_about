<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Divin
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">

		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'divin' ); ?></a>

	    <header id="masthead" class="site-header" role="banner">
	    	<div class="site-header-main wrapper">
				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

			<?php get_template_part( 'template-parts/navigation/navigation', 'primary' ); ?>

		    </div><!-- .site-header-main.wrapper -->
	    </header><!-- #masthead -->

	    <?php get_template_part( 'template-parts/header/header', 'media' ); ?>

	     <div class="below-site-header">
	    	<div class="wrapper">

			    <?php get_template_part( 'template-parts/slider/content', 'slider' ); ?>

				<?php get_template_part( 'template-parts/header/breadcrumb' ); ?>

				<?php get_template_part( 'template-parts/portfolio/display', 'portfolio' ); ?>

				<?php get_template_part( 'template-parts/hero-content/content', 'hero' ); ?>

				<?php get_template_part( 'template-parts/service/content', 'service' ); ?>

				<?php
				$featured_content_position = get_theme_mod( 'divin_featured_content_position' );

				if ( ! $featured_content_position ) {
					get_template_part( 'template-parts/featured-content/display', 'featured' );
				}
				?>


				<?php
				$testimonial_position = get_theme_mod( 'divin_testimonial_position' );

				if ( $testimonial_position ) {
					get_template_part( 'template-parts/testimonial/display', 'testimonial' );
				}
				?>

				<div id="content" class="site-content">
