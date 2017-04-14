/**
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
jQuery(document).ready(function() {
	jQuery('.controls#productpage-img-container li img').click(function(){
		jQuery('.controls#productpage-img-container li').each(function(){
			jQuery(this).find('img').removeClass ('productpage-radio-img-selected') ;
		});
		jQuery(this).addClass ('productpage-radio-img-selected') ;
	});
});
