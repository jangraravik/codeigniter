<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Debug the Array */
function test($value, $e=0){
echo "<pre>";
print_r($value);
echo "</pre>";
if($e === 1){ exit; }
}

/* Debug the Array */
function dd($value, $e=0){
	return test($value, $e);
}

/* Debug the Array */
function debug($value, $e=0){
	return test($value, $e);
}

/* Puts the output in a file */
function putInFile($value,$filname='putInFile.txt'){
	return file_put_contents($filname, var_export($value, true), FILE_APPEND | LOCK_EX);
}