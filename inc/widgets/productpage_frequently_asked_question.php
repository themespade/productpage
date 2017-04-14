<?php
/**
 * ProductPage functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ProductPage
 *
 * ProductPage Frequently Asked Question Section
 */

add_action( 'widgets_init', 'productpage_frequently_asked_question_register' );

function productpage_frequently_asked_question_register()
{
    register_widget( "productpage_frequently_asked_question" );
}

class Productpage_Frequently_Asked_Question extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array( 'classname'      => 'productpage_frequently_asked_question' );

        parent::__construct( 'productpage_frequently_asked_question', '&nbsp;' . __('&spades; TS: Frequently Asked Questions ', 'productpage' ), $widget_ops );
    }// end of construct.

    function form( $instance )
    {

        $ts_defaults['page']               =  '';
        $ts_defaults['title']              =  '';

        $instance                          =  wp_parse_args( (array) $instance, $ts_defaults );

        $ts_title                          =  $instance['title'];
    ?>
        <label><?php esc_html_e( 'Lorem ipsm is the best text i have ever wrote man', 'productpage' ); ?></label>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'productpage' ); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $ts_title ); ?>"/>
        </p>
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
        <?php
    }// end of form.

    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title']               =  sanitize_text_field($new_instance['title']);
        $instance['page']              =  absint( $new_instance['page'] );

        return $instance;
    }// end of update.

    function widget( $args, $instance )
    {
        extract( $args );
        extract( $instance );

        $ts_title       = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $ts_page              =  isset( $instance['page'] ) ? $instance['page'] : '';

        $ts_get_page   = new WP_Query(array(
            'posts_per_page'  => 1,
            'post_type'       => array( 'page' ),
            'page_id'         => $ts_page
        ));

        echo $before_widget; ?>

        <div class="ts-faqs">
            <div class="ts-container">

                <?php if ( $ts_title ): ?>
                    <div class="ts-title">
                        <?php
                        if( $ts_title )
                            echo '<h2>'.$ts_title. '</h2>';
                        ?>
                    </div>

                <?php endif; ?>

                <div class="faqs-list">

                <?php
                $i = 0;
                if ( $ts_get_page->have_posts() ) :
                while ( $ts_get_page->have_posts()) : $ts_get_page->the_post(); ?>
                    <div class="faqs-block">
                        <h4><i class="fa fa-angle-down"></i> <?php the_title(); ?> </h4>
                        <p <?php echo $i == 0?'class="active"':'';  ?> > <?php the_content(); ?> </p>
                    </div>

                <?php endwhile;
                    wp_reset_postdata();
                endif; ?>

                </div>
            </div>
        </div>
        <?php echo $after_widget;
    }// end of widget function.
}// end of apply for action widget.
