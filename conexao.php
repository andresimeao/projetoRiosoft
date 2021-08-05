<?php

class Conexao
{
    private $connect=null;

    public static function getConexao():mixed
    {
        global $connect;
        if($connect == null)
        {
            $connect= new PDO("mysql:dbname=biblioteca;host=localhost","root","root");
            return $connect;
        }

        return $connect;
    }

}