<?php

class SubscriptionTypes extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'subscriptionTypes/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['status'] = 'ValidationError';
                $this->load->view('templates/header');
                $this->load->helper('form');
                $this->load->view('subscriptionTypes/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {
                $data['description'] = $_POST['description'];

                $this->load->model('subscriptionType');
                $this->subscriptionType->insert($data);
                
                $data['status'] = 'SubscriptionTypeInserted';                

                $this->load->view('templates/header');
                $this->load->helper('form');
                $this->load->view('subscriptionTypes/create', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {
            $data['status'] = '';

            $this->load->view('templates/header');
            $this->load->helper('form');
            $this->load->view('subscriptionTypes/create', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function listSubscriptionTypes() {
        $data['status'] = '';
        $this->load->model('subscriptionType');
        $subscriptionTypes = $this->subscriptionType->getData();

        $data['subscriptionTypes'] = $subscriptionTypes;

        $this->load->view('templates/header');
        $this->load->view('subscriptionTypes/listSubscriptionTypes', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('subscriptionType');
                $data = $this->subscriptionType->getById($_POST['subscription_type_id']);

                $data['status'] = 'ValidationError';
                $data['subscription_type_id'] = $_POST['subscription_type_id'];

                $this->load->view('templates/header');
                $this->load->helper('form');
                $this->load->view('subscriptionTypes/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['description'] = $_POST['description'];
                $data['subscription_type_id'] = $_POST['subscription_type_id'];

                $this->load->model('subscriptionType');
                $this->subscriptionType->update($_POST['subscription_type_id'], $data);
                
                $data['status'] = 'SubscriptionTypeUpdated';

                $this->load->view('templates/header');
                $this->load->helper('form');
                $this->load->view('subscriptionTypes/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->model('subscriptionType');
            $data = $this->subscriptionType->getById($_GET['subscription_type_id']);
            $data['status'] = "";
            $this->load->view('templates/header');
            $this->load->helper('form');
            $this->load->view('subscriptionTypes/update', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function delete() {

        $data['status'] = '';

        $this->load->model('subscriptionType');
        $id = $_GET['subscription_type_id'];

        $this->load->model('subscriptionType');
        $this->subscriptionType->delete($id);

        if ($this->db->_error_number() == 1451) {
            $data['status'] = 'CantDelete';
        }

        $subscriptionTypes = $this->subscriptionType->getData();

        $data['subscriptionTypes'] = $subscriptionTypes;
        //load de vistas
        $this->load->view('templates/header');
        $this->load->view('subscriptionTypes/listSubscriptionTypes', array('data' => $data));
        $this->load->view('templates/footer');
    }

}