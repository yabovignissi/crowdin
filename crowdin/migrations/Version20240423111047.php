<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240423111047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil_utilisateur DROP FOREIGN KEY FK_47227AF350EAE44');
        $this->addSql('DROP TABLE profil_utilisateur');
        $this->addSql('ALTER TABLE user CHANGE type_profil type_profil ENUM(\'chef de projet\', \'traducteur\', \'les deux\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profil_utilisateur (id INT AUTO_INCREMENT NOT NULL, id_utilisateur INT DEFAULT NULL, langue VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, niveau_linguistique INT DEFAULT NULL, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_47227AF350EAE44 (id_utilisateur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE profil_utilisateur ADD CONSTRAINT FK_47227AF350EAE44 FOREIGN KEY (id_utilisateur) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user CHANGE type_profil type_profil VARCHAR(255) DEFAULT NULL');
    }
}
