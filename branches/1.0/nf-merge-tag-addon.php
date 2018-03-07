<?php
/*
Plugin Name: Ninja Forms Merge Tag Addon
Plugin URI:  https://wordpress.org/plugin/nf-merge-tag-addon/
Description: Add WordPress Tags to your Ninja Forms for the Admin Mail.
Version:     1.0
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
(c) 2018 by Benjamin Zekavica. All rights reserved. 

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

//Add Text Domain for Translation 


if ( ! function_exists( 'nfmta_multiligual_textdomain' ) ) :

  function nfmta_multiligual_textdomain() {
	load_plugin_textdomain( 'nfmta' , false, dirname( plugin_basename( __FILE__ ) ).'/languages' );
  }

  add_action( 'plugins_loaded', 'nfmta_multiligual_textdomain' );
 
endif;



// Add Action Notice 


register_activation_hook( __FILE__, 'nfmta_admin_notice_example_activation_hook' );

function nfmta_admin_notice_example_activation_hook() {
    set_transient( 'nfmta-admin-notice-example', true, 5 );
}

add_action( 'admin_notices', 'nfmta_admin_notice_example_notice' );


// Define the function

function nfmta_admin_notice_example_notice(){
	
    if( get_transient( 'nfmta-admin-notice-example' ) ){ ?>

        <div class="updated notice is-dismissible">
            <p>
    				  <strong>
    				  	<?php _e( 'Thank you for using this plugin!' , 'nfmta' ) ; ?> 
    				  </strong><br />
    				    <?php _e( 'Go now to Ninja Forms and edit the admin mail.' , 'nfmta' ); ?> 
    				     <br /><br />
    				     <?php _e( 'Kind Regards', 'nfmta' ); ?>
    				     <br />
    				    <strong>
    				     Benjamin Zekavica
    				    </strong>
		    	   </p>
        </div>

        <?php delete_transient( 'nfmta-admin-notice-example' );

    }
} // End 

// Define the function 

add_action( 'ninja_forms_loaded', 'nfmta_register_merge_tags' );

function nfmta_register_merge_tags(){
  Ninja_Forms()->merge_tags[ 'nfmta_merge_tags' ] = new NFMTA_AddonTag();
}

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
 
   
	  public function init(){ /* This section intentionally left blank. */ }
	  public function admin_init(){ /* This section intentionally left blank. */ }
  
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