<?php
/**
 * Customizer functionality
 *
 * @package Divin
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Divin 1.0
 *
 * @see divin_header_style()
 */
function divin_custom_header_and_background() {
	/**
	 * Filter the arguments used when adding 'custom-background' support in Divin.
	 *
	 * @since Divin 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'divin_custom_background_args', array(
		'default-color' => '#f0f0f0',
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Divin.
	 *
	 * @since Divin 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'divin_custom_header_args', array(
		'default-image'      	 => get_parent_theme_file_uri( '/assets/images/header.jpg' ),
		'default-text-color'     => '#242424',
		'width'                  => 1920,
		'height'                 => 1280,
		'flex-height'            => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'divin_header_style',
		'video'                  => true,
	) ) );

	register_default_headers( array(
	'default-image' => array(
		'url'           => '%s/assets/images/header.jpg',
		'thumbnail_url' => '%s/assets/images/header-thumbnail.jpg',
		'description'   => esc_html__( 'Default Header Image', 'divin' ),
		),
	) );
}
add_action( 'after_setup_theme', 'divin_custom_header_and_background' );

if ( ! function_exists( 'divin_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own divin_header_style() function to override in a child theme.
 *
 * @since Divin 1.0
 *
 * @see divin_custom_header_and_background().
 */
function divin_header_style() {
    $header_image = get_header_image();

    if ( $header_image ) : ?>
        <style type="text/css">
            .custom-header:before {
                background-image: url( <?php echo esc_url( $header_image ); ?>);
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				content: "";
				display: block;
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				z-index: -1;
            }
        </style>
    <?php
    endif;

	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="divin-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		#header-content {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // divin_header_style

/**
 * Converts a HEX value to RGB.
 *
 * @since Divin Pro 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function divin_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}
