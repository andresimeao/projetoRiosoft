<?php
require __DIR__ . '/framework/App.class.php';
try {
    $app = new EasyFast\App();
    $app->run();
    $databases = EasyFast\App::getDataBaseConfig();
    foreach ($databases as $key => $db) {
        $orm = new EasyFast\Orm\Generator();
        $xml = $orm->createSchema($key);
        $orm->setSchema($xml);
        $orm->setDir("Model" . DIRECTORY_SEPARATOR . $key);
        $orm->createClass();
        $orm->createTraits();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
