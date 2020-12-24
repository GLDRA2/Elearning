<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201221142924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question ADD task_id INT NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E8DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('CREATE INDEX IDX_B6F7494E8DB60186 ON question (task_id)');
        $this->addSql('ALTER TABLE task ADD cour_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25B7942F03 FOREIGN KEY (cour_id) REFERENCES cour (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25B7942F03 ON task (cour_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E8DB60186');
        $this->addSql('DROP INDEX IDX_B6F7494E8DB60186 ON question');
        $this->addSql('ALTER TABLE question DROP task_id');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25B7942F03');
        $this->addSql('DROP INDEX IDX_527EDB25B7942F03 ON task');
        $this->addSql('ALTER TABLE task DROP cour_id');
    }
}
