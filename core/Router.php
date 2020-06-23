<?php

  class Router {

    public static function route($url) {
      $controller = 'HomeController';
      $action = 'indexAction';
      $params = [];

      if(isset($url[0]) && $url[0] != '') {
        $controller = ucwords($url[0]) . 'Controller';
      }

      array_shift($url);
      if(isset($url[0]) && $url[0] != '') {
        $action = $url[0] . 'Action';
      }

      array_shift($url);
      $params = $url;

      $dispatch = new $controller;

      if(method_exists($controller, $action)) {
        call_user_func_array([$dispatch, $action], $params);
      } else {
        die("{$action} doesn't exist in the {$controller}");
      }
    }
  }
