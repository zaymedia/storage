<?php

declare(strict_types=1);

namespace App\Components\Data\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221001174830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audio (id INT AUTO_INCREMENT NOT NULL, file_id VARCHAR(255) NOT NULL, type INT NOT NULL, host VARCHAR(255) NOT NULL, host_s3 VARCHAR(255) DEFAULT NULL, dir VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, ext VARCHAR(255) NOT NULL, fields VARCHAR(255) DEFAULT NULL, size NUMERIC(10, 7) NOT NULL, duration INT NOT NULL, hash VARCHAR(255) NOT NULL, sizes VARCHAR(500) DEFAULT NULL, cover_dir VARCHAR(255) DEFAULT NULL, cover_name VARCHAR(255) DEFAULT NULL, cover_ext VARCHAR(255) DEFAULT NULL, cover_size VARCHAR(255) DEFAULT NULL, cover_sizes VARCHAR(500) DEFAULT NULL, cover_crop_square VARCHAR(255) DEFAULT NULL, cover_crop_custom VARCHAR(255) DEFAULT NULL, is_use TINYINT(1) DEFAULT 0 NOT NULL, created_at INT NOT NULL, updated_at INT DEFAULT NULL, deleted_at INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, file_id VARCHAR(255) NOT NULL, type INT NOT NULL, host VARCHAR(255) NOT NULL, host_s3 VARCHAR(255) DEFAULT NULL, dir VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, ext VARCHAR(255) NOT NULL, fields VARCHAR(255) DEFAULT NULL, size NUMERIC(10, 7) NOT NULL, hash VARCHAR(255) NOT NULL, sizes VARCHAR(500) DEFAULT NULL, crop_square VARCHAR(255) DEFAULT NULL, crop_custom VARCHAR(255) DEFAULT NULL, is_use TINYINT(1) DEFAULT 0 NOT NULL, resize_status INT DEFAULT 0 NOT NULL, created_at INT NOT NULL, updated_at INT DEFAULT NULL, deleted_at INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_type (id INT AUTO_INCREMENT NOT NULL, fields VARCHAR(500) DEFAULT NULL, sizes VARCHAR(500) DEFAULT NULL, crop_square_sizes VARCHAR(500) DEFAULT NULL, crop_custom_sizes VARCHAR(500) DEFAULT NULL, crop_custom_default_width INT DEFAULT NULL, crop_custom_default_height INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(500) NOT NULL, dir VARCHAR(500) DEFAULT NULL, dir_cover VARCHAR(500) DEFAULT NULL, level INT NOT NULL, allow_types VARCHAR(500) DEFAULT NULL, min_size INT NOT NULL, max_size INT NOT NULL, time_storage_no_use INT NOT NULL, time_storage_delete INT NOT NULL, UNIQUE INDEX UNIQ_E545A0C58CDE5729 (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT AUTO_INCREMENT NOT NULL, file_id VARCHAR(255) NOT NULL, type INT NOT NULL, host VARCHAR(255) NOT NULL, host_s3 VARCHAR(255) DEFAULT NULL, dir VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, ext VARCHAR(255) NOT NULL, fields VARCHAR(255) DEFAULT NULL, size NUMERIC(10, 7) NOT NULL, duration INT NOT NULL, hash VARCHAR(255) NOT NULL, sizes VARCHAR(500) DEFAULT NULL, cover_dir VARCHAR(255) DEFAULT NULL, cover_name VARCHAR(255) DEFAULT NULL, cover_ext VARCHAR(255) DEFAULT NULL, cover_size VARCHAR(255) DEFAULT NULL, cover_sizes VARCHAR(500) DEFAULT NULL, cover_crop_square VARCHAR(255) DEFAULT NULL, cover_crop_custom VARCHAR(255) DEFAULT NULL, is_use TINYINT(1) DEFAULT 0 NOT NULL, created_at INT NOT NULL, updated_at INT DEFAULT NULL, deleted_at INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT INTO photo_type (id, fields, sizes, crop_square_sizes, crop_custom_sizes, crop_custom_default_width, crop_custom_default_height) VALUES (NULL, "user_id", "480,360", "720,480,360", "720,480,360", "1920", "1080");');
        $this->addSql('INSERT INTO settings (id, type, dir, dir_cover, level, allow_types, min_size, max_size, time_storage_no_use, time_storage_delete) VALUES (NULL, "photo", "p", NULL, "4", "jpg,jpeg,png,gif", 5250, 105000000, 86400, 7776000);');
        $this->addSql('INSERT INTO settings (id, type, dir, dir_cover, level, allow_types, min_size, max_size, time_storage_no_use, time_storage_delete) VALUES (NULL, "audio", "a", "ac", "4", "mp3", 5250, 420000000, 86400, 7776000);');
        $this->addSql('INSERT INTO settings (id, type, dir, dir_cover, level, allow_types, min_size, max_size, time_storage_no_use, time_storage_delete) VALUES (NULL, "video", "v", "vc", "4", "mp4", 5250, 420000000, 86400, 7776000);');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE audio');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE photo_type');
        $this->addSql('DROP TABLE settings');
        $this->addSql('DROP TABLE video');
    }
}
