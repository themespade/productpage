<?php
/**
 * ProductPage Theme Customizer.
 *
 * @package ProductPage
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function productpage_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	require_once get_template_directory() . '/inc/wp-customize-class.php';

	//General Option---
	$wp_customize->add_panel( 'general_panel', array(
		'capability' 		  =>  'edit_theme_options',
		'priority' 			  =>  10,
		'title'				  =>  esc_html__( 'General', 'productpage' ),
	) );

	// Breadcrumbs
	$wp_customize->add_section( 'productpage_breadcrumbs_activate_settings', array(
        'priority'              =>  1,
        'title'                 =>  esc_html__('Activate Breadcrumbs', 'productpage'),
        'panel'                 =>  'general_panel'
	) );

	$wp_customize->add_setting( 'productpage_breadcrumbs_activate', array(
        'default'               => 1,
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'productpage_checkbox_sanitize'
	) );

	$wp_customize->add_control( 'productpage_breadcrumbs_activate', array(
        'type'                  =>  'checkbox',
        'label'                 =>  esc_html__('Check to activate breadcrumbs', 'productpage'),
        'section'               =>  'productpage_breadcrumbs_activate_settings',
        'settings'              =>  'productpage_breadcrumbs_activate'
	) );

	//page background image
	$wp_customize->add_section( 'productpage_background_image_section', array(
        'priority'              =>  10,
        'title'                 =>  esc_html__('Top Banner Image', 'productpage'),
        'panel'                 =>  'general_panel'
	) );

	$wp_customize->add_setting( 'productpage_page_background_image', array(
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'productpage_page_background_image', array(
        'label'                 => esc_html__('Upload background  image for page', 'productpage'),
        'section'               => 'productpage_background_image_section',
        'settings'              => 'productpage_page_background_image',
	) ) );

	//post background image
	$wp_customize->add_setting( 'productpage_post_background_image', array(
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'productpage_post_background_image', array(
        'label'                 => esc_html__('Upload background image for post', 'productpage'),
        'section'               => 'productpage_background_image_section',
        'settings'              => 'productpage_post_background_image',
	) ) );

	//default background image
	$wp_customize->add_setting( 'productpage_default_background_image', array(
        'capability'            => 'edit_theme_options',
        'sanitize_callback'     => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'productpage_default_background_image', array(
        'label'                 =>  esc_html__('Upload background image for default', 'productpage'),
        'section'               =>  'productpage_background_image_section',
        'settings'              =>  'productpage_default_background_image',
	) ) );

	$wp_customize->add_section( 'productpage_default_sidebar_section', array(
        'priority'              =>  15,
        'title'                 =>  esc_html__('Default Sidebar Settings', 'productpage'),
        'panel'                 =>  'general_panel'
	) );

	$wp_customize->add_setting( 'productpage_default_sidebar_setting', array(
        'default'               =>  esc_html__('right-sidebar', 'productpage'),
        'capability'            =>  'edit_theme_options',
        'sanitize_callback'     =>  'sanitize_text_field'
	) );

	$wp_customize->add_control( new Productpage_Image_Radio_Control($wp_customize, 'productpage_default_sidebar_setting', array(
        'type'                  =>  'radio',
        'label'                 =>  esc_html__('Select default layout for default pages.', 'productpage'),
        'section'               =>  'productpage_default_sidebar_section',
        'settings'              =>  'productpage_default_sidebar_setting',
        'choices'               =>  array(
            'right-sidebar'               =>  PRODUCTPAGE_IMAGES_ADMIN_URL . '/right-sidebar.png',
            'left-sidebar'                =>  PRODUCTPAGE_IMAGES_ADMIN_URL . '/left-sidebar.png',
            'no-sidebar-content-centered' =>  PRODUCTPAGE_IMAGES_ADMIN_URL . '/no-sidebar-content-centered-layout.png',
            'no-sidebar-full-width'       =>  PRODUCTPAGE_IMAGES_ADMIN_URL . '/no-sidebar-full-width-layout.png'
        ) ) ) );

	// site layout setting
	$wp_customize->add_section( 'productpage_site_layout_section', array(
        'priority'              =>  20,
        'title'                 =>  esc_html__( 'Site Layout', 'productpage' ),
        'panel'                 =>  'general_panel'
	) );

	$wp_customize->add_setting( 'productpage_site_layout', array(
        'default'               =>  'wide',
        'capability'            =>  'edit_theme_options',
        'sanitize_callback'     =>  'productpage_sanitize_radio'
	) );

	$wp_customize->add_control( 'productpage_site_layout', array(
        'type'                 =>  'radio',
        'priority'             =>  10,
        'label'                =>  esc_html__('Choose your site layout. The change is reflected in whole site.', 'productpage'),
        'section'              =>  'productpage_site_layout_section',
        'setting'              =>  'productpage_site_layout',
        'choices'              =>  array(
            'box'              =>  esc_html__('Boxed layout', 'productpage'),
            'wide'             =>  esc_html__('Wide layout', 'productpage')
    ) ) );


	//header option----
	$wp_customize->add_panel( 'productpage_header_option', array(
        'capability' 		  => 'edit_theme_options',
        'priority' 			  => 15,
        'title'				  => esc_html__( 'Header', 'productpage' ),
	) );

	$wp_customize->get_section( 'title_tagline'  )->panel		= 'productpage_header_option';

	// logo and site title position options
	$wp_customize->add_setting( 'productpage_header_logo_placement', array(
        'default'               =>  'header_text_only',
        'capability'            =>  'edit_theme_options',
        'sanitize_callback'     =>  'productpage_sanitize_radio'
	) );

	$wp_customize->add_control( 'productpage_header_logo_placement', array(
        'type'                  =>  'radio',
        'priority'              =>  20,
        'label'                 =>  esc_html__('Choose the option that you want from below.', 'productpage'),
        'setting'               =>  'productpage_header_logo_placement',
        'section'               =>  'title_tagline',
        'choices'               =>  array(
            'header_logo_only'  =>  esc_html__('Header Logo Only', 'productpage'),
            'header_text_only'  =>  esc_html__('Header Text Only', 'productpage'),
            'show_both'         =>  esc_html__('Show Both', 'productpage'),
            'disable'           =>  esc_html__('Disable', 'productpage')
        ) ) );

	//sticky menu
	$wp_customize->add_section( 'productpage_sticky_menu_section', array(
        'priority'          	 =>  25,
        'title'             	 =>  esc_html__('Sticky Menu', 'productpage'),
        'panel'             	 =>  'productpage_header_option'
	) );

	$wp_customize->add_setting( 'productpage_sticky_menu', array(
		'default' 				 =>  '',
		'capability' 			 =>  'edit_theme_options',
		'sanitize_callback' 	 =>  'productpage_checkbox_sanitize'
	) );

	$wp_customize->add_control( 'productpage_sticky_menu', array(
        'type' 				     =>  'checkbox',
        'label' 			     =>  esc_html__( 'Disable Sticky Menu', 'productpage' ),
        'settings' 			     =>  'productpage_sticky_menu',
        'section' 			     =>  'productpage_sticky_menu_section'
	) );


	// product option---
	$wp_customize->add_section( 'productpage_product_banner_section', array(
        'priority'          	 =>  20,
        'title'             	 =>  esc_html__('Product Banner', 'productpage'),
	) );

	$wp_customize->add_setting( 'productpage_product_banner_checkbox', array(
        'default' 				 =>  '',
        'capability' 			 =>  'edit_theme_options',
        'sanitize_callback' 	 =>  'productpage_checkbox_sanitize'
	) );

	$wp_customize->add_control( 'productpage_product_banner_checkbox', array(
        'type' 				     =>  'checkbox',
        'label' 			     =>  esc_html__( 'Enable Product Banner', 'productpage' ),
        'settings' 			     =>  'productpage_product_banner_checkbox',
        'section' 			     =>  'productpage_product_banner_section'
	) );

	$wp_customize->add_setting( 'productpage_product_banner_caption', array(
        'capability'             =>  'edit_theme_options',
        'sanitize_callback'	     =>  'sanitize_text_field'
	) );

	$wp_customize->add_control( 'productpage_product_banner_caption', array(
        'type' 				     =>  'text',
        'label'                  =>  esc_html__('Choose your Cation for Product Banner.', 'productpage'),
        'settings' 			     =>  'productpage_product_banner_caption',
        'section'                =>  'productpage_product_banner_section',
	) );

	$productpage_prod_categories_array = array('-' => __('Select category','productpage'));

	$productpage_prod_categories = get_categories( array('taxonomy' => 'product_cat', 'hide_empty' => 0, 'title_li' => '') );

	if( !empty($productpage_prod_categories) ):
		foreach ($productpage_prod_categories as $productpage_prod_cat):

			if( !empty($productpage_prod_cat->term_id) && !empty($productpage_prod_cat->name) ):
				$productpage_prod_categories_array[$productpage_prod_cat->term_id] = $productpage_prod_cat->name;
			endif;

		endforeach;
	endif;
	/* Category */
	$wp_customize->add_setting( 'productpage_products_category', array(
        'transport'             =>  'postMessage',
        'capability'            =>  'edit_theme_options',
        'sanitize_callback'     =>  'sanitize_text_field'
	));

	$wp_customize->add_control( 'productpage_products_category', array(
        'type' 		            =>  'select',
        'label' 	            =>  esc_html__( 'Products category', 'productpage' ),
        'description'           =>  esc_html__( 'Pick a product category. WooCommerce latest products are displaying.', 'productpage' ),
        'section' 	            =>  'productpage_product_banner_section',
        'choices'               =>  $productpage_prod_categories_array,
	));

	$wp_customize->add_setting( 'productpage_buy_now_button', array(
        'capability'             =>  'edit_theme_options',
        'sanitize_callback'	     =>  'sanitize_text_field'
	) );

	$wp_customize->add_control( 'productpage_buy_now_button', array(
        'type' 				     =>  'text',
        'label'                  =>  esc_html__('Type to change the  button text learn more.', 'productpage'),
        'settings' 			     =>  'productpage_buy_now_button',
        'section'                =>  'productpage_product_banner_section',
	) );

	$wp_customize->add_setting( 'productpage_product_banner',array(
		'sanitize_callback'		 =>  'esc_attr',
        'capability'             =>  'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'productpage_product_banner', array(
        'label' 				=>  esc_html__('Product Banner ','productpage'),
        'section' 				=>  'productpage_product_banner_section',
        'settings' 				=>  'productpage_product_banner',
        'flex_width'  			=>  false, // Allow any width, making the specified value recommended. False by default.
        'flex_height' 			=>  false, // Require the resulting image to be exactly as tall as the height attribute (default).
	) ) );


	//contact option---
	$wp_customize->add_section( 'productpage_contact_section', array(
        'priority'              =>  30,
        'title'                 =>  esc_html__('Contact Us', 'productpage'),
	));

	$wp_customize->add_setting( 'productpage_contact_title', array(
        'default'               =>  '',
        'capability'            =>  'edit_theme_options',
        'sanitize_callback'     =>  'sanitize_text_field'
	));

	$wp_customize->add_control( 'productpage_contact_title', array(
        'type'                  =>  'text',
        'label'                 =>  esc_html__('Contact form title', 'productpage'),
        'section'               =>  'productpage_contact_section',
        'settings'              =>  'productpage_contact_title'
	));

	// contact us
	$wp_customize->add_setting( 'productpage_contact_shortcode', array(
        'default'                =>  '',
        'capability'             =>  'edit_theme_options',
        'sanitize_callback'      =>  'sanitize_text_field'
	));

	$wp_customize->add_control( 'productpage_contact_shortcode', array(
        'type'                  => 'text',
        'label'                 => esc_html__('Contact form Short code', 'productpage'),
        'section'               => 'productpage_contact_section',
        'settings'              => 'productpage_contact_shortcode'
	) );

	//sanitize checkbox function
	function productpage_checkbox_sanitize( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}


	// radio sanitization
	function productpage_sanitize_radio($input, $setting)
	{
		// Ensuring that the input is a slug.
		$input = sanitize_key($input);
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control($setting->id)->choices;
		// If the input is a valid key, return it, else, return the default.
		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}

	function productpage_hex_color_sanitize( $color ) {
		return sanitize_hex_color( $color );
	}
	// Escape Color
	function productpage_color_escaping_sanitize( $input ) {
		$input = esc_attr($input);
		return $input;
	}

}
add_action( 'customize_register', 'productpage_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function productpage_customize_preview_js() {
	wp_enqueue_script( 'productpage_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'productpage_customize_preview_js' );
