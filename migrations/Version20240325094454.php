<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325094454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E37BB1A10C');
        $this->addSql('DROP INDEX UNIQ_717E22E37BB1A10C ON etudiant');
        $this->addSql('ALTER TABLE etudiant CHANGE PER_ID formation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_717E22E35200282E ON etudiant (formation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E35200282E');
        $this->addSql('DROP INDEX IDX_717E22E35200282E ON etudiant');
        $this->addSql('ALTER TABLE etudiant CHANGE formation_id PER_ID INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E37BB1A10C FOREIGN KEY (PER_ID) REFERENCES personne (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E37BB1A10C ON etudiant (PER_ID)');
    }
}
