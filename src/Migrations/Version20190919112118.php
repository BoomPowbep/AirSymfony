<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919112118 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE offer ADD image_id INT DEFAULT NULL, DROP image_name');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29D6873E3DA5256D ON offer (image_id)');
        $this->addSql('ALTER TABLE image ADD image_name VARCHAR(255) NOT NULL, ADD image_size INT NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE image DROP image_name, DROP image_size, DROP updated_at');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E3DA5256D');
        $this->addSql('DROP INDEX UNIQ_29D6873E3DA5256D ON offer');
        $this->addSql('ALTER TABLE offer ADD image_name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP image_id');
    }
}
