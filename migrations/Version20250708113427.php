<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250708113427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entertainment_media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, sequel_id INTEGER DEFAULT NULL, prequel_id INTEGER DEFAULT NULL, series_id INTEGER DEFAULT NULL, title VARCHAR(255) NOT NULL, date DATE NOT NULL, dtype VARCHAR(255) NOT NULL, director VARCHAR(255) DEFAULT NULL, streaming_platform VARCHAR(255) DEFAULT NULL, developer VARCHAR(255) DEFAULT NULL, rating DOUBLE PRECISION DEFAULT NULL, CONSTRAINT FK_A214E3AB1FFEAE28 FOREIGN KEY (sequel_id) REFERENCES entertainment_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A214E3ABFB4F432B FOREIGN KEY (prequel_id) REFERENCES entertainment_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A214E3AB5278319C FOREIGN KEY (series_id) REFERENCES entertainment_media (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A214E3AB1FFEAE28 ON entertainment_media (sequel_id)');
        $this->addSql('CREATE INDEX IDX_A214E3ABFB4F432B ON entertainment_media (prequel_id)');
        $this->addSql('CREATE INDEX IDX_A214E3AB5278319C ON entertainment_media (series_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE entertainment_media');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
