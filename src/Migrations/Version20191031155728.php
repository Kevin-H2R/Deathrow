<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191031155728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cloth (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, level SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, cloth_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, level SMALLINT NOT NULL, INDEX IDX_D338D583E53266EE (cloth_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment_recipe (equipment_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_7D06CE77517FE9FE (equipment_id), INDEX IDX_7D06CE7759D8A214 (recipe_id), PRIMARY KEY(equipment_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_equipment (item_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_DFE2C373126F525E (item_id), INDEX IDX_DFE2C373517FE9FE (equipment_id), PRIMARY KEY(item_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipe (id INT AUTO_INCREMENT NOT NULL, item_id INT NOT NULL, count SMALLINT NOT NULL, INDEX IDX_DA88B137126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583E53266EE FOREIGN KEY (cloth_id) REFERENCES cloth (id)');
        $this->addSql('ALTER TABLE equipment_recipe ADD CONSTRAINT FK_7D06CE77517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipment_recipe ADD CONSTRAINT FK_7D06CE7759D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_equipment ADD CONSTRAINT FK_DFE2C373126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_equipment ADD CONSTRAINT FK_DFE2C373517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583E53266EE');
        $this->addSql('ALTER TABLE equipment_recipe DROP FOREIGN KEY FK_7D06CE77517FE9FE');
        $this->addSql('ALTER TABLE item_equipment DROP FOREIGN KEY FK_DFE2C373517FE9FE');
        $this->addSql('ALTER TABLE item_equipment DROP FOREIGN KEY FK_DFE2C373126F525E');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137126F525E');
        $this->addSql('ALTER TABLE equipment_recipe DROP FOREIGN KEY FK_7D06CE7759D8A214');
        $this->addSql('DROP TABLE cloth');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE equipment_recipe');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_equipment');
        $this->addSql('DROP TABLE recipe');
    }
}
