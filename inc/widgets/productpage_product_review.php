<?php
/**
 * ProductPage functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ProductPage
 *
 * ProductPage Product Review Section
 */

add_action( 'widgets_init', 'productpage_product_review_register' );

function productpage_product_review_register()
{
    register_widget( "productpage_product_review" );
}

class Productpage_Product_Review extends WP_Widget
{
    function __construct() {
        $widget_ops = array('classname'      => 'productpage_product_review' );

        parent::__construct( 'productpage_product_review', '&nbsp;' . __( '&spades; TS: Product Review ', 'productpage' ), $widget_ops );
    }// end of construct.

    function form( $instance )
    {
        $ts_defaults['title']             =  '';

        for ($i=0; $i<5; $i++) {
            $ts_defaults['page_' . $i]    = '';
        }

        $instance                         =  wp_parse_args( (array) $instance, $ts_defaults );
        $ts_title                         =  $instance['title'];
        ?>

        <label><?php esc_html_e( 'Lorem ipsm is the best text i have ever wrote man', 'productpage' ); ?></label>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'productpage' ); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $ts_title ); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php esc_html_e( 'Page', 'productpage' ); ?>:</label>
        <?php for ( $i=0; $i<5; $i++ ) : ?>
            <?php
            $arg = array(
                'class'    => 'widefat',
                'name'     => $this->get_field_name( 'page_'.$i ),
                'id'       => $this->get_field_id( 'page_'.$i ),
                'selected' => absint( $instance['page_'.$i] )
            );
            wp_dropdown_pages( $arg );
            ?>
           <br> </br>
        <?php endfor; ?>
        </p>
        <?php
    }// end of form.

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;

        $instance['title']               =  sanitize_text_field( $new_instance['title'] );

        for( $i=0; $i<5; $i++ ) {
            $instance['page_'.$i]        = absint( $new_instance['page_'.$i] );
        }

        return $instance;
    }// end of update.

    function widget( $args, $instance )
    {
        extract($args);
        extract($instance);

        $ts_title       = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        $page = array();
        for( $i=0; $i<5; $i++ ) {
            $pages[]          = isset( $instance['page_'.$i] ) ? $instance['page_'.$i] : '';
        }

        $ts_get_page = new WP_Query(array(
            'posts_per_page'  => 5,
            'post_type'       => array( 'page' ),
            'page_id'         => $page
        ));

        echo $before_widget; ?>

        <div data-stellar-background-ratio="0.5" class="ts-reviews" style="background-size:cover;background-repeat: no-repeat;">
            <div class="ts-container">
                <?php if( $ts_title ): ?>
                    <div class="ts-title ts-title-white">
                        <?php
                        if($ts_title)
                            echo '<h2>'.  $ts_title . '</h2>';
                        ?>
                    </div>
                <?php endif; ?>

                <div class="ts-reviews-block">
                    <div class="ts-review-swiper swiper-container">
                        <div class="swiper-wrapper">

                            <?php  if ( $ts_get_page->have_posts() ) :
                            while ( $ts_get_page->have_posts() ) : $ts_get_page->the_post(); ?>
                                <div class="swiper-slide">
                                    <div class="ts-reviews-single">
                                        <p><?php the_excerpt(); ?></p>

                                    <?php if(has_post_thumbnail() ) : ?>
                                        <figure class="ts-review-img">
                                            <?php the_post_thumbnail('large'); ?>
                                        </figure>
                                     <?php endif; ?>

                                        <h4><?php the_title(); ?></h4>
                                    </div>
                                </div>
                            <?php endwhile;
                                wp_reset_postdata();
                            endif; ?>

                        </div>
                        <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                        <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
                    </div>
                </div>

            </div>
        </div>
        <?php echo $after_widget;
    }// end of widdget function.
}// end of apply for action widget.
