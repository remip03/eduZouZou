<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240725085333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` ADD ecole_id INT NOT NULL');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D7677EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('CREATE INDEX IDX_880E0D7677EF1B1E ON `admin` (ecole_id)');
        $this->addSql('ALTER TABLE classe ADD ecole_id INT NOT NULL');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF9677EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF9677EF1B1E ON classe (ecole_id)');
        $this->addSql('ALTER TABLE ecole ADD super_admin_id INT NOT NULL');
        $this->addSql('ALTER TABLE ecole ADD CONSTRAINT FK_9786AACBBF91D3B FOREIGN KEY (super_admin_id) REFERENCES super_admin (id)');
        $this->addSql('CREATE INDEX IDX_9786AACBBF91D3B ON ecole (super_admin_id)');
        $this->addSql('ALTER TABLE enseignant ADD ecole_id INT NOT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA177EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA177EF1B1E ON enseignant (ecole_id)');
        $this->addSql('ALTER TABLE message ADD messagerie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F836C1031 FOREIGN KEY (messagerie_id) REFERENCES messagerie (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F836C1031 ON message (messagerie_id)');
        $this->addSql('ALTER TABLE parents ADD messagerie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parents ADD CONSTRAINT FK_FD501D6A836C1031 FOREIGN KEY (messagerie_id) REFERENCES messagerie (id)');
        $this->addSql('CREATE INDEX IDX_FD501D6A836C1031 ON parents (messagerie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecole DROP FOREIGN KEY FK_9786AACBBF91D3B');
        $this->addSql('DROP INDEX IDX_9786AACBBF91D3B ON ecole');
        $this->addSql('ALTER TABLE ecole DROP super_admin_id');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA177EF1B1E');
        $this->addSql('DROP INDEX IDX_81A72FA177EF1B1E ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP ecole_id');
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D7677EF1B1E');
        $this->addSql('DROP INDEX IDX_880E0D7677EF1B1E ON `admin`');
        $this->addSql('ALTER TABLE `admin` DROP ecole_id');
        $this->addSql('ALTER TABLE parents DROP FOREIGN KEY FK_FD501D6A836C1031');
        $this->addSql('DROP INDEX IDX_FD501D6A836C1031 ON parents');
        $this->addSql('ALTER TABLE parents DROP messagerie_id');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F836C1031');
        $this->addSql('DROP INDEX IDX_B6BD307F836C1031 ON message');
        $this->addSql('ALTER TABLE message DROP messagerie_id');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF9677EF1B1E');
        $this->addSql('DROP INDEX IDX_8F87BF9677EF1B1E ON classe');
        $this->addSql('ALTER TABLE classe DROP ecole_id');
    }
}
