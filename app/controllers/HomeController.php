<?php

  class HomeController {

    private $_view;

    public function __construct() {
      $this->_view = new View();
      $this->_view->setLayout('default');
    }

    public function indexAction() {
      $this->_view->render('home/index');
    }
  }
