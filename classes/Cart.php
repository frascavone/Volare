<?php

class CartManager extends DBManager{

  private $clientId;

  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'client_id');
    $this->tableName = 'carrello';
    $this-> _initClientIdFromSession();
  }

  // public methods
  public function getQty($cartId, $flight_id){
    $result = $this->db -> query("SELECT quantity FROM cart_item WHERE cart_id = $cartId AND flight_id = $flight_id");
    return $result[0]; 
  }

  public function getCartTotal($cartId){
    $result = $this-> db -> query("
    SELECT 
    SUM(quantity) as num_flights,
      SUM(quantity* prezzo) as total 
    FROM cart_item 
    INNER JOIN tratte 
      ON cart_item.flight_id = tratte.id 
    WHERE cart_id = $cartId
    ");
    return $result[0];

  }

  public function getCartItems($cartId){
    return $this -> db -> query("
    SELECT
      tratte.partenza as partenza,
      tratte.ora_partenza as ora_partenza,
      tratte.ora_arrivo as ora_arrivo,
      tratte.arrivo as arrivo,
      tratte.id as id,
      tratte.prezzo as prezzo_singolo,
      tratte.prezzo_business as prezzo_business,
      tratte.prezzo * cart_item.quantity as total,
      cart_item.data as data,
      cart_item.quantity as quantity
    FROM
      cart_item
      INNER JOIN tratte
      ON cart_item.flight_id = tratte.id
    WHERE
    cart_item.cart_id = $cartId
    ");
  }

  public function removeCart($cartId){
    $result = $this->db -> query("SELECT id FROM carrello WHERE id = $cartId");
    if($result) 
    $this -> delete($cartId);
  }

  public function removeFromCart($flight_id, $cartId){

    $quantity = 0;
    $result = $this->db -> query("SELECT quantity, id FROM cart_item WHERE cart_id = $cartId AND flight_id = $flight_id");
    $cart_itemId = $result[0]['id']; 
    if(count($result) >0){
      $quantity = $result[0]['quantity'];
    } 
    $quantity --;

    if ($quantity > 0){
    $this->db -> execute("UPDATE cart_item SET quantity = $quantity WHERE cart_id = $cartId AND flight_id = $flight_id");   
    } else{
      $cartItemMgr = new CartItemManager();
      $cartItemMgr->delete($cart_itemId); 
    } 
  }


  public function addToCart($flight_id, $cartId, $data, $qty){
    $quantity = 0;
    $result = $this->db -> query("SELECT quantity FROM cart_item WHERE cart_id = $cartId AND flight_id = $flight_id");
    if(count($result) >0){
      $quantity = $result[0]['quantity'];
    } 
    $quantity ++;
    
    if (count($result) > 0){
    $this->db -> execute("UPDATE cart_item SET quantity = $quantity, data = $data WHERE cart_id = $cartId AND flight_id = $flight_id");   
    } else{
      $cartItemMgr = new CartItemManager();
      $newId = $cartItemMgr->create([
       'cart_id' => $cartId,
       'flight_id' => $flight_id,
       'data' => $data,
       'quantity' => $qty
      ]); 
    } 
  }

  public function getCurrentCartId(){
    $cartId = 0;

    $result = $this-> db -> query("SELECT * FROM carrello WHERE client_id = '$this->clientId'");
    if (count($result) > 0){
      $cartId = $result[0]['id'];
    } else{
      $cartId = $this->create([
        'client_id' => $this->clientId
      ]);
    }
    return $cartId;
  }

  // private methods
  private function _initClientIdFromSession(){
    if (isset($_SESSION['client_id'])){
      $this->clientId = $_SESSION['client_id'];
    } else{
      // genera stringa casuale
      $str = substr(md5(mt_rand()),0 ,20);
      // assegna la stringa casuale alla variabile $clientId      
      $_SESSION['client_id'] = $str;
      $this->clientId = $str;
    }
  }  
}



class CartItemManager extends DBManager{
  public function __construct(){
    parent::__construct();
    $this->columns = array('id', 'cart_id', 'flight_id', 'quantity', 'data');
    $this->tableName = 'cart_item';
  }
}
