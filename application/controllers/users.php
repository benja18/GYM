<?php

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->model('user'); //cargamos el modelo        

        //Obtener datos de la tabla 'contacto'
        $usuarios = $this->user->getData(); //llamamos a la función getData() del modelo creado anteriormente.

        $data['usuarios'] = $usuarios;

        //load de vistas
        $this->load->view('templates/header'); 
        $this->load->view('users/home'); //llamada a la vista, que crearemos posteriormente
        $this->load->view('templates/footer', $data); 
    }

    /*public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['username'] = 'Create a news user';

        $this->form_validation->set_rules('username', 'text', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('users/create');
            $this->load->view('templates/footer');
        } else {
            $this->user->set_news();
            $this->load->view('users/create');
        }
    }*/
    
 public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //recogemos los datos obtenidos por POST
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            //llamamos al modelo, concretamente a la función insert() para que nos haga el insert en la base de datos.
            $this->load->model('user');
            $this->user->insert($data);
            
            $this->load->helper('url');
            redirect('');
        } else {
            $this->load->view('templates/header');
            $this->load->helper('form');
            $this->load->view('users/create');
            $this->load->view('templates/footer');
        }
    }

}