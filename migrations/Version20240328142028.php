<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240328142028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise_formation (entreprise_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_DDC08616A4AEAFEA (entreprise_id), INDEX IDX_DDC086165200282E (formation_id), PRIMARY KEY(entreprise_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE entreprise_formation ADD CONSTRAINT FK_DDC08616A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entreprise_formation ADD CONSTRAINT FK_DDC086165200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise_formation DROP FOREIGN KEY FK_DDC08616A4AEAFEA');
        $this->addSql('ALTER TABLE entreprise_formation DROP FOREIGN KEY FK_DDC086165200282E');
        $this->addSql('DROP TABLE entreprise_formation');
    }
}
