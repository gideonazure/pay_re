<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200926192412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment ADD active TINYINT(1) NOT NULL, ADD repeatable TINYINT(1) NOT NULL, ADD repeatable_id INT NOT NULL');
        $this->addSql('ALTER TABLE reminders DROP FOREIGN KEY FK_6D92B9D4BBC61482');
        $this->addSql('DROP INDEX IDX_6D92B9D4BBC61482 ON reminders');
        $this->addSql('ALTER TABLE reminders CHANGE payments_id payment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reminders ADD CONSTRAINT FK_6D92B9D44C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D92B9D44C3A3BB ON reminders (payment_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP active, DROP repeatable, DROP repeatable_id');
        $this->addSql('ALTER TABLE reminders DROP FOREIGN KEY FK_6D92B9D44C3A3BB');
        $this->addSql('DROP INDEX UNIQ_6D92B9D44C3A3BB ON reminders');
        $this->addSql('ALTER TABLE reminders CHANGE payment_id payments_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reminders ADD CONSTRAINT FK_6D92B9D4BBC61482 FOREIGN KEY (payments_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6D92B9D4BBC61482 ON reminders (payments_id)');
    }
}
