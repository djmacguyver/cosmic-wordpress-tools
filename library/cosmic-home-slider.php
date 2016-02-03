<?php
/**
 * Cosmic Home Slider Functions for Foundation Press
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
<div class="home-fullwide-bar-wrapper nopad" id="home-flexslider-wrapper">
  <div class="flexslider" style="margin:0 auto;">
    <ul class="slides">
      <?php echo homeSliders( 'home_sliders', 5, '1000', '404'); ?>
    </ul>
    <div class="clear"></div>
  </div>
</div>

*/

if ( !function_exists('homeSliders') ) 
{
	
	function homeSliders( $name='',$id=0, $w='1000', $h='404')
	{
	
		$html='';
		
		if( get_field($name,$id) )
		{
			while( has_sub_field($name,$id) )
			{ 
			
			  $img=get_template_directory_uri().'/tmb.php?src='.get_sub_field('image',$id).'&amp;w='.$w.'&h='.$h.'&amp;q=90';
				
			  $html.='<li ><img src="'.$img.'" / >
			  <div class="flex-caption">
			  <div>
			  <h3>'.get_sub_field('title',$id).'</h3>
			  <p>'.get_sub_field('desc',$id).'</p>
			  </div>
			  </div>
			  </li>';
			}
		} 
		
		return $html;
	}
}

if (  !function_exists('registerACF_Sliders'))
{ 
	function registerACF_Sliders()
	{
	  if(function_exists("register_field_group"))
	  {
		register_field_group(array (
		'id' => 'acf_home-sliders',
		'title' => 'Home Sliders',
		'fields' => array (
			array (
				'key' => 'field_566f2efdb1a31',
				'label' => 'Home Sliders',
				'name' => 'home_sliders',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_566f2f0fb1a32',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'medium',
						'library' => 'all',
					),
					array (
						'key' => 'field_566f33a13cf68',
						'label' => 'Title',
						'name' => 'title',
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
						'key' => 'field_566f33ae3cf69',
						'label' => 'Link',
						'name' => 'link',
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
				'button_label' => 'Add Slide',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '5',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
		));
		}

	}
}


registerACF_Sliders();
?>