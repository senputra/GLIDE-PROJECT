<?php
/**
 * The plugin page view - the "settings" page of the plugin.
 *
 * @package brand-extra
 */

namespace Brand_Extra;

?>

<div class="wrap">
	<h2 class="plugin-title"> <?php echo esc_html( 'Brand Extensions' ); ?> </h2> <?php
	if ( class_exists( 'Brand_Plugin_Installer' ) ) { ?>
		<div class="be-plugin-installer"> <?php
			\Brand_Plugin_Installer::init( $this->free_brand_plugins );
			\Brand_Plugin_Installer::init_no_wp( $this->no_wp_plugins ); ?>
		</div>

		<h2 class="plugin-title"> <?php echo esc_html_e( 'Recommended Plugins' ); ?> </h2>
		<div class="be-plugin-installer"> <?php
			\Brand_Plugin_Installer::init( $this->free_rec_plugins ); ?>
		</div> <?php
	} ?>

</div>
