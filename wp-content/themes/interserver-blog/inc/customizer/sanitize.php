<?php

/**
 * Sanitize functions
 * @package Interserver Blog
 */

// Site Layout 
function interserver_blog_sanitize_site_layout( $input ){
    $choices = array(
        'boxed'     => __('Boxed', 'interserver-blog'),
        'fullwidth'   => __('Full Width', 'interserver-blog'),
    );
    if ( array_key_exists( $input, $choices ) ) {
        return $input;
    } else {
        return '';
    }
}
//Text
function interserver_blog_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function interserver_blog_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

//Sticky menu
function interserver_blog_sanitize_sticky_header( $input ) {
    $choices = array(
        'sticky'     => __('Sticky', 'interserver-blog'),
        'static'   => __('Static', 'interserver-blog'),
    );
    if ( array_key_exists( $input, $choices ) ) {
        return $input;
    } else {
        return '';
    }
}

// Slider Options 
function interserver_blog_sanitize_post_order( $input ) {
    $choices = array(
        'asc'     => __('Ascending', 'interserver-blog'),
        'desc'   => __('Descending', 'interserver-blog'),
    );
    if ( array_key_exists( $input, $choices ) ) {
        return $input;
    } else {
        return '';
    }
}

function interserver_blog_sanitize_post_orderby( $input ) {
    $choices = array(
        'none' => __('None', 'interserver-blog'),
        'date' => __('Date', 'interserver-blog'),
        'ID' => __('ID', 'interserver-blog'),
        'author' => __('Author', 'interserver-blog'),
        'title' => __('Title', 'interserver-blog'),
        'rand' => __('Random', 'interserver-blog')
    );
    if ( array_key_exists( $input, $choices ) ) {
        return $input;
    } else {
        return '';
    }
}

//Post layout

function interserver_blog_sanitize_post_layout( $input ) {
    $choices = array(
        'small_image' => __( 'Small Image Layout', 'interserver-blog' ),
        'large_image' => __( 'Large Image Layout', 'interserver-blog' ),

    );
    if ( array_key_exists( $input, $choices ) ) {
        return $input;
    } else {
        return '';
    }
}
//Slider Height
function interserver_blog_sanitize_slider_height( $input ) {
    $choices = array(
        'full'    => __('Full screen', 'interserver-blog'),
        'custom'    => __('Custom', 'interserver-blog'),
    );
    if ( array_key_exists( $input, $choices ) ) {
        return $input;
    } else {
        return '';
    }
}

// Category Dropdown 

function interserver_blog_sanitize_cat( $input ) {
    $valid = ib_cats();
    foreach ($input as $value) {
        if ( !array_key_exists( $value, $valid ) ) {
            return [];
        }
    }
    return $input;
}

//Menu style
function interserver_blog_sanitize_header_alignment( $input ) {
    $choices = array(
        'inline'     => __('Inline', 'interserver-blog'),
        'centered'   => __('Centered (menu and site logo)', 'interserver-blog'),
    );
    if ( array_key_exists( $input, $choices ) ) {
        return $input;
    } else {
        return '';
    }
}

//Checkboxes
function interserver_blog_sanitize_checkbox( $input ) {
    //returns true if checkbox is checked
    return ( ( isset( $input ) && true == $input ) ? true : false );
}

if ( ! function_exists( 'interserver_blog_sanitize_textarea_content' ) ) :

// Textarea
function interserver_blog_sanitize_textarea( $input, $setting ) {
	return ( stripslashes( wp_filter_post_kses( addslashes( $input ) ) ) );
}
endif;

//Footer widget areas
function interserver_blog_sanitize_footer_widget( $input ) {
    $choices = array(
        '1'     => __('One', 'interserver-blog'),
        '2'     => __('Two', 'interserver-blog'),
        '3'     => __('Three', 'interserver-blog'),
        '4'     => __('Four', 'interserver-blog')
    );
    if ( array_key_exists( $input, $choices ) ) {
        return $input;
    } else {
        return '';
    }
}