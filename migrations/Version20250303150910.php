<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250303150910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return "Migration to create tables child, parents and schedule";
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE child (id INT AUTO_INCREMENT NOT NULL, parents_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_22B35429B706B6D3 (parents_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FD501D6AE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, child_id INT NOT NULL, start_time DATETIME NOT NULL, end_time DATETIME NOT NULL, INDEX IDX_5A3811FBDD62C21B (child_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429B706B6D3 FOREIGN KEY (parents_id) REFERENCES parents (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FBDD62C21B FOREIGN KEY (child_id) REFERENCES child (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429B706B6D3');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FBDD62C21B');
        $this->addSql('DROP TABLE child');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP TABLE schedule');
    }
}
