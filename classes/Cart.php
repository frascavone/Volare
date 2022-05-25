<?php

class CartManager extends DBManager
{

  private $clientId;

  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'clientId');
    $this->tableName = 'cart';
    $this->_initClientIdFromSession();
  }

  // public methods
  public function getQty($cartId, $flightId)
  {
    $result = $this->db->query("SELECT passengers FROM ticket WHERE cartId = $cartId AND flightId = $flightId");
    return $result[0];
  }

  public function getCartTotal($cartId)
  {
    $result = $this->db->query("
    SELECT 
    SUM(passengers) as passengers,
      SUM(passengers* price) as total 
    FROM ticket 
    INNER JOIN flights 
      ON ticket.flightId = flights.id 
    WHERE cartId = $cartId
    ");
    return $result[0];
  }

  public function getTickets($cartId)
  {
    return $this->db->query("
    SELECT
      flights.departure as departure,
      flights.depTime as depTime,
      flights.destTime as destTime,
      flights.destination as destination,
      flights.id as id,
      flights.price as singlePrice,
      flights.price * ticket.passengers as total,
      ticket.flightDate as flightDate,
      ticket.passengers as passengers
    FROM
      ticket
      INNER JOIN flights
      ON ticket.flightId = flights.id
    WHERE
    ticket.cartId = $cartId
    ");
  }

  public function removeCart($cartId)
  {
    $result = $this->db->query("SELECT id FROM cart WHERE id = $cartId");
    if ($result)
      $this->delete($cartId);
  }

  public function removeFromCart($flightId, $cartId)
  {

    $quantity = 0;
    $result = $this->db->query("SELECT passengers, id FROM ticket WHERE cartId = $cartId AND flightId = $flightId");
    $cartItemId = $result[0]['id'];
    if (count($result) > 0) {
      $quantity = $result[0]['passengers'];
    }
    $quantity--;

    if ($quantity > 0) {
      $this->db->execute("UPDATE ticket SET passengers = $quantity WHERE cartId = $cartId AND flightId = $flightId");
    } else {
      $cartItemMgr = new TicketManager();
      $cartItemMgr->delete($cartItemId);
    }
  }


  public function addToCart($flightId, $cartId, $flightDate, $psg)
  {
    $quantity = 0;
    $result = $this->db->query("SELECT passengers FROM ticket WHERE cartId = $cartId AND flightId = $flightId");
    if (count($result) > 0) {
      $quantity = $result[0]['passengers'];
    }
    $quantity++;

    if (count($result) > 0) {
      $this->db->execute("UPDATE ticket SET passengers = $quantity, flightDate = $flightDate WHERE cartId = $cartId AND flightId = $flightId");
    } else {
      $cartItemMgr = new TicketManager();
      $newId = $cartItemMgr->create([
        'cartId' => $cartId,
        'flightId' => $flightId,
        'flightDate' => $flightDate,
        'passengers' => $psg
      ]);
    }
  }

  public function getCurrentCartId()
  {
    $cartId = 0;

    $result = $this->db->query("SELECT * FROM cart WHERE clientId = '$this->clientId'");
    if (count($result) > 0) {
      $cartId = $result[0]['id'];
    } else {
      $cartId = $this->create([
        'clientId' => $this->clientId
      ]);
    }
    return $cartId;
  }

  // private methods
  private function _initClientIdFromSession()
  {
    if (isset($_SESSION['clientId'])) {
      $this->clientId = $_SESSION['clientId'];
    } else {
      // genera stringa casuale
      $str = substr(md5(mt_rand()), 0, 20);
      // assegna la stringa casuale alla variabile $clientId      
      $_SESSION['clientId'] = $str;
      $this->clientId = $str;
    }
  }
}



class TicketManager extends DBManager
{
  public function __construct()
  {
    parent::__construct();
    $this->columns = array('id', 'cartId', 'flightId', 'passengers', 'flightDate');
    $this->tableName = 'ticket';
  }
}
