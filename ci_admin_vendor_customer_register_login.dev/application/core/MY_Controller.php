<?php

class MY_Controller extends CI_Controller{

	private function _falshAndRedirect($msgStatus, $msgSuccess, $msgFailure)
	{
		if($msgStatus) {
			$this->session->set_flashdata('msgs_text',$msgSuccess);
			$this->session->set_flashdata('msgs_class', 'alert-success');
		} else {
			$this->session->set_flashdata('msgs_text', $msgFailure);
			$this->session->set_flashdata('msgs_class', 'alert-danger');
		}
	}
}