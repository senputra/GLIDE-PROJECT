<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interserver Blog
 */
?>

<?php 
	global $ib_default;
	$hide_meta_index = get_theme_mod( 'hide_meta_index',$ib_default['hide_meta_index'] );
	$full_content_archives = get_theme_mod( 'full_content_archives',$ib_default['full_content_archives'] );
	$full_content_home = get_theme_mod( 'full_content_home',$ib_default['full_content_home'] );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="title-post entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php
		if ( 'post' == get_post_type() && $hide_meta_index != $ib_default['hide_meta_index']) : ?>
		<div class="post-meta">
			<?php interserver_blog_posted_on(); ?>
		</div><!-- .post-cat -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-post">
		<?php
		if ( ($full_content_home == $ib_default['full_content_home'] && is_home() ) || ($full_content_archives == $ib_default['full_content_archives'] && is_archive() ) ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'interserver-blog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-post -->

	<footer class="entry-footer">
		<?php interserver_blog_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->