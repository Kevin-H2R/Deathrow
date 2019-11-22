<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191122145455 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `constraint` (id INT AUTO_INCREMENT NOT NULL, equipment_id INT NOT NULL, name VARCHAR(255) NOT NULL, sign VARCHAR(255) NOT NULL, value SMALLINT NOT NULL, INDEX IDX_394A8EF2517FE9FE (equipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `constraint` ADD CONSTRAINT FK_394A8EF2517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id)');
        $this->addSql('ALTER TABLE equipment CHANGE cloth_id cloth_id INT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE `constraint`');
        $this->addSql('ALTER TABLE equipment CHANGE cloth_id cloth_id INT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
    }
}
