<?php
/**
 * ProductPage functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ProductPage
 *
 * ProductPage Info Widget Section
 */

add_action( 'widgets_init', 'productpage_info_widget_register' );

function productpage_info_widget_register()
{
    register_widget( "productpage_info_widget" );
}

class Productpage_Info_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array( 'classname'      => 'productpage_info_widget' );

        parent::__construct( 'productpage_info_widget', '&nbsp;' . __( '&spades; TS: Product Info ', 'productpage' ), $widget_ops );
    }// end of construct.

    function form( $instance )
    {
        $ts_defaults['style']              =  'style1';
        $ts_defaults['page']               =  '';
        $ts_defaults['background_color']   =  '#1e1e1e';
        $ts_defaults['button_text']        =  'Learn More';

        $instance                          =  wp_parse_args( (array) $instance, $ts_defaults );

        $ts_style                          =  $instance['style'];
        $ts_background_color               =  $instance['background_color'];
        $ts_button_text                    =  esc_attr($instance['button_text']);
        ?>
        <label><?php esc_html_e( 'Lorem ipsm is the best text i have ever wrote man', 'productpage' ); ?></label>
        <p>
            <input type="radio" <?php checked( $ts_style, 'style1' ) ?> id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" value="style1"/><?php esc_html_e( 'Style 1', 'productpage' ); ?><br/>

            <input type="radio" <?php checked( $ts_style, 'style2' ) ?> id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" value="style2"/><?php esc_html_e( 'Style 2', 'productpage' ); ?><br/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'background_color' ); ?>" class="widefat"><?php esc_html_e( 'Background Color', 'productpage' ) ?></label><br></br>

            <input class="widefat my-color-picker" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo $ts_background_color; ?>" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php esc_html_e( 'Page', 'productpage' ); ?>:</label>
            <?php
            $arg = array(
                'class' => 'widefat',
                'name' => $this->get_field_name( 'page' ),
                'id'   => $this->get_field_id( 'page' ),
                'selected' => absint( $instance['page'] )
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

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['style']             =  $new_instance['style'];
        $instance['background_color']  =  sanitize_hex_color( $new_instance['background_color'] );
        $instance['page']              =  absint( $new_instance['page'] );
        $instance['button_text']       =  sanitize_text_field( $new_instance['button_text'] );

        return $instance;
    }// end of update.

    function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        $ts_style            = isset( $instance['style'] ) ? $instance['style'] : '';
        $ts_background_color = isset( $instance['background_color'] ) ? $instance['background_color'] : '';
        $ts_page             = isset( $instance['page'] ) ? $instance['page'] : '';
        $ts_button_text      = isset( $instance['button_text'] ) ? $instance['button_text'] : '';

        $ts_get_page = new WP_Query(array(
            'posts_per_page'      => 1,
            'post_type'           => array( 'page' ),
            'page_id'           => $ts_page
        ));

        echo $before_widget; ?>

        <div class="ts-info <?php echo $ts_style == 'style2'?'ts-info2 ':' '; echo empty( $ts_image_url )?'ts-no-bg':''; ?> "
             style="<?php if ( !empty( $ts_background_color ) ) : ?> background-color:<?php echo $ts_background_color; ?> ;
             <?php endif; ?>background-size:cover;background-repeat: no-repeat;">

            <?php if ( $ts_get_page->have_posts() ) :
                while ( $ts_get_page->have_posts() ) : $ts_get_page->the_post(); ?>

                <div class="ts-container">
                    <div class="ts-info-desc">
                        <div class="ts-title" >
                            <h2><?php the_title(); ?></h2>
                            <div class="ts-inner-desc"><?php the_excerpt(); ?></div>
                        </div>
                        <a href="<?php the_permalink(); ?>"><?php echo esc_attr( $ts_button_text ); ?></a>
                    </div>
                     <?php
                     if( has_post_thumbnail() ): ?>
                        <figure class="ts-info-img">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </figure>
                      <?php endif; ?>
                </div>

                <?php endwhile;
                wp_reset_postdata();
            endif; ?>

        </div>
        <?php echo $after_widget;
    }// end of widdget function.
}// end of apply for action widget.
