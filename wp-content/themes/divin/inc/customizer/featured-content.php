<?php
/**
* Add Featured Content options
*
* @package Divin
*/

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function divin_featured_content_options( $wp_customize ) {
	// Add note to ECT Featured Content Section
	divin_register_option( $wp_customize, array(
			'name'              => 'divin_featured_content_jetpack_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Divin_Note_Control',
			'label'             => sprintf( esc_html__( 'For all Featured Content Options for this Theme, go %1$shere%2$s', 'divin' ),
				'<a href="javascript:wp.customize.section( \'divin_featured_content\' ).focus();">',
				'</a>'
			),
			'section'           => 'ect_featured_content',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'divin_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'divin' ),
			'panel' => 'divin_theme_options',
		)
	);

	divin_register_option( $wp_customize, array(
            'name'              => 'divin_featured_content_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Divin_Note_Control',
            'active_callback'   => 'divin_is_ect_featured_content_inactive',
            'label'             => sprintf( esc_html__( 'For Featured Content, install %1$sEssential Content Types%2$s Plugin with Testimonial Content Type Enabled', 'divin' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'section'           => 'divin_featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_featured_content_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'divin_sanitize_select',
			'active_callback'   => 'divin_is_ect_featured_content_active',
			'choices'           => divin_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'divin' ),
			'section'           => 'divin_featured_content',
			'type'              => 'select',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_featured_content_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Divin_Note_Control',
			'active_callback'   => 'divin_is_featured_content_active',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'divin' ),
				 '<a href="javascript:wp.customize.control( \'featured_content_title\' ).focus();">',
				 '</a>'
			),
			'section'           => 'divin_featured_content',
			'type'              => 'description',
		)
	);

	divin_register_option( $wp_customize, array(
			'name'              => 'divin_featured_content_number',
			'default'           => 3,
			'sanitize_callback' => 'divin_sanitize_number_range',
			'active_callback'   => 'divin_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'divin' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of Featured Content', 'divin' ),
			'section'           => 'divin_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage'
		)
	);

	$number = get_theme_mod( 'divin_featured_content_number', 3 );

	//loop for featured post content
	for ( $i=1; $i <=  $number ; $i++ ) {
		divin_register_option( $wp_customize, array(
				'name'              => 'divin_featured_content_cpt_' . $i,
				'sanitize_callback' => 'divin_sanitize_post',
				'active_callback'   => 'divin_is_featured_content_active',
				'label'             => esc_html__( 'Featured Content', 'divin' ) . ' ' . $i ,
				'section'           => 'divin_featured_content',
				'type'              => 'select',
				'choices'           => divin_generate_post_array( 'featured-content' ),
			)
		);
	}
}
add_action( 'customize_register', 'divin_featured_content_options' );

/** Active Callback Functions **/
if( ! function_exists( 'divin_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since Clean Portfolio 0.1
	*/
	function divin_is_featured_content_active( $control ) {
		 $enable = $control->manager->get_setting( 'divin_featured_content_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( divin_check_section( $enable ) && ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) ) );
	}
endif;

if ( ! function_exists( 'divin_is_ect_featured_content_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Divin 0.1
    */
    function divin_is_ect_featured_content_active( $control ) {
        return ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;

if ( ! function_exists( 'divin_is_ect_featured_content_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Divin 0.1
    */
    function divin_is_ect_featured_content_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;
