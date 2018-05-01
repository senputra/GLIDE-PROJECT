<?php
/**
 * @package Interserver Blog
 */
?>

<?php 
	global $ib_default;
	$post_feat_img = get_theme_mod( 'post_feat_image', $ib_default['post_feat_image'] );
	$hide_meta_single = get_theme_mod( 'hide_meta_single', $ib_default['hide_meta_single'] );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="post-cat">
			<?php interserver_blog_entry_header(); ?>
		</div><!-- .post-cat -->
		<?php the_title( '<h1 class="title-post entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php
	if ( has_post_thumbnail() && ! $post_feat_img  ) : ?>
		<div class="entry-thumb">
			<?php the_post_thumbnail('interserver-blog-large-thumb'); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'interserver-blog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php 
	if (! $hide_meta_single) : ?>	
		<div class="entry-footer">
			<?php interserver_blog_entry_footer();?>
		</div><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
