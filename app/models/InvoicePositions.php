<?php

  class InvoicePositions {

    private $_id;
    private $_invoice;
    private $_position;
    private $_name;
    private $_quantity;
    private $_unitPrice;
    private $_value;
    private $_db;
    private $_errors = [];
    private $_table;


    public function __construct($invoice = '', $position = '', $name = '', $quantity = '', $unitPrice = '', $value = '') {
      $this->_invoice = $invoice;
      $this->_position = $position;
      $this->_name = $name;
      $this->_quantity = $quantity;
      $this->_unitPrice = $unitPrice;
      $this->_value = $value;
      $this->_db = Database::getInstance();
      $this->_table = 'invoicepositions';
    }


    public function insert() {
      $query = $this->_db->pdo->prepare(
        "INSERT INTO `{$this->_table}` (`invoice`, `position`, `name`, `quantity`, `unitPrice`, `value`)
          VALUES (?, ?, ?, ?, ?, ?)"
      );

      $query->execute([
        $this->_invoice,
        $this->_position,
        $this->_name,
        $this->_quantity,
        $this->_unitPrice,
        $this->_value
      ]);
    }
  }
