<?php

require_once('api.shared.php');

class UserAPI extends SharedAPI {
  public function register() {
    $data = $this->json();

    // Hash the password
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    // Insert the user into the database using the SQL class
    $user_id = $this->sql->insert('user', $data);

    $user = null;
    if($user_id) $user = new User($user_id);



    if($user) $this->success($user->getUser());
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
      if($user = new User($user['id'])){

        return $this->success($user->getUser());
      }else{
        return $this->error("Unable to retrieve User object");
      }
    } else {
      // Send an error response
      return $this->error("Incorrect Password");
    }
  }

  public function save_profile(){
    $data = $this->json();

    //var_dump($data);

    if(!$data) return $this->error("NODATA");

    $profile = [
      "user_id" => $data["id"],
      "display_name" => $data["displayName"],
      "gender" => $data["gender"],
      "sexuality" => $data["sexuality"],
      "bio" => $data["bio"],
      "show_age" => $data["showAge"],
      "body_type" => $data["bodyType"],
      "position" => $data["position"],
      "ethnicity" => $data["ethnicity"],
      "status" => $data["relationshipStatus"],
      "nsfw" => $data["acceptsNSFW"]
    ];

    $profile_id = $this->sql->update("profile", $data["id"], $profile, "user_id");

    if(!$profile_id)
    {
      $profile_id = $this->sql->insert("profile", $profile);
    
    }

    $user = new User($data["id"]);

    if(!$user->getUserProfile()) return $this->error("An unexpected Error has occured. Please Try again Later");
    return $this->success($user->getUser());
    
  }

  public function ping(){
    echo "pong";
  }

}

?>