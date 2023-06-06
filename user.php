<?php

class User {
  private $username;
  private $password;
  private $db;

  public function __construct($username, $password, $db) {
      $this->username = $username;
      $this->password = $password;
      $this->db = $db;
  }

  public function getUsername() {
      return $this->username;
  }

  public function getPassword() {
      return $this->password;
  }

  public static function login($username, $password, $db) {
      $query = "SELECT * FROM gebruikers WHERE gebruikersnaam = :username AND wachtwoord = :password";
      $params = array(":username" => $username, ":password" => $password);
      $result = $db->execute($query, $params);

      if ($result->rowCount() > 0) {
          $row = $result->fetch(PDO::FETCH_ASSOC);
          return new User($username, $password, $db);
      } else {
          return false;
      }
  }
}

