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