<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325105347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, etu_annee INT NOT NULL, INDEX IDX_717E22E35200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, for_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, per_nom VARCHAR(38) NOT NULL, per_prenom VARCHAR(38) NOT NULL, ENT_ID INT DEFAULT NULL, INDEX IDX_FCEC9EF7A115CE9 (ENT_ID), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (pro_fonction VARCHAR(255) NOT NULL, env_accord TINYINT(1) NOT NULL, jur_annee INT NOT NULL, tut_accord TINYINT(1) NOT NULL, res_accord TINYINT(1) NOT NULL, PER_ID INT NOT NULL, PRIMARY KEY(PER_ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF7A115CE9 FOREIGN KEY (ENT_ID) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B2977BB1A10C FOREIGN KEY (PER_ID) REFERENCES personne (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E35200282E');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF7A115CE9');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B2977BB1A10C');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE profil');
    }
}
