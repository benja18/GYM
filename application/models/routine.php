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

}