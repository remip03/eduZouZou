<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240724120223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, description_act VARCHAR(500) DEFAULT NULL, type_act VARCHAR(50) NOT NULL, matiere_act VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, last_name_a VARCHAR(50) NOT NULL, first_name_a VARCHAR(50) NOT NULL, mail_a VARCHAR(50) NOT NULL, pass_a VARCHAR(60) NOT NULL, telephone_a VARCHAR(20) NOT NULL, adresse_a VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, name_cl VARCHAR(50) DEFAULT NULL, niveau_cl VARCHAR(50) NOT NULL, annee_cl DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, description_c VARCHAR(500) DEFAULT NULL, doc_c VARCHAR(50) DEFAULT NULL, video_c VARCHAR(100) DEFAULT NULL, resource_sup_c VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecole (id INT AUTO_INCREMENT NOT NULL, name_ec VARCHAR(50) NOT NULL, adresse_ec VARCHAR(100) NOT NULL, telephone_ec VARCHAR(20) NOT NULL, mail_ec VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant (id INT AUTO_INCREMENT NOT NULL, last_name_e VARCHAR(50) NOT NULL, first_name_e VARCHAR(50) NOT NULL, birth_date_e DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignant (id INT AUTO_INCREMENT NOT NULL, last_name_t VARCHAR(50) NOT NULL, first_name_t VARCHAR(50) NOT NULL, mail_t VARCHAR(50) NOT NULL, pass_t VARCHAR(60) NOT NULL, telephone_t VARCHAR(20) NOT NULL, adresse_t VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, content_message VARCHAR(500) NOT NULL, destinataire VARCHAR(50) NOT NULL, expediteur VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, messages VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, last_name_p VARCHAR(50) NOT NULL, first_name_p VARCHAR(50) NOT NULL, mail_p VARCHAR(50) NOT NULL, pass_p VARCHAR(50) NOT NULL, telephone_p VARCHAR(20) NOT NULL, adresse_p VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, type_r TINYINT(1) NOT NULL, name_r VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE super_admin (id INT AUTO_INCREMENT NOT NULL, last_name_sa VARCHAR(50) NOT NULL, first_name_sa VARCHAR(50) NOT NULL, mail_sa VARCHAR(50) NOT NULL, pass_sa VARCHAR(60) NOT NULL, telephone_sa VARCHAR(20) NOT NULL, adresse_sa VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE ecole');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('DROP TABLE enseignant');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE messagerie');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE super_admin');
    }
}
