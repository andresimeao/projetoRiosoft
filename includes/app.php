<?php
require __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';


use Conect\Config\Database;

// carrega configurações do banco
Database::config(
    'localhost',  // <= Host
    'bd_projeto', // <= Nome Banco
    'root',       // <= Usuario
    '',           // <= Senha
    ''            // <= Porta (inteiro por padrão é 3306)
);
