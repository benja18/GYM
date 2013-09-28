<?php

class Configurations extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function updateExpirationInterval() {

        $data['status'] = '';
        $this->load->model('configuration');
        $data['expirationInterval'] = $this->configuration->getExpirationInterval();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'configurations/updateExpirationInterval');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('configuration_value', 'Configuration Value', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['status'] = 'ValidationError';
                $data['configuration_value'] = $_POST['configuration_value'];
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('configurations/updateExpirationInterval', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['configuration_value'] = $_POST['configuration_value'];

                if (ctype_digit($data['configuration_value'])) {


                    $this->load->model('configuration');
                    $this->configuration->updateExpirationInterval($data['configuration_value']);
                    $data['status'] = 'IntervalUpdated';
                } else {
                    $data['status'] = 'IntervalNumericError';
                }
                
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('configurations/updateExpirationInterval', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('configurations/updateExpirationInterval', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

}