<?php
/**
 * The template for displaying Services
 *
 * @package Divin
 */

if ( ! function_exists( 'divin_service_display' ) ) :
	/**
	* Add Featured content.
	*
	* @uses action hook divin_before_content.
	*
	* @since Divin 0.1
	*/
	function divin_service_display() {
		$output = '';

		// get data value from options
		$enable_content = get_theme_mod( 'divin_service_option', 'disabled' );

		if ( divin_check_section( $enable_content ) ) {
			$layout        	= get_theme_mod( 'divin_service_layout', 'layout-three' );
			$headline       = get_theme_mod( 'divin_service_headline', esc_html__( 'Services', 'divin' ) );
			$subheadline    = get_theme_mod( 'divin_service_subheadline' );

			$classes[] = 'section';

			$output = '
			<div id="service-content-section" class="' . esc_attr( implode( ' ', $classes ) ) . '">
				<div class="section-wrapper">';
					if ( ! empty( $headline ) || ! empty( $subheadline ) ) {
						$output .= '<div class="section-heading-wrapper service-section-headline">';

						if ( ! empty( $headline ) ) {
							$output .= '<div class="section-title-wrapper"><h2 class="section-title">' . wp_kses_post( $headline ) . '</h2></div>';
						}

						if ( ! empty( $subheadline ) ) {
							$output .= '<div class="taxonomy-description-wrapper">' . wp_kses_post( $subheadline ) . '</div>';
						}

						$output .= '</div><!-- .section-heading-wrapper -->';
					}
					$output .= '
					<div class="section-content-wrapper service-content-wrapper ' . esc_attr( $layout ) . '">';

						// Select content
						$output .= divin_post_page_category_service();

						$output .= '
					</div><!-- .service-content-area -->

				</div><!-- .section-wrapper -->
			</div><!-- #service-content-section -->';
		}

		echo $output;
	}
endif;
add_action( 'divin_service', 'divin_service_display', 10 );


if ( ! function_exists( 'divin_post_page_category_service' ) ) :
	/**
	 * This function to display featured posts content
	 *
	 * @param $options: divin_theme_options from customizer
	 *
	 * @since Divin 0.1
	 */
	function divin_post_page_category_service() {
		global $post;

		$quantity   = get_theme_mod( 'divin_service_number', 3 );
		$no_of_post = 0; // for number of posts
		$post_list  = array();// list of valid post/page ids
		$output     = '';

		$args = array(
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1 // ignore sticky posts
		);

		//Get valid number of posts
		$args['post_type'] = 'ect-service';

		for ( $i = 1; $i <= $quantity; $i++ ) {
			$post_id = get_theme_mod( 'divin_service_cpt_' . $i );

			if ( $post_id && '' !== $post_id ) {
				// Polylang Support.
				if ( class_exists( 'Polylang' ) ) {
					$post_id = pll_get_post( $post_id, pll_current_language() );
				}

				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		$args['post__in'] = $post_list;

		if ( 0 === $no_of_post ) {
			return;
		}

		$args['posts_per_page'] = $no_of_post;

		$loop = new WP_Query( $args );

		$layout = get_theme_mod( 'divin_service_layout', 'layout-three' );

		while ( $loop->have_posts() ) {
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );

			$i = absint( $loop->current_post + 1 );

			$output .= '
				<article id="service-post-' . $i . '" class="status-publish has-post-thumbnail hentry ect-service">
					<div class="hentry-inner">';

					// Default value if there is no first image
					$image = '<img class="wp-post-image" src="' . trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb.jpg" >';

					if ( 'layout-one' === $layout ) {
						$thumbnail = 'post-thumbnail';
					}
					else {
						$thumbnail = 'divin-featured-square';
					}

					if ( has_post_thumbnail() ) {
						$image = get_the_post_thumbnail( $post->ID, $thumbnail, array( 'title' => $title_attribute, 'alt' => $title_attribute ) );
					}
					else {
						// Get the first image in page, returns false if there is no image.
						$first_image = divin_get_first_image( $post->ID, $thumbnail, array( 'title' => $title_attribute, 'alt' => $title_attribute ) );

						// Set value of image as first image if there is an image present in the page.
						if ( $first_image ) {
							$image = $first_image;
						}
					}

					$output .= '
						<a class="post-thumbnail" href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
							'. $image . '
						</a>
						<div class="entry-container">';

					if ( get_theme_mod( 'divin_service_enable_title', 1 ) ) {
						$output .= the_title( '<header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2></header><!-- .entry-header -->', false );
					}

					$content_show = get_theme_mod( 'divin_service_show', 'excerpt' );

					if ( 'excerpt' === $content_show ) {
						//Show Excerpt
						$output .= '
							<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
					}
					elseif ( 'full-content' === $content_show ) {
						//Show Content
						$content = apply_filters( 'the_content', get_the_content() );
						$content = str_replace( ' )]>', ' )]&gt;', $content );
						$output .= '<div class="entry-content">' . $content . '</div><!-- .entry-content -->';
					}

					$output .= '
						</div><!-- .entry-container -->
					</div><!-- .hentry-inner -->
				</article><!-- .featured-post-' . $i . ' -->';
			} //endwhile

		wp_reset_postdata();

		return $output;
	}
endif; // divin_post_page_category_service
