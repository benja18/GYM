<?php

class Subscription extends CI_Model {
        
    function Subscription() {
        parent::__construct();
    }

    function getData() {
        $subscriptions = $this->db->get('subscriptions');

        return $subscriptions->result();
    }

    function insert($data) {
        $this->db->set('start_date', $data['start_date']);
        $this->db->set('end_date', $data['end_date']);
        $this->db->set('paid', $data['paid']);
        $this->db->set('clients_client_id', $data['clients_client_id']);
        $this->db->set('subscription_types_subscription_type_id', $data['subscription_types_subscription_type_id']);        
        $this->db->insert('subscriptions');
    }
}