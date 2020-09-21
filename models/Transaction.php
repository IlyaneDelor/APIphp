<?php

require_once __DIR__ . "/../DataBaseManager.php";

  class Transaction {

    private DataBaseManager $manager;


    private int $id;
    private string $customer_id;
    private string $product;
    private string $amount;
    private string $currency;
    private string $status;

    public function __construct() {
       $this->manager = new DatabaseManager();
    }

    public function addTransaction($data) {
      // Prepare Query
      $this->manager->query('INSERT INTO transactions (id, customer_id, product, amount, currency, status) VALUES(:id, :customer_id, :product, :amount, :currency, :status)');

      // Bind Values
      $this->manager->bind(':id', $data['id']);
      $this->manager->bind(':customer_id', $data['customer_id']);
      $this->manager->bind(':product', $data['product']);
      $this->manager->bind(':amount', $data['amount']);
      $this->manager->bind(':currency', $data['currency']);
      $this->manager->bind(':status', $data['status']);

      // Execute
      if($this->manager->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getTransactions() {
      $this->manager->exec('SELECT * FROM transactions ORDER BY created_at DESC');

      $results = $this->manager->resultset();

      return $results;
    }
  }