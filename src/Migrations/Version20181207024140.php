<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181207024140 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking ADD swap_service_id INT NOT NULL, ADD user_id INT NOT NULL, ADD booking_sate_id INT NOT NULL, ADD booking_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE5DEFC0EA FOREIGN KEY (swap_service_id) REFERENCES swap_service (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE4050D10B FOREIGN KEY (booking_sate_id) REFERENCES booking_state (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9FF2C9B3 FOREIGN KEY (booking_type_id) REFERENCES booking_type (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE5DEFC0EA ON booking (swap_service_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDEA76ED395 ON booking (user_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE4050D10B ON booking (booking_sate_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE9FF2C9B3 ON booking (booking_type_id)');
        $this->addSql('ALTER TABLE booking_comment ADD booking_id INT NOT NULL, ADD user_sender_id INT NOT NULL, ADD user_receiver_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking_comment ADD CONSTRAINT FK_CECA174C3301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('ALTER TABLE booking_comment ADD CONSTRAINT FK_CECA174CF6C43E79 FOREIGN KEY (user_sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking_comment ADD CONSTRAINT FK_CECA174C64482423 FOREIGN KEY (user_receiver_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CECA174C3301C60 ON booking_comment (booking_id)');
        $this->addSql('CREATE INDEX IDX_CECA174CF6C43E79 ON booking_comment (user_sender_id)');
        $this->addSql('CREATE INDEX IDX_CECA174C64482423 ON booking_comment (user_receiver_id)');
        $this->addSql('ALTER TABLE message ADD user_sender_id INT NOT NULL, ADD user_receiver_id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF6C43E79 FOREIGN KEY (user_sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F64482423 FOREIGN KEY (user_receiver_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FF6C43E79 ON message (user_sender_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F64482423 ON message (user_receiver_id)');
        $this->addSql('ALTER TABLE transaction ADD user_sender_id INT NOT NULL, ADD user_receiver_id INT NOT NULL, ADD swap_service_id INT NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1F6C43E79 FOREIGN KEY (user_sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D164482423 FOREIGN KEY (user_receiver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D15DEFC0EA FOREIGN KEY (swap_service_id) REFERENCES swap_service (id)');
        $this->addSql('CREATE INDEX IDX_723705D1F6C43E79 ON transaction (user_sender_id)');
        $this->addSql('CREATE INDEX IDX_723705D164482423 ON transaction (user_receiver_id)');
        $this->addSql('CREATE INDEX IDX_723705D15DEFC0EA ON transaction (swap_service_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE5DEFC0EA');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEA76ED395');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE4050D10B');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9FF2C9B3');
        $this->addSql('DROP INDEX IDX_E00CEDDE5DEFC0EA ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDEA76ED395 ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE4050D10B ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE9FF2C9B3 ON booking');
        $this->addSql('ALTER TABLE booking DROP swap_service_id, DROP user_id, DROP booking_sate_id, DROP booking_type_id');
        $this->addSql('ALTER TABLE booking_comment DROP FOREIGN KEY FK_CECA174C3301C60');
        $this->addSql('ALTER TABLE booking_comment DROP FOREIGN KEY FK_CECA174CF6C43E79');
        $this->addSql('ALTER TABLE booking_comment DROP FOREIGN KEY FK_CECA174C64482423');
        $this->addSql('DROP INDEX IDX_CECA174C3301C60 ON booking_comment');
        $this->addSql('DROP INDEX IDX_CECA174CF6C43E79 ON booking_comment');
        $this->addSql('DROP INDEX IDX_CECA174C64482423 ON booking_comment');
        $this->addSql('ALTER TABLE booking_comment DROP booking_id, DROP user_sender_id, DROP user_receiver_id');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF6C43E79');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F64482423');
        $this->addSql('DROP INDEX IDX_B6BD307FF6C43E79 ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F64482423 ON message');
        $this->addSql('ALTER TABLE message DROP user_sender_id, DROP user_receiver_id');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1F6C43E79');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D164482423');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D15DEFC0EA');
        $this->addSql('DROP INDEX IDX_723705D1F6C43E79 ON transaction');
        $this->addSql('DROP INDEX IDX_723705D164482423 ON transaction');
        $this->addSql('DROP INDEX IDX_723705D15DEFC0EA ON transaction');
        $this->addSql('ALTER TABLE transaction DROP user_sender_id, DROP user_receiver_id, DROP swap_service_id');
    }
}
