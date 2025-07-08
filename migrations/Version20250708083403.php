<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250708083403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entertainment_media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date DATE DEFAULT NULL, dtype VARCHAR(255) NOT NULL, director VARCHAR(255) DEFAULT NULL, streaming_platform VARCHAR(255) DEFAULT NULL, developer VARCHAR(255) DEFAULT NULL)');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE series');
        $this->addSql('DROP TABLE video_game');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, director VARCHAR(255) NOT NULL COLLATE "BINARY", streaming_platform VARCHAR(255) NOT NULL COLLATE "BINARY", title VARCHAR(255) NOT NULL COLLATE "BINARY", date DATE NOT NULL)');
        $this->addSql('CREATE TABLE series (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, director VARCHAR(255) NOT NULL COLLATE "BINARY", streaming_platform VARCHAR(255) NOT NULL COLLATE "BINARY", title VARCHAR(255) NOT NULL COLLATE "BINARY", date DATE NOT NULL)');
        $this->addSql('CREATE TABLE video_game (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, developer VARCHAR(255) NOT NULL COLLATE "BINARY", title VARCHAR(255) NOT NULL COLLATE "BINARY", date DATE NOT NULL)');
        $this->addSql('DROP TABLE entertainment_media');
    }
}
