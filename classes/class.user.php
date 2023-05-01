<?php

class User {

    private $user;
    private $sql;

    function __construct($id){
       $this->sql = new SQL();
       
        $this->user = $this->sql->select("user", $id);

        if(!$this->user){
            throw new Exception('Invalid User ID');
        }
    }

    public function getUser(){
        $user = $this->user;

        $dob = $user['dob'];
        $age = (new DateTime($dob))->diff(new DateTime('today'))->y;
        
        $data = [
          "id" => $user['id'],
          "email" => $user['email'],
          "dob" => $user['dob'],
          "age" => $age,
          "profile" => $this->getUserProfile()
        ];
        return $data;
    }

    public function getUserProfile(){
        $profile = $this->sql->select("profile", $this->user["id"], "user_id"); 
        
        return $profile ?? false;
    }

}
?>