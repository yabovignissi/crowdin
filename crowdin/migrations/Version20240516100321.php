<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516100321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE traduction ADD attribution_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE traduction ADD CONSTRAINT FK_CF8C03A81B64C360 FOREIGN KEY (attribution_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CF8C03A81B64C360 ON traduction (attribution_user_id)');
        $this->addSql('ALTER TABLE user CHANGE type_profil type_profil ENUM(\'chef de projet\', \'traducteur\', \'les deux\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE traduction DROP FOREIGN KEY FK_CF8C03A81B64C360');
        $this->addSql('DROP INDEX IDX_CF8C03A81B64C360 ON traduction');
        $this->addSql('ALTER TABLE traduction DROP attribution_user_id');
        $this->addSql('ALTER TABLE user CHANGE type_profil type_profil VARCHAR(255) DEFAULT NULL');
    }
}
