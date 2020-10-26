<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200927011211 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blood_product_order (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, product_order_id INT NOT NULL, INDEX IDX_DE129B334584665A (product_id), INDEX IDX_DE129B33462F07AF (product_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blood_product_order ADD CONSTRAINT FK_DE129B334584665A FOREIGN KEY (product_id) REFERENCES blood_product (id)');
        $this->addSql('ALTER TABLE blood_product_order ADD CONSTRAINT FK_DE129B33462F07AF FOREIGN KEY (product_order_id) REFERENCES `order` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE blood_product_order');
    }
}
