<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240514132705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE translate DROP FOREIGN KEY FK_4A1063776B3CA4B');
        $this->addSql('ALTER TABLE translate_source DROP FOREIGN KEY FK_955F247A649893AF');
        $this->addSql('ALTER TABLE translate_source DROP FOREIGN KEY FK_955F247A953C1C61');
        $this->addSql('DROP TABLE translate');
        $this->addSql('DROP TABLE translate_source');
        $this->addSql('ALTER TABLE user CHANGE type_profil type_profil ENUM(\'chef de projet\', \'traducteur\', \'les deux\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE translate (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, contenu_traduction LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_4A1063776B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE translate_source (translate_id INT NOT NULL, source_id INT NOT NULL, INDEX IDX_955F247A649893AF (translate_id), INDEX IDX_955F247A953C1C61 (source_id), PRIMARY KEY(translate_id, source_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE translate ADD CONSTRAINT FK_4A1063776B3CA4B FOREIGN KEY (id_user) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE translate_source ADD CONSTRAINT FK_955F247A649893AF FOREIGN KEY (translate_id) REFERENCES translate (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE translate_source ADD CONSTRAINT FK_955F247A953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE type_profil type_profil VARCHAR(255) DEFAULT NULL');
    }
}
