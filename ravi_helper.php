<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Generates link to a CSS file root*/
if ( ! function_exists('link_css')){
function link_css($href = '', $rel = 'stylesheet', $type = 'text/css', $title = '', $media = '', $index_page = FALSE){
$CI =& get_instance();
$link = '<link ';
if (is_array($href)){
foreach ($href as $k=>$v){
if ($k == 'href' AND strpos($v, '://') === FALSE){
if ($index_page === TRUE){
$link .= 'href="'.$CI->config->site_url($v).'" ';
}else{
$link .= 'href="'.$CI->config->slash_item('base_url').$v.'" ';
}
}else{
$link .= "$k=\"$v\" ";
}
}
$link .= "/>";
}else{
if ( strpos($href, '://') !== FALSE){
$link .= 'href="'.$href.'" ';
}elseif ($index_page === TRUE){
$link .= 'href="'.$CI->config->site_url($href).'" ';
}else{
$link .= 'href="'.$CI->config->slash_item('base_url').$href.'" ';
}
$link .= 'rel="'.$rel.'" type="'.$type.'" ';

if ($media	!= ''){
$link .= 'media="'.$media.'" ';
}
if ($title	!= ''){
$link .= 'title="'.$title.'" ';
}
$link .= '/>';
}
echo $link;
}
}



/* Generates link to a JavaSctipe file root*/
if ( ! function_exists('link_js')) {
function link_js($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE){
$CI =& get_instance();
$script = '<scr'.'ipt';
if (is_array($src)) {
foreach ($src as $k=>$v) {
if ($k == 'src' AND strpos($v, '://') === FALSE) {
if ($index_page === TRUE) {
$script .= ' src="'.$CI->config->site_url($v).'"';
}else{
$script .= ' src="'.$CI->config->slash_item('base_url').$v.'"';
}
}else{
$script .= "$k=\"$v\"";
}
}
$script .= "></scr"."ipt>\n";
}else{
if( strpos($src, '://') !== FALSE) {
$script .= ' src="'.$src.'" ';
}elseif ($index_page === TRUE){
$script .= ' src="'.$CI->config->site_url($src).'" ';
}else{
$script .= ' src="'.$CI->config->slash_item('base_url').$src.'" ';
}
$script .= 'language="'.$language.'" type="'.$type.'"';
$script .= ' /></scr'.'ipt>'."\n";
}
echo $script;
}
}


/* 

Read more text with limit and link 
character_limiter_with_link($longText,670,'full_link.html');
*/
if(!function_exists('character_limiter_with_link')){
	function character_limiter_with_link($str, $n = 500, $end_char='')
{
	if(empty($end_char)){
	$end_char = '&#8230;';	
	} else {
		$end_char = '&#8230;'."<a href='".$end_char."' target='new'>read more</a>";
	}
	if (strlen($str) < $n)
	{
		return $str;
	}

	$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

	if (strlen($str) <= $n)
	{
		return $str;
	}

	$out = "";
	foreach (explode(' ', trim($str)) as $val)
	{
		$out .= $val.' ';

		if (strlen($out) >= $n)
		{
			$out = trim($out);
			return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
		}
	}
}
}