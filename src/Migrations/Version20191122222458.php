<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191122222458 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE effect ADD is_damage TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE equipment CHANGE cloth_id cloth_id INT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL, CHANGE pa_cost pa_cost SMALLINT DEFAULT NULL, CHANGE po_range po_range SMALLINT DEFAULT NULL, CHANGE cc_bonus cc_bonus SMALLINT DEFAULT NULL, CHANGE cc_rate cc_rate SMALLINT DEFAULT NULL, CHANGE cc_hits cc_hits SMALLINT DEFAULT NULL, CHANGE hits_count hits_count SMALLINT DEFAULT NULL, CHANGE hits_lines hits_lines SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE item CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE effect DROP is_damage');
        $this->addSql('ALTER TABLE equipment CHANGE cloth_id cloth_id INT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL, CHANGE pa_cost pa_cost SMALLINT DEFAULT NULL, CHANGE po_range po_range SMALLINT DEFAULT NULL, CHANGE cc_bonus cc_bonus SMALLINT DEFAULT NULL, CHANGE cc_rate cc_rate SMALLINT DEFAULT NULL, CHANGE cc_hits cc_hits SMALLINT DEFAULT NULL, CHANGE hits_count hits_count SMALLINT DEFAULT NULL, CHANGE hits_lines hits_lines SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE item CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
    }
}
