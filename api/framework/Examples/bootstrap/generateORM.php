<?php
ini_set('memory_limit', '0');
if (php_sapi_name() != "cli") {
    echo 'Esse arquivo só deve ser executado por linha de comando!';
    die;
}

require '../../App.class.php';

try {

    $app = new EasyFast\App();
    $app->run();


    $databases = EasyFast\App::getDataBaseConfig();
    foreach ($databases as $key => $db) {
        $orm = new EasyFast\Orm\Generator();
        $xml = $orm->createSchema($key);
        $orm->setSchema($xml);
        $orm->setDir("Model".DIRECTORY_SEPARATOR.$key);
        $orm->createClass();
        $orm->createTraits();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

