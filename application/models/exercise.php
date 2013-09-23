<?php

class Exercise extends CI_Model {
        
    function Exercise() {
        parent::__construct();
    }

    function getData() {
        $exercises = $this->db->get('exercises');
        return $exercises->result();
    }

    function insert($data) {
        $this->db->set('name', $data['name']);
        $this->db->set('muscle_id', $data['muscle_id']);        
        $this->db->insert('exercises');
    }
    
    function update($id, $data) {
        $this->db->where('exercise_id', $id);
        $this->db->update('exercises',$data);        
    }
    
    function delete($id) {
        $this->db->where('exercise_id', $id);
        $this->db->delete('exercises');        
    }
    
    function getById($id) {
        $this->db->where('exercise_id',$id);
        $query = $this->db->get('exercises');
        $exercise = $query->result_array();
        return $exercise[0];
    }
}