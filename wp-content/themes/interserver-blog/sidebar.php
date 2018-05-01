<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Interserver Blog

 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area col-md-3" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->

<?php
if (   is_active_sidebar( 'footer-1'  )
    && is_active_sidebar( 'footer-2' )
    && is_active_sidebar( 'footer-3'  )
    && is_active_sidebar( 'footer-4' )
) : ?>
 
<div id="footer-widgets" class="footer-widgets widget-area" role="complementary">
		<div class="container">
		<div class="row">

    <div class="first quarter left widget-area">
        <?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
    </div><!-- .first .widget-area -->
 
    <div class="second quarter widget-area">
        <?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
    </div><!-- .second .widget-area -->
 
    <div class="third quarter widget-area">
        <?php dynamic_sidebar( 'third-footer-widget-area' ); ?>
    </div><!-- .third .widget-area -->
 
    <div class="fourth quarter right widget-area">
        <?php dynamic_sidebar( 'fourth-footer-widget-area' ); ?>
    </div><!-- .fourth .widget-area -->
</div>
		</div>	
	</div>