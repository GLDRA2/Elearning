<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201220155349 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, cour_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_2D737AEFB7942F03 (cour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFB7942F03 FOREIGN KEY (cour_id) REFERENCES cour (id)');
        $this->addSql('ALTER TABLE upload ADD section_id INT NOT NULL');
        $this->addSql('ALTER TABLE upload ADD CONSTRAINT FK_17BDE61FD823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('CREATE INDEX IDX_17BDE61FD823E37A ON upload (section_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE upload DROP FOREIGN KEY FK_17BDE61FD823E37A');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP INDEX IDX_17BDE61FD823E37A ON upload');
        $this->addSql('ALTER TABLE upload DROP section_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
    }
}
