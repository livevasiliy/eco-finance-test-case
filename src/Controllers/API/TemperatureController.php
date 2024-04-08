<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Controllers\API;

use Livevasiliy\EcoFinanceTestCase\Services\ReadingService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TemperatureController
{
    private ReadingService $readingService;

    public function __construct()
    {
        $this->readingService = new ReadingService();
    }

    public function calculateAverageTemperature(Request $request): JsonResponse {
        // Parse JSON request body to extract number of days
        $requestData = json_decode($request->getContent(), true);
        $days = $requestData['days'] ?? null;

        // Validate number of days
        if (!is_numeric($days) || $days <= 0) {
            return new JsonResponse([
                'error' => 'Invalid number of days'
            ], Response::HTTP_BAD_REQUEST);
        }

        $averageTemperature = $this->readingService->calculateAvgTemperature($days);

        // Return average temperature as JSON response
        return new JsonResponse(['average_temperature' => $averageTemperature], Response::HTTP_OK);
    }

    public function calculateAverageTemperatureForHour(Request $request, string $sensorUuid): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true);
        $hour = $requestData['hour'] ?? null;

        if (is_null($hour)) {
            return new JsonResponse([
                'error' => 'Invalid hour pass'
            ], Response::HTTP_BAD_REQUEST);
        }

        $averageTemperature = $this->readingService->calculateAvgTemperatureForHour($sensorUuid, $hour);

        return new JsonResponse(['average_temperature' => $averageTemperature], Response::HTTP_OK);
    }
}
