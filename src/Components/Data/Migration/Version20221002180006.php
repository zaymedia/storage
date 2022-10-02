<?php

declare(strict_types=1);

namespace App\Components\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221002180006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audio MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON audio');
        $this->addSql('ALTER TABLE audio DROP id, CHANGE file_id file_id VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE audio ADD PRIMARY KEY (file_id)');
        $this->addSql('ALTER TABLE settings MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_E545A0C58CDE5729 ON settings');
        $this->addSql('DROP INDEX `primary` ON settings');
        $this->addSql('ALTER TABLE settings DROP id');
        $this->addSql('ALTER TABLE settings ADD PRIMARY KEY (type)');
        $this->addSql('ALTER TABLE video MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON video');
        $this->addSql('ALTER TABLE video DROP id, CHANGE file_id file_id VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE video ADD PRIMARY KEY (file_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audio ADD id INT AUTO_INCREMENT NOT NULL, CHANGE file_id file_id VARCHAR(255) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE settings ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E545A0C58CDE5729 ON settings (type)');
        $this->addSql('ALTER TABLE video ADD id INT AUTO_INCREMENT NOT NULL, CHANGE file_id file_id VARCHAR(255) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
