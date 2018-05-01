<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Interserver Blog
 */

get_header();

  $fullwidth = '';
  if (get_theme_mod('fullwidth_blog',$ib_default['fullwidth_blog'])) { //Check if the post needs to be full width
    $fullwidth = 'fullwidth';
  } else {
    $fullwidth = '';
  } 
?>

	<div id="primary" class="content-area <?php echo esc_attr( $fullwidth );?>">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found">
				<header class="page-header">
					<div class="fourofour"><label><?php esc_html_e( '404', 'interserver-blog' ); ?></label></div>
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'interserver-blog' ); ?></h1>
				</header><!-- .page-header -->
				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'interserver-blog' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
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

