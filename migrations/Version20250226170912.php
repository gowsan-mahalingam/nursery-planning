<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;


final class Version20250226170912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add parents table and relation with child';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_FD501D6AE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child ADD parents_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE child ADD CONSTRAINT FK_22B35429B706B6D3 FOREIGN KEY (parents_id) REFERENCES parents (id)');
        $this->addSql('CREATE INDEX IDX_22B35429B706B6D3 ON child (parents_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child DROP FOREIGN KEY FK_22B35429B706B6D3');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP INDEX IDX_22B35429B706B6D3 ON child');
        $this->addSql('ALTER TABLE child DROP parents_id');
    }
}
