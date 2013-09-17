<?php

class SubscriptionType extends CI_Model {
        
    function SubscriptionType() {
        parent::__construct();
    }

    function getData() {
        $subscriptionTypes = $this->db->get('subscriptionTypes');

        return $subscriptionTypes->result();
    }

    function insert($data) {
        $this->db->set('description', $data['name']);        
        $this->db->insert('subscriptionTypes');
    }
}