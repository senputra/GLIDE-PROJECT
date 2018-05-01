<?php /* Template Name: People of APSN template */ 



$brand_settings = wp_parse_args(
    get_option( 'brand_settings', array() ),
    brand_get_defaults()
);

get_header('page');

if( is_front_page() && 'slider' === $brand_settings['header_type_front'] ) {
	get_header( 'slider' );
} else {
	get_header( 'page' );
}

do_action( 'brand_before_singular_content' ); ?>

<div id="primary" class="container content-area">
	<main id="main" class="row site-main" role="main">
		<div id="primary-content">
			<div class="brand-grid">
		<?php
		while ( have_posts() ) : the_post();

		do_action( 'brand_inside_singular_content_above' );

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>
			</div> <!-- .brand-grid -->
    </div> <!-- #primary-content -->

    <div id="secondary-content">
       <?php brand_get_sidebar(); ?>
	  </div>	<!-- #secondary-content -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();?>
