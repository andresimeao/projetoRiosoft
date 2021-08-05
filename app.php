<?php

use Conect\Config\Database;

// carrega autoload

// carrega configurações do banco
Database::config(
    'localhost', // <= Host
    'bd_projeto', // <= Nome Banco
    'root', // <= Usuario
    '', // <= Senha
    '' // <= Porta (inteiro por padrão é 3306)
);

