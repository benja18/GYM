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
  }
}