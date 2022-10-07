<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005125958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP id_commende');
        $this->addSql('ALTER TABLE membre DROP id_membre');
        $this->addSql('ALTER TABLE vehicule DROP id_vehicule, CHANGE description description LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD id_commende INT NOT NULL');
        $this->addSql('ALTER TABLE membre ADD id_membre INT NOT NULL');
        $this->addSql('ALTER TABLE vehicule ADD id_vehicule INT NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
    }
}
