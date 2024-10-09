<?php 

class Technician {
  private $techID;
  private $firstName;
  private $lastName;
  private $email;
  private $phone;
  private $password;

  public function __construct($techID, $firstName, $lastName, $email, $phone, $password) {
    $this->techID = $techID;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->phone = $phone;
    $this->password = $password; 
  }

  // getters
  public function getTechID() {
    return $this->techID;
  }

  public function getFirstName() {
    return $this->firstName;
  }

  public function getLastName() {
    return $this->lastName;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function getPassword() {
    return $this->password;
  }

  // method to get full name

  public function getFullName() {
    return $this->firstName . '' . $this->lastName;
  }
}

?>