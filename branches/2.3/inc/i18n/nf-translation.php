<?php 

// Languages 
if ( ! function_exists( 'nfmta_multiligual_textdomain' ) ) {
    function nfmta_multiligual_textdomain() {
        load_plugin_textdomain( 'nfmta' , false, dirname( plugin_basename( __FILE__ ) ).'/languages' );
    }
    add_action( 'plugins_loaded', 'nfmta_multiligual_textdomain' );
} 