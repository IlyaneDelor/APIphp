<?php

require_once __DIR__ . "/../DataBaseManager.php";

  class CustomerPay {

    private DataBaseManager $manager;

    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;

     public function __construct() {
 
      $this->manager = new DatabaseManager();

    }


    public function addCustomerPay($data) {
      // Prepare Query
      $this->manager->query('INSERT INTO customerPay (id, first_name, last_name, email) VALUES(:id, :first_name, :last_name, :email)');

      // Bind Values
      $this->manager->bind(':id', $data['id']);
      $this->manager->bind(':first_name', $data['first_name']);
      $this->manager->bind(':last_name', $data['last_name']);
      $this->manager->bind(':email', $data['email']);

      // Execute
      if($this->manager->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getCustomers() {
      $this->manager->exec('SELECT * FROM customerPay ORDER BY created_at DESC');

      $results = $this->manager->resultset();

      return $results;
    }
  }