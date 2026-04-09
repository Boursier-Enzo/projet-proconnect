<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260408140704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type_projet VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) NOT NULL, date_debut DATE DEFAULT NULL, date_fin_prevue DATE DEFAULT NULL, budget NUMERIC(12, 2) DEFAULT NULL, adresse_chantier LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, architecte_id INT DEFAULT NULL, INDEX IDX_50159CA99F805B0 (architecte_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA99F805B0 FOREIGN KEY (architecte_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA99F805B0');
        $this->addSql('DROP TABLE projet');
    }
}
