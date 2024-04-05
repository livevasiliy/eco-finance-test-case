<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Controllers\API;

use Exception;
use Livevasiliy\EcoFinanceTestCase\Services\SensorService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SensorController
{
    private SensorService $service;

    public function __construct()
    {
        $this->service = new SensorService();
    }

    public function push(Request $request): JsonResponse
    {
        try {
            $data    = json_decode($request->getContent(), true);
            $this->service->push($data);

            return new JsonResponse([
                'status' => 'success',
                'error'  => '',
            ], Response::HTTP_CREATED);
        }
        catch (Exception $exception) {
            return new JsonResponse([
                'status' => 'fail',
                'error'  => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function read(Request $request, string $id): JsonResponse|Response
    {
        try {
            $result =  $this->service->read($id);
            return new Response($result, Response::HTTP_OK, [
                'Content-Type' => 'text/csv'
            ]);
        } catch (Exception $exception) {
            return new JsonResponse([
               'status' => 'fail',
               'error' => $exception->getMessage(),
            ]);
        }
    }
}
