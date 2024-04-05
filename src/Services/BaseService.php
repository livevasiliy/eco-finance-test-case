<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Services;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Livevasiliy\EcoFinanceTestCase\Provider\EntityManagerProvider;

class BaseService
{
    protected EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManagerProvider::getEntityManager();
    }

    public function getEntityManager(): EntityManager|EntityManagerInterface
    {
        return $this->entityManager;
    }

    public function setEntityManager(EntityManager|EntityManagerInterface $entityManager): BaseService
    {
        $this->entityManager = $entityManager;

        return $this;
    }
}
