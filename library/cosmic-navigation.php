<?php
/**
 * Cosmic Navigation for Foundation Press
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 * @author Steven P McKeon
 * Requires Plugin: Advanced Custom Fields
 * Plugin URI: http://www.advancedcustomfields.com
 *
 */
 
 
if (  !function_exists('getDontShowInNavIds'))
{
  function getDontShowInNavIds()
  {
	global $wpdb;
	$IDs=array();
	$data="";	  
	
	$qry = "SELECT distinct (post_id), meta_value
	FROM `wp_postmeta` 
	where meta_key='dont_show_page_in_nav' ;";
	
	$myrows = $wpdb->get_results( $qry );
	if ($myrows != null)
	{
	  foreach ($myrows as $row) 
	  {	 
		  // data format a:1:{i:0;s:3:"yes";}
		  if (strpos($row->meta_value, 'yes') !== FALSE)
			$IDs[]=$row->post_id;
	  }
	  $data=implode($IDs,",");
			  
	}		

	wp_reset_query();
		
	return $data;

  }

}

if (  !function_exists('getPlaceHolderPageIds'))
{
  function getPlaceHolderPageIds()
  {
	global $wpdb;
	$IDs=array();

	$qry = "SELECT distinct (post_id), meta_value
	FROM `wp_postmeta` 
	where meta_key='place_holder_page' ;";
	
	$myrows = $wpdb->get_results( $qry );
	if ($myrows != null)
	{
	  foreach ($myrows as $row) 
	  {	 
		  // data format a:1:{i:0;s:3:"yes";}
		  if (strpos($row->meta_value, 'yes') !== FALSE)
			$IDs[]=$row->post_id;
	  }
			  
	}		

	wp_reset_query();
		
	return $IDs;

  }

}


/*

example:

<nav class="top-bar" data-topbar role="navigation" >
  <section class="top-bar-section" >
	<div class="row" >
	  <div>
		<ul>
		  <?php getCosmicACFMenu(); ?>
		</ul>
	  </div>
	</div>
  </section>
</nav>

*/

if (  !function_exists('getCosmicACFMenu'))
{ 
	function getCosmicACFMenu($mode='echo',$ul=1)
	{
	  
	  $IDs=getPlaceHolderPageIds();
	  
	  if($ul==1)
	  	$nav='<ul>';
	  
	  $nav.= wp_list_pages("title_li=&echo=0&exclude=".getDontShowInNavIds()."");
	  $nav=str_replace("children","dropdown",$nav); 
	  $nav=str_replace("page_item_has_dropdown","has-dropdown",$nav); 
	  
	  if( !empty($IDs) )
	  {
		foreach ($IDs as $key => $val)
		{			
			$regex[]   = '/(<li.*class=\".*page-item-'.$val.'.*\">).*<a.*(href=\".*\")/i';
			$replace[]	= '$1<a href="#"$3';
		}
		
		$nav=preg_replace($regex, $replace, $nav,1); 
	  }
	  
	  if($ul==1)
	  	$nav.='</ul>';
	  
	  if($mode=='echo')
	  	echo $nav;
	  else
	  	return $nav;
	
	}
}

if (  !function_exists('registerACF_MenuOptions'))
{ 
	function registerACF_MenuOptions()
	{
	  if(function_exists("register_field_group"))
	  {
		  register_field_group(array (
			  'id' => 'acf_cosmic-navigation-sidebar',
			  'title' => 'Cosmic Navigation Sidebar',
			  'fields' => array (
				  array (
					  'key' => 'field_56afd5d3d019c',
					  'label' => 'Don\'t Show Page in Nav',
					  'name' => 'dont_show_page_in_nav',
					  'type' => 'checkbox',
					  'instructions' => 'This will hide the page from the top navigation menu.',
					  'choices' => array (
						  'yes' => 'yes',
					  ),
					  'default_value' => '',
					  'layout' => 'horizontal',
				  ),
				  array (
					  'key' => 'field_56afd62938d13',
					  'label' => 'Place Holder Page',
					  'name' => 'place_holder_page',
					  'type' => 'checkbox',
					  'instructions' => 'This will disable the page form being click-able and still show in the nav and sidebar.',
					  'choices' => array (
						  'yes' => 'yes',
					  ),
					  'default_value' => '',
					  'layout' => 'vertical',
				  ),
			  ),
			  'location' => array (
				  array (
					  array (
						  'param' => 'post_type',
						  'operator' => '==',
						  'value' => 'page',
						  'order_no' => 0,
						  'group_no' => 0,
					  ),
				  ),
			  ),
			  'options' => array (
				  'position' => 'side',
				  'layout' => 'default',
				  'hide_on_screen' => array (
				  ),
			  ),
			  'menu_order' => 0,
		  ));
	  }
	
	}
}


registerACF_MenuOptions();

?>