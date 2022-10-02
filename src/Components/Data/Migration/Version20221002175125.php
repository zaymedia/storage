<?php

declare(strict_types=1);

namespace App\Components\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221002175125 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON photo');
        $this->addSql('ALTER TABLE photo DROP id, CHANGE file_id file_id VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE photo ADD PRIMARY KEY (file_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo ADD id INT AUTO_INCREMENT NOT NULL, CHANGE file_id file_id VARCHAR(255) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
