<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325093912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne ADD ENT_ID INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF7A115CE9 FOREIGN KEY (ENT_ID) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_FCEC9EF7A115CE9 ON personne (ENT_ID)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF7A115CE9');
        $this->addSql('DROP INDEX IDX_FCEC9EF7A115CE9 ON personne');
        $this->addSql('ALTER TABLE personne DROP ENT_ID');
    }
}
