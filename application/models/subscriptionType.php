<?php

class SubscriptionType extends CI_Model {
        
    function SubscriptionType() {
        parent::__construct();
    }

    function getData() {
        $subscriptionTypes = $this->db->get('subscription_types');

        return $subscriptionTypes->result();
    }

    function insert($data) {
        $this->db->set('description', $data['description']);        
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
}