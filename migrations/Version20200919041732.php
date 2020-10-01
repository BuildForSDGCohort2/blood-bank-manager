<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200919041732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blood_product ADD blood_bank_id INT NOT NULL');
        $this->addSql('ALTER TABLE blood_product ADD CONSTRAINT FK_6CECDF0CAE6E20E0 FOREIGN KEY (blood_bank_id) REFERENCES blood_bank (id)');
        $this->addSql('CREATE INDEX IDX_6CECDF0CAE6E20E0 ON blood_product (blood_bank_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blood_product DROP FOREIGN KEY FK_6CECDF0CAE6E20E0');
        $this->addSql('DROP INDEX IDX_6CECDF0CAE6E20E0 ON blood_product');
        $this->addSql('ALTER TABLE blood_product DROP blood_bank_id');
    }
}
