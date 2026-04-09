<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260408142639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE intervention (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, compte_rendu LONGTEXT DEFAULT NULL, date_intervention DATE NOT NULL, statut VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, projet_id INT DEFAULT NULL, architecte_id INT DEFAULT NULL, INDEX IDX_D11814ABC18272 (projet_id), INDEX IDX_D11814AB9F805B0 (architecte_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814ABC18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE intervention ADD CONSTRAINT FK_D11814AB9F805B0 FOREIGN KEY (architecte_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814ABC18272');
        $this->addSql('ALTER TABLE intervention DROP FOREIGN KEY FK_D11814AB9F805B0');
        $this->addSql('DROP TABLE intervention');
    }
}
