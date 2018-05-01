<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Interserver Blog
 */

get_header(); ?>

<div id="primary" class="content-area col-md-9">
	<main id="main" class="post-wrap" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
            <?php get_template_part( 'template-parts/content', 'page' ); ?>
            <?php
            // If comments are open or we have at least one comment, load up the comment template
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>
            <?php endwhile; // end of the loop. ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
    /**
     * Hook - interserver_blog_action_sidebar.
     *
     * @hooked: interserver_blog_add_sidebar_widget_area
     */
    do_action( 'interserver_blog_action_sidebar' );
?>

<?php get_footer();?>