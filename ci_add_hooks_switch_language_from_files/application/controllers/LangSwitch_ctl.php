<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LangSwitch_ctl extends CI_Controller
{ 
	public function __construct() {
		parent::__construct();
	}
	function switchLang($setMyLang = "") {
		$setMyLang = ($setMyLang != "") ? $setMyLang : "english";
		$this->session->set_userdata('site_lang', $setMyLang);
		redirect($_SERVER['HTTP_REFERER']);
	}
}