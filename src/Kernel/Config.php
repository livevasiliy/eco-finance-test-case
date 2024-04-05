<?php declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Kernel;

class Config
{
    private array $config;

    public function __construct()
    {
        $this->config = [];
    }

    public function getConfig(): array
    {
        if (empty($this->config)) {
            $this->config = include dirname(__DIR__, 2) . '/config/database.php';

            if (!is_array($this->config)) {
                throw new \RuntimeException("Database configuration is not properly loaded.");
            }
        }

        return $this->config;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }
}
