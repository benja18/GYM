<?php

class Configurations extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function updateExpirationInterval() {

        $data['status'] = '';
        $this->load->model('configuration');
        $data['expirationInterval'] = $this->configuration->getExpirationInterval();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load->helper('form', 'configurations/updateExpirationInterval');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('configuration_value', 'Configuration Value', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data['status'] = 'ValidationError';
                $data['configuration_value'] = $_POST['configuration_value'];
                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('configurations/updateExpirationInterval', array('data' => $data));
                $this->load->view('templates/footer');
            } else {

                $data['configuration_value'] = $_POST['configuration_value'];

                if (ctype_digit($data['configuration_value'])) {


                    $this->load->model('configuration');
                    $this->configuration->updateExpirationInterval($data['configuration_value']);
                    $data['status'] = 'IntervalUpdated';
                } else {
                    $data['status'] = 'IntervalNumericError';
                }

                $this->load->view('templates/header', array('data' => $this->data));
                $this->load->helper('form');
                $this->load->view('configurations/updateExpirationInterval', array('data' => $data));
                $this->load->view('templates/footer');
            }
        } else {

            $this->load->view('templates/header', array('data' => $this->data));
            $this->load->helper('form');
            $this->load->view('configurations/updateExpirationInterval', array('data' => $data));
            $this->load->view('templates/footer');
        }
    }

    public function backup() {

        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = 'root18';
        $dbname = 'gym';

        $db = mysql_connect('localhost', 'root', 'root18') or die("Error connecting to database.");
        mysql_select_db('gym', $db) or die("Couldn't select the database.");
        
        $date = date('m-d-Y');
        $command = 'C:\\xampp\\mysql\\bin\\mysqldump.exe -hlocalhost -uroot -proot18 gym > C:\\GymBackup\\dbBackup-'.$date.'.sql';  
        system($command);
        mysql_close($db);       
        redirect('home', 'refresh');
    }

}