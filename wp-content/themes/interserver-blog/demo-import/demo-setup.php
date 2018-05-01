<?php
/*
/**
 * Functions to provide support for the One Click Demo Import plugin (wordpress.org/plugins/one-click-demo-import)
 *
 * @package Interserver Blog
 */

/*Import demo data*/
if ( ! function_exists( 'interserver_blog_demo_import_files' ) ) :
function interserver_blog_demo_import_files() {
    return array(
        array(
            'import_file_name'             => 'Interserver Blog Demo',
            'local_import_file'            => trailingslashit( get_template_directory() ) . '/demo-import/ib-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/demo-import/ib-widgets.wie',
            'import_notice'                => __( 'Please waiting for a few minutes, do not close the window or refresh the page until the data is imported.', 'interserver-blog' ),
        ),
		);
}
add_filter( 'pt-ocdi/import_files', 'interserver_blog_demo_import_files' );
endif;

/**
 * Action that happen after import
 */
if ( ! function_exists( 'interserver_blog_after_demo_import' ) ) :
function interserver_blog_after_demo_import( $selected_import ) {
    if ( 'Interserver Blog Demo' === $selected_import['import_file_name'] ) {
        //Set Menu
        $primary_menu = get_term_by('name', 'Main Menu', 'nav_menu');
        set_theme_mod( 'nav_menu_locations' , array( 
              'primary' => $primary_menu->term_id
             ) 
        );
    }
    
}
add_action( 'pt-ocdi/after_import', 'interserver_blog_after_demo_import' );
endif;

/**
* Remove branding
*/
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );