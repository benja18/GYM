<?php

class Clients extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'clients/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('surname', 'Surname', 'required');
            $this->form_validation->set_rules('ci', 'Ci', 'required');
            $this->form_validation->set_rules('birth', 'Birth', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('mail', 'Mail', 'required');
            $this->form_validation->set_rules('emergency', 'Emergency', 'required');
            $this->form_validation->set_rules('ocupation', 'Ocupation', 'required');


            if ($this->form_validation->run() === FALSE) {
                $data['status'] = 'ValidationError';
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('clients/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['name'] = $_POST['name'];
                $data['surname'] = $_POST['surname'];
                $data['ci'] = $_POST['ci'];
                $data['birth'] = date('Y-m-d', strtotime($_POST['birth']));
                $data['address'] = $_POST['address'];
                $data['phone'] = $_POST['phone'];
                $data['mail'] = $_POST['mail'];
                $data['emergency'] = $_POST['emergency'];
                $data['ocupation'] = $_POST['ocupation'];

                $this->load->model('client');
                $this->client->insert($data);
                
                echo $data['birth'];
                if ($this->db->_error_number() == 1062) {
                    $data['status'] = 'CiDuplicated';
                } else {
                    $data['status'] = 'ClientInserted';
                }

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('clients/create', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {
            $data['status'] = '';
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('clients/create', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function listClients() {
        
        $data['status'] = "";
        $this->load->model('client');

        $clients = $this->client->getData();

        $data['clients'] = $clients;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('clients/listClients', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'clients/update');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('surname', 'Surname', 'required');
            $this->form_validation->set_rules('ci', 'Ci', 'required');
            $this->form_validation->set_rules('birth', 'Birth', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('mail', 'Mail', 'required');
            $this->form_validation->set_rules('emergency', 'Emergency', 'required');
            $this->form_validation->set_rules('ocupation', 'Ocupation', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('client');
                $data = $this->client->getById($_POST['client_id']);

                $data['status'] = 'ValidationError';
                $data['client_id'] = $_POST['client_id'];

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('clients/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['name'] = $_POST['name'];
                $data['surname'] = $_POST['surname'];
                $data['ci'] = $_POST['ci'];
                $data['birth'] = date('Y-m-d', strtotime($_POST['birth']));
                $data['address'] = $_POST['address'];
                $data['phone'] = $_POST['phone'];
                $data['mail'] = $_POST['mail'];
                $data['emergency'] = $_POST['emergency'];
                $data['ocupation'] = $_POST['ocupation'];


                $this->load->model('client');
                $this->client->update($_POST['client_id'], $data);

                if ($this->db->_error_number() == 1062) {
                    $data['status'] = 'CiDuplicated';
                    
                } else {
                    $data['status'] = 'ClientUpdated';
                }

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('clients/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->model('client');
            $data = $this->client->getById($_GET['client_id']);
            $data['status'] = "";
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('clients/update', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function delete() {
        
        $data['status'] = "";
        
        $this->load->model('client');
        $id = $_GET['client_id'];

        $this->load->model('client');
        $this->client->delete($id);
        
        if ($this->db->_error_number() == 1451) {
            $data['status'] = 'CantDelete';
        }
        
        $clients = $this->client->getData();

        $data['clients'] = $clients;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('clients/listClients', array('data' => $data));
        $this->load->view('templates/footer');
    }

}