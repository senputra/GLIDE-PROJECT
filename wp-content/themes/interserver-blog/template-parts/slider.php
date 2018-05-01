<?php
/**
 * Slider template
 *
 * @package Interserver Blog
 */

//Slider template
if ( ! function_exists( 'interserver_blog_featured_header_template' ) ) :
function interserver_blog_featured_header_template() {
global $ib_default, $post;
 $hide_caption = get_theme_mod('hide_slider_caption', $ib_default['hide_slider_caption']);


 $site_layout = get_theme_mod('site_layout', $ib_default['site_layout']);
 if( $site_layout == 'fullwidth' ){
  $site_layout = 'fullwidth-slider';
 }

  if(is_front_page() && is_home()){
   $args = array(
        'post_type' => 'post',
        'posts_per_page' => get_theme_mod('slider_num_post'),
        'cat' =>  get_theme_mod('slider_cat'),
        'order' =>  get_theme_mod('slider_post_order'),
        'order_by' =>  get_theme_mod('slider_post_orderby'),
        'meta_query' => array( array(
        'key' => '_thumbnail_id'
       ) )
     );
  $slider_query = new WP_Query($args);
  if ($slider_query->have_posts()) :?>
                       <?php while ($slider_query->have_posts()) : $slider_query->the_post();
                         $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                         $img_arr[] = $thumb;
                     $id_arr[] = $post->ID; 
             endwhile;?>         
          <?php if(!empty($id_arr)){ ?>
            <section class="home_slider <?php echo esc_attr($site_layout);?>">
            <div class="slider-wrapper theme-default">
                   <div id="slider" class="nivoSlider">
                      <?php 
            $i=1;
            foreach($img_arr as $url){ if(!empty($url)){ ?>
            <img src="<?php echo esc_url($url[0]); ?>" title="#slidecaption<?php echo (int)$i; ?>" />
            <?php }
            $i++; } ?>
       
               </div>  
          
            <?php 
            if( ! $hide_caption ) :
            $i=1;
            foreach($id_arr as $id){ 
            $title = get_the_title( $id ); 
            $post_l = get_post($id); 
            setup_postdata( $post_l );
            ?>
            <div id="slidecaption<?php echo (int)$i;?>" class="nivo-html-caption">
              <div class="slider-inner">
                  <h2 class="slider-title"><?php echo esc_html($title);?></h2>
                  <a href="<?php echo esc_url(get_the_permalink());?>" class="ip-btn"><?php echo esc_html('Read More', 'interserver-blog');?></a>
              </div>
            </div>
            <?php $i++; } 
            endif;
            ?>       
    
          </div><!--slider_wrap-->
        </section><!--home_slider-->
 <?php }  endif; 
    }
}
endif;
// Call Custom Header
  interserver_blog_featured_header_template();

