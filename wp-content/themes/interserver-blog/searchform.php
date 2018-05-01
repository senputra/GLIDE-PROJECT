<?php
/**
 * Template for displaying search forms
 *
 * @package Interserver Blog
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" id="s" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><span class="icon"><i class="fa fa-search"></i></span></button>
</form>