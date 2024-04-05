<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Services;

use Livevasiliy\EcoFinanceTestCase\Entity\Reading;

class ReadingService extends BaseService
{
    public function calculateAvgTemperature(int $days): float|int|null
    {
        // Calculate start date for the last X days
        $startDate = date('Y-m-d', strtotime("-$days days"));

        // Query database to retrieve temperature data from all sensors for the last X days
        /** @var Reading[] $readings */
        $readings = $this->entityManager->getRepository(Reading::class)->findAll();
        $temperatures = [];

        if (count($readings) > 0) {
            foreach ($readings as $reading) {
                if ($reading->getCreatedAt()->format('Y-m-d') > $startDate) {
                    $temperatures[] = $reading->getTemperature();
                }
            }
        }

        // Calculate average temperature
        return count($temperatures) > 0 ? array_sum($temperatures) / count($temperatures) : null;
    }
}
