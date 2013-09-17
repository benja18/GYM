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

}