 <?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the <div id="content"> and all content after
 *
 * @package Interserver Blog
 */
?>
<?php
	/**
	 * Hook - interserver_blog_action_after_content.
	 *
	 * @hooked interserver_blog_content_end 
	 */
	do_action( 'interserver_blog_action_after_content' );
?>

  <?php
	/**
	 * Hook - interserver_blog_action_after.
	 *
	 * @hooked interserver_blog_footer_go_to_top - 10
	 */
	do_action( 'interserver_blog_action_after' );
?>

	<?php
	/**
	 * Hook - interserver_blog_action_before_footer.
	 *
	 * @hooked interserver_blog_footer_start - 5
	 * @hooked interserver_blog_footer_widget_area - 10
	 */
	do_action( 'interserver_blog_action_before_footer' );
	?>
   
	<?php
	/**
	 * Hook - interserver_blog_action_footer.
	 *
	 * @hooked interserver_blog_footer_copyright -5
	 */
	do_action( 'interserver_blog_action_footer' );
	?>
   

    <?php
	/**
	 * Hook - interserver_blog_action_after_footer.
	 *
	 * @hooked interserver_blog_footer_end - 10
	 */
	do_action( 'interserver_blog_action_after_footer' );
	?>
    
     
    <?php
	/**
	 * Hook - interserver_blog_action_after_page.
	 *
	 * @hooked interserver_blog_page_end - 10
	 */
	do_action( 'interserver_blog_action_after_page' );
?>
<?php wp_footer(); ?>
</body>
</html>