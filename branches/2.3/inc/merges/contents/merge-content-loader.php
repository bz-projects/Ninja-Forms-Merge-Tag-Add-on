<?php 

function nfm_pluginchecker() {
    if ( !class_exists('NF_Abstracts_MergeTags') && !is_plugin_active('ninja-forms/ninja-forms.php') ) {
        add_action( 'admin_notices', 'ninja_form_no_installed' );
    }

    if( !class_exists('NF_Abstracts_MergeTags') && is_plugin_active('ninja-forms/ninja-forms.php') ) { 
        add_action( 'admin_notices', 'nfmta_notice_no_plugin_support');
    }
}
add_action( 'admin_init', 'nfm_pluginchecker' );


if( class_exists('NF_Abstracts_MergeTags') ) {

    function nfmta_register_merge_tags(){
        require_once 'class.nfmergecontent.php';
        Ninja_Forms()->merge_tags[ 'nfmta_merge_tags' ] = new NFMTA_AddonTag();
    }
    add_action( 'ninja_forms_loaded', 'nfmta_register_merge_tags' );

}else {
    add_action( 'admin_notices', 'ninja_form_no_installed' );
}