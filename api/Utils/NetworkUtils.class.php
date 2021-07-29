<?php
namespace Utils;

use EasyFast\Exceptions\EasyFastException;
use Model\Main\DominioModel;

class NetworkUtils {

    public static function checkActiveDirectory(\Model\Main\UsuarioModel $usuario) {

        // recuperando dominio do usuario
        $domain = $usuario->getDominioIdDominioModel();

        // conectando com o AD
        $ldap = @\ldap_connect($domain->getHost());

        // informando versão do protocolo
        @\ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        @\ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);


        // criando o rdn.
        $rdn = $domain->getDominio() . "\\" . $usuario->getUsuario();

        $bind = @\ldap_bind($ldap, $rdn, $usuario->getSenha());

        if($bind) {
            $filtro = "(&(objectClass=user)(sAMAccountName=".$usuario->getUsuario()."))";
            $result = @\ldap_search($ldap, $domain->getBaseDn(), $filtro);

            $infos = @\ldap_get_entries($ldap, $result);
            for($i = 0; $i < $infos['count']; $i++) {
                if($infos['count'] > 1)
                    break;

                $usuario->setNome($infos[$i]['displayname'][0]);
                $usuario->setUltimoAcesso(date('Y-m-d H:i:s'));
            }

            // encerrando a conexão com o AD
            @\ldap_close($ldap);
            return $usuario;
        } else {
            // Lança excessão de usuário ou senha inválidos.
            throw new EasyFastException('Usuário ou senha incorretos', 401);
        }
    }

}