<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181211141819 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE4050D10B');
        $this->addSql('DROP INDEX IDX_E00CEDDE4050D10B ON booking');
        $this->addSql('ALTER TABLE booking CHANGE booking_sate_id booking_state_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE3EECA24C FOREIGN KEY (booking_state_id) REFERENCES booking_state (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE3EECA24C ON booking (booking_state_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE3EECA24C');
        $this->addSql('DROP INDEX IDX_E00CEDDE3EECA24C ON booking');
        $this->addSql('ALTER TABLE booking CHANGE booking_state_id booking_sate_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE4050D10B FOREIGN KEY (booking_sate_id) REFERENCES booking_state (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE4050D10B ON booking (booking_sate_id)');
    }
}
