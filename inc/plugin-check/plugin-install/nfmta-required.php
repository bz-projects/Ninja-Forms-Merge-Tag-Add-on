<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for plugin Ninja Forms Merge Tag Addon
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

function nfmta_required_plugins_register_required_plugins() {

	$plugins = array(

		array(
			'name'      => 'Ninja Forms – The Easy and Powerful Forms Builder',
			'slug'      => 'ninja-forms',
			'required'  => true,
		)

	);

	$config = array(
		'id'           => 'nfmta',                 
		'default_path' => '',                      
		'menu'         => 'tgmpa-install-plugins', 
		'parent_slug'  => 'plugins.php',           
		'capability'   => 'manage_options',    		
		'has_notices'  => true,                    
		'dismissable'  => true,                    
		'dismiss_msg'  => '',                      
		'is_automatic' => false,                   
		'message'      => '',                      
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'nfmta_required_plugins_register_required_plugins' );