<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240725122113 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, description_act VARCHAR(500) DEFAULT NULL, type_act VARCHAR(50) NOT NULL, matiere_act VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, name_cl VARCHAR(50) DEFAULT NULL, niveau_cl VARCHAR(50) NOT NULL, annee_cl DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, description_c VARCHAR(500) DEFAULT NULL, doc_c VARCHAR(50) DEFAULT NULL, video_c VARCHAR(100) DEFAULT NULL, resource_sup_c VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecole (id INT AUTO_INCREMENT NOT NULL, name_ec VARCHAR(50) NOT NULL, adresse_ec VARCHAR(100) NOT NULL, tel_ec VARCHAR(20) NOT NULL, mail_ec VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant (id INT AUTO_INCREMENT NOT NULL, last_name_e VARCHAR(50) NOT NULL, first_name_e VARCHAR(50) NOT NULL, birth_date_e DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, messagerie_id INT DEFAULT NULL, content_message VARCHAR(500) NOT NULL, destinataire VARCHAR(50) NOT NULL, expediteur VARCHAR(50) NOT NULL, INDEX IDX_B6BD307F836C1031 (messagerie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, messages VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, type_r TINYINT(1) NOT NULL, name_r VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, ecole_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, INDEX IDX_8D93D64977EF1B1E (ecole_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F836C1031 FOREIGN KEY (messagerie_id) REFERENCES messagerie (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64977EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F836C1031');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64977EF1B1E');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE ecole');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE messagerie');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE user');
    }
}
