<?php

  class Countries {

    private $_db;
    private $_table;

    public function __construct() {
      $this->_db = Database::getInstance();
      $this->_table = 'countries';
    }


    public function getList() {
      $query = $this->_db->pdo->prepare("SELECT * FROM `{$this->_table}` ORDER BY `id`");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_NAMED);
    }


    public function getById($id) {
      $query = $this->_db->pdo->prepare("SELECT * FROM `{$this->_table}` WHERE `id` = ?");
      $query->execute([$id]);
      $results = $query->fetchAll(PDO::FETCH_NAMED);
      return $results;
    }
  }
