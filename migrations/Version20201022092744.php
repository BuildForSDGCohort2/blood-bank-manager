<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201022092744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blood_product_order DROP FOREIGN KEY FK_DE129B33462F07AF');
        $this->addSql('DROP INDEX IDX_DE129B33462F07AF ON blood_product_order');
        $this->addSql('ALTER TABLE blood_product_order CHANGE product_order_id order_id INT NOT NULL');
        $this->addSql('ALTER TABLE blood_product_order ADD CONSTRAINT FK_DE129B338D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_DE129B338D9F6D38 ON blood_product_order (order_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blood_product_order DROP FOREIGN KEY FK_DE129B338D9F6D38');
        $this->addSql('DROP INDEX IDX_DE129B338D9F6D38 ON blood_product_order');
        $this->addSql('ALTER TABLE blood_product_order CHANGE order_id product_order_id INT NOT NULL');
        $this->addSql('ALTER TABLE blood_product_order ADD CONSTRAINT FK_DE129B33462F07AF FOREIGN KEY (product_order_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_DE129B33462F07AF ON blood_product_order (product_order_id)');
    }
}
