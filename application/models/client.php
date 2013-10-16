<?php

class Client extends CI_Model {
    
    function Client() {
        parent::__construct();
    }

    function getData() {
        $clients = $this->db->get('clients');

        return $clients->result();
    }

    function insert($data) {
        $this->db->set('name', $data['name']);
        $this->db->set('surname', $data['surname']);
        $this->db->set('ci', $data['ci']);
        $this->db->set('birth', $data['birth']);
        $this->db->set('address', $data['address']);
        $this->db->set('phone', $data['phone']);
        $this->db->set('mail', $data['mail']);
        $this->db->set('emergency', $data['emergency']);
        $this->db->set('disease', $data['disease']);
        $this->db->set('ocupation', $data['ocupation']);
        $this->db->set('active', 1);
        $this->db->set('photo', $data['photo']);
        $this->db->insert('clients');
    }
    
    function update($id, $data) {
        $this->db->where('client_id', $id);
        $this->db->update('clients',$data);        
    }
    
    function delete($id) {
        $this->db->where('client_id', $id);
        $this->db->delete('clients');        
    }
    
    function getById($id) {
        $this->db->where('client_id',$id);
        $query = $this->db->get('clients');
        $client = $query->result_array();
        return $client[0];
    }
    
    function getBirthsCount() {
        $sql = 'SELECT COUNT(*) as count FROM clients WHERE birth = CURDATE()';
        $query = $this->db->query($sql);
        $count = $query->result_array();
        return $count['0']['count'];
    }
    
    function getBirthsList() {
        $sql = 'SELECT client_id, name, surname, birth, phone, mail FROM clients WHERE birth = CURDATE()';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function getActiveClients() {
        $sql = 'SELECT client_id, name, surname, ci, birth, address, phone, mail, emergency, disease, ocupation FROM clients WHERE active = 1';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function getInactiveClients() {
        $sql = 'SELECT client_id, name, surname, ci, birth, address, phone, mail, emergency, disease, ocupation FROM clients WHERE active = 0';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function setClientInactive($id) {
        $sql = 'UPDATE clients SET active = 0 WHERE client_id = '.$id;
        $this->db->query($sql);        
    }
    
    function setClientActive($id) {
        $sql = 'UPDATE clients SET active = 1 WHERE client_id = '.$id;
        $this->db->query($sql);        
    }
}