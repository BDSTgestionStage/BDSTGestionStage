<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325100907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profil (pro_fonction VARCHAR(255) NOT NULL, env_accord TINYINT(1) NOT NULL, jur_annee VARCHAR(4) DEFAULT NULL, tut_accord TINYINT(1) NOT NULL, res_accord TINYINT(1) NOT NULL, PER_ID INT NOT NULL, PRIMARY KEY(PER_ID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B2977BB1A10C FOREIGN KEY (PER_ID) REFERENCES personne (id)');
        $this->addSql('ALTER TABLE personne DROP per_fonction');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B2977BB1A10C');
        $this->addSql('DROP TABLE profil');
        $this->addSql('ALTER TABLE personne ADD per_fonction VARCHAR(38) NOT NULL');
    }
}
