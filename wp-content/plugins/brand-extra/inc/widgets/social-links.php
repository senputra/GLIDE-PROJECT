<?php
namespace Brand_Extra\Widgets;

/**
 * Adds Brand_Social_Links_Widget widget to add social links.
 */
class Brand_Social_Links_Widget extends \WP_Widget {

		public $social_services = array(
			'facebook',
			'twitter',
			'google',
			'instagram',
			'pinterest',
			'flickr',
			'500px',
			'github',
			'linkedin',
			'tumblr',
			'vimeo',
			'youtube',
		);

		public $link_shapes = array(
			'square',
			'circle',
			'none',
		);

		public $alignment = array(
			'left',
			'center',
			'right',
		);

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'brand_social_links', // Base ID
            'Social links', // Name
            array(
							'description' => __( 'Add social links', 'brand_extra' ),
							'customize_selective_refresh' => true,
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
				$size = isset( $instance['size'] ) && ! empty( $instance['size'] ) ? $instance['size'] : '40px';
				$font_size = isset( $instance['font_size'] ) && ! empty( $instance['font_size'] ) ? $instance['font_size'] : '16px';
				$shape= isset( $instance['shape'] ) && in_array( $instance['shape'], $this->link_shapes ) ? $instance['shape'] : 'square';
				$alignment= isset( $instance['alignment'] ) && in_array( $instance['alignment'], $this->alignment ) ? $instance['alignment'] : 'left';

        echo $before_widget;
        if ( ! empty( $title ) ) {
            echo $before_title . esc_html( $title ) . $after_title;
        } ?>

				<div class="brand-social-links <?php echo esc_attr( $shape ) ?> <?php echo esc_attr( $alignment ) ?>">
					<ul style="font-size:<?php echo esc_attr( $font_size ) ?>;"> <?php
					foreach( $this->social_services as $social ) {
						if( ! empty( $instance[ $social . 'url' ] ) ) { ?>
							<li style="width:<?php echo esc_attr( $size ) ?>;height:<?php echo esc_attr( $size ) ?>;">
								<a href="<?php echo esc_url( $instance[ $social . 'url' ] ); ?>">
									<i class="fa fa-<?php echo esc_attr( $social ); ?>" aria-hidden="true"></i>
								</a>
							</li>
						<?php
						}
					} ?>
					</ul>
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
				'title' 	  => __('Social links','brand-extra'),
				'size'      => '40px',
				'font_size' => '16px',
				'shape'     => 'square',
				'alignment' => 'left',

			)); ?>

			<p>
      <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:', 'brand-extra' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
      <label for="<?php echo $this->get_field_name( 'size' ); ?>"><?php _e( 'Size:', 'brand-extra' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" type="text" value="<?php echo esc_attr( $instance['size'] ); ?>" />
      </p>
			<p>
      <label for="<?php echo $this->get_field_name( 'font_size' ); ?>"><?php _e( 'Font size:', 'brand-extra' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'font_size' ); ?>" name="<?php echo $this->get_field_name( 'font_size' ); ?>" type="text" value="<?php echo esc_attr( $instance['font_size'] ); ?>" />
      </p>
			<p>
      <label for="<?php echo $this->get_field_name( 'shape' ); ?>"><?php _e( 'Shape:', 'brand-extra' ); ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id( 'shape' ); ?>" name="<?php echo $this->get_field_name( 'shape' ); ?>" type="text" value="<?php echo esc_attr( $instance['shape'] ); ?>">
				<option value="square" <?php if( $instance['shape'] == 'square') { ?>selected="selected"<?php } ?>><?php esc_html_e( 'Square', 'brand-extra' ); ?></option>
				<option value="circle" <?php if( $instance['shape'] == 'circle') { ?>selected="selected"<?php } ?>><?php esc_html_e( 'Circle', 'brand-extra' ); ?></option>
				<option value="none" <?php if( $instance['shape'] == 'none') { ?>selected="selected"<?php } ?>><?php esc_html_e( 'None', 'brand-extra' ); ?></option>
			</select>
			</p>
			<p>
      <label for="<?php echo $this->get_field_name( 'alignment' ); ?>"><?php _e( 'Alignment:', 'brand-extra' ); ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id( 'alignment' ); ?>" name="<?php echo $this->get_field_name( 'alignment' ); ?>" type="text" value="<?php echo esc_attr( $instance['alignment'] ); ?>">
				<option value="left" <?php if( $instance['alignment'] == 'left') { ?>selected="selected"<?php } ?>><?php esc_html_e( 'Left', 'brand-extra' ); ?></option>
				<option value="center" <?php if( $instance['alignment'] == 'center') { ?>selected="selected"<?php } ?>><?php esc_html_e( 'Center', 'brand-extra' ); ?></option>
				<option value="right" <?php if( $instance['alignment'] == 'right') { ?>selected="selected"<?php } ?>><?php esc_html_e( 'Right', 'brand-extra' ); ?></option>
			</select>
			</p>
			<?php
			foreach( $this->social_services as $social ) {
				$instance[$social . 'url'] = isset( $instance[$social . 'url'] ) ? $instance[$social . 'url'] : ''; ?>
      	<p>
      		<label for="<?php echo $this->get_field_name( $social . 'url' ); ?>"><?php echo esc_html( $social ); ?></label>
      		<input class="widefat" id="<?php echo $this->get_field_id( $social . 'url' ); ?>" name="<?php echo $this->get_field_name( $social . 'url' ); ?>" type="text" value="<?php echo esc_attr( $instance[$social . 'url'] ); ?>" />
      	</p>
      <?php
    	}
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
				$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
				$instance['size'] = ( ! empty( $new_instance['size'] ) ) ? strip_tags( $new_instance['size'] ) : '40px';
				$instance['font_size'] = ( ! empty( $new_instance['font_size'] ) ) ? strip_tags( $new_instance['font_size'] ) : '16px';
				$instance['shape'] = ( in_array( $new_instance['shape'], $this->link_shapes ) ) ? strip_tags( $new_instance['shape'] ) : 'square';
				$instance['alignment'] = ( in_array( $new_instance['alignment'], $this->alignment ) ) ? strip_tags( $new_instance['alignment'] ) : 'left';
				foreach( $this->social_services as $social ) {
					$instance[$social . 'url'] = ( !empty( $new_instance[$social . 'url'] ) ) ? esc_url_raw( $new_instance[$social . 'url'] ) : '';
				}
        return $instance;
    }

} // class Brand_Instagram_Widget
add_action( 'widgets_init', function() { register_widget( '\\Brand_Extra\\Widgets\\Brand_Social_Links_Widget' ); } );
