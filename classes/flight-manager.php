<?php

class FlightManager extends DbManager {
  
  public function __construct(){
    parent::__construct();
    $this-> columns = array('id', 'partenza', 'ora_partenza', 'ora_arrivo', 'arrivo', 'prezzo', 'prezzo_business');
    $this-> tableName = 'tratte';
    $this-> part = $_GET["partenza"]; 
    $this-> arr = $_GET["arrivo"];
  }
}