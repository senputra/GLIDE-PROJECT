<?php
namespace Brand_Extra\Widgets;

/**
 * Adds Brand_Instagram_Widget widget to add Instagram feed.
 */
class Brand_Flickr_Widget extends \WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'brand_flickr', // Base ID
            'Flickr Stream', // Name
            array(
							'description' => __( 'Add Flickr photos', 'brand_extra' ),
						) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
				$username_id = isset( $instance['username_id'] ) && !empty( $instance['username_id'] ) ? $instance['username_id'] : '67254714@N02';
				$number = isset( $instance['number'] ) && !empty( $instance['number'] ) ? $instance['number'] : 6;

        echo $before_widget;
        if ( ! empty( $title ) ) {
            echo $before_title . esc_html( $title ) . $after_title;
        }

				 ?>
					<div class="flickr-stream">
						<script type="text/javascript" src="https://www.flickr.com/badge_code_v2.gne?count=<?php echo intval( $number ); ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo strip_tags( $username_id ); ?>"></script>
						<p class="flickr_stream_wrap">
							<a href="http://www.flickr.com/photos/<?php echo esc_attr( $username_id ) ?>">
								<?php esc_html_e( 'View stream on Flickr', 'brand-extra' ) ?>
							</a>
						</p>
					</div> <?php

			  echo $after_widget;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array(
				'title' 	 => __('Flickr Stream','brand-extra'),
				'username_id' => '67254714@N02',
				'number'   => 6,
			));
      ?>
      <p>
      <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:', 'brand-extra' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
      </p>
			<p>
      <label for="<?php echo $this->get_field_name( 'username_id' ); ?>"><?php _e( 'Flickr id:', 'brand-extra' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'username_id' ); ?>" name="<?php echo $this->get_field_name( 'username_id' ); ?>" type="text" value="<?php echo esc_attr( $instance['username_id'] ); ?>" />
      </p>
			<p>
      <label for="<?php echo $this->get_field_name( 'number' ); ?>"><?php _e( 'Number:', 'brand-extra' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
      </p>
      <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
				$instance['username_id'] = ( !empty( $new_instance['username_id'] ) ) ? strip_tags( $new_instance['username_id'] ) : '';
				$instance['number'] = ( !empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '67254714@N02';

        return $instance;
    }

} // class Brand_Instagram_Widget
add_action( 'widgets_init', function() { register_widget( '\\Brand_Extra\\Widgets\\Brand_Flickr_Widget' ); } );
