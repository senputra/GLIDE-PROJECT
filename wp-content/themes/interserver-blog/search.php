<?php
/**
 * The template for displaying search results pages.
 *
 * @package Interserver Blog
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
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title"><?php 
				/* translators: %s: search-term */
				echo sprintf(__( 'Search Results for: %s', 'interserver-blog' ), '<span>' . get_search_query() . '</span>'); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>
			<?php the_posts_navigation(); ?>

		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
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
