<?php

class SharedAPI {
  protected $sql;

  public function __construct() {
      // Initialize the SQL class with your database configuration
      
      $this->sql = new SQL();
  }

  public function get() {
      $data = array();
      if (isset($_GET)) {
          foreach ($_GET as $key => $value) {
              $data[$key] = $value;
          }
      }
      return $data;
  }

  public function json() {
      $data = array();
      $body = file_get_contents('php://input');
      if (!empty($body)) {
          $data = json_decode($body, true);
      }
      return $data;
  }

public static function success($data) {
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($data);
    exit();
}

public static function error($message, $code = 500) {
    header('Content-Type: application/json');
    http_response_code($code);
    echo json_encode(array('error' => $message));
    exit();
}

  
}

?>