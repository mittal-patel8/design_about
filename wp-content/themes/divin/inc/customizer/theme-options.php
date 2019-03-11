<?php
/**
 * Theme Options
 *
 * @package Divin
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function divin_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'divin_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'divin' ),
		'priority' => 130,
	) );

	// Breadcrumb Option.
	$wp_customize->add_section( 'divin_breadcrumb_options', array(
		'description'   => esc_html__( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance.', 'divin' ),
		'panel'         => 'divin_theme_options',
		'title'         => esc_html__( 'Breadcrumb', 'divin' ),
	) );

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_breadcrumb_option',
			'default'           => 1,
			'sanitize_callback' => 'divin_sanitize_checkbox',
			'label'             => esc_html__( 'Check to enable Breadcrumb', 'divin' ),
			'section'           => 'divin_breadcrumb_options',
			'type'              => 'checkbox',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'divin_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'divin' ),
		'panel' => 'divin_theme_options',
		)
	);

	/* Layout Type */
	divin_register_option( $wp_customize, array(
			'name'              => 'divin_layout_type',
			'default'           => 'fluid',
			'sanitize_callback' => 'divin_sanitize_select',
			'label'             => esc_html__( 'Site Layout', 'divin' ),
			'section'           => 'divin_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'fluid' => esc_html__( 'Fluid', 'divin' ),
				'boxed' => esc_html__( 'Boxed', 'divin' ),
			),
		)
	);

	/* Default Layout */
	divin_register_option( $wp_customize, array(
			'name'              => 'divin_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'divin_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'divin' ),
			'section'           => 'divin_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'divin' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'divin' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	divin_register_option( $wp_customize, array(
			'name'              => 'divin_homepage_archive_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'divin_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'divin' ),
			'section'           => 'divin_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'divin' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'divin' ),
			),
		)
	);

	/* Archive Content Layout */
	divin_register_option( $wp_customize, array(
			'name'              => 'divin_content_layout',
			'default'           => 'excerpt-image-top',
			'sanitize_callback' => 'divin_sanitize_select',
			'label'             => esc_html__( 'Archive Content Layout', 'divin' ),
			'section'           => 'divin_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'excerpt-image-top'      => esc_html__( 'Show Excerpt( Image Top)', 'divin' ),
				'full-content'           => esc_html__( 'Show Full Content ( No Featured Image )', 'divin' ),
			),
		)
	);

	/* Single Page/Post Image Layout */
	divin_register_option( $wp_customize, array(
			'name'              => 'divin_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'divin_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image Layout', 'divin' ),
			'section'           => 'divin_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'disabled'       => esc_html__( 'Disabled', 'divin' ),
				'post-thumbnail' => esc_html__( 'Post Thumbnail (1060x596)', 'divin' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'divin_excerpt_options', array(
		'panel' => 'divin_theme_options',
		'title' => esc_html__( 'Excerpt Options', 'divin' ),
	) );

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_excerpt_length',
			'default'           => '55',
			'sanitize_callback' => 'absint',
			'description' => esc_html__( 'Excerpt length. Default is 55 words', 'divin' ),
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'divin' ),
			'section'  => 'divin_excerpt_options',
			'type'     => 'number',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading &raquo;', 'divin' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'divin' ),
			'section'           => 'divin_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'divin_search_options', array(
		'panel'     => 'divin_theme_options',
		'title'     => esc_html__( 'Search Options', 'divin' ),
	) );

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_search_text',
			'default'           => esc_html__( 'Search ...', 'divin' ),
			'sanitize_callback' => 'wp_kses_data',
			'label'             => esc_html__( 'Search Text', 'divin' ),
			'section'           => 'divin_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'divin_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'divin' ),
		'panel'       => 'divin_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'divin' ),
	) );

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'Recent Posts', 'divin' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'divin' ),
			'section'           => 'divin_homepage_options',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_front_page_category',
			'sanitize_callback' => 'divin_sanitize_category_list',
			'custom_control'    => 'divinMultiCategoriesControl',
			'label'             => esc_html__( 'Categories', 'divin' ),
			'section'           => 'divin_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	// Pagination Options.
	$pagination_type = get_theme_mod( 'divin_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'Infinite Scroll Options requires %1$sJetPack Plugin%2$s with Infinite Scroll module Enabled.', 'divin' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="https://wordpress.org/plugins/jetpack/">',
		'</a>'
	);

	$nav_desc .= '&nbsp;' . sprintf(
		wp_kses(
			__( 'Once Jetpack is installed, Infinite Scroll Settings can be found %1$shere%2$s', 'divin' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="' . esc_url( admin_url( 'admin.php?page=jetpack#/settings' ) ) . '">',
		'</a>'
	);

	$wp_customize->add_section( 'divin_pagination_options', array(
		'description' => $nav_desc,
		'panel'       => 'divin_theme_options',
		'title'       => esc_html__( 'Pagination Options', 'divin' ),
	) );

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'divin_sanitize_select',
			'choices'           => divin_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'divin' ),
			'section'           => 'divin_pagination_options',
			'type'              => 'select',
		)
	);

	if ( ! class_exists( 'To_Top' ) ) {
		/* Scrollup Options */
		$wp_customize->add_section( 'divin_scrollup', array(
			'panel'    => 'divin_theme_options',
			'title'    => esc_html__( 'Scrollup Options', 'divin' ),
		) );

		divin_register_option( $wp_customize, array(
				'name'              => 'divin_disable_scrollup',
				'sanitize_callback' => 'divin_sanitize_checkbox',
				'label'             => esc_html__( 'Disable Scroll Up', 'divin' ),
				'section'           => 'divin_scrollup',
				'type'              => 'checkbox',
			)
		);
	}
}
add_action( 'customize_register', 'divin_theme_options' );
