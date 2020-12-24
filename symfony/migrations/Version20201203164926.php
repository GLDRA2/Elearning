<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201203164926 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, cours_id INT NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_4B98C217ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_groupe (user_id INT NOT NULL, groupe_id INT NOT NULL, INDEX IDX_61EB971CA76ED395 (user_id), INDEX IDX_61EB971C7A45358C (groupe_id), PRIMARY KEY(user_id, groupe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE groupe ADD CONSTRAINT FK_4B98C217ECF78B0 FOREIGN KEY (cours_id) REFERENCES cour (id)');
        $this->addSql('ALTER TABLE user_groupe ADD CONSTRAINT FK_61EB971CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_groupe ADD CONSTRAINT FK_61EB971C7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_groupe DROP FOREIGN KEY FK_61EB971C7A45358C');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE user_groupe');
    }
}