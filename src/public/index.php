<?php
use mikehaertl\shellcommand\Command;
use \Psr\Http\Message\ResponseInterface as Response;
require '../../vendor/autoload.php';

require '../../src/utils/common-util.php';
require '../../src/apis/read-file.php';
use \Psr\Http\Message\ServerRequestInterface as Request;

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/readfile', function (Request $request, Response $response, array $args) {
    $command = new Command('find /www/wwwroot/dede/ -name "*.php"');
    if ($command->execute()) {
        pe($command->getOutput());
    } else {
        pe($command->getError());
        $exitCode = $command->getExitCode();
    }
    return $response;
});

$app->run();
