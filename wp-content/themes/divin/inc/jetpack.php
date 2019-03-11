<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package divin
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function divin_jetpack_setup() {
	/**
	 * Setup Infinite Scroll using JetPack if navigation type is set
	 */
	$pagination_type = get_theme_mod( 'divin_pagination_type', 'default' );

	if ( 'infinite-scroll' === $pagination_type ) {
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'divin_infinite_scroll_render',
			'footer'    => 'page',
		) );
	}

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details'       => array(
			'stylesheet'      => 'divin-style',
			'date'            => '.posted-on',
			'categories'      => '.cat-links',
			'tags'            => '.tags-links',
			'author'          => '.byline',
			'comment'         => '.comments-link',
			),
	) );
}
add_action( 'after_setup_theme', 'divin_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function divin_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content/content', 'search' );
		else :
			get_template_part( 'template-parts/content/content', get_post_format() );
		endif;
	}
}

/**
 * Support JetPack featured content
 */
function divin_get_featured_posts() {
	$number = get_theme_mod( 'divin_featured_content_number', 3 );

	$post_list = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
	$args['post_type'] = 'featured-content';

	for ( $i = 1; $i <= $number; $i++ ) {
		$post_id = get_theme_mod( 'divin_featured_content_cpt_' . $i );

		if ( $post_id && '' !== $post_id ) {
			$post_list = array_merge( $post_list, array( $post_id ) );
		}
	}

	$args['post__in'] = $post_list;
	$args['orderby']  = 'post__in';

	$featured_posts = get_posts( $args );

	return $featured_posts;
}

/**
 * Show/Hide Featured Image on single posts view outside of the loop.
 */
function divin_jetpack_featured_image_display() {
	if ( ! function_exists( 'jetpack_featured_images_remove_post_thumbnail' ) ) {
		return true;
	} else {
		$options         = get_theme_support( 'jetpack-content-options' );
		$featured_images = ( ! empty( $options[0]['featured-images'] ) ) ? $options[0]['featured-images'] : null;

		$settings = array(
			'post-default' => ( isset( $featured_images['post-default'] ) && false === $featured_images['post-default'] ) ? '' : 1,
			'page-default' => ( isset( $featured_images['page-default'] ) && false === $featured_images['page-default'] ) ? '' : 1,
		);

		$settings = array_merge( $settings, array(
			'post-option'  => get_option( 'jetpack_content_featured_images_post', $settings['post-default'] ),
			'page-option'  => get_option( 'jetpack_content_featured_images_page', $settings['page-default'] ),
		) );

		if ( ( ! $settings['post-option'] && is_single() )
			|| ( ! $settings['page-option'] && is_singular() && is_page() ) ) {
			return false;
		} else {
			return true;
		}
	}
}
