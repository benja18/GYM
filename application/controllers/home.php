
<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI

class Home extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {        
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->view('welcome_message', $data);
            $this->load->view('templates/footer', array('data' => $this->data));
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout() {        
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

}