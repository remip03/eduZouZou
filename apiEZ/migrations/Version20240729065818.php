<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240729065818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe_user DROP FOREIGN KEY FK_9380A3AF8F5EA509');
        $this->addSql('ALTER TABLE classe_user DROP FOREIGN KEY FK_9380A3AFA76ED395');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE classe_user');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF9677EF1B1E');
        $this->addSql('DROP INDEX IDX_8F87BF9677EF1B1E ON classe');
        $this->addSql('ALTER TABLE classe DROP ecole_id, CHANGE name_cl name_cl VARCHAR(50) NOT NULL, CHANGE annee_cl annee_cl DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE enfant DROP FOREIGN KEY FK_34B70CA28F5EA509');
        $this->addSql('DROP INDEX IDX_34B70CA28F5EA509 ON enfant');
        $this->addSql('ALTER TABLE enfant DROP classe_id, CHANGE first_name_e first_name_e VARCHAR(50) NOT NULL, CHANGE birth_date_e birth_date_e DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F836C1031');
        $this->addSql('DROP INDEX IDX_B6BD307F836C1031 ON message');
        $this->addSql('ALTER TABLE message DROP messagerie_id');
        $this->addSql('ALTER TABLE messagerie ADD messages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60CA5905F5A FOREIGN KEY (messages_id) REFERENCES message (id)');
        $this->addSql('CREATE INDEX IDX_14E8F60CA5905F5A ON messagerie (messages_id)');
        $this->addSql('ALTER TABLE ressource CHANGE type_r type_r VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, description_act VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type_act VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, matiere_act VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE classe_user (classe_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9380A3AF8F5EA509 (classe_id), INDEX IDX_9380A3AFA76ED395 (user_id), PRIMARY KEY(classe_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE classe_user ADD CONSTRAINT FK_9380A3AF8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_user ADD CONSTRAINT FK_9380A3AFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe ADD ecole_id INT NOT NULL, CHANGE name_cl name_cl VARCHAR(50) DEFAULT NULL, CHANGE annee_cl annee_cl VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF9677EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8F87BF9677EF1B1E ON classe (ecole_id)');
        $this->addSql('ALTER TABLE enfant ADD classe_id INT DEFAULT NULL, CHANGE first_name_e first_name_e VARCHAR(255) NOT NULL, CHANGE birth_date_e birth_date_e DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE enfant ADD CONSTRAINT FK_34B70CA28F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_34B70CA28F5EA509 ON enfant (classe_id)');
        $this->addSql('ALTER TABLE messagerie DROP FOREIGN KEY FK_14E8F60CA5905F5A');
        $this->addSql('DROP INDEX IDX_14E8F60CA5905F5A ON messagerie');
        $this->addSql('ALTER TABLE messagerie DROP messages_id');
        $this->addSql('ALTER TABLE message ADD messagerie_id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F836C1031 FOREIGN KEY (messagerie_id) REFERENCES messagerie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B6BD307F836C1031 ON message (messagerie_id)');
        $this->addSql('ALTER TABLE ressource CHANGE type_r type_r TINYINT(1) NOT NULL');
    }
}
