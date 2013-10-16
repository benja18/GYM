<?php

class Configuration extends CI_Model {
    function Configuration() {
        parent::__construct();
    }

    function getData() {
        $configurations = $this->db->get('configurations');
        return $configurations->result();
    }
    
    function getExpirationInterval() {
        $sql = 'SELECT configuration_value FROM configurations WHERE configuration_key = "EXPIRATION_INTERVAL_DAYS"';
        $query = $this->db->query($sql);               
        $inerval = $query->result_array();        
        return $inerval['0']['configuration_value'];
    }
    
    function updateExpirationInterval($interval) {
        $sql = 'UPDATE configurations SET configuration_value = '.$interval.' WHERE configuration_key = "EXPIRATION_INTERVAL_DAYS"';
        $query = $this->db->query($sql);                       
    }
}