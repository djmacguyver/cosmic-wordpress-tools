<?php
/**
 * Cosmic Image Blocks Functions for Foundation Press
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

<link rel="stylesheet" type="text/css" href="<?php bloginfo("template_directory"); ?>/assets/css/flexslider.css" media="screen" />
<div class=" nopad" id="home-flexslider-wrapper">
  <div class="flexslider" style="margin:0 auto;">
    <ul class="slides">
      <?php echo homeSliders( 'home_sliders', 5, '1000', '404'); ?>
    </ul>
    <div class="clear"></div>
  </div>
</div>

*/

if ( !function_exists('VideoBlocks') ) 
{
	
	function VideoBlocks( $id=0, $w='1600', $h='440')
	{
	    $name='youtube_videos';
		$html='<div id="image-blocks-wrapper">
		<div class="row" style="margin-bottom:1.5em;">';
		$popupCounter=0;
		
		if( get_field($name,$id) )
		{
			while( has_sub_field($name,$id) )
			{ 
			
			  $html.='
              <div class="small-12 medium-6 large-4 columns nopad" >
			  <h3>'.get_sub_field('video_title',$id).'</h3>
			  <iframe class="video-block-iframe"
			  src="https://www.youtube.com/embed/'.get_sub_field('video_id',$id).'?autoplay=0">
			  </iframe></div>';
			  
			}
		} 
		
		$html.='</div></div>';
		
		return $html;
	}
}

if (  !function_exists('registerACF_VideoBlocks'))
{ 
	function registerACF_VideoBlocks()
	{
	  
	  if(function_exists("register_field_group"))
	  {
	  register_field_group(array (
	  'id' => 'acf_videos',
	  'title' => 'Videos',
	  'fields' => array (
	  array (
	  'key' => 'field_52df4afe97d41',
	  'label' => 'YouTube Videos',
	  'name' => 'youtube_videos',
	  'type' => 'repeater',
	  'sub_fields' => array (
	  array (
	  'key' => 'field_52df4ba4de450',
	  'label' => 'Video Title',
	  'name' => 'video_title',
	  'type' => 'text',
	  'column_width' => '',
	  'default_value' => '',
	  'placeholder' => '',
	  'prepend' => '',
	  'append' => '',
	  'formatting' => 'html',
	  'maxlength' => '',
	  ),
	  array (
	  'key' => 'field_52df4b1097d42',
	  'label' => 'Video ID',
	  'name' => 'video_id',
	  'type' => 'text',
	  'column_width' => '',
	  'default_value' => '',
	  'placeholder' => '',
	  'prepend' => '',
	  'append' => '',
	  'formatting' => 'html',
	  'maxlength' => '',
	  ),
	  ),
	  'row_min' => '',
	  'row_limit' => '',
	  'layout' => 'row',
	  'button_label' => 'Add Video',
	  ),
	  ),
	  'location' => array (
	  array (
	  array (
	  'param' => 'page_template',
	  'operator' => '==',
	  'value' => 'templates/subpage-video-blocks.php',
	  'order_no' => 0,
	  'group_no' => 0,
	  ),
	  ),
	  ),
	  'options' => array (
	  'position' => 'acf_after_title',
	  'layout' => 'no_box',
	  'hide_on_screen' => array (
	  'the_content'=> 1,
	  'comments'=> 1,
	  ),
	  ),
	  'menu_order' => 0,
	  ));
	  }

	}
}


registerACF_VideoBlocks();
?>