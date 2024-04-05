<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Provider;

use Doctrine\DBAL\DriverManager;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Livevasiliy\EcoFinanceTestCase\Kernel\Config;

class EntityManagerProvider
{
    private static ?EntityManager $entityManager = null;

    public static function getEntityManager(): EntityManager
    {
        /** @var array<string,mixed> $conn */
        $conn = (new Config())->getConfig();

        if (self::$entityManager === null) {

            $isDevMode = $_ENV['APP_DEBUG'] ?? false;

            $migrations = new PhpFile(dirname(__DIR__ , 2) . '/config/migrations.php');

            $config    = ORMSetup::createAttributeMetadataConfiguration([dirname(__DIR__, 2) . '/src/Entity'], (bool) $isDevMode);

            $connection = DriverManager::getConnection($conn);

            self::$entityManager = new EntityManager($connection, $config);

            DependencyFactory::fromEntityManager($migrations, new ExistingEntityManager(self::$entityManager));
        }

        return self::$entityManager;
    }
}
