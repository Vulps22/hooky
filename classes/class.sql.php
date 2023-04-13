<?php


class SQL {
  private $conn;

  public function __construct() {
    try{
    $host = $_ENV["DB_HOST"];
    $database = $_ENV["DB_DATABASE"];
    $username = $_ENV["DB_USERNAME"];
    $password = $_ENV["DB_PASSWORD"];


    // Connect to the database using PDO
    $dsn = "mysql:host=$host;dbname=$database";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $this->conn = new PDO($dsn, $username, $password, $options);
    }catch(PDOException $e){
      var_dump($e);
    }
  }

  public function select($table, $id, $pk = "id") {
    // Prepare and execute the SELECT query
    $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $pk = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  public function insert($table, $data) {
    // Build the named parameter placeholders and values arrays
    $named_placeholders = array();
    $values = array();
    foreach ($data as $key => $value) {
      $named_placeholders[] = ":$key";
      $values[":$key"] = $value;
    }
    $named_placeholders_str = implode(',', $named_placeholders);

    // Prepare and execute the INSERT query
    $stmt = $this->conn->prepare("INSERT INTO $table (" . implode(',', array_keys($data)) . ") VALUES ($named_placeholders_str)");
    $stmt->execute($values);
    $id = $this->conn->lastInsertId();
    return $id;
  }

  public function update($table, $id, $data, $pk = "id") {
    var_dump($data);
    // Build the named parameter placeholders and values arrays
    $set_clauses = array();
    $values = array(':id' => $id);
    foreach ($data as $key => $value) {
      $set_clauses[] = "$key = :$key";
      $values[":$key"] = $value;
    }
    $set_clauses_str = implode(',', $set_clauses);

    // Prepare and execute the UPDATE query
    $stmt = $this->conn->prepare("UPDATE $table SET $set_clauses_str WHERE $pk = :id");
    $stmt->execute($values);

    return $this->conn->lastInsertId();
  }

  public function delete($table, $id, $pk) {
    // Prepare and execute the DELETE query
    $stmt = $this->conn->prepare("DELETE FROM $table WHERE $pk = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }

  public function query($query, $data) {
    // Prepare the statement with named parameters
    $stmt = $this->conn->prepare($query);
    foreach ($data as $key => $value) {
      $stmt->bindParam($key, $data[$key]);
    }
  
    // Execute the query and return the result
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  
  public function query_row($query, $data) {
    // Prepare the statement with named parameters
    $stmt = $this->conn->prepare($query);
    foreach ($data as $key => $value) {
      $stmt->bindParam($key, $data[$key]);
    }
  
    // Execute the query and return a single row
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  
}
?>