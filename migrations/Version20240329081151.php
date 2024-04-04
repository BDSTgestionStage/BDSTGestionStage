<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329081151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, ent_nom VARCHAR(255) NOT NULL, ent_ville VARCHAR(255) NOT NULL, ent_pays VARCHAR(255) DEFAULT NULL, ent_specialite VARCHAR(255) DEFAULT NULL, ent_adresse VARCHAR(255) NOT NULL, ent_cp VARCHAR(5) NOT NULL, site VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise_formation (entreprise_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_DDC08616A4AEAFEA (entreprise_id), INDEX IDX_DDC086165200282E (formation_id), PRIMARY KEY(entreprise_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (per_id INT NOT NULL, formation_id INT DEFAULT NULL, etu_annee INT NOT NULL, INDEX IDX_717E22E35200282E (formation_id), PRIMARY KEY(per_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, for_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, per_nom VARCHAR(38) NOT NULL, per_prenom VARCHAR(38) NOT NULL, telephone VARCHAR(10) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, ENT_ID INT DEFAULT NULL, INDEX IDX_FCEC9EF7A115CE9 (ENT_ID), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (pro_fonction VARCHAR(255) NOT NULL, env_accord TINYINT(1) NOT NULL, jur_annee INT NOT NULL, tut_accord TINYINT(1) NOT NULL, res_accord TINYINT(1) NOT NULL, PER_ID INT NOT NULL, PRIMARY KEY(PER_ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, rol_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, identifiant VARCHAR(255) NOT NULL, uti_password VARCHAR(513) NOT NULL, INDEX IDX_1D1C63B3D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise_formation ADD CONSTRAINT FK_DDC08616A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_formation ADD CONSTRAINT FK_DDC086165200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3B304206A FOREIGN KEY (per_id) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF7A115CE9 FOREIGN KEY (ENT_ID) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B2977BB1A10C FOREIGN KEY (PER_ID) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise_formation DROP FOREIGN KEY FK_DDC08616A4AEAFEA');
        $this->addSql('ALTER TABLE entreprise_formation DROP FOREIGN KEY FK_DDC086165200282E');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3B304206A');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E35200282E');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF7A115CE9');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B2977BB1A10C');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3D60322AC');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE entreprise_formation');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE utilisateur');
    }
}
