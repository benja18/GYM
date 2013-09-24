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
    
    function update($id, $data) {
        $this->db->where('muscle_id', $id);
        $this->db->update('muscles',$data);        
    }
    
    function delete($id) {
        $this->db->where('muscle_id', $id);
        $this->db->delete('muscles');        
    }
    
    function getById($id) {
        $this->db->where('muscle_id',$id);
        $query = $this->db->get('muscles');
        $muscle = $query->result_array();
        return $muscle[0];
    }
}