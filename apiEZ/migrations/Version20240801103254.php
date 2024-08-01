<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240801103254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, ecole_id INT DEFAULT NULL, name_cl VARCHAR(50) NOT NULL, niveau_cl VARCHAR(50) NOT NULL, annee_cl DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_8F87BF9677EF1B1E (ecole_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecole (id INT AUTO_INCREMENT NOT NULL, name_ec VARCHAR(50) NOT NULL, adresse_ec VARCHAR(100) NOT NULL, tel_ec VARCHAR(20) NOT NULL, mail_ec VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enfant (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, last_name_e VARCHAR(50) NOT NULL, first_name_e VARCHAR(50) NOT NULL, birth_date_e DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', INDEX IDX_34B70CA28F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(500) NOT NULL, destinataire VARCHAR(50) NOT NULL, expediteur VARCHAR(50) NOT NULL, msg_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messagerie (id INT AUTO_INCREMENT NOT NULL, messages_id INT DEFAULT NULL, INDEX IDX_14E8F60CA5905F5A (messages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, type_r VARCHAR(50) NOT NULL, name_r VARCHAR(50) NOT NULL, description_r VARCHAR(500) DEFAULT NULL, matiere_r VARCHAR(50) NOT NULL, dtype VARCHAR(255) NOT NULL, type_act VARCHAR(50) DEFAULT NULL, doc_c VARCHAR(50) DEFAULT NULL, video_c VARCHAR(100) DEFAULT NULL, ressource_sup_c VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource_user (ressource_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7D2CD6C0FC6CD52A (ressource_id), INDEX IDX_7D2CD6C0A76ED395 (user_id), PRIMARY KEY(ressource_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, messagerie_id INT NOT NULL, ecole_id INT NOT NULL, email VARCHAR(100) NOT NULL, roles JSON NOT NULL, password VARCHAR(60) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, tel VARCHAR(20) NOT NULL, adresse VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_8D93D649836C1031 (messagerie_id), INDEX IDX_8D93D64977EF1B1E (ecole_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF9677EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA28F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60CA5905F5A FOREIGN KEY (messages_id) REFERENCES message (id)');
        $this->addSql('ALTER TABLE ressource_user ADD CONSTRAINT FK_7D2CD6C0FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource_user ADD CONSTRAINT FK_7D2CD6C0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649836C1031 FOREIGN KEY (messagerie_id) REFERENCES messagerie (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64977EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF9677EF1B1E');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA28F5EA509');
        $this->addSql('ALTER TABLE messagerie DROP FOREIGN KEY FK_14E8F60CA5905F5A');
        $this->addSql('ALTER TABLE ressource_user DROP FOREIGN KEY FK_7D2CD6C0FC6CD52A');
        $this->addSql('ALTER TABLE ressource_user DROP FOREIGN KEY FK_7D2CD6C0A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649836C1031');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64977EF1B1E');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE ecole');
        $this->addSql('DROP TABLE enfant');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE messagerie');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE ressource_user');
        $this->addSql('DROP TABLE user');
    }
}
