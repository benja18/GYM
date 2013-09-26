<?php

class Subscription extends CI_Model {
        
    function Subscription() {
        parent::__construct();
    }

    function getData() {
        $subscriptions = $this->db->get('subscriptions');

        return $subscriptions->result();
    }
    
    function getClientData($id) {
        $sql = 'SELECT s.* , st.description AS subscription_type FROM subscriptions s, subscription_types st WHERE s.subscription_types_subscription_type_id = st.subscription_type_id AND clients_client_id='.$id;
        $subscriptions = $this->db->query($sql);               
        return $subscriptions->result();
    }
    
    function insert($data) {
        $this->db->set('start_date', $data['start_date']);
        $this->db->set('end_date', $data['end_date']);
        $this->db->set('paid', $data['paid']);
        $this->db->set('price', $data['price']);
        $this->db->set('clients_client_id', $data['clients_client_id']);
        $this->db->set('subscription_types_subscription_type_id', $data['subscription_types_subscription_type_id']);        
        $this->db->insert('subscriptions');
    }
    
    function update($id, $data) {
        $this->db->where('subscription_id', $id);
        $this->db->update('subscriptions',$data);        
    }
    
    function delete($id) {
        $this->db->where('subscription_id', $id);
        $this->db->delete('subscriptions');        
    }
    
    function getById($id) {
        $this->db->where('subscription_id',$id);
        $query = $this->db->get('subscriptions');
        $subscription = $query->result_array();
        return $subscription[0];
    }
}