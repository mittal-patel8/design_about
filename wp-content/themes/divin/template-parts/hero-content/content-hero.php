<?php
/**
 * The template used for displaying hero content
 *
 * @package Divin
 */
?>

<?php
$enable_section = get_theme_mod( 'divin_hero_content_visibility', 'homepage' );

if ( ! divin_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/hero-content/post-type', 'hero' );
