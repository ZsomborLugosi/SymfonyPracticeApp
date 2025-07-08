<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250708114317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__entertainment_media AS SELECT id, sequel_id, prequel_id, series_id, title, date, dtype, director, streaming_platform, developer, rating FROM entertainment_media');
        $this->addSql('DROP TABLE entertainment_media');
        $this->addSql('CREATE TABLE entertainment_media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sequel_id INTEGER DEFAULT NULL, prequel_id INTEGER DEFAULT NULL, series_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, dtype VARCHAR(255) NOT NULL, director VARCHAR(255) DEFAULT NULL, streaming_platform VARCHAR(255) DEFAULT NULL, developer VARCHAR(255) DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_A214E3AB1FFEAE28 FOREIGN KEY (sequel_id) REFERENCES entertainment_media (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A214E3ABFB4F432B FOREIGN KEY (prequel_id) REFERENCES entertainment_media (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A214E3AB5278319C FOREIGN KEY (series_id) REFERENCES entertainment_media (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO entertainment_media (id, sequel_id, prequel_id, series_id, title, date, dtype, director, streaming_platform, developer, rating) SELECT id, sequel_id, prequel_id, series_id, title, date, dtype, director, streaming_platform, developer, rating FROM __temp__entertainment_media');
        $this->addSql('DROP TABLE __temp__entertainment_media');
        $this->addSql('CREATE INDEX IDX_A214E3AB5278319C ON entertainment_media (series_id)');
        $this->addSql('CREATE INDEX IDX_A214E3ABFB4F432B ON entertainment_media (prequel_id)');
        $this->addSql('CREATE INDEX IDX_A214E3AB1FFEAE28 ON entertainment_media (sequel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__entertainment_media AS SELECT id, sequel_id, prequel_id, series_id, title, date, dtype, director, streaming_platform, developer, rating FROM entertainment_media');
        $this->addSql('DROP TABLE entertainment_media');
        $this->addSql('CREATE TABLE entertainment_media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sequel_id INTEGER DEFAULT NULL, prequel_id INTEGER DEFAULT NULL, series_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, dtype VARCHAR(255) NOT NULL, director VARCHAR(255) DEFAULT NULL, streaming_platform VARCHAR(255) DEFAULT NULL, developer VARCHAR(255) DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_A214E3AB1FFEAE28 FOREIGN KEY (sequel_id) REFERENCES entertainment_media (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A214E3ABFB4F432B FOREIGN KEY (prequel_id) REFERENCES entertainment_media (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A214E3AB5278319C FOREIGN KEY (series_id) REFERENCES entertainment_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO entertainment_media (id, sequel_id, prequel_id, series_id, title, date, dtype, director, streaming_platform, developer, rating) SELECT id, sequel_id, prequel_id, series_id, title, date, dtype, director, streaming_platform, developer, rating FROM __temp__entertainment_media');
        $this->addSql('DROP TABLE __temp__entertainment_media');
        $this->addSql('CREATE INDEX IDX_A214E3AB1FFEAE28 ON entertainment_media (sequel_id)');
        $this->addSql('CREATE INDEX IDX_A214E3ABFB4F432B ON entertainment_media (prequel_id)');
        $this->addSql('CREATE INDEX IDX_A214E3AB5278319C ON entertainment_media (series_id)');
    }
}
