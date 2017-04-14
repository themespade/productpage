<?php
/**
 * Template Name: Contact Page
 * @package ProductPage
 * @subpackage ProductPage
 */

$ts_contact_title = esc_html(get_theme_mod('productpage_contact_title'));
$ts_contact_text = sanitize_text_field(get_theme_mod('productpage_contact_text'));
$ts_contact_shortcode = get_theme_mod('productpage_contact_shortcode');

//productpage header funtion
get_header();
?>
    <div class="ts-breadcrumb-banner">

        <div data-stellar-background-ratio="0.5" class="ts-parallax-image" style="background-image: url(<?php echo esc_url(get_theme_mod('productpage_page_background_image'));?>);  background-size:cover; background-position: center center;">
            <div class="ts-container">

                <div id="productpage--breadcrumbs">
                    <div class="ts-default-title"><?php the_title(); ?></div>

                    <div class="ts-top-breadcrumbs">
                        <?php productpage_breadcrumbs(); ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php
while ( have_posts() ) : the_post();
    ?>
    <div id="content" class="site-content">
        <div class="ts-container">
            <main id="main" class="site-main" role="main">
                <div class="ts-contact-info">
                    <?php if(! empty($ts_contact_title)): ?>
                    <h4><?php echo esc_html($ts_contact_title); ?></h4>
                    <?php endif; ?>

                    <p><?php the_content(); ?></p>
                </div>
            </main>

            <?php if(!empty($ts_contact_shortcode)): ?>
            <div class="ts-contact-form">
                <?php echo do_shortcode($ts_contact_shortcode );?>
            </div>
            <?php endif;
            ?>
            <!-- #main -->
        </div>
    </div>
    <?php

endwhile; // End of the loop.

get_footer();

?>