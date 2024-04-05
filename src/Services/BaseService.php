<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Services;

use Doctrine\ORM\EntityManagerInterface;
use Livevasiliy\EcoFinanceTestCase\Provider\EntityManagerProvider;

class BaseService
{
    protected EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManagerProvider::getEntityManager();
    }

    /**
     * @return \Doctrine\ORM\EntityManager|EntityManagerInterface
     */
    public function getEntityManager(): \Doctrine\ORM\EntityManager|EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @param \Doctrine\ORM\EntityManager|EntityManagerInterface $entityManager
     *
     * @return BaseService
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager|EntityManagerInterface $entityManager): BaseService
    {
        $this->entityManager = $entityManager;

        return $this;
}
}
