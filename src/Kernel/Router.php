<?php

namespace Livevasiliy\EcoFinanceTestCase\Kernel;

use Livevasiliy\EcoFinanceTestCase\Controllers\API\SensorController;
use Livevasiliy\EcoFinanceTestCase\Controllers\API\TemperatureController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router {

    public function handleRequest(Request $request): Response
    {
        $path = $request->getPathInfo();

        // Handle specific routes
        if ($path === '/') {
            return $this->home();
        } elseif ($path === '/api/push') {
            return (new SensorController())->push($request);
        } elseif (preg_match('/^\/sensor\/read\/(\w+)$/', $path, $matches)) {
            // Extract 'id' from the route path and pass it to the controller action
            return (new SensorController())->read($request, $matches[1]);
        } elseif ($path === '/api/temperature/avg') {
            return (new TemperatureController())->calculateAverageTemperature($request);
        }

        return $this->notFound();
    }

    private function home(): Response
    {
        return new Response('Welcome to the home page');
    }

    private function notFound(): Response
    {
        return new Response('404 Not Found', Response::HTTP_NOT_FOUND);
    }
}
