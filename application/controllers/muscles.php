<?php

class Muscles extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'muscles/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['status'] = 'ValidationError';
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('muscles/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {
                $data['name'] = $_POST['name'];

                $this->load->model('muscle');
                $this->muscle->insert($data);
                if ($this->db->_error_number() == 1062) {
                    $data['status'] = 'NameDuplicated';
                } else {
                    $data['status'] = 'MuscleInserted';
                }

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('muscles/create', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {
            $data['status'] = '';

            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('muscles/create', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function listMuscles() {
        $data['status'] = '';
        $this->load->model('muscle');
        $muscles = $this->muscle->getData();

        $data['muscles'] = $muscles;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('muscles/listMuscles', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('muscle');
                $data = $this->muscle->getById($_POST['muscle_id']);

                $data['status'] = 'ValidationError';
                $data['muscle_id'] = $_POST['muscle_id'];

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('muscles/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['name'] = $_POST['name'];
                $data['muscle_id'] = $_POST['muscle_id'];

                $this->load->model('muscle');
                $this->muscle->update($_POST['muscle_id'], $data);

                if ($this->db->_error_number() == 1062) {
                    $data['status'] = 'NameDuplicated';
                } else {
                    $data['status'] = 'MuscleUpdated';
                }

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('muscles/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->model('muscle');
            $data = $this->muscle->getById($_GET['muscle_id']);
            $data['status'] = "";
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('muscles/update', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function delete() {

        $data['status'] = '';

        $this->load->model('muscle');
        $id = $_GET['muscle_id'];

        $this->load->model('muscle');
        $this->muscle->delete($id);

        if ($this->db->_error_number() == 1451) {
            $data['status'] = 'CantDelete';
        }

        $muscles = $this->muscle->getData();

        $data['muscles'] = $muscles;
        //load de vistas
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('muscles/listMuscles', array('data' => $data));
        $this->load->view('templates/footer');
    }

}