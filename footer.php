<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ProductPage
 */

?>

	</div><!-- #content -->
    <?php if ( is_active_sidebar( 'productpage_footer1_area' ) || is_active_sidebar( 'productpage_footer2_area' )
    || is_active_sidebar( 'productpage_footer3_area' ) || is_active_sidebar('productpage_footer4_area' ) ) : ?>
		<footer class="ts-footer">
			<div class="ts-container">
                <div class="ts-footer-block ts-clearblock ts-footer-column-<?php echo productpage_footer_count(); ?>">
                    <?php if ( is_active_sidebar( 'productpage_footer1_area' ) ) { ?>
                        <div class="ts-footer-single">
                            <?php dynamic_sidebar( 'productpage_footer1_area' ); ?>
                        </div>
                    <?php } ?>

                    <?php if ( is_active_sidebar( 'productpage_footer2_area' ) ) { ?>
                        <div class="ts-footer-single">
                            <?php dynamic_sidebar( 'productpage_footer2_area' ); ?>
                        </div>
                    <?php } ?>

                    <?php if ( is_active_sidebar( 'productpage_footer3_area' ) ) { ?>
                        <div class="ts-footer-single">
                            <?php dynamic_sidebar( 'productpage_footer3_area' ); ?>
                        </div>
                    <?php } ?>

                    <?php if ( is_active_sidebar( 'productpage_footer4_area' ) ) { ?>
                        <div class="ts-footer-single">
                            <?php dynamic_sidebar( 'productpage_footer4_area' ); ?>
                        </div>
                    <?php } ?>
                </div>
			</div>
		</footer>
    <?php endif; ?>

		<div class="ts-bottom-footer">
			<div class="ts-container">
                <?php  do_action( 'productpage_footer_copyright' ); ?>
			</div>
		</div>

		<div class="ts-scroll-top">
			<span class="ts-scroll-top-inner"><i class="fa fa-long-arrow-up"></i></span>
		</div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
