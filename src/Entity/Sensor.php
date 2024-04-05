<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity()]
#[ORM\Table(name: 'sensors')]
class Sensor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column('id')]
    private int $id;

    #[ORM\Column(name: 'uuid', type: 'guid', unique: true)]
    private string $uuid;

    #[ORM\Column(name: 'readingId', type: 'integer', nullable: true)]
    private ?int $readingId;

    #[ORM\OneToMany(targetEntity: Reading::class, mappedBy: 'sensor')]
    private Collection $readings;

    /**
     * @return ArrayCollection<int, Reading>
     */
    public function getReadings(): ArrayCollection
    {
        return $this->readings;
    }

    /**
     * @param ArrayCollection<int, Reading> $readings
     *
     * @return Sensor
     */
    public function setReadings(ArrayCollection $readings): Sensor
    {
        $this->readings = $readings;

        return $this;
    }

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
        $this->readings = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): Sensor
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getReadingId(): ?int
    {
        return $this->readingId;
    }

    /**
     * @param int|null $readingId
     *
     * @return Sensor
     */
    public function setReadingId(?int $readingId): Sensor
    {
        $this->readingId = $readingId;

        return $this;
    }

}
