<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ProductPage
 */

get_header();
$default_sidebar_layout = get_theme_mod('productpage_default_sidebar_setting', 'right-sidebar');
?>

	<div class="ts-breadcrumb-banner">

		<div data-stellar-background-ratio="0.5" class="ts-parallax-image" style="background-image: url(<?php echo esc_url( get_theme_mod( 'productpage_default_background_image' ) );?>);  background-size:cover; background-repeat: no-repeat;">
			<div class="ts-container">

				<div id="productpage--breadcrumbs">

					<div class="ts-default-title"><?php the_archive_title(); ?></div>
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
	if ( $default_sidebar_layout == 'left-sidebar' ):
		?>
		<aside id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'productpage_left_sidebar' ); ?>
		</aside><!-- #secondary -->
		<?php
	endif;
	?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php

					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if ($default_sidebar_layout == 'right-sidebar'):
	get_sidebar();
endif;

echo " </div></div>";
get_footer();
