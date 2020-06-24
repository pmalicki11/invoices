<?php

  class InvoicesController {

    private $_view;
    private $_model;

    public function __construct() {
      $this->_view = new View();
      $this->_model = new Invoices();
    }


    public function indexAction() {
      $this->_view->invoices = $this->_model->getAll();
      $this->_view->render('invoices/index');
    }


    public function addAction() {
      $customers = new Customers();
      $this->_view->customers = $customers->getList();
      $this->_view->nextNumber = $this->_model->getNextNumber();
      if(isset($_POST['number'])) {
        $this->_view->errors = [];
        $this->_model = new Invoices();
        $this->_model->getFromArray($_POST);
        if(!$this->_model->exists()) {
          if($this->_model->isValid()) {
            $this->_model->insert();
            header('Location: ' . PROOT . 'invoices/index'); die();
          } else {
            $this->_view->errors = $this->_model->getErrors();
          }
        } else {
          $this->_view->errors = ['number' => 'Invoice already exists'];
        }
      }
      $this->_view->render('invoices/add');
    }


    public function deleteAction($id) {
      if($this->_model->delete($id)) {
        header('Location: '. PROOT . 'invoices/index');
      }
    }
  }
