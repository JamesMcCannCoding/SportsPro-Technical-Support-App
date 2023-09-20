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

    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;
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
    
    public function getTechID() {
        return $this->techID;
    }
    
}
?>
