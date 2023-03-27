<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230326124737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gladiator CHANGE address address DOUBLE PRECISION NOT NULL, CHANGE strength strength DOUBLE PRECISION NOT NULL, CHANGE balance balance DOUBLE PRECISION NOT NULL, CHANGE speed speed DOUBLE PRECISION NOT NULL, CHANGE strategy strategy DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gladiator CHANGE address address SMALLINT NOT NULL, CHANGE strength strength SMALLINT NOT NULL, CHANGE balance balance SMALLINT NOT NULL, CHANGE speed speed SMALLINT NOT NULL, CHANGE strategy strategy SMALLINT NOT NULL');
    }
}
