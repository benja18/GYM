<?php

class Subscription_type extends CI_Model {
        
    function Subscription_type() {
        parent::__construct();
    }

    function getData() {
        $subscriptionTypes = $this->db->get('subscription_types');

        return $subscriptionTypes->result();
    }

    function insert($data) {
        $this->db->set('description', $data['description']);        
        $this->db->set('days', $data['days']);
        $this->db->set('price', $data['price']);
        $this->db->insert('subscription_types');
    }
    
    
    function update($id, $data) {
        $this->db->where('subscription_type_id', $id);
        $this->db->update('subscription_types',$data);
    }
    
    function delete($id) {
        $this->db->where('subscription_type_id', $id);
        $this->db->delete('subscription_types');        
    }
    
    function getById($id) {
        $this->db->where('subscription_type_id',$id);
        $query = $this->db->get('subscription_types');
        $subscriptionType = $query->result_array();
        return $subscriptionType[0];
    }
    
    function getDayAmount($id) {        
        $sql = 'SELECT days FROM subscription_types where subscription_type_id='.$id;
        $query = $this->db->query($sql);
        $days = $query->result_array();
        return $days[0]['days'];
    }
    
    function getPrice($id) {        
        $sql = 'SELECT price FROM subscription_types where subscription_type_id='.$id;
        $query = $this->db->query($sql);
        $price = $query->result_array();
        return $price[0]['price'];
    }
}