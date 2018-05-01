<?php
/**
 *
 * @package Interserver Blog
*/
 
if (class_exists('WP_Customize_Control')) {
    //Titles
    class Interserver_Blog_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() { ?>
        <h3 style="margin-top:30px;border:1px dashed;padding:10px;color:#000;background:#ccc;text-transform:uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }   


class Interserver_Blog_Multiple_Select_Control extends WP_Customize_Control {
/**
 * The type of customize control being rendered.
 */
public $type = 'multiple-select';

/**
 * Displays the multiple select on the customize screen.
 */
public function render_content() {
if ( empty( $this->choices ) )
    return;
?>
    <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
            <?php
                foreach ( $this->choices as $value => $label ) {
                    $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                    echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
                }
            ?>
        </select>
    </label>
<?php }}

    // Category Dropdown
    class Interserver_Blog_Category_Control extends WP_Customize_Control {
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;','interserver-blog' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
            printf(
    '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
    $this->label,
    $dropdown);
        }
    }
}

function interserver_blog_is_custom_slider_height(){
    global $ib_default;
    $slider_height = get_theme_mod( 'slider_height',$ib_default['slider_height']);
    if($slider_height == $ib_default['slider_height']) {
        return false;
    }
    return true;
}