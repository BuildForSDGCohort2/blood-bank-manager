<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200924034802 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blood_product_stock (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, bloodbank_id INT NOT NULL, created_at DATETIME NOT NULL, expire_at DATETIME NOT NULL, quantity INT NOT NULL, INDEX IDX_600D5ECB4584665A (product_id), INDEX IDX_600D5ECB9E41ABF1 (bloodbank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blood_product_stock ADD CONSTRAINT FK_600D5ECB4584665A FOREIGN KEY (product_id) REFERENCES blood_product (id)');
        $this->addSql('ALTER TABLE blood_product_stock ADD CONSTRAINT FK_600D5ECB9E41ABF1 FOREIGN KEY (bloodbank_id) REFERENCES blood_bank (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE blood_product_stock');
    }
}
