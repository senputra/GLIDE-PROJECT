<?php
/**
 * The template for displaying all single posts.
 *
 * @package Interserver Blog
 */
get_header(); ?>

	<?php 
	$fullwidth = '';
	if (get_theme_mod('fullwidth_single',$ib_default['fullwidth_single'])) { //Check if the post needs to be full width
		$fullwidth = 'fullwidth';
	} else {
		$fullwidth = '';
	} ?>

	<?php do_action('interserver_blog_before_content'); ?>

	<div id="primary" class="content-area <?php echo esc_attr($fullwidth); ?>">
		<main id="main" class="blog-wrapper" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'single' ); ?>
			<?php interserver_blog_post_navigation(); ?>
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( get_theme_mod('fullwidth_single', $ib_default['fullwidth_single']) == $ib_default['fullwidth_single'] ) :
	/**
	 * Hook - interserver_blog_action_sidebar.
	 *
	 * @hooked: interserver_blog_add_sidebar_widget_area
	 */
	do_action( 'interserver_blog_action_sidebar' );
endif;
get_footer(); ?>