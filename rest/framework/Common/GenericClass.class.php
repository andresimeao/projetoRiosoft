<?php
/**
 * Created by PhpStorm.
 * User: hiago
 * Date: 25/12/2016
 * Time: 17:05
 */

namespace EasyFast\Common;

class GenericClass
{
    function toJson()
    {
        $json = array();
        while ( list ($key, $value) = each ($this) ) {
            //tem caracter especial no "" não mexer!
            $key = explode(" ", $key);
            $json[Utils::camelToSnakeCase($key[count($key) - 1])] = $value;
        }
        return $json;
    }
}