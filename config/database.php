<?php declare(strict_types=1);

return [
    'dbname'   => $_ENV['DB_DATABASE'] ?? 'test_app',
    'user'     => $_ENV['DB_USERNAME'] ?? 'root',
    'password' => $_ENV['DB_PASSWORD'] ?? 'password',
    'host'     => $_ENV['DB_HOST'] ?? 'localhost',
    'port'     => $_ENV['DB_PORT'] ?? 3306,
    'driver'   => 'pdo_mysql',
];