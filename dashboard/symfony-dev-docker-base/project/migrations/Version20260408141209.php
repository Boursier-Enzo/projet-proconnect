<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260408141209 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande_client (id INT AUTO_INCREMENT NOT NULL, objet VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type_prestation VARCHAR(255) DEFAULT NULL, creneau_souhaite VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, architecte_id INT DEFAULT NULL, INDEX IDX_850042BA9F805B0 (architecte_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE demande_client ADD CONSTRAINT FK_850042BA9F805B0 FOREIGN KEY (architecte_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_client DROP FOREIGN KEY FK_850042BA9F805B0');
        $this->addSql('DROP TABLE demande_client');
    }
}
