<?php

  class Invoices {

    private $_id;
    private $_number;
    private $_customer;
    private $_date;
    private $_db;
    private $_errors = [];
    private $_table;


    public function __construct($number = '', $customer = '', $date = '') {
      $this->_number = $number;
      $this->_customer = $customer;
      $this->_date = $date;
      $this->_db = Database::getInstance();
      $this->_table = 'customers';
    }


    public function getFromArray($array) {
      if(isset($array['id'])) {
        $this->_id = $array['id'];
      }
      $this->_number = $array['number'];
      $this->_customer = $array['customer'];
      $this->_date = $array['date'];
    }


    public function setToPost() {
      $_POST['id'] = $this->_id;
      $_POST['number'] = $this->_number;
      $_POST['customer'] = $this->_customer;
      $_POST['date'] = $this->_date;
    }


    public function exists() {
      $query = $this->_db->pdo->prepare("SELECT `id`, `number` FROM `{$this->_table}` WHERE `number` = ?");
      $query->execute([$this->_number]);
      $results = $query->fetchAll(PDO::FETCH_NAMED);
      if(count($results) == 1)
      {
        if($results[0]['id'] == $this->_id) {
          return false;
        }
        return true;
      }
      return false;
    }


    public function insert() {
      $query = $this->_db->pdo->prepare(
        "INSERT INTO `{$this->_table}` (`number`, `customer`, `date`)
          VALUES (?, ?, ?)"
      );

      $query->execute([
        $this->_number,
        $this->_customer,
        $this->_date
      ]);
    }


    public function update() {
      if(strlen($this->_id) > 0) {
        $query = $this->_db->pdo->prepare(
          "UPDATE `{$this->_table}` SET
            `number` = ?,
            `customer` = ?,
            `date` = ?
          WHERE `id` = ?"
        );

        $query->execute([
          $this->_number,
          $this->_customer,
          $this->_date,
          $this->_id
        ]);
      }
    }


    public function delete($id) {
      $query = $this->_db->pdo->prepare("DELETE FROM `{$this->_table}` WHERE `id` = ?");
      return $query->execute([$id]);
    }


    public function getAll() {
      $query = $this->_db->pdo->prepare(
        "SELECT I.*, C.name AS customerName
        FROM invoices I LEFT JOIN customers C ON I.customer = C.id "
      );
      $query->execute();
      return $query->fetchAll(PDO::FETCH_NAMED);
    }


    public function getById($id) {
      $query = $this->_db->pdo->prepare("SELECT * FROM `{$this->_table}` WHERE `id` = ?");
      $query->execute([$id]);
      $results = $query->fetchAll(PDO::FETCH_NAMED);

      if(count($results) == 1) {
        $this->getFromArray($results[0]);
      }
      return $results;
    }


    public function isValid() {
      if(strlen($this->_number) < 5) {
        $this->_errors += ['number' =>'Number must be at least 5 characters long'];
      }
      if(strlen($this->_customer) == 0) {
        $this->_errors += ['customer' => 'Customer can not be empty'];
      }
      if(strlen($this->_date) == 0) {
        $this->_errors += ['date' => 'date can not be empty'];
      }

      if(count($this->_errors) > 0) {
        return false;
      }
      return true;
    }


    public function getErrors() {
      return $this->_errors;
    }
  }
