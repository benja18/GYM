<?php

class Debt extends CI_Model {
        
    function Debt() {
        parent::__construct();
    }

    function getData() {
        $sql = 'SELECT c.client_id, c.name, c.surname, c.ci, d.* FROM debts d, clients c WHERE c.client_id = d.clients_client_id ';
        $query = $this->db->query($sql);        
        return $query->result();
    }
    
    function getClientDebts($clientId) {        
        $sql = 'SELECT c.client_id, c.name, c.surname, c.ci, d.* FROM debts d, clients c WHERE d.clients_client_id =c.client_id AND d.clients_client_id = '.$clientId;
        $query = $this->db->query($sql);        
        return $query->result();
    }
    
    function insert($data) {
        $this->db->set('description', $data['description']);
        $this->db->set('value', $data['value']);
        $this->db->set('clients_client_id', $data['client_id']);
        $this->db->insert('debts');
    }
    
    function update($id, $data) {
        $this->db->where('debt_id', $id);
        $this->db->update('debts',$data);        
    }
    
    function delete($id) {
        $this->db->where('debt_id', $id);
        $this->db->delete('debts');        
    }
    
    function getById($id) {
        $this->db->where('debt_id',$id);
        $query = $this->db->get('debts');
        $expense = $query->result_array();
        return $expense[0];
    }    
}