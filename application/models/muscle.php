<?php

class Muscle extends CI_Model {
        
    function Muscle() {
        parent::__construct();
    }

    function getData() {
        $muscles = $this->db->get('muscles');

        return $muscles->result();
    }

    function insert($data) {
        $this->db->set('name', $data['name']);        
        $this->db->insert('muscles');
    }
}