<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200916074058 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blood_product ADD blood_group_id INT NOT NULL, ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE blood_product ADD CONSTRAINT FK_6CECDF0C5F3AECE2 FOREIGN KEY (blood_group_id) REFERENCES blood_group (id)');
        $this->addSql('ALTER TABLE blood_product ADD CONSTRAINT FK_6CECDF0CC54C8C93 FOREIGN KEY (type_id) REFERENCES blood_product_type (id)');
        $this->addSql('CREATE INDEX IDX_6CECDF0C5F3AECE2 ON blood_product (blood_group_id)');
        $this->addSql('CREATE INDEX IDX_6CECDF0CC54C8C93 ON blood_product (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blood_product DROP FOREIGN KEY FK_6CECDF0C5F3AECE2');
        $this->addSql('ALTER TABLE blood_product DROP FOREIGN KEY FK_6CECDF0CC54C8C93');
        $this->addSql('DROP INDEX IDX_6CECDF0C5F3AECE2 ON blood_product');
        $this->addSql('DROP INDEX IDX_6CECDF0CC54C8C93 ON blood_product');
        $this->addSql('ALTER TABLE blood_product DROP blood_group_id, DROP type_id');
    }
}
