<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Livevasiliy\EcoFinanceTestCase\Provider\EntityManagerProvider;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$entityManager = EntityManagerProvider::getEntityManager();

global $entityManager;