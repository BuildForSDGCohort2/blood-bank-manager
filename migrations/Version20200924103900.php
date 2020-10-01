<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200924103900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blood_product_stock DROP FOREIGN KEY FK_600D5ECB9E41ABF1');
        $this->addSql('DROP INDEX IDX_600D5ECB9E41ABF1 ON blood_product_stock');
        $this->addSql('ALTER TABLE blood_product_stock CHANGE bloodbank_id blood_bank_id INT NOT NULL');
        $this->addSql('ALTER TABLE blood_product_stock ADD CONSTRAINT FK_600D5ECBAE6E20E0 FOREIGN KEY (blood_bank_id) REFERENCES blood_bank (id)');
        $this->addSql('CREATE INDEX IDX_600D5ECBAE6E20E0 ON blood_product_stock (blood_bank_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blood_product_stock DROP FOREIGN KEY FK_600D5ECBAE6E20E0');
        $this->addSql('DROP INDEX IDX_600D5ECBAE6E20E0 ON blood_product_stock');
        $this->addSql('ALTER TABLE blood_product_stock CHANGE blood_bank_id bloodbank_id INT NOT NULL');
        $this->addSql('ALTER TABLE blood_product_stock ADD CONSTRAINT FK_600D5ECB9E41ABF1 FOREIGN KEY (bloodbank_id) REFERENCES blood_bank (id)');
        $this->addSql('CREATE INDEX IDX_600D5ECB9E41ABF1 ON blood_product_stock (bloodbank_id)');
    }
}
