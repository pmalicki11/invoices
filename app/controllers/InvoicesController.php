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


    public function showInvoiceAction($id) {
      $this->_view->invoice = $this->_model->getById($id)[0];
      $customer = new Customers();
      $this->_view->customer = $customer->getById($this->_view->invoice['customer'])[0];
      $country = new Countries();
      $this->_view->country = $country->getById($this->_view->customer['country'])[0];
      $positions = new InvoicePositions();
      $this->_view->positions = $positions->getByInvoiceId($id);

      $this->_view->render('invoices/show');
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
