<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240423084548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profil_utilisateur (id INT AUTO_INCREMENT NOT NULL, id_utilisateur INT DEFAULT NULL, langue VARCHAR(255) NOT NULL, niveau_linguistique INT NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_47227AF350EAE44 (id_utilisateur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, id_utilisateur INT DEFAULT NULL, nom_projet VARCHAR(255) NOT NULL, langue_origine VARCHAR(255) NOT NULL, langues_cibles JSON NOT NULL, INDEX IDX_50159CA950EAE44 (id_utilisateur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, id_projet INT DEFAULT NULL, cle VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_5F8A7F7376222944 (id_projet), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traduction (id INT AUTO_INCREMENT NOT NULL, id_source INT DEFAULT NULL, langue_cible VARCHAR(255) NOT NULL, contenu_traduction LONGTEXT NOT NULL, INDEX IDX_CF8C03A879BDCA9E (id_source), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, type_profil ENUM(\'chef de projet\', \'traducteur\', \'les deux\'), is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profil_utilisateur ADD CONSTRAINT FK_47227AF350EAE44 FOREIGN KEY (id_utilisateur) REFERENCES user (id)');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA950EAE44 FOREIGN KEY (id_utilisateur) REFERENCES user (id)');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F7376222944 FOREIGN KEY (id_projet) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE traduction ADD CONSTRAINT FK_CF8C03A879BDCA9E FOREIGN KEY (id_source) REFERENCES source (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profil_utilisateur DROP FOREIGN KEY FK_47227AF350EAE44');
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA950EAE44');
        $this->addSql('ALTER TABLE source DROP FOREIGN KEY FK_5F8A7F7376222944');
        $this->addSql('ALTER TABLE traduction DROP FOREIGN KEY FK_CF8C03A879BDCA9E');
        $this->addSql('DROP TABLE profil_utilisateur');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE traduction');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
