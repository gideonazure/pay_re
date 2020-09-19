<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200919171812 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attachments (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, payment INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type INT NOT NULL, cperson VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, code INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, payer_id INT DEFAULT NULL, recipient_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, amount_uah INT NOT NULL, amount_eur INT DEFAULT NULL, amount_usd INT DEFAULT NULL, expected_date INT NOT NULL, actual_date INT NOT NULL, status INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updates_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_6D28840DC54C8C93 (type_id), UNIQUE INDEX UNIQ_6D28840DC17AD9A9 (payer_id), UNIQUE INDEX UNIQ_6D28840DE92F8F78 (recipient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_users (payment_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_43CA935B4C3A3BB (payment_id), INDEX IDX_43CA935B67B3B43D (users_id), PRIMARY KEY(payment_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_reminders (payment_id INT NOT NULL, reminders_id INT NOT NULL, INDEX IDX_2EBB96FC4C3A3BB (payment_id), INDEX IDX_2EBB96FCC7C7BF28 (reminders_id), PRIMARY KEY(payment_id, reminders_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_types (id INT AUTO_INCREMENT NOT NULL, abbr VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reminder_recipients (id INT AUTO_INCREMENT NOT NULL, reminder_id INT NOT NULL, recipient_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reminders (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, text LONGTEXT DEFAULT NULL, type INT NOT NULL, date INT NOT NULL, repeatable TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, payment_responsible_id INT DEFAULT NULL, payment_created_id INT DEFAULT NULL, payment_updated_id INT DEFAULT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, telegram VARCHAR(255) DEFAULT NULL, active TINYINT(1) NOT NULL, position VARCHAR(255) DEFAULT NULL, INDEX IDX_1483A5E985026911 (payment_responsible_id), INDEX IDX_1483A5E96B169F91 (payment_created_id), INDEX IDX_1483A5E9A3FA4626 (payment_updated_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DC54C8C93 FOREIGN KEY (type_id) REFERENCES payment_types (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DC17AD9A9 FOREIGN KEY (payer_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DE92F8F78 FOREIGN KEY (recipient_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE payment_users ADD CONSTRAINT FK_43CA935B4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_users ADD CONSTRAINT FK_43CA935B67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_reminders ADD CONSTRAINT FK_2EBB96FC4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_reminders ADD CONSTRAINT FK_2EBB96FCC7C7BF28 FOREIGN KEY (reminders_id) REFERENCES reminders (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E985026911 FOREIGN KEY (payment_responsible_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E96B169F91 FOREIGN KEY (payment_created_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9A3FA4626 FOREIGN KEY (payment_updated_id) REFERENCES payment (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DC17AD9A9');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DE92F8F78');
        $this->addSql('ALTER TABLE payment_users DROP FOREIGN KEY FK_43CA935B4C3A3BB');
        $this->addSql('ALTER TABLE payment_reminders DROP FOREIGN KEY FK_2EBB96FC4C3A3BB');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E985026911');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E96B169F91');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9A3FA4626');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DC54C8C93');
        $this->addSql('ALTER TABLE payment_reminders DROP FOREIGN KEY FK_2EBB96FCC7C7BF28');
        $this->addSql('ALTER TABLE payment_users DROP FOREIGN KEY FK_43CA935B67B3B43D');
        $this->addSql('DROP TABLE attachments');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_users');
        $this->addSql('DROP TABLE payment_reminders');
        $this->addSql('DROP TABLE payment_types');
        $this->addSql('DROP TABLE reminder_recipients');
        $this->addSql('DROP TABLE reminders');
        $this->addSql('DROP TABLE users');
    }
}
