<?php
/**
* The template for adding Service Settings in Customizer
*
 * @package Divin
*/

function divin_service_options( $wp_customize ) {
	// Add note to Jetpack Portfolio Section
    divin_register_option( $wp_customize, array(
            'name'              => 'divin_ect_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Divin_Note_Control',
            'label'             => sprintf( esc_html__( 'For Service Options for this Theme, go %1$shere%2$s', 'divin' ),
                 '<a href="javascript:wp.customize.section( \'divin_service\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'ect_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	$wp_customize->add_section( 'divin_service', array(
			'panel'    => 'divin_theme_options',
			'title'    => esc_html__( 'Service', 'divin' ),
		)
	);

	divin_register_option( $wp_customize, array(
            'name'              => 'divin_service_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Divin_Note_Control',
			'active_callback'   => 'divin_is_ect_service_inactive',
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Service Content Type Enabled', 'divin' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'section'           => 'divin_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_service_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'divin_sanitize_select',
			'active_callback'   => 'divin_is_ect_service_active',
			'choices'           => divin_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'divin' ),
			'section'           => 'divin_service',
			'type'              => 'select',
		)
	);

	divin_register_option( $wp_customize, array(
            'name'              => 'divin_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Divin_Note_Control',
            'active_callback'   => 'divin_is_service_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'divin' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'divin_service',
            'type'              => 'description',
        )
    );

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_service_number',
			'default'           => 3,
			'sanitize_callback' => 'divin_sanitize_number_range',
			'active_callback'   => 'divin_is_service_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Service is changed', 'divin' ),
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Service', 'divin' ),
			'section'           => 'divin_service',
			'type'              => 'number',
		)
	);

	$number = get_theme_mod( 'divin_service_number', '3' );

	for ( $i = 1; $i <= $number ; $i++ ) {
		divin_register_option( $wp_customize, array(
				'name'              => 'divin_service_cpt_' . $i,
				'sanitize_callback' => 'divin_sanitize_post',
				'default'           => 0,
				'active_callback'   => 'divin_is_service_active',
				'label'             => esc_html__( 'Service ', 'divin' ) . ' ' . $i ,
				'section'           => 'divin_service',
				'type'              => 'select',
				'choices'           => divin_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'divin_service_options' );

if ( ! function_exists( 'divin_is_service_active' ) ) :
	/**
	* Return true if service is active
	*
	* @since Divin 0.1
	*/
	function divin_is_service_active( $control ) {
		$enable = $control->manager->get_setting( 'divin_service_option' )->value();

		//return true only if previwed page on customizer matches the type of content option selected
		return ( divin_check_section( $enable ) && ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) ) );
	}
endif;

if ( ! function_exists( 'divin_is_ect_service_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since Divin 0.1
    */
    function divin_is_ect_service_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'divin_is_ect_service_inactive' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since Divin 0.1
    */
    function divin_is_ect_service_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
