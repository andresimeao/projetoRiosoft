<?php

namespace Controller;

use \EasyFast\Exceptions\RouteException;

class MainController {
    public function index () {
      return json_encode(['message' =>'Hello world']);
    }

    public function notfound() {
        throw new RouteException('Não encontramos nada', 404);
    }
}