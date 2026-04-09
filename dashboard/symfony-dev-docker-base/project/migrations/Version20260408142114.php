<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260408142114 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, type_document VARCHAR(255) DEFAULT NULL, fichier_path VARCHAR(500) DEFAULT NULL, code_acces VARCHAR(255) DEFAULT NULL, contenu LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, projet_id INT DEFAULT NULL, demande_id INT DEFAULT NULL, INDEX IDX_D8698A76C18272 (projet_id), INDEX IDX_D8698A7680E95E18 (demande_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7680E95E18 FOREIGN KEY (demande_id) REFERENCES demande_client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76C18272');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7680E95E18');
        $this->addSql('DROP TABLE document');
    }
}
