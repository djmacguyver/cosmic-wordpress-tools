<?php
/**
 * Cosmic Common Functions for Foundation Press
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0
 * @author Steven P McKeon
 * Requires Plugin: Advanced Custom Fields
 * Plugin URI: http://www.advancedcustomfields.com
 *
 */
 

if ( ! function_exists( 'is_int_val' ) )
{ 
  function is_int_val($data) {
	if (is_int($data) === true) return true;
	elseif (is_string($data) === true && is_numeric($data) === true) {
		return (strpos($data, '.') === false);
	} 
	return false;
  }

}

function cosmic_reading_link() {
	return ' <span class="more-link"><a href="'. esc_url( get_permalink() ) . '">' . __( '>More', 'cosmic' ) . '</a></span>';
}

function cosmic_auto_excerpt_more( $more ) {
	return ' &hellip; ' . cosmic_reading_link();
}
add_filter( 'excerpt_more', 'cosmic_auto_excerpt_more' );


function cosmic_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= cosmic_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'cosmic_custom_excerpt_more' );


if (  !function_exists('get_option_escape'))
{
	
	function get_option_escape($data='')
	{
	  $html=get_option($data);
	  return  stripcslashes( $html);
	    
	}

}

if ( ! function_exists('ShortenText'))
{
	function ShortenText($text,$chars=25) 
	{
		$testL=$text;
		$text = $text." ";
		$text = substr($text,0,$chars);
		if(strlen($testL)>$chars)	
			$text = $text."...";
		return $text;
	}

}
if ( ! function_exists('cosmic_init_session'))
{
	function cosmic_init_session()
	{
	  @session_start();
	}
}



class Excerpt {

  public static $length = 55;

  public static $types = array(
      'short' => 25,
      'regular' => 55,
      'long' => 100
    );

  public static function length($new_length = 55) {
    Excerpt::$length = $new_length;
    add_filter('excerpt_length', 'Excerpt::new_length');
    Excerpt::output();
  }

  // Tells WP the new length
  public static function new_length() {
    if( isset(Excerpt::$types[Excerpt::$length]) )
      return Excerpt::$types[Excerpt::$length];
    else
      return Excerpt::$length;
  }

  // Echoes out the excerpt
  public static function output() {
   return get_the_excerpt();
  }

}


// An alias to the Excerpt class
if ( ! function_exists('my_excerpt'))
{
	function my_excerpt($length = 55) {
	  Excerpt::length($length);
	  return Excerpt::output();
	}
}


if ( ! function_exists('getImage'))
{
	function getImage($num) {
		global $more;
		$more = 1;
		$link = get_permalink();
		$content = get_the_content();
		$count = substr_count($content, '<img');
		$start = 0;
		for($i=1;$i<=$count;$i++) {
		$imgBeg = strpos($content, '<img', $start);
		$post = substr($content, $imgBeg);
		$imgEnd = strpos($post, '>');
		$postOutput = substr($post, 0, $imgEnd+1);
		$postOutput = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '/width="80"/',$postOutput);
		$postOutput = preg_replace('/class="(?:[^\\"]+|\\.)*"/', '/class=""/',$postOutput);	
		$postOutput = preg_replace('/style="(?:[^\\"]+|\\.)*"/', '/style="width:80px"/',$postOutput);
		$image[$i] = $postOutput;
		$start=$imgEnd+1;
		}
		if(stristr($image[$num],'<img')) { return ''.$image[$num].""; }
		$more = 0;
	}

}


if (  !function_exists('get_parent_array'))
{
	
	function get_parent_array($post_id)
	{
	 
	  $data=array();
	  $parent_id = get_post($post_id)->post_parent;
	  	  
	  if($parent_id == 0)
	  {
		$data[]=$post_id;
	  }
	  else
	  {
		  $data[]=$post_id;
		  
		  $parent_id2 = get_post($parent_id)->post_parent;
		  
		  if($parent_id2 == 0)
		  {
			$data[]=$parent_id;
		  }
		  else
		  {
			  $data[]= $parent_id;
			  
			  $parent_id3 = get_post($parent_id2)->post_parent;
			  
			  if($parent_id3 == 0)
			  {
				$data[]=$parent_id2;
			  }
			  else
			  {
			      $data[]= $parent_id2;
				  $parent_id4 = get_post($parent_id3)->post_parent;
				  
				  if($parent_id4 == 0)
				  {
					$data[]=$parent_id3;
				  }
		  	  } 
			  
		  }
	  }	
	    
	  return array_reverse($data);
	 	  
	}

}

if (  !function_exists('get_breadcrum_fromID'))
{
	
	function get_breadcrum_fromID($post_id)
	{
				
	  $ids=get_parent_array($post_id);
	  $html="";
	  $c=0;

	  foreach ($ids as $key => $value)
	  {			 
		 
		  if ($c==0 && count($ids)==1) 
		  {
			  $html.= '<span id="subTitleInner">'.trim(get_the_title($value))."</span>&nbsp;"; 
		  }	 
		  else if ($c==0) 
		  {
			  $html.= trim(get_the_title($value)).":&nbsp;"; 
		  }	 
		  else
		  {
			  $html.= '<span id="subTitleInner">'.trim(get_the_title($value))."</span>&nbsp;";  	  
		  }
		  
		  $c++;
		 
	  }  

	 return $html;
	    
	}

}

if ( ! function_exists('set_largest_tags'))
{
	function set_largest_tags($args) {
	$args = array('number' => 30);
	return $args;
	}

}

if ( ! function_exists('getACFData'))
{
	function getACFData($name='',$id=0)
	{
	
	  if( get_field($name,$id) )
	  {
		echo get_field($name,$id);
	  } 
	}
}

?>