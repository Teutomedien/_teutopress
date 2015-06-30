<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Teutopress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _teutopress_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', '_teutopress_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function _teutopress_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', '_teutopress' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', '_teutopress_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function _teutopress_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', '_teutopress_render_title' );
endif;

/**
 * Remove all Plain text emails within the content and the widget Text
 * and replace them with the encoded Mail
 *
 * @param E-Mail adress as String
 * @return encoded Email
 */

function _teutopress_remove_plaintext_email($emailAddress) {
    $emailRegEx = '/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4})/i';
    return preg_replace_callback($emailRegEx, "_teutopress_encodeEmail", $emailAddress);
}

function _teutopress_encodeEmail($result) {
    return antispambot($result[1]);
}

add_filter( 'the_content', '_teutopress_remove_plaintext_email', 20 );
add_filter( 'widget_text', '_teutopress_remove_plaintext_email', 20 );


/**
 * Disable Comments
 *
 * @param none
 * @return none
 */

add_filter('get_header', '_teutopress_turn_comments_off');
function _teutopress_turn_comments_off(){
    if(is_single() || is_page()){
      global $post;
      $post->comment_status="closed";
  }
}
