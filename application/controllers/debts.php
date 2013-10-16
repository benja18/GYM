<?php

class Debts extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'debts/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('description', 'Description', 'required');            
            $this->form_validation->set_rules('value', 'Value', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['status'] = 'ValidationError';
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('debts/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {
                $data['description'] = $_POST['description'];                
                $data['value'] = $_POST['value'];
                $data['client_id'] = $_POST['client_id'];
                
                if (ctype_digit($data['value'])) {
                    $this->load->model('debt');
                    $this->debt->insert($data);
                    $data['status'] = 'DebtInserted';                
                } else {
                    $data['status'] = 'InvalidValue';
                }             
                    
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('debts/create', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {
            $data['status'] = '';

            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('debts/create', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function listDebts() {
        $data['status'] = '';
        $this->load->model('debt');
        $debts = $this->debt->getData();

        $data['debts'] = $debts;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('debts/listDebts', array('data' => $data));
        $this->load->view('templates/footer');
    }
    
    public function listClientDebts() {
        $data['status'] = '';        
        $this->load->model('debt');
        $debts = $this->debt->getClientDebts($_GET['client_id']);

        $data['debts'] = $debts;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('debts/listClientDebts', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'debts/update');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('value', 'Value', 'required');            

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('debt');
                $data = $this->debt->getById($_POST['debt_id']);

                $data['status'] = 'ValidationError';
                $data['debt_id'] = $_POST['debt_id'];

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('debts/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['description'] = $_POST['description'];
                $data['value'] = $_POST['value'];
                

                if (ctype_digit($data['value'])) {
                    $this->load->model('debt');
                    $this->debt->update($_POST['debt_id'], $data);
                    $data['status'] = 'DebtUpdated';
                } else {
                    $data['status'] = 'InvalidValue';                    
                }
                $data['client_id'] = $_POST['client_id'];
                $data['debt_id'] = $_POST['debt_id'];
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('debts/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->model('debt');
            $data = $this->debt->getById($_GET['debt_id']);
            $data['status'] = "";
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('debts/update', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function delete() {

        $data['status'] = '';

        $this->load->model('debt');
        $id = $_GET['debt_id'];

        $this->load->model('debt');
        $this->debt->delete($id);

        $debts = $this->debt->getData();

        $data['debts'] = $debts;
        //load de vistas
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('debts/listDebts', array('data' => $data));
        $this->load->view('templates/footer');
    }
    
    public function deleteClientDebts() {

        $data['status'] = '';

        $this->load->model('debt');
        $id = $_GET['debt_id'];

        $this->load->model('debt');
        $this->debt->delete($id);

        $debts = $this->debt->getData();

        $data['debts'] = $debts;
        //load de vistas
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('debts/listClientDebts', array('data' => $data));
        $this->load->view('templates/footer');
    }

}