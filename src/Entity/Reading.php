<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'readings')]
class Reading
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(name: 'sensorId', type: 'integer')]
    private int $sensorId;

    #[ORM\Column(name: 'temperature', type: 'decimal', precision: 5, scale: 2)]
    private float $temperature;

    #[ORM\Column(name: 'createdAt', type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\ManyToOne(targetEntity: Sensor::class)]
    #[ORM\JoinColumn(name: 'sensorId', referencedColumnName: 'id')]
    private ?Sensor $sensor;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }


    /**
     * @return int
     */
    public function getSensorId(): int
    {
        return $this->sensorId;
    }

    /**
     * @param int $sensorId
     *
     * @return Reading
     */
    public function setSensorId(int $sensorId): Reading
    {
        $this->sensorId = $sensorId;

        return $this;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     *
     * @return Reading
     */
    public function setTemperature(float $temperature): Reading
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeImmutable $createdAt
     *
     * @return Reading
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): Reading
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Sensor|null
     */
    public function getSensor(): ?Sensor
    {
        return $this->sensor;
    }

    /**
     * @param Sensor|null $sensor
     *
     * @return Reading
     */
    public function setSensor(?Sensor $sensor): Reading
    {
        $this->sensor = $sensor;

        return $this;
}

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
