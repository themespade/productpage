<?php
/**
 * This function is responsible for rendering metaboxes in single post area
 *
 * @package ProductPage
 * @subpackage ProductPage
 * @since ProductPage 1.0
 */

add_action( 'add_meta_boxes', 'productpage_add_custom_box' );
/**
 * Add Meta Boxes.
 */
function productpage_add_custom_box()
{
    // Adding layout meta box for Page
    add_meta_box( 'page-layout', esc_html__( 'Select Layout' , 'productpage' ), 'productpage_meta_form', 'page', 'side', 'default' );

    // Adding layout meta box for Post
    add_meta_box( 'post-layout', esc_html__( 'Select Layout' , 'productpage' ), 'productpage_meta_form', 'post', 'side', 'default' );
}

/****************************************************************************************/

global $productpage_page_specific_layout;

$productpage_page_specific_layout = array(

    'right-sidebar'               =>  array(
        'id'                      =>  'productpage_page_specific_layout',
        'value'                   =>  'right-sidebar',
        'label'                   =>  esc_html__( 'Right Sidebar', 'productpage' )
    ),

    'left-sidebar'                =>  array(
        'id'                      =>  'productpage_page_specific_layout',
        'value'                   =>  'left-sidebar',
        'label'                   =>  esc_html__( 'Left Sidebar', 'productpage' )
    ),

    'no-sidebar-content-centered' =>  array(
        'id'                      =>  'productpage_page_specific_layout',
        'value'                   =>  'no-sidebar-content-centered',
        'label'                   =>  esc_html__( 'No Sidebar Content Centered', 'productpage' )
    ),

    'no-sidebar-full-width'       =>  array(
        'id'                      =>  'productpage_page_specific_layout',
        'value'                   =>  'no-sidebar-full-width',
        'label'                   =>  esc_html__( 'No Sidebar Full Width', 'productpage' )
    )
);

/**
 * Displays metabox to for select layout option
 */
function productpage_meta_form()
{
    global $productpage_page_specific_layout;
    global $post;

    // Use nonce for verification
    wp_nonce_field( basename(__FILE__), 'custom_meta_box_nonce' );

    foreach ( $productpage_page_specific_layout as $field ) {

        $layout_meta = get_post_meta( $post->ID, $field['id'], true );
        switch ( $field['id'] ) {

            // Layout
            case 'productpage_page_specific_layout':

                if ( empty( $layout_meta ) ) {
                    $layout_meta = 'right-sidebar';
                } ?>

                <input class="post-format" type="radio" name="<?php echo esc_attr( $field['id'] ); ?>" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout_meta ); ?>/>

                <label class="post-format-icon"><?php echo esc_html( $field['label'] ); ?></label><br/>

                <?php
                break;
        }
    }
}

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function productpage_save_custom_meta( $post_id ) {
    global $productpage_page_specific_layout;

    // Verify the nonce before proceeding.
    if ( !isset( $_POST['custom_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['custom_meta_box_nonce'], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    if ( 'page' == $_POST['post_type'] ) {

        if ( !current_user_can( 'edit_page', $post_id ) )
            return $post_id;

    }
    elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    foreach ( $productpage_page_specific_layout as $field ) {

        //Execute this saving function
        $old = get_post_meta( $post_id, $field['id'], true );
        $new = sanitize_key( $_POST[$field['id']] );

        if ( $new && $new != $old ) {
            update_post_meta( $post_id, $field['id'], $new );
        }
        elseif ( '' == $new && $old ) {
            delete_post_meta( $post_id, $field['id'], $old );
        }

    } // end foreach
}

add_action( 'save_post', 'productpage_save_custom_meta' );