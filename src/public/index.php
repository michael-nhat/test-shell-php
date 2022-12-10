<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../../vendor/autoload.php';

require '../../src/utils/common-util.php';
require '../../src/apis/read-file.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$app->get('/readfile', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello, jlkdsfs");
    return $response;
});





$app->run();
