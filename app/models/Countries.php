<?php

  class Countries {

    private $_db;
    private $_table;

    public function __construct() {
      $this->_db = Database::getInstance();
      $this->_table = 'countries';
    }


    public function getList() {
      $query = $this->_db->pdo->prepare("SELECT * FROM countries ORDER BY `id`");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_NAMED);
    }
  }
