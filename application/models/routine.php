<?php

class Routine extends CI_Model {

    function Routine() {
        parent::__construct();
    }

    function getData() {
        $routines = $this->db->get('routines');
        return $routines->result();
    }
    
    function getClientData($id) {
        $sql = 'SELECT * FROM routines WHERE clients_client_id='.$id;
        $routines = $this->db->query($sql);               
        return $routines->result();
    }
    
    function insert($data) {
        $this->db->set('name', $data['name']);
        $this->db->set('clients_client_id', $data['clients_client_id']);
        $this->db->insert('routines');
    }

    function update($id, $data) {
        $this->db->where('routine_id', $id);
        $this->db->update('routines', $data);
    }

    function delete($id) {
        $this->db->where('routine_id', $id);
        $this->db->delete('routines');
    }

    function getById($id) {
        $this->db->where('routine_id', $id);
        $query = $this->db->get('routines');
        $routine = $query->result_array();
        return $routine[0];
    }
    
    function insertExercise($data) {
        $this->db->set('exercises_exercise_id', $data['exercises_exercise_id']);
        $this->db->set('routines_routine_id', $data['routines_routine_id']);
        $this->db->set('day', $data['day']);
        $this->db->insert('exercises_has_routines');
    }
    
    function getExercises($id) {
        $sql = 'SELECT e.exercise_id, e.name as exercise_name, e.muscles_muscle_id, m.name as muscle_name, ehr.day FROM exercises e, muscles m, exercises_has_routines ehr WHERE ehr.exercises_exercise_id = e.exercise_id AND m.muscle_id = e.muscles_muscle_id AND ehr.routines_routine_id ='.$id;
        $routines = $this->db->query($sql);               
        return $routines->result();
    }
    
    function deleteExercise($routineId,$exerciseId,$day) {
        $this->db->where('routines_routine_id', $routineId);
        $this->db->where('exercises_exercise_id', $exerciseId);
        $this->db->where('day', $day);
        $this->db->delete('exercises_has_routines');
    }
    
    function deleteAllExercises($routineId) {
        $this->db->where('routines_routine_id', $routineId);        
        $this->db->delete('exercises_has_routines');
    }
}