<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Divin
 */

if ( ! function_exists( 'divin_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see divin_custom_header_setup().
 */
function divin_header_style() {
	$header_text_color = get_header_textcolor();
	$header_image = get_header_image();

	if ( is_singular() ) {
		global $post, $wp_query;
		$enable = get_theme_mod( 'divin_header_media_option', 'homepage' );

		// Get Page ID outside Loop
		$page_id = absint( $wp_query->get_queried_object_id() );

		$page_for_posts = absint( get_option( 'page_for_posts' ) );

		//Individual Page/Post Image Setting
		$individual_featured_image = get_post_meta( $post->ID, 'divin-header-image', true );

		if ( 'disable' === $individual_featured_image || ( 'default' === $individual_featured_image && 'disable' === $enable ) ) {
			echo '<!-- Page/Post Disable Header Image -->';
			return;
		} elseif ( ( 'enable' == $individual_featured_image || ( 'exclude-home-page-post' === $enable || 'entire-site-page-post' === $enable || 'pages-posts' === $enable ) ) && has_post_thumbnail() ) {
			$header_image = get_the_post_thumbnail_url( get_the_ID(), 'divin-header' );
		}
	}

	if ( $header_image ) : ?>
        <style type="text/css">
            .custom-header-media:before {
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

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-identity {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;


/**
 * Customize video play/pause button in the custom header.
 */
function divin_video_controls( $settings ) {
	$settings['l10n']['play'] = '<span class="screen-reader-text">' . esc_html__( 'Play background video', 'divin' ) . '</span>' . divin_get_svg( array( 'icon' => 'play' ) );
	$settings['l10n']['pause'] = '<span class="screen-reader-text">' . esc_html__( 'Pause background video', 'divin' ) . '</span>' . divin_get_svg( array( 'icon' => 'pause' ) );
	return $settings;
}
add_filter( 'header_video_settings', 'divin_video_controls' );
