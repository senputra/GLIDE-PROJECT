<?php
/**
 * Default theme options.
 *
 * @package Interserver Blog
 */
 
// Preloader
function interserver_blog_preloader(){ ?>
  <div class="ib-loader">
    <div class="cube-folding">
    <span class="leaf1"></span>
    <span class="leaf2"></span>
    <span class="leaf3"></span>
    <span class="leaf4"></span>
  </div>
  </div>
<?php }
add_action('interserver_blog_before_site', 'interserver_blog_preloader');

// Custom Excerpt
function interserver_blog_custom_excerpt() {
  global $ib_default;
  $limit = get_theme_mod('excerpt_length', $ib_default['excerpt_length']);
  $excerpt = explode(' ', strip_tags(get_the_content()), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
 
// Get images alt
function interserver_blog_get_image_alt( $image ) {
    global $wpdb;
    if( empty( $image ) ) {
        return false;
    }
    $img_id = attachment_url_to_postid($image);
    $alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
    return $alt;
}

// Get Post layout
function interserver_blog_post_layout() {
	global $ib_default;
	$layout = get_theme_mod('post_layout', $ib_default['post_layout']);
	return $layout;
}

// Get Categories in featured categories dropdown
function ib_cats() {
  $cats = array();
  foreach ( get_categories() as $categories => $category ) {
    $cats[$category->term_id] = $category->name;
  }
  return $cats;
}
