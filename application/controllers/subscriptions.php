<?php

class Subscriptions extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        $data['status'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'subscriptions/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('start_date', 'Start_date', 'required');
            $this->form_validation->set_rules('end_date', 'End_date', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
            $data['clients_client_id'] = $_POST['clients_client_id'];
            $this->load->model('subscription_type');
            $subscriptionTypes = $this->subscription_type->getData();
            $data['subscription_types'] = $subscriptionTypes;

            if ($this->form_validation->run() === FALSE) {

                $data['status'] = 'ValidationError';

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('subscriptions/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['start_date'] = date('Y-m-d', strtotime($_POST['start_date']));
                $data['end_date'] = date('Y-m-d', strtotime($_POST['end_date']));
                $data['paid'] = isset($_POST['paid']) && $_POST['paid'] ? 1 : 0;
                $data['price'] = $_POST['price'];
                $data['clients_client_id'] = $_POST['clients_client_id'];
                $data['subscription_types_subscription_type_id'] = $_POST['subscription_types_subscription_type_id'];

                if (ctype_digit($data['price'])) {
                    $this->load->model('subscription');
                    $this->subscription->insert($data);

                    $data['status'] = 'SubscriptionInserted';
                } else {
                    $data['status'] = 'PriceError';
                }

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('subscriptions/create', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {
            $data['status'] = '';
            $this->load->model('subscription_type');
            $subscriptionTypes = $this->subscription_type->getData();
            $data['subscription_types'] = $subscriptionTypes;
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('subscriptions/create', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('start_date', 'Start_date', 'required');
            $this->form_validation->set_rules('end_date', 'End_date', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('subscription');
                $data['subscription'] = $this->subscription->getById($_POST['subscription_id']);                
                $data['status'] = 'ValidationError';
                $data['clients_client_id'] = $_POST['clients_client_id'];
                $data['subscription_id'] = $_POST['subscription_id'];

                $this->load->model('subscription_type');
                $subscriptionTypes = $this->subscription_type->getData();
                $data['subscription_types'] = $subscriptionTypes;

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('subscriptions/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {
                
                $data['start_date'] = date('Y-m-d', strtotime($_POST['start_date']));
                $data['end_date'] = date('Y-m-d', strtotime($_POST['end_date']));
                $data['paid'] = isset($_POST['paid']) && $_POST['paid'] ? 1 : 0;
                $data['price'] = $_POST['price'];
                $data['clients_client_id'] = $_POST['clients_client_id'];
                $data['subscription_types_subscription_type_id'] = $_POST['subscription_types_subscription_type_id'];

                if (ctype_digit($data['price'])) {

                    $this->load->model('subscription');
                    $this->subscription->update($_POST['subscription_id'], $data);
                    $data['status'] = 'SubscriptionUpdated';
                } else {
                    $data['status'] = 'PriceError';
                    $this->load->model('subscription');
                    $data['subscription'] = $this->subscription->getById($_POST['subscription_id']);

                    $data['clients_client_id'] = $_POST['clients_client_id'];
                    $data['subscription_id'] = $_POST['subscription_id'];

                    $this->load->model('subscription_type');
                    $subscriptionTypes = $this->subscription_type->getData();
                    $data['subscription_types'] = $subscriptionTypes;
                }                                
                
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('subscriptions/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $data['status'] = '';
            $this->load->model('subscription_type');
            $subscriptionTypes = $this->subscription_type->getData();
            $data['subscription_types'] = $subscriptionTypes;

            $this->load->model('subscription');
            $data['subscription'] = $this->subscription->getById($_GET['subscription_id']);
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('subscriptions/update', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function delete() {

        $data['status'] = '';

        $this->load->model('subscription');
        $id = $_GET['subscription_id'];

        $this->load->model('subscription');
        $this->subscription->delete($id);

        if ($this->db->_error_number() == 1451) {
            $data['status'] = 'CantDelete';
        }

        $subscriptions = $this->subscription->getClientData($_GET['client_id']);

        $data['subscriptions'] = $subscriptions;
        //load de vistas
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('subscriptions/listClientSubscriptions', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function listClientSubscriptions() {
        $this->load->model('subscription');
        $subscriptions = $this->subscription->getClientData($_GET['client_id']);
        $data['subscriptions'] = $subscriptions;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('subscriptions/listClientSubscriptions', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function listNextExpirations() {
        $this->load->model('subscription');
        $subscriptions = $this->subscription->getNextExpirations($this->data['daysCount']);
        $data['subscriptions'] = $subscriptions;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('subscriptions/listNextExpirations', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function listSubscriptionsUnpaid() {
        $this->load->model('subscription');
        $subscriptions = $this->subscription->getSubscriptionsUnpaid();
        $data['subscriptions'] = $subscriptions;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('subscriptions/listSubscriptionsUnpaid', array('data' => $data));
        $this->load->view('templates/footer');
    }
    
    public function findSubscriptions() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('start_date', 'Start_date', 'required');
            $this->form_validation->set_rules('end_date', 'End_date', 'required');            

            if ($this->form_validation->run() === FALSE) {

                $data['status'] = '';
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('subscriptions/findSubscriptions', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['start_date'] = date('Y-m-d', strtotime($_POST['start_date']));
                $data['end_date'] = date('Y-m-d', strtotime($_POST['end_date']));
                
                $this->load->model('subscription');
                $data['subscriptions'] = $this->subscription->getByDate($data['start_date'],$data['end_date']);
                $data['status'] = 'ShowTable';
                
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('subscriptions/findSubscriptions', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $data['status'] = '';
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('subscriptions/findSubscriptions', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }
}