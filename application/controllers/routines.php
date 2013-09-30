<?php

class Routines extends MY_Controller {

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
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('routines/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {
                $data['name'] = $_POST['name'];
                $data['clients_client_id'] = $_POST['clients_client_id'];
                $this->load->model('routine');
                $this->routine->insert($data);

                $data['status'] = 'RoutineInserted';

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('routines/create', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {
            $data['status'] = '';

            $this->load->view('templates/header', array('data' => $this->data));
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

        $this->load->view('templates/header', array('data' => $this->data));
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

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('routines/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['name'] = $_POST['name'];
                $data['clients_client_id'] = $_POST['clients_client_id'];

                $this->load->model('routine');
                $this->routine->update($_POST['routine_id'], $data);

                $data['status'] = 'RoutineUpdated';

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('routines/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->model('routine');
            $data = $this->routine->getById($_GET['routine_id']);
            $data['status'] = "";
            $this->load->view('templates/header', array('data' => $this->data));
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
        $this->routine->deleteAllExercises($id);
        $this->routine->delete($id);

        if ($this->db->_error_number() == 1451) {
            $data['status'] = 'CantDelete';
        }

        $routines = $this->routine->getClientData($_GET['client_id']);

        $data['routines'] = $routines;
        //load de vistas
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('routines/listClientRoutines', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function addExercise() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('muscle_id', 'Muscle Id', 'required');
            $this->form_validation->set_rules('exercises_exercise_id', 'Exercise Id', 'required');
            $this->form_validation->set_rules('day', 'Day', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('muscle');
                $data['muscles'] = $this->muscle->getData();

                $data['routine_id'] = $_POST['routine_id'];
                $data['client_id'] = $_POST['client_id'];
                
                $data['status'] = 'ValidationError';

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('routines/addExercise', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['routines_routine_id'] = $_POST['routine_id'];
                $data['exercises_exercise_id'] = $_POST['exercises_exercise_id'];
                $data['day'] = $_POST['day'];

                $this->load->model('routine');
                $this->routine->insertExercise($data);
                $data['client_id'] = $_POST['client_id'];
                echo $this->db->_error_number();
                echo $this->db->_error_message();
                $data['status'] = 'ExerciseInserted';

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('routines/addExercise', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->model('muscle');
            $data['muscles'] = $this->muscle->getData();

            $data['routine_id'] = $_GET['routine_id'];
            $data['client_id'] = $_GET['client_id'];
            $data['status'] = '';

            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('routines/addExercise', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function getExercises($muscleId) {
        $this->load->model('exercise');
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->exercise->getByMuscle($muscleId)));
    }
    
    public function listExercises() {
        $data['status'] = '';
        $data['client_id'] = $_GET['client_id'];
        $this->load->model('routine');
        $exercises = $this->routine->getExercises($_GET['routine_id']);

        $data['exercises'] = $exercises;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('routines/listExercises', array('data' => $data));
        $this->load->view('templates/footer');
    }
    
    public function deleteExercise() {

        $data['status'] = '';

        $this->load->model('routine');
        $routineId = $_GET['routine_id'];
        $exerciseId = $_GET['exercise_id'];
        $clientId = $_GET['client_id'];
        $day = $_GET['day'];
        
        $this->load->model('routine');
        $this->routine->deleteExercise($routineId,$exerciseId,$day);

        $exercises = $this->routine->getExercises($routineId);

        $data['exercises'] = $exercises;
        $data['client_id'] = $clientId;
        //load de vistas
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('routines/listExercises', array('data' => $data));
        $this->load->view('templates/footer');
    }
}