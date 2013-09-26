<?php

class Routines extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'routines/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['status'] = 'ValidationError';
                $data['clients_client_id'] = $_POST['clients_client_id'];
                $this->load->view('templates/header');
                $this->load->helper('form');
                $this->load->view('routines/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {
                $data['name'] = $_POST['name'];
                $data['clients_client_id'] = $_POST['clients_client_id'];
                $this->load->model('routine');
                $this->routine->insert($data);
                
                $data['status'] = 'RoutineInserted';

                $this->load->view('templates/header');
                $this->load->helper('form');
                $this->load->view('routines/create', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {
            $data['status'] = '';

            $this->load->view('templates/header');
            $this->load->helper('form');
            $this->load->view('routines/create', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function listClientRoutines() {
        $data['status'] = '';
        $this->load->model('routine');
        $routines = $this->routine->getClientData($_GET['client_id']);

        $data['routines'] = $routines;

        $this->load->view('templates/header');
        $this->load->view('routines/listClientRoutines', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('routine');
                $data = $this->routine->getById($_POST['routine_id']);

                $data['status'] = 'ValidationError';
                $data['routine_id'] = $_POST['routine_id'];

                $this->load->view('templates/header');
                $this->load->helper('form');
                $this->load->view('routines/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['name'] = $_POST['name'];
                $data['clients_client_id'] = $_POST['clients_client_id'];

                $this->load->model('routine');
                $this->routine->update($_POST['routine_id'], $data);

                $data['status'] = 'RoutineUpdated';

                $this->load->view('templates/header');
                $this->load->helper('form');
                $this->load->view('routines/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->model('routine');
            $data = $this->routine->getById($_GET['routine_id']);
            $data['status'] = "";
            $this->load->view('templates/header');
            $this->load->helper('form');
            $this->load->view('routines/update', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function delete() {

        $data['status'] = '';

        $this->load->model('routine');
        $id = $_GET['routine_id'];

        $this->load->model('routine');
        $this->routine->delete($id);

        if ($this->db->_error_number() == 1451) {
            $data['status'] = 'CantDelete';
        }

        $routines = $this->routine->getClientData($_GET['client_id']);

        $data['routines'] = $routines;
        //load de vistas
        $this->load->view('templates/header');
        $this->load->view('routines/listClientRoutines', array('data' => $data));
        $this->load->view('templates/footer');
    }

}