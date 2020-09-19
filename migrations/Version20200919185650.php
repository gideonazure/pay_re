<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200919185650 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE payment_reminders');
        $this->addSql('DROP TABLE payment_users');
        $this->addSql('ALTER TABLE attachments ADD payment_attachment_id INT DEFAULT NULL, DROP payment');
        $this->addSql('ALTER TABLE attachments ADD CONSTRAINT FK_47C4FAD6F960EF46 FOREIGN KEY (payment_attachment_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX IDX_47C4FAD6F960EF46 ON attachments (payment_attachment_id)');
        $this->addSql('ALTER TABLE payment DROP INDEX UNIQ_6D28840DC17AD9A9, ADD INDEX IDX_6D28840DC17AD9A9 (payer_id)');
        $this->addSql('ALTER TABLE payment DROP INDEX UNIQ_6D28840DC54C8C93, ADD INDEX IDX_6D28840DC54C8C93 (type_id)');
        $this->addSql('ALTER TABLE payment DROP INDEX UNIQ_6D28840DE92F8F78, ADD INDEX IDX_6D28840DE92F8F78 (recipient_id)');
        $this->addSql('ALTER TABLE payment ADD responsible_id INT DEFAULT NULL, ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL, CHANGE type_id type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D602AD315 FOREIGN KEY (responsible_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DB03A8386 FOREIGN KEY (created_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D896DBBDE FOREIGN KEY (updated_by_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_6D28840D602AD315 ON payment (responsible_id)');
        $this->addSql('CREATE INDEX IDX_6D28840DB03A8386 ON payment (created_by_id)');
        $this->addSql('CREATE INDEX IDX_6D28840D896DBBDE ON payment (updated_by_id)');
        $this->addSql('ALTER TABLE reminders ADD payments_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reminders ADD CONSTRAINT FK_6D92B9D4BBC61482 FOREIGN KEY (payments_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX IDX_6D92B9D4BBC61482 ON reminders (payments_id)');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E96B169F91');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E985026911');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9A3FA4626');
        $this->addSql('DROP INDEX IDX_1483A5E96B169F91 ON users');
        $this->addSql('DROP INDEX IDX_1483A5E985026911 ON users');
        $this->addSql('DROP INDEX IDX_1483A5E9A3FA4626 ON users');
        $this->addSql('ALTER TABLE users ADD payment_supervisor_id INT DEFAULT NULL, DROP payment_responsible_id, DROP payment_created_id, DROP payment_updated_id');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9E4EDA592 FOREIGN KEY (payment_supervisor_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9E4EDA592 ON users (payment_supervisor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE payment_reminders (payment_id INT NOT NULL, reminders_id INT NOT NULL, INDEX IDX_2EBB96FC4C3A3BB (payment_id), INDEX IDX_2EBB96FCC7C7BF28 (reminders_id), PRIMARY KEY(payment_id, reminders_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE payment_users (payment_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_43CA935B4C3A3BB (payment_id), INDEX IDX_43CA935B67B3B43D (users_id), PRIMARY KEY(payment_id, users_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE payment_reminders ADD CONSTRAINT FK_2EBB96FC4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_reminders ADD CONSTRAINT FK_2EBB96FCC7C7BF28 FOREIGN KEY (reminders_id) REFERENCES reminders (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_users ADD CONSTRAINT FK_43CA935B4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_users ADD CONSTRAINT FK_43CA935B67B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attachments DROP FOREIGN KEY FK_47C4FAD6F960EF46');
        $this->addSql('DROP INDEX IDX_47C4FAD6F960EF46 ON attachments');
        $this->addSql('ALTER TABLE attachments ADD payment INT NOT NULL, DROP payment_attachment_id');
        $this->addSql('ALTER TABLE payment DROP INDEX IDX_6D28840DC54C8C93, ADD UNIQUE INDEX UNIQ_6D28840DC54C8C93 (type_id)');
        $this->addSql('ALTER TABLE payment DROP INDEX IDX_6D28840DC17AD9A9, ADD UNIQUE INDEX UNIQ_6D28840DC17AD9A9 (payer_id)');
        $this->addSql('ALTER TABLE payment DROP INDEX IDX_6D28840DE92F8F78, ADD UNIQUE INDEX UNIQ_6D28840DE92F8F78 (recipient_id)');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D602AD315');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DB03A8386');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D896DBBDE');
        $this->addSql('DROP INDEX IDX_6D28840D602AD315 ON payment');
        $this->addSql('DROP INDEX IDX_6D28840DB03A8386 ON payment');
        $this->addSql('DROP INDEX IDX_6D28840D896DBBDE ON payment');
        $this->addSql('ALTER TABLE payment DROP responsible_id, DROP created_by_id, DROP updated_by_id, CHANGE type_id type_id INT NOT NULL');
        $this->addSql('ALTER TABLE reminders DROP FOREIGN KEY FK_6D92B9D4BBC61482');
        $this->addSql('DROP INDEX IDX_6D92B9D4BBC61482 ON reminders');
        $this->addSql('ALTER TABLE reminders DROP payments_id');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9E4EDA592');
        $this->addSql('DROP INDEX IDX_1483A5E9E4EDA592 ON users');
        $this->addSql('ALTER TABLE users ADD payment_created_id INT DEFAULT NULL, ADD payment_updated_id INT DEFAULT NULL, CHANGE payment_supervisor_id payment_responsible_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E96B169F91 FOREIGN KEY (payment_created_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E985026911 FOREIGN KEY (payment_responsible_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9A3FA4626 FOREIGN KEY (payment_updated_id) REFERENCES payment (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1483A5E96B169F91 ON users (payment_created_id)');
        $this->addSql('CREATE INDEX IDX_1483A5E985026911 ON users (payment_responsible_id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9A3FA4626 ON users (payment_updated_id)');
    }
}
