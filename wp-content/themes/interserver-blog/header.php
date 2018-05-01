<?php 
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Interserver Blog
 */
?>
<?php
	/**
	 * Hook - interserver_blog_action_doctype.
	 *
	 * @hooked interserver_blog_doctype -  10
	 */
	do_action( 'interserver_blog_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - interserver_blog_action_head.
	 *
	 * @hooked interserver_blog_head -  10
	 */
	do_action( 'interserver_blog_action_head' );
	?>

<?php wp_head(); ?>
</head>


<body <?php body_class();?>>
	<?php
	/**
	 * Hook - interserver_blog_before_site.
	 *
	 * @hooked interserver_blog_preloader 
	 */
	do_action( 'interserver_blog_before_site' );
	?>
	<?php
	/**
	 * Hook - interserver_blog_action_before_page.
	 *
	 * @hooked interserver_blog_page_start 
	 */
	do_action( 'interserver_blog_action_before_page' );
	?>
    
    <?php
	/**
	 * Hook - interserver_blog_action_before.
	 *
	 * @hooked interserver_blog_skip_to_content 
	 */
	do_action( 'interserver_blog_action_before' );
	?>
    <?php
	 /**
	  * Hook - interserver_blog_action_before_header.
	  *
	  * @hooked interserver_blog_header_top_bar - 5
	  * @hooked interserver_blog_header_start - 10
	 */
	do_action( 'interserver_blog_action_before_header' );
	?>

    <?php
	 /**
	  * Hook - interserver_blog_action_header.
	  *
	  * @hooked interserver_blog_site_header 
	 */
	do_action( 'interserver_blog_action_header' );
	?>
    
	<?php
	 /**
	  * Hook - interserver_blog_action_after_header.
	  *
	  * @hooked interserver_blog_header_end - 5 
	  * @hooked interserver_blog_display_featured_header - 10
	 */
	do_action( 'interserver_blog_action_after_header' );
	?>
       
     <?php
	 /**
	  * Hook - interserver_blog_action_before_content
	  *
	  * @hooked interserver_blog_content_start
	 */
	do_action( 'interserver_blog_action_before_content' );
	?>
	