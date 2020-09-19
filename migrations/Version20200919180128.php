<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200919180128 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reminder_recipients');
        $this->addSql('ALTER TABLE users ADD reminders_recipients_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E990E08582 FOREIGN KEY (reminders_recipients_id) REFERENCES reminders (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E990E08582 ON users (reminders_recipients_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reminder_recipients (id INT AUTO_INCREMENT NOT NULL, reminder_id INT NOT NULL, recipient_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E990E08582');
        $this->addSql('DROP INDEX IDX_1483A5E990E08582 ON users');
        $this->addSql('ALTER TABLE users DROP reminders_recipients_id');
    }
}
