<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Services;

use Livevasiliy\EcoFinanceTestCase\Entity\Reading;
use Livevasiliy\EcoFinanceTestCase\Entity\Sensor;

class SensorService extends BaseService
{
    private const MIN_TEMPERATURE_RANGE_VALUE = -1000;
    private const MAX_TEMPERATURE_RANGE_VALUE = 8000;
    private const COEFFICIENT                 = 100;

    public function push(array $data): void
    {
        $reader = new Reading();

        /** @var Sensor|null $sensor */
        $sensor = $this->entityManager->getRepository(Sensor::class)->findOneBy(['uuid' => $data['reading']['sensor_uuid']]);

        if ( ! $sensor) {
            throw new \Exception('Model not found');
        }

        $reader->setSensor($sensor);
        $reader->setTemperature((float) $data['reading']['temperature']);

        $this->entityManager->persist($reader);
        $this->entityManager->flush();
    }

    public function read(string $id): string
    {
        /** @var Sensor|null $sensor */
        $sensor = $this->entityManager->getRepository(Sensor::class)->findOneBy(['uuid' => $id]);

        if ( ! $sensor) {
            throw new \Exception('Model not found');
        }

        $temperature      = mt_rand(self::MIN_TEMPERATURE_RANGE_VALUE, self::MAX_TEMPERATURE_RANGE_VALUE) / self::COEFFICIENT;
        $currentReadingId = $sensor->getReadingId();

        $newReadingId = $currentReadingId + 1;
        $sensor->setReadingId($newReadingId);
        $this->entityManager->persist($sensor);
        $this->entityManager->flush();

        return implode(',', [$newReadingId, $temperature]);
    }
}
