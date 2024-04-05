<?php declare(strict_types=1);

require_once __DIR__ . '/../bootstrap/bootstrap.php';

use Livevasiliy\EcoFinanceTestCase\Kernel\Router;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$router = new Router();
$response = $router->handleRequest($request);
$response->send();
