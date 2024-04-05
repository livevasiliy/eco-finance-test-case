<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Livevasiliy\EcoFinanceTestCase\Entity\Reading;
use Livevasiliy\EcoFinanceTestCase\Entity\Sensor;
use Livevasiliy\EcoFinanceTestCase\Provider\EntityManagerProvider;


class SensorService extends BaseService
{
    public function push(array $data)
    {
        $reader = new Reading();

        /** @var Sensor|null $sensor */
        $sensor = $this->entityManager->getRepository(Sensor::class)->findOneBy(['uuid' => $data['reading']['sensor_uuid']]);

        if (!$sensor) {
            throw new \Exception('Model not found');
        }

        $reader->setSensor($sensor);
        $reader->setTemperature((float)$data['reading']['temperature']);

        $this->entityManager->persist($reader);
        $this->entityManager->flush();
    }

    public function read(string $id): string
    {
        /** @var Sensor|null $sensor */
        $sensor = $this->entityManager->getRepository(Sensor::class)->findOneBy(['uuid' => $id]);

        if (!$sensor) {
            throw new \Exception('Model not found');
        }

        $temperature = mt_rand(-1000, 8000) / 100;
        $currentReadingId = $sensor->getReadingId();

        $newReadingId = $currentReadingId + 1;
        $sensor->setReadingId($newReadingId);
        $this->entityManager->persist($sensor);
        $this->entityManager->flush();

        return implode(',', [$newReadingId, $temperature]);
    }
}
