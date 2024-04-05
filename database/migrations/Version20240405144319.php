<?php

declare(strict_types=1);

namespace Livevasiliy\EcoFinanceTestCase\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240405144319 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE readings (id INT AUTO_INCREMENT NOT NULL, sensorId INT NOT NULL, temperature NUMERIC(5, 2) NOT NULL, createdAt DATETIME NOT NULL, INDEX IDX_1A14A4F14DABD40B (sensorId), PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sensors (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL, readingId INT DEFAULT NULL, UNIQUE INDEX UNIQ_D0D3FA90D17F50A6 (uuid), PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE readings ADD CONSTRAINT FK_1A14A4F14DABD40B FOREIGN KEY (sensorId) REFERENCES sensors (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE readings DROP FOREIGN KEY FK_1A14A4F14DABD40B');
        $this->addSql('DROP TABLE readings');
        $this->addSql('DROP TABLE sensors');
    }
}
