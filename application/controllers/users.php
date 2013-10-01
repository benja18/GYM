<?php

class Users extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'users/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passwordCheck', 'PasswordCheck', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['status'] = 'ValidationError';
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('users/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {
                //recogemos los datos obtenidos por POST
                $data['username'] = $_POST['username'];
                $data['password'] = md5($_POST['password']);

                if ($data['password'] == md5($_POST['passwordCheck'])) {
                    //llamamos al modelo, concretamente a la función insert() para que nos haga el insert en la base de datos.
                    $this->load->model('user');
                    $this->user->insert($data);
                    if ($this->db->_error_number() == 1062) {
                        $data['status'] = 'UsernameDuplicated';
                    } else {
                        $data['status'] = 'UserInserted';
                    }

                    $this->load->view('templates/header', array('data' => $this->data));
                    $this->load->helper('form');
                    $this->load->view('users/create', array('data' => $data));
                    $this->load->view('templates/footer');
                } else {
                    $data['status'] = 'WrongPasswords';
                    $this->load->view('templates/header', array('data' => $this->data));
                    $this->load->helper('form');
                    $this->load->view('users/create', array('data' => $data));
                    $this->load->view('templates/footer');
                }
            }
        } else {
            $data['status'] = '';
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('users/create', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function listUsers() {
        $this->load->model('user'); //cargamos el modelo        
        //Obtener datos de la tabla 'contacto'
        $users = $this->user->getData(); //llamamos a la función getData() del modelo creado anteriormente.

        $data['users'] = $users;

        //load de vistas
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('users/listUsers', array('data' => $data)); //llamada a la vista, que crearemos posteriormente
        $this->load->view('templates/footer');
    }

    public function update() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('user');
                $data = $this->user->getById($_POST['user_id']);

                $data['status'] = 'ValidationError';
                $data['user_id'] = $_POST['user_id'];

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('users/update', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['username'] = $_POST['username'];
                $data['user_id'] = $_POST['user_id'];

                $this->load->model('user');
                $this->user->update($_POST['user_id'], $data);

                if ($this->db->_error_number() == 1062) {
                    $data['status'] = 'UsernameDuplicated';
                } else {
                    $data['status'] = 'UserUpdated';
                }

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('users/update', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->model('user');
            $data = $this->user->getById($_GET['user_id']);
            $data['status'] = "";
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('users/update', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function delete() {

        $this->load->model('user');
        $id = $_GET['user_id'];

        $this->load->model('user');
        $this->user->delete($id);

        $users = $this->user->getData(); //llamamos a la función getData() del modelo creado anteriormente.

        $data['users'] = $users;
        //load de vistas
        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('users/listUsers', array('data' => $data)); //llamada a la vista, que crearemos posteriormente
        $this->load->view('templates/footer');
    }

    public function updatePassword() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('oldPassword', 'OldPassword', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passwordCheck', 'PasswordCheck', 'required');

            if ($this->form_validation->run() === FALSE) {

                $this->load->model('user');
                $data = $this->user->getById($_POST['user_id']);

                $data['status'] = 'ValidationError';
                $data['user_id'] = $_POST['user_id'];

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('users/updatePassword', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $oldPassword = md5($_POST['oldPassword']);
                $data['password'] = md5($_POST['password']);                

                if ($data['password'] == md5($_POST['passwordCheck'])) {
                    
                    $this->load->model('user');
                    $user = $this->user->getById($_POST['user_id']);
                    
                    if($user['password'] == $oldPassword){
                        $this->user->update($_POST['user_id'], $data);
                        $data['status'] = 'UserUpdated';
                    } else{
                        $data['status'] = 'WrongOldPassword';
                    }
                    $data['user_id'] = $_POST['user_id'];
                    $this->load->view('templates/header', array('data' => $this->data));
                    $this->load->helper('form');
                    $this->load->view('users/updatePassword', array('data' => $data));
                    $this->load->view('templates/footer');
                } else {
                    $data['user_id'] = $_POST['user_id'];
                    $data['status'] = 'WrongPasswords';
                    $this->load->view('templates/header', array('data' => $this->data));
                    $this->load->helper('form');
                    $this->load->view('users/updatePassword', array('data' => $data));
                    $this->load->view('templates/footer');
                }
            }
        } else {

            $this->load->model('user');
            $data = $this->user->getById($_GET['user_id']);
            $data['status'] = "";
            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('users/updatePassword', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

}