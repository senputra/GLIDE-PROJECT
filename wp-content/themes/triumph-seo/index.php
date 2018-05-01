<?php
/**
 * The main template file.
 *
 * Used to display the homepage when home.php doesn't exist.
 */
?>
<?php get_header(); ?>
	<div id="page" class="home-page">
		<div class="article">
			<?php if ( have_posts() ) :
				$triumph_seo_full_posts = get_theme_mod('triumph_seo_full_posts');
				while ( have_posts() ) : the_post();
					triumph_seo_archive_post();
				endwhile;
				triumph_seo_post_navigation();
			endif; ?>
		</div><!-- .article -->
		<?php get_sidebar(); ?>
		</div>
		<?php get_footer(); ?>
