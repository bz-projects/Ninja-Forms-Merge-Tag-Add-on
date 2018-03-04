<?php
class My_MergeTags extends NF_Abstracts_MergeTags
{
  /*
   * The $id property should match the array key where the class is registered.
   */
  protected $id = 'my_merge_tags';
  
  public function __construct()
  {
    parent::__construct();
    
    /* Translatable display name for the group. */
    $this->title = __( 'My Merge Tags', 'ninja-forms' );
    
    /* Individual tag registration. */
    $this->merge_tags = array(
      
        'foo' => array(
          'id' => 'post_content',
          'tag' => '{my:foo}', // The tag to be  used.
          'label' => __( 'Foo', 'my_plugin' ), // Translatable label for tag selection.
          'callback' => 'post_content' // Class method for processing the tag. See below.
      ),
    );
    
    /*
     * Use the `init` and `admin_init` hooks for any necessary data setup that relies on WordPress.
     * See: https://codex.wordpress.org/Plugin_API/Action_Reference
     */
    add_action( 'init', array( $this, 'init' ) );
    add_action( 'admin_init', array( $this, 'admin_init' ) );
  }
  
  public function init(){ /* This section intentionally left blank. */ }
  public function admin_init(){ /* This section intentionally left blank. */ }
  
  /**
   * The callback method for the {my:foo} merge tag.
   * @return string
   */
	protected function post_id()
	{
		global $post;

		if ( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			// If we are doing AJAX, use the referer to get the Post ID.
			$post_id = url_to_postid( wp_get_referer() );
		} elseif( $post ) {
			$post_id = $post->ID;
		} else {
			return false; // No Post ID found.
		}

		return $post_id;
	}
	
	
	protected function post_content()
    {
			
		$post_id = $this->post_id();
        if( ! $post_id ) return;
        $post = get_post( $post_id );
        return ( $post ) ? $post->post_content : '';
		
    }
	

}