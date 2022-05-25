<?php

class DB
{

  private $conn;
  public $pdo;

  // Connessione al DB
  public function __construct()
  {
    global $conn;
    $this->conn = $conn;
    if (mysqli_connect_errno()) {
      echo "Errore connessione al Database: " . mysqli_connect_errno();
      die;
    }
    $this->pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASS);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  // query
  public function query($sql)
  {
    //try {
    $q = $this->pdo->query($sql);
    if (!$q) {
      //throw new Exception("Errore esecuzione query...");
      return;
    }
    $data = $q->fetchAll();
    return $data;
    //}catch (Exception $e) {
    //   throw $e;
    //}
  }

  public function execute($sql)
  {
    $stnt = $this->pdo->prepare($sql);
    $stnt->execute();
  }

  // query "Seleziona tutti"
  public function select_all($tableName, $columns = array())
  {
    $query = "SELECT ";

    $strCol = '';
    // var_dump($columns); die;
    foreach ($columns as $colName) {
      $strCol .= ' ' . esc($colName) . ',';
    }
    $strCol = substr($strCol, 0, -1);

    $query .= $strCol . ' FROM ' . $tableName;
    // var_dump($query); die;
    $result = mysqli_query($this->conn, $query);
    $resultArray = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    return $resultArray;
  }

  // query "Seleziona uno"
  public function select_one($tableName, $columns = array(), $id)
  {

    $strCol = '';
    foreach ($columns as $colName) {
      $colName = esc($colName);
      $strCol .= ' ' . $colName . ',';
    }
    $strCol = substr($strCol, 0, -1);
    $id = esc($id);
    $query = "SELECT $strCol FROM $tableName WHERE id = $id";

    $result = mysqli_query($this->conn, $query);
    $resultArray = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    return $resultArray;
  }

  // query "Seleziona qualcuno"
  public function select_some($tableName, $dep, $dest)
  {
    $query = "SELECT * FROM $tableName WHERE departure = '$dep' AND destination = '$dest'";
    // var_dump($query); die;

    $result = mysqli_query($this->conn, $query);
    $resultArray = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    return $resultArray;
  }

  public function select_some_inverted($tableName, $dep, $dest)
  {
    $query = "SELECT * FROM $tableName WHERE departure = '$dest' AND destination = '$dep'";
    // var_dump($query); die;

    $result = mysqli_query($this->conn, $query);
    $resultArray = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    return $resultArray;
  }


  // query "Cancella uno"
  public function delete_one($tableName, $id)
  {

    $id = esc($id);
    $query = "DELETE FROM $tableName WHERE id = $id";

    if (mysqli_query($this->conn, $query)) {
      $rowsAffected = mysqli_affected_rows($this->conn);

      return $rowsAffected;
    } else {
      return -1;
    }
  }

  // query "Aggiorna uno"
  public function update_one($tableName, $columns = array(), $id)
  {
    $id = esc($id);
    $strCol = '';
    foreach ($columns as $colName => $colValue) {
      $colName = esc($colName);
      $strCol .= " " . $colName . " = '$colValue' ,";
    }
    $strCol = substr($strCol, 0, -1);

    $query = "UPDATE $tableName SET $strCol WHERE id = $id";
    $query = str_replace("'NULL'", "NULL", $query);
    //var_dump($query); die;
    if (mysqli_query($this->conn, $query)) {
      $rowsAffected = mysqli_affected_rows($this->conn);

      return $rowsAffected;
    } else {

      return -1;
    }
  }

  // query "Inserisci uno"
  public function insert_one($tableName, $columns = array())
  {

    $strCol = '';
    foreach ($columns as $colName => $colValue) {
      $colName = esc($colName);
      $strCol .= ' ' . $colName . ',';
    }
    $strCol = substr($strCol, 0, -1);

    $strColValues = '';
    foreach ($columns as $colName => $colValue) {
      $colValue = esc($colValue);
      $strColValues .= " '" . $colValue . "' ,";
    }
    $strColValues = substr($strColValues, 0, -1);

    $query = "INSERT INTO $tableName ($strCol) VALUES ($strColValues)";
    // var_dump($query); die;
    if (mysqli_query($this->conn, $query)) {
      $lastId = mysqli_insert_id($this->conn);

      return $lastId;
    } else {

      return -1;
    }
  }
}

class DBManager
{
  protected $db;
  protected $columns;
  protected $tableName;

  public function __construct()
  {
    $this->db = new DB();
  }

  public function get($id)
  {
    $resultArr = $this->db->select_one($this->tableName, $this->columns, (int)$id);
    return (object) $resultArr;
  }

  public function getAll()
  {
    $results = $this->db->select_all($this->tableName, $this->columns);
    $objects = array();
    foreach ($results as $result) {
      array_push($objects, (object)$result);
    }
    return $objects;
  }

  public function getSome()
  {
    $results = $this->db->select_some($this->tableName, $this->dep, $this->dest);
    $objects = array();
    foreach ($results as $result) {
      array_push($objects, (object)$result);
    }
    return $objects;
  }

  public function getSomeInverted()
  {
    $results = $this->db->select_some_inverted($this->tableName, $this->dep, $this->dest);
    $objects = array();
    foreach ($results as $result) {
      array_push($objects, (object)$result);
    }
    return $objects;
  }

  public function create($obj)
  {
    $newId = $this->db->insert_one($this->tableName, (array) $obj);
    return $newId;
  }

  public function delete($id)
  {
    $rowsDeleted = $this->db->delete_one($this->tableName, (int)$id);
    return (int) $rowsDeleted;
  }

  public function update($obj, $id)
  {
    $rowsUpdated = $this->db->update_one($this->tableName, (array) $obj, (int)$id);
    return (int) $rowsUpdated;
  }
}
