<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable (__DIR__ . '/../');

$dotenv->load();

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App;

$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer(__DIR__ . '/../templates/');

// Routes
require __DIR__ . '/Routes.php';

// Render
$app->get('/', function (Request $request, Response $response) {
  $response = $this->view->render($response, 'elevatortest.phtml', ["", "router" => $this->router]);
  return $response;
});