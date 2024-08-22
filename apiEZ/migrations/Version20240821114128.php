<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240821114128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messagerie DROP FOREIGN KEY FK_14E8F60CA5905F5A');
        $this->addSql('DROP INDEX IDX_14E8F60CA5905F5A ON messagerie');
        $this->addSql('ALTER TABLE messagerie DROP messages_id');
        $this->addSql('ALTER TABLE ressource ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user DROP INDEX IDX_8D93D649836C1031, ADD UNIQUE INDEX UNIQ_8D93D649836C1031 (messagerie_id)');
        $this->addSql('ALTER TABLE user CHANGE ecole_id ecole_id INT DEFAULT NULL, CHANGE email email VARCHAR(100) NOT NULL, CHANGE password password VARCHAR(60) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP INDEX UNIQ_8D93D649836C1031, ADD INDEX IDX_8D93D649836C1031 (messagerie_id)');
        $this->addSql('ALTER TABLE user CHANGE ecole_id ecole_id INT NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ressource DROP updated_at');
        $this->addSql('ALTER TABLE messagerie ADD messages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE messagerie ADD CONSTRAINT FK_14E8F60CA5905F5A FOREIGN KEY (messages_id) REFERENCES message (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_14E8F60CA5905F5A ON messagerie (messages_id)');
    }
}
