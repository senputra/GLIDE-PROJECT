var be_installer = be_installer || {};

jQuery(document).ready(function($) {

	"use strict";

	var is_loading = false;



	/*
   *  install_plugin
   *  Install the plugin
   *
   *
   *  @param el       object Button element
   *  @param plugin   string Plugin slug
   *  @since 1.0
   */

	be_installer.install_plugin = function(el, plugin){

   	// Confirm activation
   	var r = confirm(be_installer_localize.install_now);

      if (r) {

         is_loading = true;
         el.addClass('installing');

      	$.ajax({
	   		type: 'POST',
	   		url: be_installer_localize.ajax_url,
	   		data: {
	   			action: 'be_plugin_installer',
	   			plugin: plugin,
	   			nonce: be_installer_localize.admin_nonce,
	   			dataType: 'json'
	   		},
	   		success: function(data) {
		   		if(data){
			   		if(data.status === 'success'){
				   		el.attr('class', 'activate button button-primary');
				   		el.html(be_installer_localize.activate_btn);
			   		} else {
			   			el.removeClass('installing');
		   			}
		   		} else {
						el.removeClass('installing');
		   		}
		   		is_loading = false;
	   		},
	   		error: function(xhr, status, error) {
	      		console.log(status);
	      		el.removeClass('installing');
	      		is_loading = false;
	   		}
	   	});

   	}
	}



	/*
   *  activate_plugin
   *  Activate the plugin
   *
   *
   *  @param el       object Button element
   *  @param plugin   string Plugin slug
   *  @since 1.0
   */

	be_installer.activate_plugin = function(el, plugin){

      $.ajax({
   		type: 'POST',
   		url: be_installer_localize.ajax_url,
   		data: {
   			action: 'be_plugin_activation',
   			plugin: plugin,
   			nonce: be_installer_localize.admin_nonce,
   			dataType: 'json'
   		},
   		success: function(data) {
	   		if(data){
		   		if(data.status === 'success'){
			   		el.attr('class', 'installed button disabled');
			   		el.html(be_installer_localize.installed_btn);
		   		}
	   		}
	   		is_loading = false;
   		},
   		error: function(xhr, status, error) {
      		console.log(status);
      		is_loading = false;
   		}
   	});

	};

	/*
   *  activate_plugin_no_wp
   *  Activate the plugin that isn't in the WP repo.
   *
   *
   *  @param el       object Button element
   *  @param plugin   string Plugin slug
   *  @since 1.0
   */

	be_installer.activate_plugin_no_wp = function(el, plugin){

      $.ajax({
   		type: 'POST',
   		url: be_installer_localize.ajax_url,
   		data: {
   			action: 'be_no_wp_plugin_activation',
   			plugin: plugin,
   			nonce: be_installer_localize.admin_nonce,
   			dataType: 'json'
   		},
   		success: function(data) {
	   		if(data){
					console.log(data.status);
		   		if( data.status === 'success'){
			   		el.attr('class', 'installed button disabled');
			   		el.html(be_installer_localize.installed_btn);
		   		}
	   		}
	   		is_loading = false;
   		},
   		error: function(xhr, status, error) {
					console.log(status);
      		is_loading = false;
   		}
   	});

	};



	/*
   *  Install/Activate Button Click
   *
   *  @since 1.0
   */

	$(document).on('click', '.be-plugin-installer a.button:not(.no-wp-activation):not(.no-wp-link)', function(e){
   	var el = $(this),
   		 plugin = el.data('slug');

   	e.preventDefault();

   	if(!el.hasClass('disabled')){

      	if(is_loading) return false;

	   	// Installation
      	if(el.hasClass('install')){
	      	be_installer.install_plugin(el, plugin);
	   	}

	   	// Activation
	   	if(el.hasClass('activate')){
		   	be_installer.activate_plugin(el, plugin);
		   }
   	}
	});

	/*
   *  Install/Activate Button Click for no wp plugins
   *
   *  @since 1.0
   */

	$(document).on('click', 'a.button.no-wp-activation', function(e){
   	var el = $(this),
   		 plugin = el.data('slug');

   	e.preventDefault();

   	if(!el.hasClass('disabled')){

      	if(is_loading) return false;

	   	// Activation
	   	if(el.hasClass('activate')){
		   	be_installer.activate_plugin_no_wp(el, plugin);
		   }
   	}
	});


});
