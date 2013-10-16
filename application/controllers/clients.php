<?php

class Clients extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function create() {
                
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_SERVER['CONTENT_LENGTH'] > 8380000) {
                redirect('clients/create');
            }
            $this->load->helper('form', 'clients/create');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('surname', 'Surname', 'required');
            $this->form_validation->set_rules('ci', 'Ci', 'required');

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
                $data['birth'] = empty($_POST['birth']) ? NULL : date('Y-m-d', strtotime($_POST['birth']));
                $data['address'] = $_POST['address'];
                $data['phone'] = $_POST['phone'];
                $data['mail'] = $_POST['mail'];
                $data['emergency'] = $_POST['emergency'];
                $data['disease'] = $_POST['disease'];
                $data['ocupation'] = $_POST['ocupation'];

                if ($_FILES['photo']['name']) {
                    if (!$_FILES['photo']['error']) {
                        $data['photo'] = str_replace('.', '', $data['ci']) . '.jpeg';
                        $convert = imagejpeg(imagecreatefromstring(file_get_contents($_FILES['photo']['tmp_name'])), 'C:\xampp\htdocs\GYM\assets\photos\\' . $data['photo'], 9);
                        if ($convert) {
                            $this->load->model('client');
                            $this->client->insert($data);

                            if ($this->db->_error_number() == 1062) {
                                $data['status'] = 'CiDuplicated';
                                $data['client_id'] = '';
                            } else {
                                $data['client_id'] = $this->db->insert_id();
                                $data['status'] = 'ClientInserted';
                            }
                        } else {
                            $data['status'] = 'InvalidFormat';
                        }
                    } else {
                        $data['status'] = 'FileError';
                    }
                } else {
                    $data['photo'] = 'empty.jpg';
                    $this->load->model('client');
                    $this->client->insert($data);

                    if ($this->db->_error_number() == 1062) {
                        $data['status'] = 'CiDuplicated';
                        $data['client_id'] = '';
                    } else {
                        $data['client_id'] = $this->db->insert_id();
                        $data['status'] = 'ClientInserted';
                    }
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
            if ($_SERVER['CONTENT_LENGTH'] > 8380000) {
                redirect('clients/listClients');                
            }
            $this->load->helper('form', 'clients/update');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('surname', 'Surname', 'required');
            $this->form_validation->set_rules('ci', 'Ci', 'required');

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
                $data['birth'] = empty($_POST['birth']) ? NULL : date('Y-m-d', strtotime($_POST['birth']));
                $data['address'] = $_POST['address'];
                $data['phone'] = $_POST['phone'];
                $data['mail'] = $_POST['mail'];
                $data['emergency'] = $_POST['emergency'];
                $data['disease'] = $_POST['disease'];
                $data['ocupation'] = $_POST['ocupation'];
                $data['active'] = $_POST['active'];

                if ($_FILES['photo']['name']) {
                    if (!$_FILES['photo']['error']) {
                        $data['photo'] = str_replace('.', '', $data['ci']) . '.jpeg';

                        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);

                        if ($extension == 'jpeg' || $extension == 'jpg' || $extension == 'png') {
                            $convert = imagejpeg(imagecreatefromstring(file_get_contents($_FILES['photo']['tmp_name'])), 'C:\xampp\htdocs\GYM\assets\photos\\' . $data['photo'], 9);
                            if ($convert) {
                                $this->load->model('client');
                                $this->client->update($_POST['client_id'], $data);

                                if ($this->db->_error_number() == 1062) {
                                    $data['status'] = 'CiDuplicated';
                                } else {
                                    $data['status'] = 'ClientUpdated';
                                }
                            } else {
                                $this->load->model('client');
                                $data = $this->client->getById($_POST['client_id']);

                                $data['status'] = 'InvalidFormat';
                                $data['client_id'] = $_POST['client_id'];
                            }
                        } else {
                            $this->load->model('client');
                            $data = $this->client->getById($_POST['client_id']);

                            $data['status'] = 'InvalidFormat';
                            $data['client_id'] = $_POST['client_id'];
                        }
                    } else {
                        $this->load->model('client');
                        $data = $this->client->getById($_POST['client_id']);

                        $data['status'] = 'FileError';
                        $data['client_id'] = $_POST['client_id'];
                    }
                } else {
                    //$data['photo'] = 'empty.jpg';
                    $this->load->model('client');
                    $this->client->update($_POST['client_id'], $data);

                    if ($this->db->_error_number() == 1062) {
                        $data['status'] = 'CiDuplicated';
                    } else {
                        $data['status'] = 'ClientUpdated';
                    }
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

    public function listBirths() {

        $data['status'] = "";
        $this->load->model('client');

        $clients = $this->client->getBirthsList();

        $data['clients'] = $clients;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('clients/listBirths', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function listActiveClients() {

        $data['status'] = "";
        $this->load->model('client');

        $clients = $this->client->getActiveClients();

        $data['clients'] = $clients;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('clients/listActiveClients', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function listInactiveClients() {

        $data['status'] = "";
        $this->load->model('client');

        $clients = $this->client->getInactiveClients();

        $data['clients'] = $clients;

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('clients/listInactiveClients', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function setClientInactive() {

        $data['status'] = "";

        $this->load->model('client');
        $id = $_GET['client_id'];

        $this->load->model('client');
        $this->client->setClientInactive($id);

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('welcome_message', array('data' => $data));
        $this->load->view('templates/footer');
    }

    public function setClientActive() {

        $data['status'] = "";

        $this->load->model('client');
        $id = $_GET['client_id'];

        $this->load->model('client');
        $this->client->setClientActive($id);

        $this->load->view('templates/header', array('data' => $this->data));
        $this->load->view('welcome_message', array('data' => $data));
        $this->load->view('templates/footer');
    }

}