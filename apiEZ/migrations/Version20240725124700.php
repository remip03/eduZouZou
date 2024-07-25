<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240725124700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT NOT NULL, type_act VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT NOT NULL, doc_c VARCHAR(50) DEFAULT NULL, video_c VARCHAR(100) DEFAULT NULL, ressource_sup_c VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite ADD CONSTRAINT FK_B8755515BF396750 FOREIGN KEY (id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CBF396750 FOREIGN KEY (id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ressource DROP type_act, DROP doc_c, DROP video_c, DROP ressource_sup_c');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite DROP FOREIGN KEY FK_B8755515BF396750');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CBF396750');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE cours');
        $this->addSql('ALTER TABLE ressource ADD type_act VARCHAR(50) DEFAULT NULL, ADD doc_c VARCHAR(50) DEFAULT NULL, ADD video_c VARCHAR(100) DEFAULT NULL, ADD ressource_sup_c VARCHAR(50) DEFAULT NULL');
    }
}
