<?php
/**
 * Cosmic Header Image Functions for Foundation Press
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 * @author Steven P McKeon
 * Requires Plugin: Advanced Custom Fields
 * Plugin URI: http://www.advancedcustomfields.com
 *
 */
 
 
/*

example:

<div class="image-header" style="<?php echo getSubHeaderImage(get_the_ID(),1200,247); ?>">
  <div class="image-header-inner" >
    <div class="row">
      <div class="small-12 large-12 columns" role="main">
        <header>
          <h1 class="entry-title"> <?php echo get_the_title($post->ID); ?> </h1>
        </header>
      </div>
    </div>
  </div>
</div>

*/
 
if ( ! function_exists('getSubHeaderImage'))
{
	function getSubHeaderImage($id=0, $w='1200', $h='247')
	{
	
	  $html='';
	
	  if( get_field('image',$id) )
	  {
		
		$html.="background-image:url('"
		.get_template_directory_uri()."/tmb.php?src="
		.get_field('image').'&amp;w='.$w.'&h='.$h."&amp;q=80'";
   
	  } 
	  
	  return $html;
	}
}

if (  !function_exists('registerACF_HeaderImage'))
{ 
	function registerACF_HeaderImage()
	{

	  if(function_exists("register_field_group"))
	  {
		  register_field_group(array (
			  'id' => 'acf_header-image',
			  'title' => 'Header Image',
			  'fields' => array (
				  array (
					  'key' => 'field_569f3260bcb90',
					  'label' => 'Header Image',
					  'name' => 'image',
					  'type' => 'image',
					  'save_format' => 'url',
					  'preview_size' => 'medium',
					  'library' => 'all',
				  ),
			  ),
			  'location' => array (
				  array (
					  array (
						  'param' => 'page_template',
						  'operator' => '!=',
						  'value' => 'templates/home.php',
						  'order_no' => 0,
						  'group_no' => 0,
					  ),
				  ),
			  ),
			  'options' => array (
				  'position' => 'acf_after_title',
				  'layout' => 'no_box',
				  'hide_on_screen' => array (
				  ),
			  ),
			  'menu_order' => 0,
		  ));
	  }

	}
}

registerACF_HeaderImage();
?>