<?php
namespace Brand_Extra\Widgets;

/**
 * Adds Brand_Instagram_Widget widget to add Instagram feed.
 */
class Brand_Instagram_Widget extends \WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'brand_instagram', // Base ID
            'Instagram Feed', // Name
            array(
							'description' => __( 'Add Instagram feed', 'brand_extra' ),
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
				$username = isset( $instance['username'] ) && !empty( $instance['username'] ) ? $instance['username'] : 'natgeo';
				$number = isset( $instance['number'] ) && !empty( $instance['number'] ) ? $instance['number'] : 6;
				$columns = isset( $instance['columns'] ) && !empty( $instance['columns'] ) ? $instance['columns'] : 'widget-3-col';

        echo $before_widget;
        if ( ! empty( $title ) ) {
            echo $before_title . esc_html( $title ) . $after_title;
        }

				$images = $this->get_instagram_data( $username, $number );

				if( ! empty( $images ) ) { ?>
					<div class="brand-instagram-feed"> <?php
						foreach( $images as $image ) { ?>
								<a href="https://www.instagram.com/p/<?php echo esc_attr($image['link']); ?> " class="<?php echo esc_attr( $columns ) ?>">
									<figure style="background-image:url('<?php echo esc_url( $image['large'] ) ?>')">
									</figure>
								</a>
								<?php
						} ?>
					</div> <?php
				}

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
				'title' 	 => __('Instagram','brand-extra'),
				'username' => 'natgeo',
				'number'   => 6,
				'columns'  => 'widget-3-col',
			));
      ?>
      <p>
      <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:', 'brand-extra' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
      </p>
			<p>
      <label for="<?php echo $this->get_field_name( 'username' ); ?>"><?php _e( 'Username:', 'brand-extra' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $instance['username'] ); ?>" />
      </p>
			<p>
      <label for="<?php echo $this->get_field_name( 'number' ); ?>"><?php _e( 'Number:', 'brand-extra' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
      </p>
			<p>
      <label for="<?php echo $this->get_field_name( 'columns' ); ?>"><?php _e( 'Columns:', 'brand-extra' ); ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>" type="text" value="<?php echo esc_attr( $instance['columns'] ); ?>">
				<option value="widget-2-col" <?php if($instance['columns'] == 'widget-2-col') { ?>selected="selected"<?php } ?>><?php esc_html_e( '2 Columns', 'brand-extra' ); ?></option>
				<option value="widget-3-col" <?php if($instance['columns'] == 'widget-3-col') { ?>selected="selected"<?php } ?>><?php esc_html_e( '3 Columns', 'brand-extra' ); ?></option>
				<option value="widget-4-col" <?php if($instance['columns'] == 'widget-4-col') { ?>selected="selected"<?php } ?>><?php esc_html_e( '4 Columns', 'brand-extra' ); ?></option>
				<option value="widget-5-col" <?php if($instance['columns'] == 'widget-5-col') { ?>selected="selected"<?php } ?>><?php esc_html_e( '5 Columns', 'brand-extra' ); ?></option>
				<option value="widget-6-col" <?php if($instance['columns'] == 'widget-6-col') { ?>selected="selected"<?php } ?>><?php esc_html_e( '6 Columns', 'brand-extra' ); ?></option>
				<option value="widget-7-col" <?php if($instance['columns'] == 'widget-7-col') { ?>selected="selected"<?php } ?>><?php esc_html_e( '7 Columns', 'brand-extra' ); ?></option>
				<option value="widget-8-col" <?php if($instance['columns'] == 'widget-8-col') { ?>selected="selected"<?php } ?>><?php esc_html_e( '8 Columns', 'brand-extra' ); ?></option>
				<option value="widget-9-col" <?php if($instance['columns'] == 'widget-9-col') { ?>selected="selected"<?php } ?>><?php esc_html_e( '9 Columns', 'brand-extra' ); ?></option>
				<option value="widget-10-col" <?php if($instance['columns'] == 'widget-10-col') { ?>selected="selected"<?php } ?>><?php esc_html_e( '10 Columns', 'brand-extra' ); ?></option>
			</select>
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
				$instance['username'] = ( !empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
				$instance['number'] = ( !empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
				$instance['columns'] = ( !empty( $new_instance['columns'] ) ) ? strip_tags( $new_instance['columns'] ) : '';

        return $instance;
    }

		/**
     * Get images data from Instagram.
     *
     * @param string $username Instagram username.
		 * @param int $number Number of images to show.
		 *
     * @return array Instagram images data.
     */
    public function get_instagram_data( $username, $number ) {

			if( false === ( $instagram = get_transient( 'brand_instagram-' . md5( $username ) ) ) ) {
				$response = wp_remote_get('https://www.instagram.com/'. trim( $username ), array( 'sslverify' => false, 'timeout' => 60 ) );
				if ( is_wp_error( $response ) ) {
					return $response->get_error_message();
				}
				$images = array();
				if ( $response['response']['code'] == 200 ) {

					$shards      = explode( 'window._sharedData = ', $response['body'] );
					$insta_json  = explode( ';</script>', $shards[1] );
					$results = json_decode( $insta_json[0], true );

					if ( $results && is_array( $results ) ) {
						$images = isset( $results['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] ) ? $results['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'] : array();

						if ( empty( $images ) ) {
							return __( 'No images found', 'brand-extra');
						}

						foreach ( $images as $image ) {
							if( ! isset( $instagram ) ) {
								$instagram = array();
							}
							if ( count( $instagram ) >= $number ) {
								break;
							}

							$caption = '';
							if ( ! empty( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
								$caption = wp_kses( $image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array() );
							}

							$instagram[] = array(
								'description'     => $caption,
								'link'            => $image['node']['shortcode'],
								'time'            => $image['node']['taken_at_timestamp'],
								'comments'        => $image['node']['edge_media_to_comment']['count'],
								'likes'           => $image['node']['edge_liked_by']['count'],
								'thumbnail'       => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src'] ),
								'small'           => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src'] ),
								'large'           => preg_replace( '/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src'] ),
								'original'        => preg_replace( '/^https?\:/i', '', $image['node']['display_url'] ),
							);

						}
						$instagram = base64_encode( serialize( $instagram ) );
						set_transient( 'brand_instagram-' . md5( $username ), $instagram, apply_filters( 'brand_instagram_cache_time', HOUR_IN_SECONDS * 1 ) );
					}

				}
			}

			return unserialize( base64_decode( $instagram ) );
    }



} // class Brand_Instagram_Widget
add_action( 'widgets_init', function() { register_widget( '\\Brand_Extra\\Widgets\\Brand_Instagram_Widget' ); } );
