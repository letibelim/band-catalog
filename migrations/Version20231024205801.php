<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231024205801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE band_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE band (id INT NOT NULL, name VARCHAR(255) NOT NULL, origin VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, start_year INT NOT NULL, end_year INT DEFAULT NULL, founding_members VARCHAR(512) DEFAULT NULL, members_count INT DEFAULT NULL, trend VARCHAR(255) DEFAULT NULL, summary TEXT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE band_id_seq CASCADE');
        $this->addSql('DROP TABLE band');
    }
}
