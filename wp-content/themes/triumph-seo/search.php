<?php
/**
 * The template for displaying search results pages.
 *
 * @package triumph Lite
 */

get_header(); ?>
	<div id="page" class="search-area">
		<div class="article">
			<?php if ( have_posts() ) :
				$triumph_seo_full_posts = get_theme_mod('triumph_seo_full_posts');
				while ( have_posts() ) : the_post();
					triumph_seo_archive_post();
				endwhile;
				triumph_seo_post_navigation();
			else : ?>
				<div class="single_post clear">
					<article id="content" class="article page">
						<header>
							<h1 class="title"><?php esc_html_e( 'Nothing Found', 'triumph-seo' ); ?></h1>
						</header>
						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'triumph-seo' ); ?></p>
						<?php get_search_form(); ?>
					</article>
				</div>
			<?php endif; ?>
		</div><!-- .article -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>
