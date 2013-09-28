<?php

class Expense extends CI_Model {
        
    function Expense() {
        parent::__construct();
    }

    function getData($start, $end) {        
        $sql = 'SELECT * FROM expenses WHERE date BETWEEN "'.$start.'" AND "'.$end.'"';
        $query = $this->db->query($sql);        
        return $query->result();
    }

    function insert($data) {
        $this->db->set('name', $data['name']);
        $this->db->set('value', $data['value']);
        $this->db->set('date', $data['date']);
        $this->db->insert('expenses');
    }
    
    function update($id, $data) {
        $this->db->where('expense_id', $id);
        $this->db->update('expenses',$data);        
    }
    
    function delete($id) {
        $this->db->where('expense_id', $id);
        $this->db->delete('expenses');        
    }
    
    function getById($id) {
        $this->db->where('expense_id',$id);
        $query = $this->db->get('expenses');
        $expense = $query->result_array();
        return $expense[0];
    }
}