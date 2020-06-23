<?php

  class Database {

    private static $_instance = null;
    public $pdo;


    private function __construct() {
      try {
        $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=invoices', 'root', 'root');
      } catch (PDOException $e) {
        die($e->getMessage());
      }
    }


    public static function getInstance() {
      if(!isset(self::$_instance)) {
        self::$_instance = new self();
      }
      return self::$_instance;
    }
}
