<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ProductPage
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function productpage_body_classes( $classes )
{
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Add class site layout style.
	if ( get_theme_mod ( 'productpage_site_layout', 'wide' ) == 'wide' ) {
		$classes[] = 'wide';
	} else {
		$classes[] = 'box';
	}

	return $classes;
}

add_filter( 'body_class', 'productpage_body_classes' );


function productpage_page_post_layout( $productpage_classes )
{

	global $post;

	$productpage_default_sidebar_layout = get_theme_mod( 'productpage_default_sidebar_setting', 'right-sidebar' );


	if ( is_singular() ) {

		$productpage_post_class = get_post_meta( $post->ID, 'productpage_page_specific_layout', true );

		if (empty($productpage_post_class)) {

			$productpage_post_class = 'right-sidebar';
			$productpage_classes[] = $productpage_post_class;

		} else {

			$productpage_post_class = get_post_meta($post->ID, 'productpage_page_specific_layout', true);
			$productpage_classes[] = $productpage_post_class;

		}

	}
	elseif ( is_archive() ) {

		if ( empty( $productpage_default_sidebar_layout ) ) {

			$productpage_classes[] = 'right-sidebar';

		} else {

			$productpage_classes[] = $productpage_default_sidebar_layout;

		}
	}
	elseif ( is_search() ) {

		if ( empty( $productpage_default_sidebar_layout ) ) {

			$productpage_classes[] = 'right-sidebar';

		} else {

			$productpage_classes[] = $productpage_default_sidebar_layout;

		}
	}
	else {

		$productpage_classes[] = 'right-sidebar';

	}

	return $productpage_classes;
}

add_filter( 'body_class', 'productpage_page_post_layout' );