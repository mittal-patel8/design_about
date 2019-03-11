<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package divin
 */

if ( ! function_exists( 'divin_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 */
function divin_entry_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'divin' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'divin' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'divin' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

if ( ! function_exists( 'divin_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 */
function divin_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		_x( 'Posted on', 'Used before publish date.', 'divin' ),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;

if ( ! function_exists( 'divin_entry_category' ) ) :
/**
 * Prints HTML with category for current post.
 */
function divin_entry_category() {
	$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'divin' ) );
	if ( $categories_list && divin_categorized_blog() ) {
		printf( '<span class="cat-links"><span class="cat-label">%1$s </span>%2$s</span>',
			_x( 'Categories: ', 'Used before category names.', 'divin' ),
			$categories_list
		);
	}
}
endif;

if ( ! function_exists( 'divin_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function divin_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x( 'Posted on %s', 'post date', 'divin' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x( 'by %s', 'post author', 'divin' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'divin_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function divin_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'divin' ) );
			if ( $categories_list && divin_categorized_blog() ) {
				echo '<span class="cat-links"><span>' . esc_html__( 'Posted in ', 'divin' ) . '</span>' . $categories_list . '</span>'; // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'divin' ) );
			if ( $tags_list ) {
				echo '<span class="tags-links"><span>' . esc_html__( ' Tagged ', 'divin' ) . '</span>' . $tags_list . '</span>'; // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'divin' ), esc_html__( '1 Comment', 'divin' ), esc_html__( '% Comments', 'divin' ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'divin' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'divin_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Divin 0.1
 */
function divin_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

if ( ! function_exists( 'divin_entry_category_date' ) ) :
/**
 * Prints HTML with category and tags for current post.
 *
 * Create your own divin_entry_category_date() function to override in a child theme.
 *
 * @since Divin 0.1
 */
function divin_entry_category_date() {
	$meta = '<div class="entry-meta">';
	$portfolio_categories_list = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '<span class="portfolio-entry-meta entry-meta">', esc_html_x( ', ', 'Used between list items, there is a space after the comma.', 'divin' ), '</span>' );
	if ( 'jetpack-portfolio' === get_post_type() && ! is_wp_error( $portfolio_categories_list ) ) {
		$meta .= sprintf( '<span class="cat-links">%1$s%2$s</span>',
			sprintf( _x( '<span class="screen-reader-text">Categories: </span>', 'Used before category names.', 'divin' ) ),
			$portfolio_categories_list
		);

		$meta .= '<span class="sep">' . _x( ' &ndash; ', 'Post meta separator', 'divin' ) . '</span>';
	}

	$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'divin' ) );
	if ( $categories_list && divin_categorized_blog() ) {
		$meta .= sprintf( '<span class="cat-links">%1$s%2$s</span>',
			sprintf( _x( '<span class="screen-reader-text">Categories: </span>', 'Used before category names.', 'divin' ) ),
			$categories_list
		);

		$meta .= '<span class="sep">' . _x( ' &ndash; ', 'Post meta separator', 'divin' ) . '</span>';
	}

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$meta .= sprintf( '<span class="posted-on">%1$s<a href="%2$s" rel="bookmark">%3$s</a></span>',
		sprintf( __( '<span class="date-label">Posted on </span>', 'divin' ) ),
		esc_url( get_permalink() ),
		$time_string
	);

	$meta .= '</div><!-- .entry-meta -->';

	return $meta;

}
endif;

if ( ! function_exists( 'divin_categorized_blog' ) ) :
/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own divin_categorized_blog() function to override in a child theme.
 *
 * @since Divin 0.1
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function divin_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'divin_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'divin_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so divin_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so divin_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flushes out the transients used in divin_categorized_blog().
 *
 * @since Divin 0.1
 */
function divin_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'divin_categories' );
}
add_action( 'edit_category', 'divin_category_transient_flusher' );
add_action( 'save_post',     'divin_category_transient_flusher' );

if ( ! function_exists( 'divin_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own divin_excerpt() function to override in a child theme.
	 *
	 * @since Divin 0.1
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function divin_excerpt( $class = 'entry-summary' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() ) : ?>
			<div class="<?php echo $class; ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php echo $class; ?> -->
		<?php endif;
	}
endif;

if ( ! function_exists( 'divin_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Divin 0.1
	 */
	function divin_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options.
		$length	= get_theme_mod( 'divin_excerpt_length', 55 );

		return absint( $length );
	}
endif; //divin_excerpt_length
add_filter( 'excerpt_length', 'divin_excerpt_length' );

if ( ! function_exists( 'divin_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer.
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function divin_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = get_theme_mod( 'divin_excerpt_more_text',  esc_html__( 'Continue reading &raquo;', 'divin' ) );

		$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ) . '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
		);

		return ' &hellip; ' . $link;
	}
endif;
add_filter( 'excerpt_more', 'divin_excerpt_more' );

if ( ! function_exists( 'divin_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Divin 0.1
	 */
	function divin_custom_excerpt( $output ) {

		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = get_theme_mod( 'divin_excerpt_more_text', esc_html__( 'Continue reading &raquo;', 'divin' ) );

			$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
				esc_url( get_permalink( get_the_ID() ) ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ) . '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

			$output .= ' &hellip; ' . $link;
		}

		return $output;
	}
endif; // divin_custom_excerpt.
add_filter( 'get_the_excerpt', 'divin_custom_excerpt' );

if ( ! function_exists( 'divin_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Divin 0.1
	 */
	function divin_more_link( $more_link, $more_link_text ) {
		$more_tag_text = get_theme_mod( 'divin_excerpt_more_text', esc_html__( 'Continue reading &raquo;', 'divin' ) );

		return str_replace( $more_link_text, wp_kses_post( $more_tag_text ), $more_link );
	}
endif; // divin_more_link.
add_filter( 'the_content_more_link', 'divin_more_link', 10, 2 );

/**
 * Footer Text
 *
 * @get footer text from theme options and display them accordingly
 * @display footer_text
 * @action divin_footer
 *
 * @since Divin 0.1
 */
function divin_footer_content() {
	$theme_data = wp_get_theme();

	$left_content   = '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>';
	$right_content  = get_bloginfo( 'description' );
	$copyright_text = sprintf( _x( 'Copyright &copy; %1$s %2$s. %3$s', '1: Year, 2: Site Title with home URL 3: Privacy Policy Link', 'divin' ), esc_attr( date_i18n( __( 'Y', 'divin' ) ) ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>', get_the_privacy_policy_link() );
	$powered_by     = esc_html( $theme_data->get( 'Name' ) ) . '&nbsp;' . esc_html__( 'by', 'divin' ) . '&nbsp;<a target="_blank" href="' . esc_url( $theme_data->get( 'AuthorURI' ) ) . '">' . esc_html( $theme_data->get( 'Author' ) ) . '</a>';
	?>
	<div class="site-info">
		<div class="wrapper">
			<div class="site-credits">
				<div id="footer-left-content" class="title">
					<?php echo $left_content; /* WPCS: xss ok. */ ?>
				</div><!-- #footer-left-content -->

				<div id="footer-right-content" class="description">
					<?php echo $right_content; /* WPCS: xss ok. */ ?>
				</div><!-- #footer-right-content -->

				<div class="copyright">
					<?php echo $copyright_text; /* WPCS: xss ok. */ ?>
				</div><!-- .copyright -->

				<div class="powered">
					<?php echo $powered_by; /* WPCS: xss ok. */ ?>
				</div><!-- .powered -->
			</div><!-- .site-credits -->
			</div><!-- .wrapper -->
	</div><!-- .site-info -->
<?php
}
add_action( 'divin_credits', 'divin_footer_content', 10 );
