<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200923080332 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE payment_supervisor (user_id INT NOT NULL, supervisor_id INT NOT NULL, INDEX IDX_7867132DA76ED395 (user_id), INDEX IDX_7867132D19E9AC5F (supervisor_id), PRIMARY KEY(user_id, supervisor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reminders_recipient (user_id INT NOT NULL, recipient_id INT NOT NULL, INDEX IDX_10619D08A76ED395 (user_id), INDEX IDX_10619D08E92F8F78 (recipient_id), PRIMARY KEY(user_id, recipient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment_supervisor ADD CONSTRAINT FK_7867132DA76ED395 FOREIGN KEY (user_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE payment_supervisor ADD CONSTRAINT FK_7867132D19E9AC5F FOREIGN KEY (supervisor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reminders_recipient ADD CONSTRAINT FK_10619D08A76ED395 FOREIGN KEY (user_id) REFERENCES reminders (id)');
        $this->addSql('ALTER TABLE reminders_recipient ADD CONSTRAINT FK_10619D08E92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64990E08582');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E4EDA592');
        $this->addSql('DROP INDEX IDX_8D93D64990E08582 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649E4EDA592 ON user');
        $this->addSql('ALTER TABLE user DROP payment_supervisor_id, DROP reminders_recipients_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE payment_supervisor');
        $this->addSql('DROP TABLE reminders_recipient');
        $this->addSql('ALTER TABLE user ADD payment_supervisor_id INT DEFAULT NULL, ADD reminders_recipients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64990E08582 FOREIGN KEY (reminders_recipients_id) REFERENCES reminders (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E4EDA592 FOREIGN KEY (payment_supervisor_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8D93D64990E08582 ON user (reminders_recipients_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649E4EDA592 ON user (payment_supervisor_id)');
    }
}
