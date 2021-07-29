<?php
// -> dentro da pasta api rodar o comando: php -S 0.0.0.0:8081 -t . index.php
date_default_timezone_set('America/Sao_Paulo'); 

require __DIR__ . '/framework/App.class.php';

$app = new EasyFast\App();

try {
    if (php_sapi_name() == 'cli-server') {
        $_GET['url'] = ltrim($_SERVER['REQUEST_URI'], "/");
    }

    // header('Access-Control-Expose-Headers: Token'); // CORS - Expor header
    // EasyFast\Http\Restful::crossOrigin(true, 'Token');
    $app->execMethodBeforeRunApp('Controller\\SecurityController', 'checkApi');
    $app->run();
} catch (\Exception $ex) {
    header('HTTP/1.1 ' . $ex->getCode());
    header('Content-type: application/json');

    echo json_encode(['error' => $ex->getMessage()]);
}
