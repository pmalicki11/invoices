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
      if(isset($_POST['name'])) {
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
          $this->_view->errors = ['name' => 'Invoice already exists'];
        }
      }
      $this->_view->render('invoices/add');
    }


    public function editAction($id = '') {
      $countries = new Countries();
      $this->_view->countries = $countries->getList();
      if(isset($_POST['name'])) {
        $this->_view->errors = [];
        $this->_model = new Customers();
        $this->_model->getFromArray($_POST);
        if(!$this->_model->exists()) {
          if($this->_model->isValid()) {
            $this->_model->update();
            header('Location: ' . PROOT . 'customers/index'); die();
          } else {
            $this->_view->errors = $this->_model->getErrors();
          }
        } else {
          $this->_view->errors = ['name' => 'Customer already exists'];
        }
      } else {
        $this->_model = new Customers();
        $this->_model->getById($id);
        $this->_model->setToPost();
      }
      $this->_view->render('customers/edit');

    }

    public function deleteAction($id) {
      if($this->_model->delete($id)) {
        header('Location: '. PROOT . 'customers/index');
      }
    }
  }
