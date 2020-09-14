<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200910231647 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blood_bank_manager (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, blood_bank_id INT NOT NULL, INDEX IDX_D60A560CA76ED395 (user_id), INDEX IDX_D60A560CAE6E20E0 (blood_bank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blood_bank_manager ADD CONSTRAINT FK_D60A560CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE blood_bank_manager ADD CONSTRAINT FK_D60A560CAE6E20E0 FOREIGN KEY (blood_bank_id) REFERENCES blood_bank (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE blood_bank_manager');
    }
}
