<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @packageProductPage
 */
function productpage_widgets_init() {
    register_sidebar( array(
        'name'              => esc_html__( 'Right Sidebar', 'productpage' ),
        'id'                => 'sidebar-1',
        'description'       => esc_html__( 'Add widgets here.', 'productpage' ),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ) );

    register_sidebar( array(
        'name'              => esc_html__( 'Left Sidebar', 'productpage' ),
        'id'                => 'productpage_left_sidebar',
        'description'       => esc_html__( 'Add widgets here.', 'productpage' ),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ) );

    register_sidebar( array(
        'name'              => esc_html__('Front Page', 'productpage'),
        'id'                => 'productpage_front_page',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ) );

    register_sidebar( array(
        'name'              => esc_html__('Footer 1', 'productpage'),
        'id'                => 'productpage_footer1_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array(
        'name'              => esc_html__('Footer 2', 'productpage'),
        'id'                => 'productpage_footer2_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array(
        'name'              => esc_html__('Footer 3', 'productpage'),
        'id'                => 'productpage_footer3_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

    register_sidebar( array(
        'name'              => esc_html__('Footer 4', 'productpage'),
        'id'                => 'productpage_footer4_area',
        'description'       => esc_html__('Add widgets here.', 'productpage'),
        'before_widget'     => '<section id="%1$s" class="widget %2$s">',
        'after_widget'      => '</section>',
        'before_title'      => '<h2 class="widget-title">',
        'after_title'       => '</h2>',
    ));

}
add_action( 'widgets_init', 'productpage_widgets_init' );

// productpage Breadcrums function
if ( !function_exists( 'productpage_breadcrumbs' ) ) :

    function productpage_breadcrumbs( $delimiter = '' )
    {
        global $post;

        $productpage_et_to = get_theme_mod( 'productpage_breadcrumbs_activate', 1 );

        if ( $productpage_et_to == 1 ) :
            $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

            if ( isset( $productpage_et_to['breadcrumb_separator'] ) ) {
                $delimiter = '<span class="breadcrumb_separator">' . $productpage_et_to['breadcrumb_separator'] . '</span>';
            } else {
                $delimiter = '<span class="breadcrumb_separator"> / </span>'; // delimiter between crumbs
            }

            if ( isset( $productpage_et_to['breadcrumb_home_text'] ) ) {
                $home = $productpage_et_to['breadcrumb_home_text'];
            } else {
                $home = esc_html__( 'Home', 'productpage' ); // text for the 'Home' link
            }

            $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
            $before = '<a>'; // tag before the current crumb
            $after = '</a>'; // tag after the current crumb

            $homeLink = esc_url( home_url() );

            if ( is_home() || is_front_page() ) {
                if ( $showOnHome == 1 ) echo '<a href="' . $homeLink . '" class="breadcrumb_home_text">' . $home . '</a>';
            }
            else {
                echo '<a href="' . $homeLink . '" class="breadcrumb_home_text">' . $home . '</a>' . $delimiter . ' ';

                if ( is_category() ) {
                    $thisCat = get_category( get_query_var( 'cat' ), false);
                    if ( $thisCat->parent != 0 ) echo get_category_parents( $thisCat->parent, TRUE, ' ' . $delimiter . ' ' );
                    echo $before . single_cat_title( '', false ) . $after;

                }
                elseif (is_search()) {
                    echo $before . esc_html__( 'Search results for "', 'productpage' ) . get_search_query() . '"' . $after;

                }
                elseif (is_day()) {

                    echo '<a href="' . esc_url(get_year_link( get_the_time( 'Y' ) )) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
                    echo '<a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . get_the_time( 'F' ) . '</a> ' . $delimiter . ' ';
                    echo $before . get_the_time( 'd' ) . $after;

                }
                elseif ( is_month() ) {

                    echo '<a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a> ' . $delimiter . ' ';
                    echo $before . get_the_time( 'F' ) . $after;

                }
                elseif ( is_year() ) {
                    echo $before . get_the_time( 'Y' ) . $after;

                }
                elseif ( is_single() && !is_attachment() ) {

                    if ( get_post_type() != 'post' ) {
                        $post_type = get_post_type_object( get_post_type() );
                        $slug = $post_type->rewrite;
                        echo '<a href="' . esc_url(home_url() . '/' . $slug['slug']) . '/">' . $post_type->labels->singular_name . '</a>';
                        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                    }
                    else {
                        $cat = get_the_category();
                        $cat = $cat[0];
                        $cats = get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
                        if ( $showCurrent == 0 ) $cats = preg_replace( "#^(.+)\s$delimiter\s$#", "$1", $cats );
                        echo $cats;
                        if ( $showCurrent == 1 ) echo $before . get_the_title() . $after;
                    }

                }
                elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                    $post_type = get_post_type_object( get_post_type() );
                    echo $before . $post_type->labels->singular_name . $after;

                }
                elseif ( is_attachment() ) {

                    $parent = get_post( $post->post_parent );
                    $cat = get_the_category( $parent->ID );
                    $cat = $cat[0];
                    echo get_category_parents( $cat, TRUE, ' ' . $delimiter . ' ' );
                    echo '<a href="' . esc_url( get_permalink( $parent ) ) . '">' . $parent->post_title . '</a>';

                    if ( $showCurrent == 1 ) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

                }
                elseif ( is_page() && !$post->post_parent ) {
                    if ( $showCurrent == 1 ) echo $before . get_the_title() . $after;

                }
                elseif ( is_page() && $post->post_parent ) {

                    $parent_id = $post->post_parent;
                    $breadcrumbs = array();

                    while ( $parent_id ) {
                        $page = get_page( $parent_id );
                        $breadcrumbs[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . get_the_title( $page->ID ) . '</a>';
                        $parent_id = $page->post_parent;
                    }

                    $breadcrumbs = array_reverse( $breadcrumbs );

                    for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
                        echo $breadcrumbs[$i];
                        if ( $i != count( $breadcrumbs ) - 1) echo ' ' . $delimiter . ' ';
                    }

                    if ( $showCurrent == 1 ) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

                }
                elseif ( is_tag() ) {
                    echo $before . esc_html__( 'Posts tagged "', 'productpage' ) . single_tag_title( '', false ) . '"' . $after;

                }
                elseif ( is_author() ) {
                    global $author;
                    $userdata = get_userdata( $author );
                    echo $before . esc_html__( 'Articles posted by ', 'productpage' ) . $userdata->display_name . $after;

                }
                elseif ( is_404() ) {
                    echo $before . esc_html__( 'Error 404', 'productpage' ) . $after;
                }

                if ( get_query_var( 'paged' ) ) {
                    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
                    echo __( 'Page', 'productpage' ) . ' ' . get_query_var( 'paged' );
                    if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
                }
            }
        endif;
    }

endif;

//productpage footer count function
if ( !function_exists( 'productpage_footer_count' ) ) :

    function productpage_footer_count() {

        $productpage_count = 0;
        if ( is_active_sidebar( 'productpage_footer1_area' ) )
            $productpage_count++;

        if ( is_active_sidebar( 'productpage_footer2_area' ) )
            $productpage_count++;

        if ( is_active_sidebar( 'productpage_footer3_area' ) )
            $productpage_count++;

        if ( is_active_sidebar( 'productpage_footer4_area' ) )
            $productpage_count++;

        return $productpage_count;
    }

endif;

// function to show the footer info, copyright information
if ( !function_exists( 'productpage_footer_copyright_info' ) ) :

    function productpage_footer_copyright_info()
    {
        $site_link = '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" >' . get_bloginfo( 'name', 'display' ) . '</a>';

        $wp_link = '<a href="' . esc_url( 'http://wordpress.org' ) . '" target="_blank" title="' . esc_attr__( 'WordPress', 'productpage' ) . '"><span>' . esc_html__( 'WordPress', 'productpage' ) . '</span></a>';

        $tm_link = '<a href="' . 'http://themespade.com/' . '" target="_blank" title="' . esc_attr__( 'themespade', 'productpage' ) . '" rel="designer"><span>' . esc_html__( 'ThemeSpade &spades; ', 'productpage' ) . '</span></a>';

        $default_footer_value = '<p class="ts-left">' . sprintf( esc_html__( ' &copy; %1$s %2$s. All Right Reserved. ', 'productpage' ), $site_link, date( 'Y' ) ) . sprintf( esc_html__( '| Powered by %s.', 'productpage' ), $wp_link ) . '</p><p class="ts-right">' . sprintf( esc_html__( 'Designed By %s.', 'productpage' ), $tm_link ) . '</p>';

        $productpage_footer_copyright = '<div class="ts-footer-bottom"><div class="ts-container">' . $default_footer_value . '</div></div>';
        echo $productpage_footer_copyright;
    }

    add_action( 'productpage_footer_copyright', 'productpage_footer_copyright_info', 10 );

endif;

/** Plugin Install ***/


    function productpage_required_plugins() {

    /**
    * Array of plugin arrays. Required keys are name and slug.
    * If the source is NOT from the .org repo, then source is also required.
    */
    $plugins = array(

        array(
            'name'      => 'Woocommerce',
            'slug'      => 'woocommerce',
            'required'  => false,
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            ),
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            ), 
        );

        /**
        * Array of configuration settings. Amend each line as needed.
        * If you want the default strings to be available under your own theme domain,
        * leave the strings uncommented.
        * Some of the strings are added into a sprintf, so see the comments at the
        * end of each line for what each argument will be.
        */
        $config = array(
                'page_title'                      => __( 'Install Required Plugins', 'productpage' ),
                'menu_title'                      => __( 'Install Plugins', 'productpage' ),
                'installing'                      => __( 'Installing Plugin: %s', 'productpage' ),
                'oops'                            => __( 'Something went wrong with the plugin API.', 'productpage' ),
                'notice_can_install_required'     => _n_noop(
                    'This theme requires the following plugin: %1$s.',
                    'This theme requires the following plugins: %1$s.',
                    'productpage'
                ),
                'notice_can_install_recommended'  => _n_noop(
                    'This theme recommends the following plugin: %1$s.',
                    'This theme recommends the following plugins: %1$s.',
                    'productpage'
                ),
                'notice_cannot_install'           => _n_noop(
                    'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
                    'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
                    'productpage'
                ),
                'notice_ask_to_update'            => _n_noop(
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                    'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                    'productpage'
                ),
                'notice_ask_to_update_maybe'      => _n_noop(
                    'There is an update available for: %1$s.',
                    'There are updates available for the following plugins: %1$s.',
                    'productpage'
                ),
                'notice_cannot_update'            => _n_noop(
                    'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
                    'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
                    'productpage'
                ),
                'notice_can_activate_required'    => _n_noop(
                    'The following required plugin is currently inactive: %1$s.',
                    'The following required plugins are currently inactive: %1$s.',
                    'productpage'
                ),
                'notice_can_activate_recommended' => _n_noop(
                    'The following recommended plugin is currently inactive: %1$s.',
                    'The following recommended plugins are currently inactive: %1$s.',
                    'productpage'
                ),
                'notice_cannot_activate'          => _n_noop(
                    'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
                    'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
                    'productpage'
                ),
                'install_link'                    => _n_noop(
                    'Begin installing plugin',
                    'Begin installing plugins',
                    'productpage'
                ),
                'update_link'                     => _n_noop(
                    'Begin updating plugin',
                    'Begin updating plugins',
                    'productpage'
                ),
                'activate_link'                   => _n_noop(
                    'Begin activating plugin',
                    'Begin activating plugins',
                    'productpage'
                ),
                'return'                          => __( 'Return to Required Plugins Installer', 'productpage' ),
                'dashboard'                       => __( 'Return to the dashboard', 'productpage' ),
                'plugin_activated'                => __( 'Plugin activated successfully.', 'productpage' ),
                'activated_successfully'          => __( 'The following plugin was activated successfully:', 'productpage' ),
                'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'productpage' ),
                'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'productpage' ),
                'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'productpage' ),
                'dismiss'                         => __( 'Dismiss this notice', 'productpage' ),
                'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'productpage' ),
            );

tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'productpage_required_plugins' );