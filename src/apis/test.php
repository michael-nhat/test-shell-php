<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
require '../vendor/autoload.php';
require '../utils/common-util.php';

function hello(Request $request, Response $response, array $args)
{
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
};
