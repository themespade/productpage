<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ProductPage
 */

get_header();

$sidebar_layout = get_post_meta( $post->ID, 'productpage_page_specific_layout', true );
?>
	<div class="ts-breadcrumb-banner">

		<div data-stellar-background-ratio="0.5" class="ts-parallax-image" style="background-image: url(<?php echo esc_url( get_theme_mod( 'productpage_post_background_image' ) );?>);  background-size:cover; background-repeat: no-repeat;">
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



	<div id="content" class="site-content">
	<div class="ts-container">

<?php if( $sidebar_layout == 'left-sidebar' ):
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
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
if( $sidebar_layout == 'right-sidebar' ):
	get_sidebar();
endif;
echo " </div></div>";
get_footer();
