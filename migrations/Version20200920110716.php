<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200920110716 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attachments (id INT AUTO_INCREMENT NOT NULL, payment_attachment_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, INDEX IDX_47C4FAD6F960EF46 (payment_attachment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type INT NOT NULL, cperson VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, code INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, payer_id INT DEFAULT NULL, recipient_id INT DEFAULT NULL, responsible_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, amount_uah INT NOT NULL, amount_eur INT DEFAULT NULL, amount_usd INT DEFAULT NULL, expected_date INT NOT NULL, actual_date INT NOT NULL, status INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updates_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6D28840DC54C8C93 (type_id), INDEX IDX_6D28840DC17AD9A9 (payer_id), INDEX IDX_6D28840DE92F8F78 (recipient_id), INDEX IDX_6D28840D602AD315 (responsible_id), INDEX IDX_6D28840DB03A8386 (created_by_id), INDEX IDX_6D28840D896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_types (id INT AUTO_INCREMENT NOT NULL, abbr VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reminders (id INT AUTO_INCREMENT NOT NULL, payments_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, text LONGTEXT DEFAULT NULL, type INT NOT NULL, date INT NOT NULL, repeatable TINYINT(1) NOT NULL, INDEX IDX_6D92B9D4BBC61482 (payments_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, payment_supervisor_id INT DEFAULT NULL, reminders_recipients_id INT DEFAULT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone INT DEFAULT NULL, telegram VARCHAR(255) DEFAULT NULL, active TINYINT(1) NOT NULL, position VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), INDEX IDX_8D93D649E4EDA592 (payment_supervisor_id), INDEX IDX_8D93D64990E08582 (reminders_recipients_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attachments ADD CONSTRAINT FK_47C4FAD6F960EF46 FOREIGN KEY (payment_attachment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DC54C8C93 FOREIGN KEY (type_id) REFERENCES payment_types (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DC17AD9A9 FOREIGN KEY (payer_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DE92F8F78 FOREIGN KEY (recipient_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D602AD315 FOREIGN KEY (responsible_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reminders ADD CONSTRAINT FK_6D92B9D4BBC61482 FOREIGN KEY (payments_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E4EDA592 FOREIGN KEY (payment_supervisor_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64990E08582 FOREIGN KEY (reminders_recipients_id) REFERENCES reminders (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DC17AD9A9');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DE92F8F78');
        $this->addSql('ALTER TABLE attachments DROP FOREIGN KEY FK_47C4FAD6F960EF46');
        $this->addSql('ALTER TABLE reminders DROP FOREIGN KEY FK_6D92B9D4BBC61482');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E4EDA592');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DC54C8C93');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64990E08582');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D602AD315');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DB03A8386');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D896DBBDE');
        $this->addSql('DROP TABLE attachments');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_types');
        $this->addSql('DROP TABLE reminders');
        $this->addSql('DROP TABLE user');
    }
}
