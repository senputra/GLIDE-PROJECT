<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Interserver Blog
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">   
		<h1 class="page-title"><?php the_title();?></h1>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'interserver-blog' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'interserver-blog' ), '<span class="edit-link">', '</span>' ); ?>	
	</div><!-- .entry-footer -->
</article><!-- #post-## -->

