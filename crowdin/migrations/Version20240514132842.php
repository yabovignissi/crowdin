<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514132842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE traduction (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, contenu_traduction LONGTEXT NOT NULL, INDEX IDX_CF8C03A86B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traduction_source (traduction_id INT NOT NULL, source_id INT NOT NULL, INDEX IDX_E51D4947E0955EF (traduction_id), INDEX IDX_E51D494953C1C61 (source_id), PRIMARY KEY(traduction_id, source_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE traduction ADD CONSTRAINT FK_CF8C03A86B3CA4B FOREIGN KEY (id_user) REFERENCES user (id)');
        $this->addSql('ALTER TABLE traduction_source ADD CONSTRAINT FK_E51D4947E0955EF FOREIGN KEY (traduction_id) REFERENCES traduction (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE traduction_source ADD CONSTRAINT FK_E51D494953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE type_profil type_profil ENUM(\'chef de projet\', \'traducteur\', \'les deux\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE traduction DROP FOREIGN KEY FK_CF8C03A86B3CA4B');
        $this->addSql('ALTER TABLE traduction_source DROP FOREIGN KEY FK_E51D4947E0955EF');
        $this->addSql('ALTER TABLE traduction_source DROP FOREIGN KEY FK_E51D494953C1C61');
        $this->addSql('DROP TABLE traduction');
        $this->addSql('DROP TABLE traduction_source');
        $this->addSql('ALTER TABLE user CHANGE type_profil type_profil VARCHAR(255) DEFAULT NULL');
    }
}
