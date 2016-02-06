<?php
/**
 * Cosmic Image Blocks Small Functions for Foundation Press
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 * @author Steven P McKeon
 * Requires Plugin: Advanced Custom Fields
 * Plugin URI: http://www.advancedcustomfields.com
 *
 */
 

if ( !function_exists('smallImageBlocks') ) 
{
	
	function smallImageBlocks( $id=0, $w='150', $h='150')
	{
		$name='Small_Image_blocks';
		
		$html='<div id="image-blocks-wrapper">
		<div class="row" style="margin-bottom:1.5em;">';
		$popupCounter=0;
		
		if( get_field($name,$id) )
		{
			while( has_sub_field($name,$id) )
			{ 
			
			  $img=get_template_directory_uri().'/tmb.php?src='.get_sub_field('block_image',$id).'&amp;w='.$w.'&h='.$h.'&amp;q=90';
			  
			   $html.='<div class="small-6 medium-3 large-2 columns nopad" >
				  <h3>'.get_sub_field('block_title',$id).'</h3>
				  <a title="click to view more" onclick="jQuery(\'#popup-div'.$popupCounter.'\').foundation(\'reveal\', \'open\');" 
				  href="javascript:return false;" 
				  class="image-block-links-sm"  style="background-image: url(\''.$img.'\');">
				  <span><div>'.get_sub_field('block_desc',$id).'</div></span></a></div>';

				  // popup content
				  $html.='<div id="popup-div'.$popupCounter.'" class="reveal-modal" data-reveal>
				  <div class="row row-wide">
				  <div class="large-12 medium-12 columns" >
				  <h2 class="popup-title">'.get_sub_field('block_title',$id).'</h2> 
					 
					  <div class="large-3 medium-3 small-12 columns nopad" class="popup-image">
					  <div  style="background-image: url(\''.$img.'\');" class="popup-image"></div>
					  </div>
					  	
					  <div class="large-9 medium-9 small-12 columns" >
					  '.get_sub_field('block_popup_content',$id).'
					  </div>
				  
				  </div></div>
				  <a class="close-reveal-modal" id="close-popup-div">&#215;</a> </div>';
				  
				  $popupCounter++;


			}
		} 
		
		$html.='</div></div>';
		
		return $html;
	}
}

if (  !function_exists('registerACF_ImageBlocksSmall'))
{ 
	function registerACF_ImageBlocksSmall()
	{
	  if(function_exists("register_field_group"))
	  {
	  register_field_group(array (
	  'id' => 'acf_home_small',
	  'title' => 'Small Image Blocks',
	  'fields' => array (
	  array (
	  'key' => 'field_66b278287e6a8',
	  'label' => 'Small Image Blocks',
	  'name' => 'Small_Image_blocks',
	  'type' => 'repeater',
	  'sub_fields' => array (
	  
	  array (
	  'key' => 'field_66b278367e6a9',
	  'label' => 'Block Title',
	  'name' => 'block_title',
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
	  'key' => 'field_66b2784b7e6aa',
	  'label' => 'Block Image',
	  'name' => 'block_image',
	  'type' => 'image',
	  'column_width' => '',
	  'save_format' => 'url',
	  'preview_size' => 'thumbnail',
	  'library' => 'all',
	  ),
	  array (
	  'key' => 'field_66b2785e7e6ab',
	  'label' => 'Block Desc',
	  'name' => 'block_desc',
	  'type' => 'textarea',
	  'column_width' => '',
	  'default_value' => '',

	  'placeholder' => '',
	  'maxlength' => 100,
	  'rows' => '2',
	  'formatting' => 'br',
	  ),
	  array (
	  'key' => 'field_66b4570041853',
	  'label' => 'Block Popup Content',
	  'name' => 'block_popup_content',
	  'type' => 'wysiwyg',
	  'conditional_logic' => array (
	  'status' => 1,
	  'rules' => array (
	  array (
		'field' => 'field_66b456c68e937',
		'operator' => '==',
		'value' => 'popup',
	  ),
	  ),
	  'allorany' => 'all',
	  ),
	  'column_width' => '',
	  'default_value' => '',
	  'toolbar' => 'full',
	  'media_upload' => 'yes',
	  ),
	  ),
	  'row_min' => 1,
	  'row_limit' => 12,
	  'layout' => 'row',
	  'button_label' => 'Add Block',
	  ),
	  ),
	  'location' => array (
	  array (
	  array (
	  'param' => 'page_template',
	  'operator' => '==',
	  'value' => 'templates/subpage-image-blocks-small.php',
	  'order_no' => 0,
	  'group_no' => 0,
	  ),
	  ),
	
	  ),
	  'options' => array (
	  'position' => 'acf_after_title',
	  'layout' => 'no_box',
	  'hide_on_screen' => array (
	  'comments'=> 1,
	  ),
	  ),
	  'menu_order' => 1,
	  ));
	  }

	}
}


registerACF_ImageBlocksSmall();
?>