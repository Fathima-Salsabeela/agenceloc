<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221006193510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', ADD password VARCHAR(255) NOT NULL, DROP pseudo, DROP mdp, DROP nom, DROP prenom, DROP civilite, DROP statut, DROP date_enregistrement, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F6B4FB29E7927C74 ON membre (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F6B4FB29E7927C74 ON membre');
        $this->addSql('ALTER TABLE membre ADD mdp VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD civilite VARCHAR(255) NOT NULL, ADD statut INT NOT NULL, ADD date_enregistrement DATETIME NOT NULL, DROP roles, CHANGE email email VARCHAR(255) NOT NULL, CHANGE password pseudo VARCHAR(255) NOT NULL');
    }
}
