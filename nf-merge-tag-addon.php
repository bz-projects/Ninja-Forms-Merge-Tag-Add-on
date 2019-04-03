<?php
/*
Plugin Name: Ninja Forms Merge Tag Addon
Plugin URI:  https://wordpress.org/plugin/nf-merge-tag-addon/
Description: Add WordPress Tags to your Ninja Forms for the Admin Mail.
Version:     2.2
Text Domain: nfmta
Domain Path: /languages
Author:      Benjamin Zekavica
Author URI:  http://www.benjamin-zekavica.de
License:     GPL2

Ninja Forms Merge Tag Addon is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Ninja Forms Merge Tag Addon is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with Ninja Forms Merge Tag Addon. If not, see license.txt .


Copyright by:
(c) 2019 by Benjamin Zekavica. All rights reserved.

Imprint:
Benjamin Zekavica
Oranienstraße 12
52066 Aachen

E-Mail: info@benjamin-zekavica.de
Web: www.benjamin-zekavica.de

I don't give support by Mail. Please write in the
community forum for questions and problems.

--- Credits from Ninja Forms  ---
Ninja Forms Core: The WP Ninjas (wpninjasllc, Kevin Stover, James Laws,
Kyle B. Johnson, klhall1987, krmoorhouse, jmcelhaney and Zachary Skaggs)

*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Load Plugin Installation / Required Plugin 
require_once( plugin_dir_path( __FILE__ ). '/inc/nfmta-required.php' );

function ninja_form_no_installed() { ?>

	<div class="notice notice-error no-dismissible">
		<h2>Install & Activate Ninja Forms!</h2>
		<p>Please install Ninja Forms now. Click here: </p>
		<p>
			<a href="<?php echo admin_url( 'plugins.php?page=tgmpa-install-plugins');?>">Install & activate Ninja Forms now.</a>
		</p>
	</div>

<?php }

function nfmta_notice_no_plugin_support() { ?>

	<div class="notice notice-error no-dismissible">
		<h2>Ninja Forms Merge Tag Addon no support Ninja Forms in this Edition!</h2>
		<p>Please use different Editions of Ninja Forms or contact the Ninja Forms Team.</p>
		<p>
			<a href="<?php echo admin_url( 'plugins.php');?>">Deactivate this Plug-In now.</a>
		</p>
	</div>

<?php }

function check_ninja_forms() {
	if ( ! is_plugin_active('ninja-forms/ninja-forms.php') ) {
		add_action( 'admin_notices', 'ninja_form_no_installed' );
	} 
}
add_action( 'admin_init', 'check_ninja_forms' );

// Languages 
if ( ! function_exists( 'nfmta_multiligual_textdomain' ) ) :
  function nfmta_multiligual_textdomain() {
  	load_plugin_textdomain( 'nfmta' , false, dirname( plugin_basename( __FILE__ ) ).'/languages' );
  }
  add_action( 'plugins_loaded', 'nfmta_multiligual_textdomain' );
endif;


// Functions

if( class_exists('NF_Abstracts_MergeTags') ) {

	function nfmta_register_merge_tags(){
		Ninja_Forms()->merge_tags[ 'nfmta_merge_tags' ] = new NFMTA_AddonTag();
	}
	add_action( 'ninja_forms_loaded', 'nfmta_register_merge_tags' );

	// Add WP Content Merge Tag
	class NFMTA_AddonTag extends NF_Abstracts_MergeTags {
		protected $id = 'nfmta_merge_tags';
			public function __construct(){
			parent::__construct();
			$this->title = __( 'Merge Addon', 'nfmta' );
			$this->merge_tags = array(
				'nfmtacontent' => array(
					'id' => 'nfmta_merge_content',
					'tag' => '{nfmta:nfmtacontent}',
					'label' => __( 'WordPress Single Page Content', 'nfmta' ),
					'callback' => 'nfmta_merge_content'
				),
			);
			add_action( 'init', array( $this, 'init' ) );
			add_action( 'admin_init', array( $this, 'admin_init' ) );
			}
			// Add Post Meta from WordPress
		protected function post_id(){
			global $post;
			if ( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				$post_id = url_to_postid( wp_get_referer() );
			} elseif( $post ) {
				$post_id = $post->ID;
			} else {
				return false;
			}
			return $post_id;
		}
		// Return the Content
		protected function nfmta_merge_content(){
			$post_id = $this->post_id();
			if( ! $post_id ) return;
			$post = get_post( $post_id );
			return ( $post ) ? $post->post_content : '';
		}
	}

}else { 
	  add_action( 'admin_notices', 'nfmta_notice_no_plugin_support' );
}