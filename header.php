<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ProductPage
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'productpage' ); ?></a>
		<?php  $sticky = get_theme_mod('productpage_sticky_menu'); ?>
	<header id="masthead" class="site-header <?php echo $sticky == 1?'ts-fixed':''; ?>" role="banner">
			<div class="ts-top-header ts-clearblock">

				<div class="ts-container">
					<div class="site-branding">

						<?php if ( ( get_theme_mod( 'productpage_header_logo_placement', 'header_text_only' ) == 'show_both'
								|| get_theme_mod( 'productpage_header_logo_placement', 'header_text_only' ) == 'header_logo_only') && has_custom_logo()) : ?>
							<div class="ts-logo">
									<?php the_custom_logo(); ?>
							</div>
						<?php endif; ?>

                        <div class="ts-site-title">
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php
                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) : ?>
                                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                                <?php
                            endif; ?>
                        </div>

					</div>

                    <nav id="ts-main-nav" class="ts-main-navigation">
                        <div id="primary-menu" class="menu">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
                        </div>
                    </nav>
				</div>

			</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">