<?php

class Exercises extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        $data['status'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'exercises/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['status'] = 'ValidationError';

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('exercises/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {
                $data['name'] = $_POST['name'];
                $data['muscle_id'] = $_POST['muscle_id'];

                $this->load->model('exercise');
                $this->exercise->insert($data);
                
                $data['status'] = 'ExerciseInserted';
                
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('exercises/create', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {
            $data['status'] = '';
            $this->load->model('muscle');
            $muscles = $this->muscle->getData();
            $data['muscles'] = $muscles;
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('exercises/create', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function listExercises() {
        $this->load->model('exercise');
        $exercises = $this->exercise->getData();

        $data['exercises'] = $exercises;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('exercises/listExercises', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('exercise');
                $data['exercise'] = $this->exercise->getById($_POST['exercise_id']);

                $data['status'] = 'ValidationError';
                $data['exercise_id'] = $_POST['exercise_id'];
                
                $this->load->model('muscle');
                $muscles = $this->muscle->getData();
                $data['muscles'] = $muscles;
            
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('exercises/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['name'] = $_POST['name'];
                $data['exercise_id'] = $_POST['exercise_id'];

                $this->load->model('exercise');
                $this->exercise->update($_POST['exercise_id'], $data);

                $data['status'] = 'ExerciseUpdated';
                
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('exercises/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $data['status'] = '';
            $this->load->model('muscle');
            $muscles = $this->muscle->getData();
            $data['muscles'] = $muscles;

            $this->load->model('exercise');
            $data['exercise'] = $this->exercise->getById($_GET['exercise_id']);
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('exercises/update', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function delete() {

        $data['status'] = '';

        $this->load->model('exercise');
        $id = $_GET['exercise_id'];

        $this->load->model('exercise');
        $this->exercise->delete($id);

        if ($this->db->_error_number() == 1451) {
            $data['status'] = 'CantDelete';
        }

        $exercises = $this->exercise->getData();

        $data['exercises'] = $exercises;
        //load de vistas
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('exercises/listExercises', array('data' => $data));
        $this->load->view('templates/footer');
    }

}