<?php

class UserManager extends DBManager{

  public function __construct(){
    parent::__construct();
    $this -> tableName = 'user';
    $this -> columns = ['id', 'email', 'password', 'user_type_id'];

  }

  //public methods
  public function login($email, $password){
    $result = $this-> db -> query("
      SELECT *
      FROM user
      WHERE email = '$email'
      AND password = MD5('$password');
    ");

    if(count($result) > 0) {
      $user = (object) $result[0];
      //set user
      $this -> _setUser($user);
      return true;
    }
    return false;
  }

  public function passwordsMatch($password, $confirm_password){
    return $password == $confirm_password;
  }


  public function register($email, $password){
    
    $result = $this-> db -> query("SELECT * FROM user WHERE email = '$email'");

    if(!$result){
    $userId = $this-> create([
      'email' => $email,
      'password' => md5($password),
      'user_type_id' => 2
    ]);
    return $userId;
    } 
    return false;
    
  }


  //private methods
  private function _setUser($user){
    
    $storedUser = (object) [
      'id' => $user-> id,
      'email' => $user -> email,
      'is_admin' => $user -> user_type_id == 1
    ];
      
    $_SESSION['user'] = $storedUser;
  }  
}



