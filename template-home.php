<?php
/**
 * The main template file.
 *Template Name: Home
 *
 * @package ProductPage
 */

//productpage header function
get_header();

//productpage front banner function
productpage_front_banner();

//productpage front page
if (is_active_sidebar( 'productpage_front_page' ) ) {

    if (!dynamic_sidebar( 'productpage_front_page' ) ):
    endif;
}

get_footer();

?>