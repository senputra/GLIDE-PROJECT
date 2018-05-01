<?php
/**
 * The main template file.
 */

get_header(); 
?>
<?php 
  $fullwidth = '';
  if (get_theme_mod('fullwidth_blog',$ib_default['fullwidth_blog'])) { //Check if the post needs to be full width
    $fullwidth = 'fullwidth';
  } else {
    $fullwidth = '';
  } ?>

  <div id="primary" class="content-area <?php echo esc_attr(interserver_blog_post_layout()) .' '. esc_attr( $fullwidth );?>">
    <main id="main" class="blog-wrapper" role="main">
    <?php if (have_posts()) : ?>
    <section id="posts">
    <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part( 'template-parts/content', get_post_format() );?>
        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || get_comments_number() ) :
        comments_template();
        endif;
    endwhile; ?>
   </section>
   <?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav class="load_more">
      <?php next_posts_link( 'Load More' ); ?>
    </nav>
    <?php endif; ?>
  <?php else : ?>
    <?php get_template_part( 'template-parts/content', 'none' ); ?>
  <?php endif; ?>
  <div class="clear"></div>
  <div class="featured-cat"><?php interserver_blog_featured_cat_grid();?></div>
  </main><!-- #main -->
</div><!-- #primary -->
  
<?php if ( get_theme_mod('fullwidth_blog', $ib_default['fullwidth_blog']) != $ib_default['fullwidth_blog'] ) :
  /**
   * Hook - interserver_blog_action_sidebar.
   *
   * @hooked: interserver_blog_add_sidebar_widget_area
   */
  do_action( 'interserver_blog_action_sidebar' );
  endif;
?>
<?php get_footer(); ?>