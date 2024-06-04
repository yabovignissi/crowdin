<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240423093718 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil_utilisateur CHANGE langue langue VARCHAR(255) DEFAULT NULL, CHANGE niveau_linguistique niveau_linguistique INT DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE type_profil type_profil ENUM(\'chef de projet\', \'traducteur\', \'les deux\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil_utilisateur CHANGE langue langue VARCHAR(255) NOT NULL, CHANGE niveau_linguistique niveau_linguistique INT NOT NULL, CHANGE description description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE type_profil type_profil VARCHAR(255) DEFAULT NULL');
    }
}
