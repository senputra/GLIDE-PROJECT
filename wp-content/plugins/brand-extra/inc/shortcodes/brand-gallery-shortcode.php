<?php
/**
 * Main Brand Extra plugin class/file.
 *
 * @package brand-extra
 */

 namespace Brand_Extra\Shortcodes;

 /**
  * Brand Extra class, so we don't have to worry about namespaces.
  */
 class Brand_Gallery_Shortcode {
 	/**
 	 * The instance *Singleton* of this class
 	 *
 	 * @var object
 	 */
 	private static $instance;

	/**
 	 * CSS to apply to the gallery
 	 *
 	 * @var string
 	 */
 	public $gallery_styles;

	/**
	 * Returns the *Singleton* instance of this class.
	 *
	 * @return Brand_Gallery_Shortcode the *Singleton* instance.
	 */
	public static function get_instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	protected function __construct() {
		// Actions and filters.
		add_filter( 'post_gallery', array( $this, 'brand_gallery_shortcode' ), 10, 2);
		add_action( 'attachment_fields_to_edit', array( $this, 'add_attachment_fields' ), 10, 2 );
		add_action( 'edit_attachment', array( $this, 'save_attachment_fields' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'gallery_scripts' ), 99 );
	}

	/**
	 * Private clone method to prevent cloning of the instance of the *Singleton* instance.
	 *
	 * @return void
	 */
	private function __clone() {}


	/**
	 * Private unserialize method to prevent unserializing of the *Singleton* instance.
	 *
	 * @return void
	 */
	private function __wakeup() {}

	/*
 	* Change WordPress default gallery output
 	*
 	*/
	public function brand_gallery_shortcode($output, $attr) {
		global $post;

		if (isset($attr['orderby'])) {
    	$attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    	if (!$attr['orderby'])
        unset($attr['orderby']);
		}

		extract(shortcode_atts(array(
    	'order' => 'ASC',
    	'orderby' => 'menu_order ID',
    	'id' => $post->ID,
    	'itemtag' => 'dl',
    	'icontag' => 'dt',
    	'captiontag' => 'dd',
    	'columns' => 3,
    	'size' => 'thumbnail',
    	'include' => '',
    	'exclude' => '',
			'my_custom_attr' => '',
		), $attr));

		$id = intval($id);
		if ('RAND' == $order) $orderby = 'none';

		if (!empty($include)) {
    	$include = preg_replace('/[^0-9,]+/', '', $include);
    	$_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

    	$attachments = array();
    	foreach ($_attachments as $key => $val) {
        $attachments[$val->ID] = $_attachments[$key];
    	}
		}

		if (empty($attachments)) return '';

		// Here's your actual output, you may customize it to your need
		$output = "<div class=\"brand-gallery gallery-columns-" . $columns . "\">\n";

		// Now you loop through each attachment
		foreach ($attachments as $id => $attachment) {
    	// Fetch all data related to attachment
    	$img = wp_prepare_attachment_for_js($id);

    	// If you want a different size change 'large' to eg. 'medium'
			$custom_text = get_post_meta( $id, 'custom_text', true );
			$custom_url = get_post_meta( $id, 'custom_url', true );
    	$url = $img['sizes'][$size]['url'];
			$large_url = ! empty( $custom_url ) ? esc_url( $custom_url ): $img['sizes']['full']['url'];
			$data_url = $img['sizes']['full']['url'];
			$large_height = $img['sizes']['full']['height'];
    	$large_width = $img['sizes']['full']['width'];
    	$height = $img['sizes'][$size]['height'];
    	$width = $img['sizes'][$size]['width'];
    	$alt = $img['alt'];

    	// Store the caption and description
    	$caption = $img['caption'];
			$description = $img['description'];

			$output .= "<figure class=\"gallery-item\" itemprop=\"associatedMedia\" itemscope itemtype=\"http://schema.org/ImageObject\"> \n";
				$output .= "<a href=\"{$large_url}\" itemprop=\"contentUrl\" data-size=\"{$large_width}x{$large_height}\" data-href=\"{$data_url}\"> \n";
				if( $large_url !== $data_url ) {
					$output .= "<span> {$custom_text} </span>";
				}
					$output .= "<div class=\"brand-gallery-thumb\" style=\"background-image:url('{$url}');\" itemprop=\"thumbnail\" width=\"{$width}\" height=\"{$height}\" alt=\"{$alt}\">\n";
					$output .= "</div>\n";
				$output .= "</a>\n";
				// Output the caption if it exists
				$output .= "<figcaption itemprop=\"caption description\"> \n";
					if ( $caption ) {
						$output .= "<strong> {$caption} </strong> \n";
					}
					if ( $description ) {
						$output .= "<p>{$description}</p> \n";
					}
				$output .= "</figcaption>\n";
			$output .= "</figure>\n";

		}

		$output .= "</div>\n";

		// Add inline styles
		$this->gallery_styles = $this->gallery_styles( $columns );

		// Core PhotoSwipe JS file
		wp_enqueue_script( 'photoswipe-js', BRAND_EXTRA_URL . 'assets/photoswipe/photoswipe.min.js' , array(), PHOTOSWIPE_VERSION, true );
		// UI PhotoSwipe JS file
		wp_enqueue_script( 'photoswipe-ui-js', BRAND_EXTRA_URL . 'assets/photoswipe/photoswipe-ui-default.min.js' , array(), PHOTOSWIPE_VERSION, true );
		// UI PhotoSwipe JS file
		wp_enqueue_script( 'brand-photoswipe-js', BRAND_EXTRA_URL . 'assets/js/brand-photoswipe.js' , array( 'photoswipe-js' ), BRAND_EXTRA_VERSION, true );
		// Core PhotoSwipe CSS file
		wp_enqueue_style( 'photoswipe-css', BRAND_EXTRA_URL . 'assets/photoswipe/photoswipe.css', array() , PHOTOSWIPE_VERSION );
		// Skin CSS file (styling of UI - buttons, caption, etc.)
		wp_enqueue_style( 'photoswipe-ui-css', BRAND_EXTRA_URL . 'assets/photoswipe/default-skin/default-skin.css', array() , PHOTOSWIPE_VERSION );

		return $output;
	}

	public function add_attachment_fields( $form_fields, $post ) {
    $url_field_value = get_post_meta( $post->ID, 'custom_url', true );
		$text_field_value = get_post_meta( $post->ID, 'custom_text', true );
    $form_fields['custom_url'] = array(
        'value' => $url_field_value ? $url_field_value : '',
        'label' => __( 'Custom url', 'brand-extra' ),
        'helps' => __( 'Set a url link for this attachment to use it in the galleries', 'brand-extra' )
    );
		$form_fields['custom_text'] = array(
        'value' => $text_field_value ? $text_field_value : '',
        'label' => __( 'Custom text', 'brand-extra' ),
        'helps' => __( 'Set a text to display inside a button when display this attachment inside a gallery', 'brand-extra' )
    );
    return $form_fields;
	}

	public function save_attachment_fields( $attachment_id ) {
    if ( isset( $_REQUEST['attachments'][$attachment_id]['custom_url'] ) ) {
        $custom_url = esc_url_raw( $_REQUEST['attachments'][$attachment_id]['custom_url'] );
        update_post_meta( $attachment_id, 'custom_url', $custom_url );
    }
		if ( isset( $_REQUEST['attachments'][$attachment_id]['custom_text'] ) ) {
        $custom_text = sanitize_text_field( $_REQUEST['attachments'][$attachment_id]['custom_text'] );
        update_post_meta( $attachment_id, 'custom_text', $custom_text );
    }
	}

	public function gallery_styles( $col_width ) {
		$tablet = apply_filters( 'brand_tablet_breakpoint', '1024px' );
		$mobile = apply_filters( 'brand_mobile_breakpoint', '640px' );
		$tablet_breakpoint = intval( $tablet );
		$breakpoint_unit = str_replace( $tablet_breakpoint, '', $tablet );
		$desktop_breakpoint = $tablet_breakpoint + 1 . $breakpoint_unit;
		$output = '';
		$output .= '@media (min-width:' . $desktop_breakpoint . ') {
			.brand-gallery .gallery-item {
				max-width:' . $col_width . '%;
				flex: 0 0 ' . $col_width . '%;
			}
		}';

		$output .= '@media (max-width:' . $tablet . ') {
			.brand-gallery .gallery-item {
				max-width: 50%;
				flex: 0 0 50%;
			}
		}';

		$output .= '@media (max-width:' . $mobile . ') {
			.brand-gallery .gallery-item {
				max-width: 100%;
				flex: 0 0 100%;
			}
		}';
		return $output;
	}

	public function gallery_scripts() {
		wp_add_inline_style( 'brand', $this->gallery_styles );
	}
}

$brand_gallery_shortcode = Brand_Gallery_Shortcode::get_instance();
