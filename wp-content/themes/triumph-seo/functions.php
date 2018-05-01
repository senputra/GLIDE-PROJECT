<?php
/**
 * triumph Lite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package triumph Lite
 */

if ( ! function_exists( 'triumph_seo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function triumph_seo_setup() {
    /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on triumph, use a find and replace
	 * to change 'triumph-seo' to the name of your theme in all the template files.
	 */
    load_theme_textdomain( 'triumph-seo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'triumph-seo-related', 200, 125, true ); //related

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'triumph-seo' ),
   ) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
   ) );

	// Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'triumph_seo_custom_background_args', array(
    'default-color' => '#eee',
    'default-image' => '',
    ) ) );
}
endif;
add_action( 'after_setup_theme', 'triumph_seo_setup' );

function triumph_seo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'triumph_seo_content_width', 678 );
}
add_action( 'after_setup_theme', 'triumph_seo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function triumph_seo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'triumph-seo' ),
		'id'            => 'sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
   ) );

    // First Top Widget 
  register_sidebar( array(
    'name'          => __( 'Top Widget 1', 'triumph-seo' ),
    'description'   => __( 'First Top Widget Column', 'triumph-seo' ),
    'id'            => 'top-widget-first',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );


    // Second Top Widget 
  register_sidebar( array(
    'name'          => __( 'Top Widget 2', 'triumph-seo' ),
    'description'   => __( 'Second Top Widget Column', 'triumph-seo' ),
    'id'            => 'top-widget-second',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );

    // Third Top Widget 
  register_sidebar( array(
    'name'          => __( 'Top Widget 3', 'triumph-seo' ),
    'description'   => __( 'Third Top Widget Column', 'triumph-seo' ),
    'id'            => 'top-widget-third',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );


    // First Footer 
  register_sidebar( array(
    'name'          => __( 'Footer 1', 'triumph-seo' ),
    'description'   => __( 'First footer column', 'triumph-seo' ),
    'id'            => 'footer-first',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );

	// Second Footer 
  register_sidebar( array(
    'name'          => __( 'Footer 2', 'triumph-seo' ),
    'description'   => __( 'Second footer column', 'triumph-seo' ),
    'id'            => 'footer-second',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );

	// Third Footer 
  register_sidebar( array(
    'name'          => __( 'Footer 3', 'triumph-seo' ),
    'description'   => __( 'Third footer column', 'triumph-seo' ),
    'id'            => 'footer-third',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'triumph_seo_widgets_init' );

function triumph_seo_custom_sidebar() {
  $sidebar = 'sidebar';
  return $sidebar;
}

/**
 * Load Upsell Button In Customizer
 * 2016 &copy; [Justin Tadlock](http://justintadlock.com).
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/upgrade/class-customize.php' );

/**
 * Enqueue scripts and styles.
 */
function triumph_seo_scripts() {
	wp_enqueue_style( 'triumph-seo-style', get_stylesheet_uri() );

	$handle = 'triumph-seo-style';

  wp_enqueue_script( 'triumph-seo-customscripts-jquery', get_template_directory_uri() . '/js/customscripts.js',array('jquery'),'',true); 

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'triumph_seo_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Custom Comments template
 */
if ( ! function_exists( 'triumph_seo_comments' ) ) {
	function triumph_seo_comment($comment, $args, $depth) { ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div id="comment-<?php comment_ID(); ?>" style="position:relative;" itemscope itemtype="http://schema.org/UserComments">
    <div class="comment-author vcard">
     <?php echo get_avatar( $comment->comment_author_email, 70 ); ?>
     <div class="comment-metadata">
      <?php printf('<span class="fn" itemprop="creator" itemscope itemtype="http://schema.org/Person">%s</span>', get_comment_author_link()) ?>
      <span class="comment-meta">
        <?php edit_comment_link(__('(Edit)', 'triumph-seo'),'  ','') ?>
      </span>
    </div>
  </div>
  <?php if ($comment->comment_approved == '0') : ?>
  <em><?php esc_html_e('Your comment is awaiting moderation.', 'triumph-seo') ?></em>
  <br />
<?php endif; ?>
<div class="commentmetadata" itemprop="commentText">
 <?php comment_text() ?>
 <time><?php comment_date(get_option( 'date_format' )); ?></time>
 <span class="reply">
  <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
</span>
</div>
</div>
</li>
<?php }
}

/*
 * Excerpt
 */
function triumph_seo_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt);
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/**
 * Shorthand function to check for more tag in post.
 *
 * @return bool|int
 */
function triumph_seo_post_has_moretag() {
  return strpos( get_the_content(), '<!--more-->' );
}

if ( ! function_exists( 'triumph_seo_readmore' ) ) {
    /**
     * Display a "read more" link.
     */
    function triumph_seo_readmore() {
      ?>
      <div class="readMore">
        <a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
          <?php esc_html_e( 'Read More', 'triumph-seo' ); ?>
        </a>
      </div>
      <?php 
    }
  }

/**
 * Breadcrumbs
 */
if (!function_exists('triumph_seo_the_breadcrumb')) {
  function triumph_seo_the_breadcrumb() {
    if ( is_front_page() ) {
      return;
    }
    echo '<span typeof="v:Breadcrumb" class="root"><a rel="v:url" property="v:title" href="';
    echo esc_url( home_url() );
    echo '">'.esc_html(sprintf( __( "Home", 'triumph-seo' )));
    echo '</a></span><span><i class="triumph-icon icon-angle-double-right"></i></span>';
    if (is_single()) {
      $categories = get_the_category();
      if ( $categories ) {
        $level = 0;
        $hierarchy_arr = array();
        foreach ( $categories as $cat ) {
          $anc = get_ancestors( $cat->term_id, 'category' );
          $count_anc = count( $anc );
          if (  0 < $count_anc && $level < $count_anc ) {
            $level = $count_anc;
            $hierarchy_arr = array_reverse( $anc );
            array_push( $hierarchy_arr, $cat->term_id );
          }
        }
        if ( empty( $hierarchy_arr ) ) {
          $category = $categories[0];
          echo '<span typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></span><span><i class="triumph-icon icon-angle-double-right"></i></span>';
        } else {
          foreach ( $hierarchy_arr as $cat_id ) {
            $category = get_term_by( 'id', $cat_id, 'category' );
            echo '<span typeof="v:Breadcrumb"><a href="'. esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></span><span><i class="triumph-icon icon-angle-double-right"></i></span>';
          }
        }
      }
      echo "<span><span>";
      the_title();
      echo "</span></span>";
    } elseif (is_page()) {
      $parent_id  = wp_get_post_parent_id( get_the_ID() );
      if ( $parent_id ) {
        $breadcrumbs = array();
        while ( $parent_id ) {
          $page = get_page( $parent_id );
          $breadcrumbs[] = '<span typeof="v:Breadcrumb"><a href="'.esc_url( get_permalink( $page->ID ) ).'" rel="v:url" property="v:title">'.esc_html( get_the_title($page->ID) ). '</a></span><span><i class="triumph-icon icon-angle-double-right"></i></span>';
          $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse( $breadcrumbs );
        foreach ( $breadcrumbs as $crumb ) { echo esc_html($crumb); }
      }
      echo "<span><span>";
      the_title();
      echo "</span></span>";
    } elseif (is_category()) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $this_cat_id = $cat_obj->term_id;
      $hierarchy_arr = get_ancestors( $this_cat_id, 'category' );
      if ( $hierarchy_arr ) {
        $hierarchy_arr = array_reverse( $hierarchy_arr );
        foreach ( $hierarchy_arr as $cat_id ) {
          $category = get_term_by( 'id', $cat_id, 'category' );
          echo '<span typeof="v:Breadcrumb"><a href="'.esc_url( get_category_link( $category->term_id ) ).'" rel="v:url" property="v:title">'.esc_html( $category->name ).'</a></span><span><i class="triumph-icon icon-angle-double-right"></i></span>';
        }
      }
      echo "<span><span>";
      single_cat_title();
      echo "</span></span>";
    } elseif (is_author()) {
      echo "<span><span>";
      if(get_query_var('author_name')) :
        $curauth = get_user_by('slug', get_query_var('author_name'));
      else :
        $curauth = get_userdata(get_query_var('author'));
      endif;
      echo esc_html( $curauth->nickname );
      echo "</span></span>";
    } elseif (is_search()) {
      echo "<span><span>";
      the_search_query();
      echo "</span></span>";
    } elseif (is_tag()) {
      echo "<span><span>";
      single_tag_title();
      echo "</span></span>";
    }
  }
}


/*
 * Google Fonts
 */
function triumph_seo_fonts_url() {
  $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Monda, translate this to 'off'. Do not translate
    * into your own language.
    */
    $monda = _x( 'on', 'Monda font: on or off', 'triumph-seo' );

    if ( 'off' !== $monda ) {
      $font_families = array();

      if ( 'off' !== $monda ) {
        $font_families[] = urldecode('Roboto:300,400,500,700,900');
      }

      $query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),
            //'subset' => urlencode( 'latin,latin-ext' ),
        );

      $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }

    return $fonts_url;
  }

  function triumph_seo_scripts_styles() {
    wp_enqueue_style( 'triumph-seo-fonts', triumph_seo_fonts_url(), array(), null );
  }
  add_action( 'wp_enqueue_scripts', 'triumph_seo_scripts_styles' );

/**
 * WP Mega Menu Plugin Support
 */
function triumph_seo_megamenu_parent_element( $selector ) {
  return '.primary-navigation .container';
}
add_filter( 'wpmm_container_selector', 'triumph_seo_megamenu_parent_element' );


/**
 * Post Layout for Archives
 */
if ( ! function_exists( 'triumph_seo_archive_post' ) ) {
    /**
     * Display a post of specific layout.
     * 
     * @param string $layout
     */
    function triumph_seo_archive_post( $layout = '' ) { 
     ?>
     <article class="post excerpt">

       <?php if ( has_post_thumbnail() ) { ?>
       <div class="post-blogs-container-thumbnails">
         <?php } else { ?>
         <div class="post-blogs-container">
           <?php } ?>

           <?php if ( empty($triumph_seo_full_posts) ) : ?>


           <?php if ( has_post_thumbnail() ) { ?>
           <div class="featured-thumbnail-container">
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" id="featured-thumbnail">
              <?php  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');  
              echo '<div class="blog-featured-thumbnail" style="background-image:url('.esc_url($featured_img_url).')"></div>';
              ?>
            </a>
          </div>
          <div class="thumbnail-post-content">
            <?php } else { ?>
            <div class="nothumbnail-post-content">
              <?php } ?>


              <h2 class="title">
                <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
              </h2>

              <span class="entry-meta">
                <?php echo get_the_date(); ?>
                <?php
                if ( is_sticky() && is_home() && ! is_paged() ) {
                  printf( ' / <span class="sticky-text">%s</span>', __( 'Featured', 'triumph-seo' ) );
                } ?>
              </span>
              <div class="post-content">
                <?php echo esc_html(triumph_seo_excerpt(50)); ?>...
              </div>
            <?php else : ?>
            <?php if (triumph_seo_post_has_moretag()) : ?>
            <?php triumph_seo_readmore(); ?>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>

  </article>
  <?php }
}



/**
 * Triumph SEO Links Page
 */
add_action( 'admin_menu', 'creative_gem_subpage_sidebar' );
function creative_gem_subpage_sidebar() {
  add_theme_page( __('Triumph SEO Links', 'triumph-seo'), __('Triumph SEO Links', 'triumph-seo'), 'edit_theme_options', 'creative_gem-subpage.php', 'creative_gem_subpage_contents');
}

function creative_gem_subpage_contents(){ ?>


<div class="wrap">
  <div class="welcome-panel">
    <div class="welcome-panel-content">
      <h1><strong><?php echo __('Get Started With Triumph SEO', 'triumph-seo') ?></strong>

      </h1>
      <p class="about-description"><?php echo __('Here is some links to help you get going with the theme!', 'triumph-seo') ?></p>
      <div class="welcome-panel-column-container">
        <div class="welcome-panel-column">
          <h3><?php echo __('Helpdesk and Feedback', 'triumph-seo') ?></h3>
          <a class="button button-primary button-hero" target="_blank" href="<?php echo esc_url('http://businessclassthemes.com/contact/') ?>"><?php echo __('Theme Help And Feedback', 'triumph-seo') ?></a>
        </div>
        <div class="welcome-panel-column">
          <h3><?php echo __('Triumph SEO Pro', 'triumph-seo') ?></h3>
          <a class="button button-primary button-hero" target="_blank" href="<?php echo esc_url('http://businessclassthemes.com/triumph-seo/') ?>"><?php echo __('View Pro Features', 'triumph-seo') ?></a>
        </div>
        <div class="welcome-panel-column">
          <h3><?php echo __('Triumph SEO Demo', 'triumph-seo') ?></h3>
          <a class="button button-primary button-hero" target="_blank" href="<?php echo esc_url('http://businessclassthemes.com/themes/triumph-seo/') ?>"><?php echo __('View Demo', 'triumph-seo') ?></a>
        </div>
      </div>

      <p>&nbsp;</p>

      <p class="hide-if-no-customize">
        <?php echo __('In case you did not find what you were looking for, you can visit our website', 'triumph-seo') ?>
        <a href="<?php echo esc_url('http://businessclassthemes.com/triumph-seo/') ?>" target="_blank"><?php echo __('here.', 'triumph-seo') ?></a></p>
      </div>

    </div>
  </div>
  <?php }


