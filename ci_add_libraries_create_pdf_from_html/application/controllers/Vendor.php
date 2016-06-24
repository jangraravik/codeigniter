<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function invoice(){
		$this->load->library('pdf');
		$data['id'] = 123;
		$data['name'] = "Ravi Kumar Vendor";
		$data['contact'] = 9811669942;
		
		/* Load html/css template file and replace */
		$html = $this->load->view('html-to-make-pdf', $data, true);
		
		/* Where you want PDF to be created */
		$pdfPath = "invoice_vendor/"; 
		
		/* Do not Add .pdf extention */
		$fileName = $pdfPath."invoice_".$data['id']."_".time();

		/* Add a pdf fileName Title  */
		$fileTitle = "Vendor - Invoice";

		/* Add a pdf watermakr status in the center of the file */
		$invoiceStatus = "Due";		

		/* Do not Add .pdf extention */
		$this->pdf->create($html,$fileName,$invoiceStatus,$fileTitle);
		echo $this->pdf->dlink($fileName,'click');
	}

}