<?php

  class InvoicePositions {

    private $_id;
    private $_invoice;
    private $_position;
    private $_name;
    private $_quantity;
    private $_unit;
    private $_unitPrice;
    private $_netValue;
    private $_tax;
    private $_value;
    private $_db;
    private $_errors = [];
    private $_table;


    public function __construct($invoice = '', $position = '', $name = '', $quantity = '', $unit = '', $unitPrice = '', $netValue = '', $tax = '', $value = '') {
      $this->_invoice = $invoice;
      $this->_position = $position;
      $this->_name = $name;
      $this->_quantity = $quantity;
      $this->_unit = $unit;
      $this->_unitPrice = $unitPrice;
      $this->_netValue = $netValue;
      $this->_tax = $tax;
      $this->_value = $value;
      $this->_db = Database::getInstance();
      $this->_table = 'invoicepositions';
    }


    public function setInvoice($invoiceId) {
      $this->_invoice = $invoiceId;
    }


    public function insert() {
      $query = $this->_db->pdo->prepare(
        "INSERT INTO `{$this->_table}` (
          `invoice`,
          `position`,
          `name`,
          `quantity`,
          `unit`,
          `unitPrice`,
          `netValue`,
          `taxPercent`,
          `value`
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
      );

      $query->execute([
        $this->_invoice,
        $this->_position,
        $this->_name,
        $this->_quantity,
        $this->_unit,
        $this->_unitPrice,
        $this->_netValue,
        $this->_tax,
        $this->_value
      ]);
    }


    public function getNetValue() {
      return $this->_netValue;
    }

    public function getValue() {
      return $this->_value;
    }


    public function getByInvoiceId($id) {
      $query = $this->_db->pdo->prepare("SELECT * FROM `{$this->_table}` WHERE `invoice` = ?");
      $query->execute([$id]);
      $results = $query->fetchAll(PDO::FETCH_NAMED);

      if(count($results) == 1) {
        $this->getFromArray($results[0]);
      }
      return $results;
    }
  }
