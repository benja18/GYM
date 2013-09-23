<?php

class User extends CI_Model {

    function User() {
        parent::__construct(); //llamada al constructor de Model.
    }

    function getData() {
        $users = $this->db->get('users'); //obtenemos la tabla 'users'. db->get('nombre_tabla') equivale a SELECT * FROM nombre_tabla.

        return $users->result(); //devolvemos el resultado de lanzar la query.
    }

    function insert($data) {
        $this->db->set('username', $data['username']);
        $this->db->set('password', $data['password']);
        $this->db->insert('users');
    }
    
    function update($id, $data) {
        $this->db->where('user_id', $id);
        $this->db->update('users',$data);        
    }
    
    function delete($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('users');        
    }
    
    function getById($id) {
        $this->db->where('user_id',$id);
        $query = $this->db->get('users');
        $user = $query->result_array();
        return $user[0];
    }
}