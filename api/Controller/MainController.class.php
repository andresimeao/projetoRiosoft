<?php

namespace Controller;

use \EasyFast\Exceptions\RouteException;

class MainController {
    
  //reposta tem que ser sempre um json
  public function index () {
   
     
      echo json_encode('André Simeão Ferreira');
  }

    public function notfound() {
        throw new RouteException('Não encontramos nada', 404);
    }
}