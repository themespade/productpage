<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ProductPage
 * @subpackage ProductPage
 * @since ProductPage 1.0
 */
if ( !class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * A class to create a radio button  for sidebar
 */
class Productpage_Image_Radio_Control extends WP_Customize_Control {

    public function render_content() {

        if ( empty( $this->choices ) )
            return;

        $name = '_customize-radio-' . $this->id;

        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

        <ul class="controls" id = 'productpage-img-container'>

            <?php	foreach ( $this->choices as $value => $label ) :

                $class = ( $this->value() == $value )?'productpage-radio-img-selected productpage-radio-img-img':'productpage-radio-img-img';

                ?>

                <li style="display: inline;">

                    <label>

                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />

                        <img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo esc_attr( $class) ; ?>' />

                    </label>

                </li>

            <?php	endforeach;	?>

        </ul>

        <?php
    }
}
