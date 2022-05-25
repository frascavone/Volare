<?php

class FlightManager extends DbManager
{

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'departure', 'depTime', 'destTime', 'destination', 'price');
    $this->tableName = 'flights';
    $this->dep = $_GET["departure"];
    $this->dest = $_GET["destination"];
  }
}
