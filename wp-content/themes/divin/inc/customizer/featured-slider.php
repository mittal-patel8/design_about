<?php
/**
 * Featured Slider Options
 *
 * @package Divin
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function divin_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'divin_featured_slider', array(
			'panel' => 'divin_theme_options',
			'title' => esc_html__( 'Featured Slider', 'divin' ),
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'divin_sanitize_select',
			'choices'           => divin_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'divin' ),
			'section'           => 'divin_featured_slider',
			'type'              => 'select',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_slider_transition_effect',
			'default'           => 'fade',
			'sanitize_callback' => 'divin_sanitize_select',
			'active_callback'   => 'divin_is_slider_active',
			'choices'           => divin_slider_transition_effects(),
			'label'             => esc_html__( 'Transition Effect', 'divin' ),
			'section'           => 'divin_featured_slider',
			'type'              => 'select',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_slider_transition_delay',
			'default'           => '4',
			'sanitize_callback' => 'absint',
			'active_callback'   => 'divin_is_slider_active',
			'description'       => esc_html__( 'seconds(s)', 'divin' ),
			'input_attrs'       => array(
				'style' => 'width: 40px;',
			),
			'label'             => esc_html__( 'Transition Delay', 'divin' ),
			'section'           => 'divin_featured_slider',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_slider_transition_length',
			'default'           => '1',
			'sanitize_callback' => 'absint',

			'active_callback'   => 'divin_is_slider_active',
			'description'       => esc_html__( 'seconds(s)', 'divin' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
			),
			'label'             => esc_html__( 'Transition Length', 'divin' ),
			'section'           => 'divin_featured_slider',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_slider_image_loader',
			'default'           => 'false',
			'sanitize_callback' => 'divin_sanitize_select',
			'active_callback'   => 'divin_is_slider_active',
			'choices'           => divin_slider_image_loader(),
			'label'             => esc_html__( 'Image Loader', 'divin' ),
			'section'           => 'divin_featured_slider',
			'type'              => 'select',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'divin_sanitize_number_range',

			'active_callback'   => 'divin_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'divin' ),
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Slides', 'divin' ),
			'section'           => 'divin_featured_slider',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_slider_content_show',
			'default'           => 'hide-content',
			'sanitize_callback' => 'divin_sanitize_select',
			'active_callback'   => 'divin_is_slider_active',
			'choices'           => divin_content_show(),
			'label'             => esc_html__( 'Display Content', 'divin' ),
			'section'           => 'divin_featured_slider',
			'type'              => 'select',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_slider_meta_show',
			'default'           => 'hide-meta',
			'sanitize_callback' => 'divin_sanitize_select',
			'active_callback'   => 'divin_is_slider_active',
			'choices'           => divin_meta_show(),
			'label'             => esc_html__( 'Display Meta', 'divin' ),
			'section'           => 'divin_featured_slider',
			'type'              => 'select',
		)
	);

	$slider_number = get_theme_mod( 'divin_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Page Sliders
		divin_register_option( $wp_customize, array(
				'name'              =>'divin_slider_page_' . $i,
				'sanitize_callback' => 'divin_sanitize_post',
				'active_callback'   => 'divin_is_slider_active',
				'label'             => esc_html__( 'Page', 'divin' ) . ' # ' . $i,
				'section'           => 'divin_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'divin_slider_options' );


/**
 * Returns an array of feature slider transition effects
 *
 * @since Divin 0.1
 */
function divin_slider_transition_effects() {
	$options = array(
		'fade'       => esc_html__( 'Fade', 'divin' ),
		'fadeout'    => esc_html__( 'Fade Out', 'divin' ),
		'none'       => esc_html__( 'None', 'divin' ),
		'scrollHorz' => esc_html__( 'Scroll Horizontal', 'divin' ),
		'scrollVert' => esc_html__( 'Scroll Vertical', 'divin' ),
		'flipHorz'   => esc_html__( 'Flip Horizontal', 'divin' ),
		'flipVert'   => esc_html__( 'Flip Vertical', 'divin' ),
		'tileSlide'  => esc_html__( 'Tile Slide', 'divin' ),
		'tileBlind'  => esc_html__( 'Tile Blind', 'divin' ),
		'shuffle'    => esc_html__( 'Shuffle', 'divin' ),
	);

	return apply_filters( 'divin_slider_transition_effects', $options );
}


/**
 * Returns an array of featured slider image loader options
 *
 * @since Divin 0.1
 */
function divin_slider_image_loader() {
	$options = array(
		'true'  => esc_html__( 'True', 'divin' ),
		'wait'  => esc_html__( 'Wait', 'divin' ),
		'false' => esc_html__( 'False', 'divin' ),
	);

	return apply_filters( 'divin_slider_image_loader', $options );
}


/**
 * Returns an array of featured content show registered for Lucida.
 *
 * @since Divin 0.1
 */
function divin_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'divin' ),
		'full-content' => esc_html__( 'Full Content', 'divin' ),
		'hide-content' => esc_html__( 'Hide Content', 'divin' ),
	);
	return apply_filters( 'divin_content_show', $options );
}

/**
 * Returns an array of featured content show registered for Lucida.
 *
 * @since Divin 0.1
 */
function divin_meta_show() {
	$options = array(
		'show-meta' => esc_html__( 'Show Meta', 'divin' ),
		'hide-meta' => esc_html__( 'Hide Meta', 'divin' ),
	);
	return apply_filters( 'divin_content_show', $options );
}

/** Active Callback Functions */

if( ! function_exists( 'divin_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Divin 0.1
	*/
	function divin_is_slider_active( $control ) {
		global $wp_query;

		$page_id = $wp_query->get_queried_object_id();

		// Front page display in Reading Settings
		$page_for_posts = get_option('page_for_posts');

		$enable = $control->manager->get_setting( 'divin_slider_option' )->value();

		//return true only if previwed page on customizer matches the type of slider option selected
		return ( 'entire-site' == $enable || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && 'homepage' == $enable )
			);
	}
endif;
