<?php
/**
 * Custom template tags for this theme.
 *
 * @package Interserver Blog
 */

if ( ! function_exists( 'interserver_blog_post_navigation' ) ) :
function interserver_blog_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'interserver-blog' ); ?></h2>
		<div class="nav-links clearfix">
			<div class="nav-previous">
			<?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i> %title'); ?>
			</div>
			<div class="nav-next">
			<?php next_post_link('%link', '%title <i class="fa fa-long-arrow-right"></i>'); ?>
			</div>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
if ( ! function_exists( 'interserver_blog_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function interserver_blog_entry_footer() {
	$archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_date  = get_the_time('d'); 

	$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url(get_day_link($archive_year, $archive_month, $archive_date )),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date() ),
		esc_html( get_the_date() )
	);

	$byline = sprintf(
		/* translators: %s: post author */
		__( 'By %s', 'interserver-blog' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<div class="entry-meta"><span class="byline"> ' . wp_kses_data($byline) . '</span> <span class="posted-on">' . wp_kses_data($time_string). '</span>';
	
	echo '<div class="comments-likes">';
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'interserver-blog' ), __( '1 Comment', 'interserver-blog' ), __( '% Comments', 'interserver-blog' ) );
		echo '</span>';
	}
 if(function_exists('wp_ulike')){
 	wp_ulike('get');   
 }
 	echo "</div></div>";
}
endif;

if ( ! function_exists( 'interserver_blog_entry_header' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function interserver_blog_entry_header() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'interserver-blog' ) );
		if ( $categories_list && interserver_blog_categorized_blog() ) {
			/* translators: %s: category name */
			echo '<span class="cat-links">'. sprintf( esc_html__( ' %1$s', 'interserver-blog' ), wp_kses_data($categories_list)).'</span>';
		}
		$tags_list = get_the_tag_list( '', __( ', ', 'interserver-blog' ) );
		if ( $tags_list && is_single() ) {
			/* translators: %s: tag name */
			printf( '<span class="tags-links"><i class="fa fa-tags"></i>' . esc_html__( ' %1$s', 'interserver-blog' ) . '</span>', wp_kses_data($tags_list) );
		}
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function interserver_blog_categorized_blog() {
	if ( false === ( $cat_list = get_transient( 'interserver_blog_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$cat_list = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$cat_list = count( $cat_list );

		set_transient( 'interserver_blog_categories', $cat_list );
	}

	if ( $cat_list > 1 ) {
		// This blog has more than 1 category so interserver_blog_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so interserver_blog_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in interserver_blog_categorized_blog.
 */
function interserver_blog_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'interserver_blog_categories' );
}
add_action( 'edit_category', 'interserver_blog_category_transient_flusher' );
add_action( 'save_post',     'interserver_blog_category_transient_flusher' );