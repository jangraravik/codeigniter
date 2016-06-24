<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function invoice(){
		$this->load->library('pdf');
		$data['id'] = 123;
		$data['name'] = "Ravi Kumar Customer";
		$data['contact'] = 9811669952;
		
		/* Load html/css template file and replace */
		$html = $this->load->view('html-to-make-pdf', $data, true);
		
		/* Where you want PDF to be created */
		$path = "invoice_customer/"; 
		
		/* Do not Add .pdf extention */
		$file = $path."invoice_".$data['id']."_".time();

		/* Do not Add .pdf extention */
		$this->pdf->create($html,$file,'Unpaid');
		echo $this->pdf->dlink($file,'click');
	}

}