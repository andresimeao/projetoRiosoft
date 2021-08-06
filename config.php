<?php

spl_autoload_register(function($class_name){
    
    $filename=$class_name;
    $filename = explode('\\', $class_name);
    $last_key = array_key_last($filename);

    if(file_exists(($filename[$last_key].".php"))){
      
        require_once ($filename[$last_key].".php");

    }

});