<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191122145803 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipment ADD pa_cost SMALLINT DEFAULT NULL, ADD po_range SMALLINT DEFAULT NULL, ADD cc_bonus SMALLINT DEFAULT NULL, ADD cc_rate SMALLINT DEFAULT NULL, ADD cc_hits SMALLINT DEFAULT NULL, ADD hits_count SMALLINT DEFAULT NULL, ADD hits_lines SMALLINT DEFAULT NULL, CHANGE cloth_id cloth_id INT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipment DROP pa_cost, DROP po_range, DROP cc_bonus, DROP cc_rate, DROP cc_hits, DROP hits_count, DROP hits_lines, CHANGE cloth_id cloth_id INT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
    }
}
