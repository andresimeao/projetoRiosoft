<?php

namespace Controller;

use \EasyFast\Exceptions\RouteException;

class MainController {
    
  //reposta tem que ser sempre um json
  public function index () {
   
     
      echo json_encode('Pedrinho matador');
  }

    public function notfound() {
        throw new RouteException('Não encontramos nada', 404);
    }
}