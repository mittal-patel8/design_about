<?php
/**
 * Hero Content Options
 *
 * @package Divin
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function divin_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'divin_hero_content_options', array(
			'title' => esc_html__( 'Hero Content Options', 'divin' ),
			'panel' => 'divin_theme_options',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'divin_sanitize_select',
			'choices'           => divin_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'divin' ),
			'section'           => 'divin_hero_content_options',
			'type'              => 'select',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'divin_sanitize_post',
			'active_callback'   => 'divin_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'divin' ),
			'section'           => 'divin_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);


	divin_register_option( $wp_customize, array(
			'name'              => 'divin_disable_hero_content_title',
			'sanitize_callback' => 'divin_sanitize_checkbox',
			'active_callback'   => 'divin_is_hero_content_active',
			'label'             => esc_html__( 'Check to disable title', 'divin' ),
			'section'           => 'divin_hero_content_options',
			'type'              => 'checkbox',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_hero_content_show',
			'default'           => 'full-content',
			'sanitize_callback' => 'divin_sanitize_select',
			'active_callback'   => 'divin_is_hero_content_active',
			'choices'           => divin_content_show(),
			'label'             => esc_html__( 'Display Content', 'divin' ),
			'section'           => 'divin_hero_content_options',
			'type'              => 'select',
		)
	);
}
add_action( 'customize_register', 'divin_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'divin_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Divin 0.1
	*/
	function divin_is_hero_content_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option( 'page_for_posts' );

		$enable = $control->manager->get_setting( 'divin_hero_content_visibility' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( 'entire-site' == $enable  || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) &&	 'homepage' == $enable )
			);
	}
endif;
