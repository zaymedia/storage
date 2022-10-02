<?php

declare(strict_types=1);

namespace App\Components\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221002184204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audio CHANGE ext ext VARCHAR(20) NOT NULL, CHANGE size size NUMERIC(11, 2) NOT NULL');
        $this->addSql('ALTER TABLE photo CHANGE ext ext VARCHAR(20) NOT NULL, CHANGE size size NUMERIC(11, 2) NOT NULL');
        $this->addSql('ALTER TABLE video CHANGE ext ext VARCHAR(20) NOT NULL, CHANGE size size NUMERIC(11, 2) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo CHANGE ext ext VARCHAR(255) NOT NULL, CHANGE size size NUMERIC(11, 4) NOT NULL');
        $this->addSql('ALTER TABLE audio CHANGE ext ext VARCHAR(255) NOT NULL, CHANGE size size NUMERIC(10, 7) NOT NULL');
        $this->addSql('ALTER TABLE video CHANGE ext ext VARCHAR(255) NOT NULL, CHANGE size size NUMERIC(10, 7) NOT NULL');
    }
}
