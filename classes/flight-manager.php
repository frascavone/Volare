<?php

class FlightFinder extends DbManager {
  
  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'partenza', 'ora_partenza', 'ora_arrivo', 'arrivo', 'prezzo', 'prezzo_business');
    $this->tableName = 'tratte';
    $this -> part = $_POST["partenza"]; 
    $this -> arr = $_POST["arrivo"];
  }
}

class FlightShower extends DbManager {
  
  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'partenza', 'ora_partenza', 'ora_arrivo', 'arrivo', 'prezzo', 'prezzo_business');
    $this->tableName = 'tratte';
  }
}