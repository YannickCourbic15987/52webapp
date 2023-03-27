<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324182211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ludis_lanistes (id INT AUTO_INCREMENT NOT NULL, ludi_id INT DEFAULT NULL, INDEX IDX_97BD1E8B390910BB (ludi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ludis_lanistes ADD CONSTRAINT FK_97BD1E8B390910BB FOREIGN KEY (ludi_id) REFERENCES ludi (id)');
        $this->addSql('ALTER TABLE gladiator ADD ludis_id INT NOT NULL');
        $this->addSql('ALTER TABLE gladiator ADD CONSTRAINT FK_FFC56584BBFBDE31 FOREIGN KEY (ludis_id) REFERENCES ludi (id)');
        $this->addSql('CREATE INDEX IDX_FFC56584BBFBDE31 ON gladiator (ludis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ludis_lanistes DROP FOREIGN KEY FK_97BD1E8B390910BB');
        $this->addSql('DROP TABLE ludis_lanistes');
        $this->addSql('ALTER TABLE gladiator DROP FOREIGN KEY FK_FFC56584BBFBDE31');
        $this->addSql('DROP INDEX IDX_FFC56584BBFBDE31 ON gladiator');
        $this->addSql('ALTER TABLE gladiator DROP ludis_id');
    }
}
