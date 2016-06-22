<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	function makepdf()
	{
		$this->load->helper(array('pdf', 'file'));
		$data['id'] = 123;
		$data['name'] = "Ravi Kumar Jangra";
		$data['contact'] = 9811669942;
		$filename="invoice_pdf/invoice_".$data['id']."_".time().".pdf";
		$html = $this->load->view('html-to-make-pdf', $data, true);
		echo pdf_create($html,'Unpaid',$filename); /* Download Link */
	}
}