<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Kernel;

require_once dirname(__DIR__, 2) . '/bootstrap/bootstrap.php';

use Symfony\Component\HttpFoundation\Request;

class App
{
    public static function run(): void
    {
        $request = Request::createFromGlobals();

        $router = new Router();

        $response = $router->handleRequest($request);

        $response->send();
    }
}
