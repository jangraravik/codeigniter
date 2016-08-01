<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
		redirect('page/form');
	}
    
	public function form()
	{
		$this->load->view('form');
	}	
	
	public function validateRules()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');		
	}
	
    public function formProcess()
    {
		if ($this->form_validation->run($this->validateRules()) == FALSE){
			$formErrors = array();
			foreach ($this->input->post() as $key => $value){
				$formErrors[$key] = form_error($key);
			}
			$response['msgs'] = array_filter($formErrors); // Some might be empty
			header('Content-type: application/json');
			exit(json_encode($response));				
		} else {
		   $data['username'] = $this->input->post('username', TRUE);
		   $data['$password'] = $this->input->post('password', TRUE);
		   $data['$email'] = $this->input->post('email', TRUE);
		   // space for insert or update script with $data
		   header('Content-type: application/json');
		   $response = array('status'=>'ok', 'msgs' => 'Request successfully processed');
		   exit(json_encode($response));
		}
    }
}

?>

