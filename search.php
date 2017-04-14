<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ProductPage
 */

get_header();
$default_sidebar_layout = get_theme_mod('productpage_default_sidebar_setting', 'right-sidebar');
?>

    <div class="ts-breadcrumb-banner">
        <div data-stellar-background-ratio="0.5" class="ts-parallax-image" style="background-image: url(<?php echo esc_url(get_theme_mod('productpage_default_background_image'));?>);  background-size:cover; background-position: center center;">
            <div class="ts-container">

                <div id="productpage--breadcrumbs">
                    <div class="ts-default-title"><?php esc_html_e('Search', 'productpage'); ?></div>

                    <div class="ts-top-breadcrumbs">
                        <?php productpage_breadcrumbs(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="content" class="site-content">
        <div class="ts-container">

        <?php
            if ( $default_sidebar_layout == 'left-sidebar' ) :
                ?>
                <aside id="secondary" class="widget-area" role="complementary">
                    <?php dynamic_sidebar( 'productpage_left_sidebar' ); ?>
                </aside><!-- #secondary -->
                <?php
            endif;
        ?>

        <section id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php
                if (have_posts()) : ?>

                    <header class="page-header">
                        <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'productpage'), '<span>' . get_search_query() . '</span>'); ?></h1>
                    </header><!-- .page-header -->

                    <?php
                    /* Start the Loop */
                    while (have_posts()) : the_post();

                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('template-parts/content', 'search');

                    endwhile;

                    the_posts_navigation();

                else :

                    get_template_part('template-parts/content', 'none');

                endif; ?>

            </main><!-- #main -->
        </section><!-- #primary -->

<?php
if ($default_sidebar_layout == 'right-sidebar'):
    get_sidebar();
endif;
echo "</div>
    </div>";
get_footer();
