<?php
/**
 * ProductPage functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ProductPage
 *
 * ProductPage Call To Action Section
 */

add_action( 'widgets_init', 'productpage_call_to_action_register' );

function productpage_call_to_action_register()
{
    register_widget( "productpage_call_to_action" );
}

class Productpage_Call_To_Action extends WP_Widget
{
    function __construct() {

        $widget_ops = array( 'classname'      => 'productpage_call_to_action' );

        parent::__construct( 'productpage_call_to_action', '&nbsp;' . esc_html__( '&spades; TS: Call To Action ', 'productpage' ), $widget_ops );
    }// end of construct.

    function form( $instance )
    {
        $ts_defaults['page']               =  '';
        $ts_defaults['button_text']        =  'Learn More';

        $instance                          =  wp_parse_args( (array) $instance, $ts_defaults );
        $ts_button_text                    =  $instance['button_text'];
        ?>
        <label><?php esc_html_e( 'Lorem ipsm is the best text i have ever wrote man', 'productpage' ); ?></label>
        <p>
            <label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php esc_html_e( 'Page', 'productpage' ); ?>:</label>
            <?php
            $arg = array(
                'class'             =>  'widefat',
                'name'              =>  $this->get_field_name( 'page' ),
                'id'                =>  $this->get_field_id( 'page' ),
                'selected'          =>  absint( $instance['page'] )
            );
            wp_dropdown_pages( $arg );
            ?>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php esc_html_e( 'Edit Button Text:', 'productpage' ); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $ts_button_text ); ?>"/>
        </p>
        <?php
    }// end of form.

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['page']              =  absint( $new_instance['page'] );
        $instance['button_text']       =  sanitize_text_field( $new_instance['button_text'] );

        return $instance;
    }// end of update.

    function widget( $args, $instance ) {

        extract( $args );
        extract( $instance );

        $ts_page              =  isset( $instance['page'] ) ? $instance['page'] : '';
        $ts_button_text       =  isset( $instance['button_text'] ) ? $instance['button_text'] : '';

        $ts_get_page   = new WP_Query(array(
            'posts_per_page'  => 1,
            'post_type'       => array( 'page' ),
            'page_id'         => $ts_page
        ));

        echo $before_widget; ?>

        <div class="ts-cta">
            <div class="ts-container">

                <?php if ( $ts_get_page->have_posts() ) :
                    while ( $ts_get_page->have_posts()) : $ts_get_page->the_post(); ?>

                        <p><?php the_title(); ?></p>

                    <?php endwhile;
                    wp_reset_postdata();
                endif; ?>
                <span><a href="<?php the_permalink(); ?>"><?php echo esc_attr( $ts_button_text ); ?></a></span>

            </div>
        </div>

        <?php echo $after_widget;
    }// end of widdget function.
}// end of apply for action widget.
