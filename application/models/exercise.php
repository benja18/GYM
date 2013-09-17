<?php

class Exercise extends CI_Model {
        
    function Exercise() {
        parent::__construct();
    }

    function getData() {
        $exercices = $this->db->get('exercices');

        return $exercices->result();
    }

    function insert($data) {
        $this->db->set('name', $data['name']);
        $this->db->set('muscles_muscle_id', $data['muscles_muscle_id']);
        $this->db->set('days_day_id', $data['days_day_id']);        
        $this->db->insert('exercices');
    }
}