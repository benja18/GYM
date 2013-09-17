<?php

class Day extends CI_Model {
        
    function Day() {
        parent::__construct();
    }

    function getData() {
        $days = $this->db->get('days');

        return $days->result();
    }

    function insert($data) {
        $this->db->set('name', $data['name']);
        $this->db->set('routines_routine_id', $data['routines_routine_id']);        
        $this->db->insert('days');
    }
}