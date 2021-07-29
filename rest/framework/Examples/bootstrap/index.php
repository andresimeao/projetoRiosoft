<?php

require '../../App.class.php';
$app = new EasyFast\App();

try {
    $app->execMethodBeforeRunApp('Controller\\MainController', 'sessionAnalyser');
    $app->run();
} catch (Exception $ex) {
    echo json_encode(array('message' => $ex->getMessage()));
}