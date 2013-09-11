<?php

class Users extends CI_Controller {

    public function create() {
        $this->load->helper('form');
	$this->load->library('form_validation');

	$data['username'] = 'Create a news user';

	$this->form_validation->set_rules('username', 'text', 'required');
	$this->form_validation->set_rules('password', 'password', 'required');

	if ($this->form_validation->run() === FALSE)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('users/create');
		$this->load->view('templates/footer');

	}
	else
	{
		$this->user->set_news();
		$this->load->view('users/create');
	}
    }

}