<?php
/**
 * Header Media Options
 *
 * @package Divin
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function divin_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'divin' );

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_header_media_option',
			'default'           => 'entire-site-page-post',
			'sanitize_callback' => 'divin_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'divin' ),
				'exclude-home'           => esc_html__( 'Excluding Homepage', 'divin' ),
				'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'divin' ),
				'entire-site'            => esc_html__( 'Entire Site', 'divin' ),
				'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'divin' ),
				'pages-posts'            => esc_html__( 'Pages and Posts', 'divin' ),
				'disable'                => esc_html__( 'Disabled', 'divin' ),
			),
			'label'             => esc_html__( 'Enable on ', 'divin' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);
}
add_action( 'customize_register', 'divin_header_media_options' );
