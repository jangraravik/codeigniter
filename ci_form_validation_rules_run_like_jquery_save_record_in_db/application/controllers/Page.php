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
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('passwordconf', 'Password Confirm', 'required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');	
		$this->form_validation->set_error_delimiters("<span style='color:red;padding:5px;'>","</span>");
	}
	
    public function formProcess()
    {
		if ($this->form_validation->run($this->validateRules()) == FALSE){
			$formErrors = array();
			foreach ($this->input->post() as $key => $value){
				$formErrors[$key] = form_error($key);
			}
			$response['msgs'] = array_filter($formErrors); // Some might be empty
			$this->output->set_content_type('application/json');
			exit(json_encode($response));				
		} else {
			// space for insert or update script with $data
			$person_data = array(
				'first_name'=>$this->input->post('first_name'),
				'last_name'=>$this->input->post('last_name'),
				'email'=>$this->input->post('email'),
				'password'=>md5($this->input->post('password')),
				'role'=>$this->input->post('role'),
				'addedon'=>time());
			$this->load->model('persons_mdl');
			$newPersonId = $this->persons_mdl->save_person($person_data);
		   $response = array('status'=>'ok', 'msgs' => 'Request successfully processed # '.$newPersonId);
		   $this->output->set_content_type('application/json');
		   exit(json_encode($response));
		}
    }
}

?>

