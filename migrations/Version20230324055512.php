<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324055512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ludi ADD lanistes_id INT NOT NULL');
        $this->addSql('ALTER TABLE ludi ADD CONSTRAINT FK_37714A43A80255F7 FOREIGN KEY (lanistes_id) REFERENCES laniste (id)');
        $this->addSql('CREATE INDEX IDX_37714A43A80255F7 ON ludi (lanistes_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ludi DROP FOREIGN KEY FK_37714A43A80255F7');
        $this->addSql('DROP INDEX IDX_37714A43A80255F7 ON ludi');
        $this->addSql('ALTER TABLE ludi DROP lanistes_id');
    }
}
