<?php

class Configuration extends CI_Model {
    function Configuration() {
        parent::__construct();
    }

    function getData() {
        $configurations = $this->db->get('configurations');

        return $configurations->result();
    }

    function insert($data) {
        $this->db->set('key', $data['key']);
        $this->db->set('value', $data['value']);        
        $this->db->insert('configurations');
    }

}