<?php 

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