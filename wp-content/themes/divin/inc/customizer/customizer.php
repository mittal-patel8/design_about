<?php
/**
 * Theme Customizer
 *
 * @package Divin
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function divin_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport            = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport     = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport    = 'postMessage';
	$wp_customize->get_setting( 'header_image' )->transport        = 'refresh';

	$wp_customize->get_control( 'display_header_text' )->label     = esc_html__( 'Display Site Title', 'divin' );

	// Reset all settings to default.
	$wp_customize->add_section( 'divin_reset_all', array(
		'description'   => esc_html__( 'Caution: Reset all settings to default. Refresh the page after save to view full effects.', 'divin' ),
		'title'         => esc_html__( 'Reset all settings', 'divin' ),
		'priority'      => 998,
	) );

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_reset_all_settings',
			'sanitize_callback' => 'divin_sanitize_checkbox',
			'label'             => esc_html__( 'Check to reset all settings to default', 'divin' ),
			'section'           => 'divin_reset_all',
			'transport'         => 'postMessage',
			'type'              => 'checkbox',
		)
	);
	// Reset all settings to default end.

	// Important Links.
	$wp_customize->add_section( 'divin_important_links', array(
		'priority'      => 999,
		'title'         => esc_html__( 'Important Links', 'divin' ),
	) );

	// Has dummy Sanitizaition function as it contains no value to be sanitized.
	divin_register_option( $wp_customize, array(
			'name'              => 'divin_important_links',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'divinImportantLinksControl',
			'label'             => esc_html__( 'Important Links', 'divin' ),
			'section'           => 'divin_important_links',
			'type'              => 'divin_important_links',
		)
	);
	// Important Links End.
}
add_action( 'customize_register', 'divin_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function divin_customize_preview_js() {
	wp_enqueue_script( 'divin-customize-preview', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/customize-preview.min.js', array( 'customize-preview' ), '20170816', true );
}
add_action( 'customize_preview_init', 'divin_customize_preview_js' );

/**
 * Include Custom Controls
 */
require get_parent_theme_file_path( 'inc/customizer/custom-controls.php' );

/**
 * Include Header Media Options
 */
require get_parent_theme_file_path( 'inc/customizer/header-media.php' );

/**
 * Include Theme Options
 */
require get_parent_theme_file_path( 'inc/customizer/theme-options.php' );

/**
 * Include Hero Content
 */
require get_parent_theme_file_path( 'inc/customizer/hero-content.php' );

/**
 * Include Featured Slider
 */
require get_parent_theme_file_path( 'inc/customizer/featured-slider.php' );

/**
 * Include Featured Content
 */
require get_parent_theme_file_path( 'inc/customizer/featured-content.php' );

/**
 * Include Testimonial
 */
require get_parent_theme_file_path( 'inc/customizer/testimonial.php' );

/**
 * Include Portfolio
 */
require get_parent_theme_file_path( 'inc/customizer/portfolio.php' );

/**
 * Include Service
 */
require get_parent_theme_file_path( 'inc/customizer/service.php' );

/**
 * Include Customizer Helper Functions
 */
require get_parent_theme_file_path( 'inc/customizer/helpers.php' );

/**
 * Include Sanitization functions
 */
require get_parent_theme_file_path( 'inc/customizer/sanitize-functions.php' );

/**
 * Include Upgrade Button
 */
require get_parent_theme_file_path( 'inc/customizer/upgrade-button/class-customize.php' );
