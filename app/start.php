<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
//
//$app = new \Slim\Slim([
//    'view' => new \Slim\Views\Twig()
//]);
//
//// Views
//$view = $app->view();
//$view->setTemplatesDirectory('../app/views');
//$view->parserExtensioons = [
//    new \Slim\Views\TwigExtension()
//];
//
//require 'routes.php';
//
//$app->run();

$app = new \Slim\App();

$container = $app->getContainer();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('views/', [
        'cache' => false
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

/*
require '../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
$app->run();
*/