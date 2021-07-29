<?php

namespace Controller;

use \EasyFast\Exceptions\EasyFastException;
use \Utils\JWTUtils;
use \Model\Main\UsuarioModel;

class SecurityController {

    /**
     * Verificação de segurança / Controle de Acesso
     * @author Hiago Silva Souza <hiago.souza@riosoft.com.br>
     */
    public function checkApi () {
        /*if(strpos($_GET['url'], 'no-auth/') !== FALSE) {
          return true;
        }

        if(!isset($_SERVER['HTTP_TOKEN']) && isset($_GET['token'])) {
          $_SERVER['HTTP_TOKEN'] = $_GET['token'];
        }

        if(!isset($_SERVER['HTTP_TOKEN'])) {
          throw new EasyFastException('Usuário não autenticado, verifique!', 401);
        } else {
          JWTUtils::verify($_SERVER['HTTP_TOKEN']);

          $payload = JWTUtils::getPayload($_SERVER['HTTP_TOKEN']);

          // colocando usuário em propriedade estatica para acesso
          AuthController::$user = new UsuarioModel($payload->id);

          return true;
        }*/
        return true;
    }
}