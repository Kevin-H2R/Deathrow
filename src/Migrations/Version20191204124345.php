<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204124345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipment CHANGE cloth_id cloth_id INT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL, CHANGE pa_cost pa_cost SMALLINT DEFAULT NULL, CHANGE po_range po_range SMALLINT DEFAULT NULL, CHANGE cc_bonus cc_bonus SMALLINT DEFAULT NULL, CHANGE cc_rate cc_rate SMALLINT DEFAULT NULL, CHANGE cc_hits cc_hits SMALLINT DEFAULT NULL, CHANGE hits_count hits_count SMALLINT DEFAULT NULL, CHANGE hits_lines hits_lines SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE item CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price ADD equipment_id INT DEFAULT NULL, DROP is_item, CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D9517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_CAC822D9517FE9FE ON price (equipment_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipment CHANGE cloth_id cloth_id INT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL, CHANGE pa_cost pa_cost SMALLINT DEFAULT NULL, CHANGE po_range po_range SMALLINT DEFAULT NULL, CHANGE cc_bonus cc_bonus SMALLINT DEFAULT NULL, CHANGE cc_rate cc_rate SMALLINT DEFAULT NULL, CHANGE cc_hits cc_hits SMALLINT DEFAULT NULL, CHANGE hits_count hits_count SMALLINT DEFAULT NULL, CHANGE hits_lines hits_lines SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE item CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D9517FE9FE');
        $this->addSql('DROP INDEX IDX_CAC822D9517FE9FE ON price');
        $this->addSql('ALTER TABLE price ADD is_item TINYINT(1) NOT NULL, DROP equipment_id, CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
    }
}
