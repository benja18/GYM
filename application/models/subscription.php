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
    
    function getSubscriptionsUnpaidCount() {
        $sql = 'SELECT COUNT(*) as count FROM subscriptions WHERE paid = 0';
        $query = $this->db->query($sql);               
        $count = $query->result_array();        
        return $count['0']['count'];
    }
    
    function getNextExpirationsCount($days) {
        $sql = 'SELECT COUNT(*) as count FROM subscriptions WHERE end_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(),interval '.$days.' day)';
        $query = $this->db->query($sql);               
        $count = $query->result_array();        
        return $count['0']['count'];
    }
    
    function getNextExpirations($days) {
        $sql = 'SELECT s.* , st.description AS subscription_type, c.name AS name, c.surname AS surname, c.ci AS ci FROM subscriptions s, subscription_types st, clients c WHERE s.subscription_types_subscription_type_id = st.subscription_type_id AND s.clients_client_id = c.client_id AND end_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(),interval '.$days.' day)';
        $query = $this->db->query($sql);               
        return $query->result();                
    }
    
    function getSubscriptionsUnpaid() {
        $sql = 'SELECT s.* , st.description AS subscription_type, c.name AS name, c.surname AS surname, c.ci AS ci FROM subscriptions s, subscription_types st, clients c WHERE s.subscription_types_subscription_type_id = st.subscription_type_id AND s.clients_client_id = c.client_id AND s.paid = 0';
        $query = $this->db->query($sql);        
        return $query->result();                
    }
    
    function getByDate($start,$end) {
        $sql = 'SELECT s.* , st.description AS subscription_type, c.name AS name, c.surname AS surname, c.ci AS ci FROM subscriptions s, subscription_types st, clients c WHERE s.subscription_types_subscription_type_id = st.subscription_type_id AND s.clients_client_id = c.client_id AND s.end_date BETWEEN "'.$start.'" AND "'.$end.'"';
        $query = $this->db->query($sql);        
        return $query->result();                
    }
}