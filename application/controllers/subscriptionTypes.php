<?php

class SubscriptionTypes extends MY_Controller {

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
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('subscriptionTypes/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {
                $data['description'] = $_POST['description'];

                $this->load->model('subscription_type');
                $this->subscription_type->insert($data);
                
                $data['status'] = 'SubscriptionTypeInserted';                

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('subscriptionTypes/create', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {
            $data['status'] = '';

            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('subscriptionTypes/create', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function listSubscriptionTypes() {
        $data['status'] = '';
        $this->load->model('subscription_type');
        $subscriptionTypes = $this->subscription_type->getData();

        $data['subscriptionTypes'] = $subscriptionTypes;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('subscriptionTypes/listSubscriptionTypes', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('subscription_type');
                $data = $this->subscription_type->getById($_POST['subscription_type_id']);

                $data['status'] = 'ValidationError';
                $data['subscription_type_id'] = $_POST['subscription_type_id'];

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('subscriptionTypes/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['description'] = $_POST['description'];
                $data['subscription_type_id'] = $_POST['subscription_type_id'];

                $this->load->model('subscription_type');
                $this->subscription_type->update($_POST['subscription_type_id'], $data);
                
                $data['status'] = 'SubscriptionTypeUpdated';

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('subscriptionTypes/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->model('subscription_type');
            $data = $this->subscription_type->getById($_GET['subscription_type_id']);
            $data['status'] = "";
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('subscriptionTypes/update', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function delete() {

        $data['status'] = '';

        $this->load->model('subscription_type');
        $id = $_GET['subscription_type_id'];

        $this->load->model('subscription_type');
        $this->subscription_type->delete($id);

        if ($this->db->_error_number() == 1451) {
            $data['status'] = 'CantDelete';
        }

        $subscriptionTypes = $this->subscription_type->getData();

        $data['subscriptionTypes'] = $subscriptionTypes;
        //load de vistas
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('subscriptionTypes/listSubscriptionTypes', array('data' => $data));
        $this->load->view('templates/footer');
    }

}