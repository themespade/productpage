<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ProductPage
 */

get_header(); ?>
    <div class="ts-breadcrumb-banner">

        <div data-stellar-background-ratio="0.5" class="ts-parallax-image"
             style="background-image: url(<?php echo esc_url( get_theme_mod( 'productpage_default_background_image' ) ); ?>);  background-size:cover; background-position: center center;">
            <div class="ts-container">

                <div id="productpage--breadcrumbs">
                    <div class="ts-default-title"><?php esc_html_e( '404 Error', 'productpage' ); ?></div>

                    <div class="ts-top-breadcrumbs">
                        <?php productpage_breadcrumbs(); ?>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div id="content" class="site-content">
        <div class="ts-container">

                <main id="main" class="site-main" role="main">

                    <section class="error-404 not-found">
                        <header class="page-header">
                            <p><?php esc_html_e( 'Page Not Found', 'productpage' ); ?></p>
                        </header><!-- .page-header -->

                        <div class="page-content">
                            <p><?php esc_html_e( 'It looks like you may have a wrong turn. Don\'t worry... it happens to the best of us.', 'productpage' ); ?></p>

                            <?php get_search_form(); ?>

                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->

                </main><!-- #main -->
        </div>
    </div>

<?php

get_footer();
