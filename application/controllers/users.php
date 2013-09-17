<?php

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form','users/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('passwordCheck', 'PasswordCheck', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['status'] = 'ValidationError';
                //$this->load->helper('url');
                $this->load->view('templates/header');
                $this->load->helper('form');
                $this->load->view('users/create', array('data' => $data));
                $this->load->view('templates/footer');
            } else {
                //recogemos los datos obtenidos por POST
                $data['username'] = $_POST['username'];
                $data['password'] = $_POST['password'];

                $passwordCheck = $_POST['passwordCheck'];

                if ($data['password'] == $passwordCheck) {
                    //llamamos al modelo, concretamente a la función insert() para que nos haga el insert en la base de datos.
                    $this->load->model('user');
                    $this->user->insert($data);
                    if($this->db->_error_number() == 1062){
                        $data['status'] = 'UsernameDuplicated';
                    }   else{
                            $data['status'] = 'UserInserted';
                    }                  
                    
                    $this->load->view('templates/header');
                    $this->load->helper('form');
                    $this->load->view('users/create', array('data' => $data));
                    $this->load->view('templates/footer');                    
                } else {
                    $data['status'] = 'WrongPasswords';
                    $this->load->view('templates/header');
                    $this->load->helper('form');
                    $this->load->view('users/create', array('data' => $data));
                    $this->load->view('templates/footer');
                }
            }
        } else {
            $data['status'] = 'Empty';
            $this->load->view('templates/header');
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
        $this->load->view('templates/header');
        $this->load->view('users/listUsers', array('data' => $data)); //llamada a la vista, que crearemos posteriormente
        $this->load->view('templates/footer');
    }

    public function update() {

        $status['status'] = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() === FALSE) {
                $status['status'] = 'Missing Text';
                $this->load->helper('url');
                redirect('users/create');
            } else {
                //recogemos los datos obtenidos por POST
                $data['username'] = $_POST['username'];
                $data['password'] = $_POST['password'];

                try {
                    //llamamos al modelo, concretamente a la función insert() para que nos haga el insert en la base de datos.
                    $this->load->model('user');
                    $this->user->insert($data);
                } catch (Exception $exc) {
                    if ($this->db->_error_number() == 1062) {
                        echo'usuario ya existe';
                    }
                }

                $this->load->helper('url');
                redirect('');
            }
        } else {

            $this->load->view('templates/header');
            $this->load->helper('form');
            $this->load->view('users/update');
            $this->load->view('templates/footer');
        }
    }

}