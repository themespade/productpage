<?php
/**
 * ProductPage functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ProductPage
 *
 * ProductPage Featured  Section
 */

add_action( 'widgets_init', 'productpage_feature_register' );

function productpage_feature_register()
{
    register_widget( "productpage_feature" );
}

class Productpage_Feature extends WP_Widget
{
    function __construct()
    {
        $widget_ops = array(
            'classname'      =>  'productpage_feature' );

        parent::__construct( 'productpage_feature', '&nbsp;' . __( '&spades; TS: Our Feature ', 'productpage' ), $widget_ops);
    }// end of construct.

    function form( $instance )
    {
        $ts_defaults['title']        =  '';
        $ts_defaults['image_url']    =  '';

        for ( $i=0; $i<5; $i++ ) {
            $ts_defaults['page_'.$i]  = '';
        }

        $instance                    =  wp_parse_args( (array) $instance, $ts_defaults );

        $ts_title                    =  $instance['title'];
        $ts_image_url                =  'image_url';
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title: ', 'productpage' ); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $ts_title ); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( $ts_image_url ); ?>"> <?php esc_html_e( 'Image: ', 'productpage' ); ?></label>
            <?php
            if ( $instance[$ts_image_url] != '' ) :
                echo '<img id="' . $this->get_field_id( $instance[$ts_image_url] . 'preview' ) . '"src="' . $instance[$ts_image_url] . '"style="max-width:250px;" /><br />';
            endif;
            ?>
            <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $ts_image_url ); ?>" name="<?php echo $this->get_field_name( $ts_image_url ); ?>" value="<?php echo $instance[$ts_image_url]; ?>" style="margin-top:5px;"/>

            <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name($ts_image_url); ?>" value="<?php esc_html_e( 'Upload Image', 'productpage' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $ts_image_url ); ?>' ); return false;"/>
        </p>

        <?php for ($i=0; $i<5; $i++) : ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php esc_html_e( 'Page', 'productpage' ); ?>:</label>
            <?php
            $arg  =  array (
                'class'      => 'widefat',
                'name'       => $this->get_field_name( 'page_'.$i ),
                'id'         => $this->get_field_id( 'page_'.$i ),
                'selected'   => absint( $instance['page_'.$i] )
            );
            wp_dropdown_pages( $arg );
            ?>
        </p>
        <?php endfor; ?>

        <?php
    }// end of form.

    function update( $new_instance, $old_instance ) {

        $instance                       =  $old_instance;
        $instance['title']              =  sanitize_text_field( $new_instance['title'] );
        $image_url                      =  'image_url';
        $instance[$image_url]           =  esc_url_raw( $new_instance[$image_url] );

        for( $i=0; $i<5; $i++ ) {
            $instance['page_'.$i]       = absint( $new_instance['page_'.$i] );
        }

        return $instance;
    }// end of update.

    function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );

        $ts_title       = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $ts_image_url   =  isset( $instance['image_url'] ) ? $instance['image_url'] : '';
        $pages          = array();

        for( $i=0; $i<5; $i++ ) {
            $pages[] = isset( $instance['page_'.$i] ) ? $instance['page_'.$i] : '';
        }

        $ts_get_page = new WP_Query(array(
            'posts_per_page'      => 5,
            'post_type'           => array( 'page' ),
            'post__in'            => $pages,
            'orderby'             => 'post__in'
        ));

        echo $before_widget; ?>

        <div class="ts-features">
            <div class="ts-container">

                <?php if( $ts_title): ?>
                    <div class="ts-title">
                        <?php
                             if($ts_title)
                                 echo '<h2>'.$ts_title. '</h2>';
                        ?>
                    </div>
                <?php endif; ?>

                <div class="ts-features-block ts-clearblock">
                    <?php
                    if ( $ts_get_page->have_posts() ) :
                    while ( $ts_get_page->have_posts() ) : $ts_get_page->the_post(); ?>

                    <div class="ts-features-single">

                        <div class="ts-hex-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>); background-size:cover; background-repeat: no-repeat;">
                            <span class="ts-top"></span>
                            <span class="ts-bottom"></span>
                        </div>

                        <h4> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title(); ?> </a> </h4>
                        <p><?php echo wp_trim_words( get_the_excerpt(), 55, ''); ?></p>

                    </div>

                    <?php endwhile;
                        wp_reset_postdata();
                    endif; ?>
                </div>

                <div class="featured-image">
                    <?php $output = '';
                    if ( !empty($ts_image_url) ) {

                        $output .= '<img src="' . $ts_image_url . '" >';
                    }
                    echo $output; ?>
                </div>

            </div>
        </div>

        <?php echo $after_widget;
    }// end of widget function.
}// end of apply for action widget.
