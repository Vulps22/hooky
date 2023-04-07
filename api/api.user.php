<?php



require_once('api.shared.php');

class UserAPI extends SharedAPI {
  public function register() {
    $data = $this->json();

    // Hash the password
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    // Insert the user into the database using the SQL class
    $user_id = $this->sql->insert('user', $data);

    if($user_id) $this->success($user_id);
    else $this->error("Registration Failed");
}


  public function login() {
    // Validate the input data
    
    $data = $this->json();

    // Check if the user exists in the database using the SQL class
    $user = $this->sql->query_row("SELECT * FROM user WHERE email = :email LIMIT 1", array(':email' => $data['email']));
    if(!$user) return $this->error("Email Address Not Found");
    



    // Check if the password is correct using the password_verify() function
    if ($user && password_verify($data['password'], $user['password'])) {
      // Send a success response

      $dob = $user['dob'];
      $age = (new DateTime($dob))->diff(new DateTime('today'))->y;

      $data = [
        "id" => $user['id'],
        "email" => $user['email'],
        "dob" => $user['dob'],
        "age" => $age
      ];
      

      return $this->success($data);
    } else {
      // Send an error response
      return $this->error("Incorrect Password");
    }
  }

  public function ping(){
    echo "pong";
  }

}

?>