<?php
/**
 * @package Interserver Blog
 */
?>

<?php 
	global $ib_default;
	$index_feat_img = get_theme_mod( 'index_feat_image', $ib_default['index_feat_image'] );
	$full_content_archives = get_theme_mod( 'full_content_archives', $ib_default['full_content_archives'] );
	$full_content_home = get_theme_mod( 'full_content_home', $ib_default['full_content_home'] );
	$hide_meta_index = get_theme_mod( 'hide_meta_index', $ib_default['hide_meta_index'] );

 $add_thumb_class = '';
	if( $index_feat_img ) {
		$add_thumb_class = 'hide-thumb';
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($add_thumb_class); ?>>
	<div class="entry-header">
		<div class="post-cat">
			<?php interserver_blog_entry_header();?>
		</div><!-- .post-cat -->
		<?php the_title( sprintf( '<h3 class="title-post entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	</div><!-- .entry-header -->
	<?php

	if ( has_post_thumbnail() && ! $index_feat_img ) : ?>
	<div class="entry-thumb">
		<a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail();?></a>
	</div>
	<?php endif; ?>

	<div class="entry-post">
		<?php 
		if ( ($full_content_home && is_home() ) || $full_content_archives && is_archive() ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<?php echo esc_html(interserver_blog_custom_excerpt()); ?>
			<div class="read-more"><a href="<?php echo esc_url(get_permalink()). esc_html_e('Continue reading..!','interserver-blog');?>"></a></div>	
		<?php endif; ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'interserver-blog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-post -->

	<?php 
	if ( 'post' == get_post_type() && !$hide_meta_index ) : ?>
		<div class="entry-footer">
			<?php edit_post_link( __( 'Edit', 'interserver-blog' ), '<span class="edit-link">', '</span>' ); ?>
			<?php //interserver_blog_entry_footer();?>
		</div><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->