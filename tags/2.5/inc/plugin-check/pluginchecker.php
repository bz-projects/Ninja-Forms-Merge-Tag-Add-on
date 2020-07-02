<?php 

if (!function_exists('check_ninja_forms') ) {

	// If Ninja Foms isn't installed 
	function check_ninja_forms() {
		if ( !is_plugin_active('ninja-forms/ninja-forms.php') ) {
			add_action( 'admin_notices', 'ninja_form_no_installed' );
		} 
	}
	add_action( 'admin_init', 'check_ninja_forms' );
}