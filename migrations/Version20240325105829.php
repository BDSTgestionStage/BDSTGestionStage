<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325105829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON etudiant');
        $this->addSql('ALTER TABLE etudiant ADD per_id INT NOT NULL, DROP id');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3B304206A FOREIGN KEY (per_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE etudiant ADD PRIMARY KEY (per_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3B304206A');
        $this->addSql('ALTER TABLE etudiant ADD id INT AUTO_INCREMENT NOT NULL, DROP per_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }
}
