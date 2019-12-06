<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206120334 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `constraint` CHANGE item_id item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE effect CHANGE item_id item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item CHANGE cloth_id cloth_id INT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL, CHANGE pa_cost pa_cost SMALLINT DEFAULT NULL, CHANGE po_range po_range VARCHAR(255) DEFAULT NULL, CHANGE cc_bonus cc_bonus SMALLINT DEFAULT NULL, CHANGE cc_rate cc_rate SMALLINT DEFAULT NULL, CHANGE cc_hits cc_hits SMALLINT DEFAULT NULL, CHANGE hits_count hits_count SMALLINT DEFAULT NULL, CHANGE hits_lines hits_lines SMALLINT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX u_item_name ON item (name)');
        $this->addSql('ALTER TABLE price CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B1374584665A FOREIGN KEY (product_id) REFERENCES item (id)');
        $this->addSql('CREATE INDEX IDX_DA88B1374584665A ON recipe (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `constraint` CHANGE item_id item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE effect CHANGE item_id item_id INT DEFAULT NULL');
        $this->addSql('DROP INDEX u_item_name ON item');
        $this->addSql('ALTER TABLE item CHANGE cloth_id cloth_id INT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL, CHANGE pa_cost pa_cost SMALLINT DEFAULT NULL, CHANGE po_range po_range VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE cc_bonus cc_bonus SMALLINT DEFAULT NULL, CHANGE cc_rate cc_rate SMALLINT DEFAULT NULL, CHANGE cc_hits cc_hits SMALLINT DEFAULT NULL, CHANGE hits_count hits_count SMALLINT DEFAULT NULL, CHANGE hits_lines hits_lines SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE price CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B1374584665A');
        $this->addSql('DROP INDEX IDX_DA88B1374584665A ON recipe');
    }
}
