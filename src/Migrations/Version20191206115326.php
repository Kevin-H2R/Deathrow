<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206115326 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

//        $this->addSql('ALTER TABLE `constraint` DROP FOREIGN KEY FK_394A8EF2517FE9FE');
//        $this->addSql('ALTER TABLE effect DROP FOREIGN KEY FK_B66091F2517FE9FE');
//        $this->addSql('ALTER TABLE equipment_recipe DROP FOREIGN KEY FK_7D06CE77517FE9FE');
//        $this->addSql('ALTER TABLE item_equipment DROP FOREIGN KEY FK_DFE2C373517FE9FE');
//        $this->addSql('ALTER TABLE price DROP FOREIGN KEY FK_CAC822D9517FE9FE');
//        $this->addSql('DROP TABLE equipment');
//        $this->addSql('DROP TABLE equipment_recipe');
//        $this->addSql('DROP TABLE item_equipment');
//        $this->addSql('DROP INDEX IDX_394A8EF2517FE9FE ON `constraint`');
//        $this->addSql('ALTER TABLE `constraint` ADD item_id INT DEFAULT NULL, DROP equipment_id');
//        $this->addSql('ALTER TABLE `constraint` ADD CONSTRAINT FK_394A8EF2126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
//        $this->addSql('CREATE INDEX IDX_394A8EF2126F525E ON `constraint` (item_id)');
//        $this->addSql('DROP INDEX IDX_B66091F2517FE9FE ON effect');
//        $this->addSql('ALTER TABLE effect ADD item_id INT DEFAULT NULL, DROP equipment_id');
//        $this->addSql('ALTER TABLE effect ADD CONSTRAINT FK_B66091F2126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
//        $this->addSql('CREATE INDEX IDX_B66091F2126F525E ON effect (item_id)');
//        $this->addSql('ALTER TABLE item ADD cloth_id INT DEFAULT NULL, ADD level SMALLINT NOT NULL, ADD type VARCHAR(255) NOT NULL, ADD pa_cost SMALLINT DEFAULT NULL, ADD po_range VARCHAR(255) DEFAULT NULL, ADD cc_bonus SMALLINT DEFAULT NULL, ADD cc_rate SMALLINT DEFAULT NULL, ADD cc_hits SMALLINT DEFAULT NULL, ADD hits_count SMALLINT DEFAULT NULL, ADD hits_lines SMALLINT DEFAULT NULL, CHANGE image_id image_id INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EE53266EE FOREIGN KEY (cloth_id) REFERENCES cloth (id)');
//        $this->addSql('CREATE INDEX IDX_1F1B251EE53266EE ON item (cloth_id)');
//        $this->addSql('DROP INDEX IDX_CAC822D9517FE9FE ON price');
//        $this->addSql('ALTER TABLE price DROP equipment_id, CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE recipe ADD product_id INT NOT NULL');
//        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B1374584665A FOREIGN KEY (product_id) REFERENCES item (id)');
//        $this->addSql('CREATE INDEX IDX_DA88B1374584665A ON recipe (product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, cloth_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, level SMALLINT NOT NULL, image_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, pa_cost SMALLINT DEFAULT NULL, po_range SMALLINT DEFAULT NULL, cc_bonus SMALLINT DEFAULT NULL, cc_rate SMALLINT DEFAULT NULL, cc_hits SMALLINT DEFAULT NULL, hits_count SMALLINT DEFAULT NULL, hits_lines SMALLINT DEFAULT NULL, INDEX IDX_D338D583E53266EE (cloth_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipment_recipe (equipment_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_7D06CE7759D8A214 (recipe_id), INDEX IDX_7D06CE77517FE9FE (equipment_id), PRIMARY KEY(equipment_id, recipe_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE item_equipment (item_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_DFE2C373517FE9FE (equipment_id), INDEX IDX_DFE2C373126F525E (item_id), PRIMARY KEY(item_id, equipment_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583E53266EE FOREIGN KEY (cloth_id) REFERENCES cloth (id)');
        $this->addSql('ALTER TABLE equipment_recipe ADD CONSTRAINT FK_7D06CE77517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipment_recipe ADD CONSTRAINT FK_7D06CE7759D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_equipment ADD CONSTRAINT FK_DFE2C373126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_equipment ADD CONSTRAINT FK_DFE2C373517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `constraint` DROP FOREIGN KEY FK_394A8EF2126F525E');
        $this->addSql('DROP INDEX IDX_394A8EF2126F525E ON `constraint`');
        $this->addSql('ALTER TABLE `constraint` ADD equipment_id INT NOT NULL, DROP item_id');
        $this->addSql('ALTER TABLE `constraint` ADD CONSTRAINT FK_394A8EF2517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_394A8EF2517FE9FE ON `constraint` (equipment_id)');
        $this->addSql('ALTER TABLE effect DROP FOREIGN KEY FK_B66091F2126F525E');
        $this->addSql('DROP INDEX IDX_B66091F2126F525E ON effect');
        $this->addSql('ALTER TABLE effect ADD equipment_id INT NOT NULL, DROP item_id');
        $this->addSql('ALTER TABLE effect ADD CONSTRAINT FK_B66091F2517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_B66091F2517FE9FE ON effect (equipment_id)');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EE53266EE');
        $this->addSql('DROP INDEX IDX_1F1B251EE53266EE ON item');
        $this->addSql('ALTER TABLE item DROP cloth_id, DROP level, DROP type, DROP pa_cost, DROP po_range, DROP cc_bonus, DROP cc_rate, DROP cc_hits, DROP hits_count, DROP hits_lines, CHANGE image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price ADD equipment_id INT DEFAULT NULL, CHANGE item_id item_id INT DEFAULT NULL, CHANGE unit unit INT DEFAULT NULL, CHANGE tens tens INT DEFAULT NULL, CHANGE hundreds hundreds INT DEFAULT NULL');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D9517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id)');
        $this->addSql('CREATE INDEX IDX_CAC822D9517FE9FE ON price (equipment_id)');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B1374584665A');
        $this->addSql('DROP INDEX IDX_DA88B1374584665A ON recipe');
        $this->addSql('ALTER TABLE recipe DROP product_id');
    }
}
