<?php

declare(strict_types=1);

namespace App\Components\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221002105919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE settings ADD min_size_optimize INT DEFAULT NULL, CHANGE type type VARCHAR(50) NOT NULL, CHANGE allow_types allow_types VARCHAR(500) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE settings DROP min_size_optimize, CHANGE type type VARCHAR(500) NOT NULL, CHANGE allow_types allow_types VARCHAR(500) DEFAULT NULL');
    }
}
