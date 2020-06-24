<?php

  class Invoices {

    private $_id;
    private $_number;
    private $_customer;
    private $_date;
    private $_invoicePositions = [];
    private $_db;
    private $_errors = [];
    private $_table;


    public function __construct($number = '', $customer = '', $date = '') {
      $this->_number = $number;
      $this->_customer = $customer;
      $this->_date = $date;
      $this->_db = Database::getInstance();
      $this->_table = 'invoices';
    }


    public function getFromArray($array) {
      if(isset($array['id'])) {
        $this->_id = $array['id'];
      }
      $this->_number = $array['number'];
      $this->_customer = $array['customer'];
      $this->_date = $array['date'];

      if(isset($array['posName']) && isset($array['posQuantity']) && isset($array['posUnitPrice']) && isset($array['posValue'])) {
        for($i = 0; $i < count($array['posName']); $i++) {
          $this->_invoicePositions[] = new InvoicePositions(
            $array['number'],
            $i,
            $array['posName'][$i],
            $array['posQuantity'][$i],
            $array['posUnitPrice'][$i],
            $array['posValue'][$i]
          );
        }
      }
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

      foreach ($this->_invoicePositions as $position) {
        $position->insert();
      }
    }


    public function delete($id) {
      $query = $this->_db->pdo->prepare("DELETE FROM `{$this->_table}` WHERE `id` = ?");
      return $query->execute([$id]);
    }


    public function getNextNumber() {
      $query = $this->_db->pdo->prepare(
        "SELECT SUBSTR(`number`, 4) AS `lastNumber` FROM `invoices`
        WHERE SUBSTR(`number`, 1, 2) = DATE_FORMAT(CURDATE(), '%y')
        ORDER BY `number` DESC LIMIT 1"
      );
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_NAMED);
      $nextNumber = count($result) > 0 ? intval($result[0]['lastNumber']) + 1 : 1;
      $numDigits = 7;
      $this->_number = substr(date("Y"), -2) . '-';
      $this->_number .= str_pad($nextNumber, $numDigits, '0', STR_PAD_LEFT);
      return $this->_number;
    }


    public function getAll() {
      $query = $this->_db->pdo->prepare(
        "SELECT I.*, C.name AS customerName
        FROM `invoices` I LEFT JOIN `customers` C ON I.customer = C.id "
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
        $this->_errors += ['date' => 'Date can not be empty'];
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
