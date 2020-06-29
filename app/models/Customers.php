<?php

  class Customers {

    private $_id;
    private $_name;
    private $_address;
    private $_taxCode;
    private $_zip;
    private $_state;
    private $_country;
    private $_contact;
    private $_db;
    private $_errors = [];
    private $_table;


    public function __construct($name = '', $address = '', $taxCode = '', $zip = '', $state = '', $country = '', $contact = '') {
      $this->_name = $name;
      $this->_address = $address;
      $this->_taxCode = $taxCode;
      $this->_zip = $zip;
      $this->_state = $state;
      $this->_country = $country;
      $this->_contact = $contact;
      $this->_db = Database::getInstance();
      $this->_table = 'customers';
    }


    public function getFromArray($array) {
      if(isset($array['id'])) {
        $this->_id = $array['id'];
      }
      $this->_name = $array['name'];
      $this->_address = $array['address'];
      $this->_taxCode = $array['taxCode'];
      $this->_zip = $array['zip'];
      $this->_state = $array['state'];
      $this->_country = $array['country'];
      $this->_contact = $array['contact'];
    }


    public function setToPost() {
      $_POST['id'] = $this->_id;
      $_POST['name'] = $this->_name;
      $_POST['address'] = $this->_address;
      $_POST['taxCode'] = $this->_taxCode;
      $_POST['zip'] = $this->_zip;
      $_POST['state'] = $this->_state;
      $_POST['country'] = $this->_country;
      $_POST['contact'] = $this->_contact;
    }


    public function exists() {
      $query = $this->_db->pdo->prepare("SELECT `id`, `name` FROM `{$this->_table}` WHERE `name` = ?");
      $query->execute([$this->_name]);
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
        "INSERT INTO `{$this->_table}` (`name`, `address`, `taxCode`, `zip`, `state`, `country`, `contact`)
          VALUES (?, ?, ?, ?, ?, ?, ?)"
      );

      try {
        $query->execute([
          $this->_name,
          $this->_address,
          $this->_taxCode,
          $this->_zip,
          $this->_state,
          $this->_country,
          $this->_contact
        ]);
      } catch (PDOException $e) {
        die($e->getMessage());
      }
    }


    public function update() {
      if(strlen($this->_id) > 0) {
        $query = $this->_db->pdo->prepare(
          "UPDATE `{$this->_table}` SET
            `name` = ?,
            `address` = ?,
            `taxCode` = ?,
            `zip` = ?,
            `state` = ?,
            `country` = ?,
            `contact` = ?
          WHERE `id` = ?"
        );

        $query->execute([
          $this->_name,
          $this->_address,
          $this->_taxCode,
          $this->_zip,
          $this->_state,
          $this->_country,
          $this->_contact,
          $this->_id
        ]);
      }
    }


    public function delete($id) {
      $query = $this->_db->pdo->prepare("DELETE FROM `{$this->_table}` WHERE `id` = ?");
      return $query->execute([$id]);
    }


    public function getList() {
      $query = $this->_db->pdo->prepare("SELECT * FROM customers ORDER BY `id`");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_NAMED);
    }


    public function getAll() {
      $query = $this->_db->pdo->prepare(
        "SELECT C.*, CO.name AS countryName
        FROM customers C LEFT JOIN countries CO ON C.country = CO.id "
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
      if(strlen($this->_name) < 2) {
        $this->_errors += ['name' =>'Name must be at least 2 characters long'];
      }
      if(strlen($this->_address) == 0) {
        $this->_errors += ['address' => 'Address can not be empty'];
      }
      if(strlen($this->_taxCode) < 10) {
        $this->_errors += ['taxCode' => 'Tax code can not be empty'];
      }
      if(strlen($this->_zip) == 0) {
        $this->_errors += ['zip' => 'Zip code can not be empty'];
      }
      if(strlen($this->_country) == 0) {
        $this->_errors += ['country' => 'Country can not be empty'];
      }
      if(strlen($this->_contact) == 0) {
        $this->_errors += ['contact' => 'Contact can not be empty'];
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
