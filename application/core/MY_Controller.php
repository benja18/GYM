<?php

class MY_Controller extends CI_Controller {
  
    public function __construct(){
    parent::__construct();
    //cargar configuracion
    $this->load->model('configuration');
    $this->data['daysCount'] = $this->configuration->getExpirationInterval();
    
    $this->load->model('subscription');
    $this->data['unpaidSubscriptionsCounter'] = $this->subscription->getSubscriptionsUnpaidCount();
    $this->data['nextExpirationsCounter'] = $this->subscription->getNextExpirationsCount($this->data['daysCount']);
    $expiredClients = $this->subscription->expiredClients();
    $expiredCount = 0;
    foreach ($expiredClients as $client){
        if(date('Y-m-d', strtotime($client->end_date)) <= date('Y-m-d', strtotime("+1 days"))){
            $expiredCount = $expiredCount + 1;
        }
    }
    
    $this->data['expiredClientsCount'] = $expiredCount;
    
    $this->load->model('client');
    $this->data['clientsBirths'] = $this->client->getBirthsCount();
    
    
  }
}