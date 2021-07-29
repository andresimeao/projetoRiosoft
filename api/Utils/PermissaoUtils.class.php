<?php

namespace Utils;
use \Controller\AuthController;
use EasyFast\Exceptions\EasyFastException;
use EasyFast\Http\StatusCode;

class PermissaoUtils{
    

    public static function isAdministrator(){
        if(AuthController::$user->getEAdministrador() !=='1'){
            throw new EasyFastException('O usuário não possui os direitos administrativos!', StatusCode::$PreconditionFailed);
        }
    }
}
