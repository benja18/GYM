<?php

class Routine extends CI_Model {
        
    function Routine() {
        parent::__construct();
    }

    function getData() {
        $routines = $this->db->get('routines');

        return $routines->result();
    }

    function insert($data) {
        $this->db->set('name', $data['name']);
        $this->db->set('clients_client_id', $data['clients_client_id']);        
        $this->db->insert('routines');
    }
}