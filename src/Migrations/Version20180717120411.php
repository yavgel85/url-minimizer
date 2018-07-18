<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180717120411 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE statistics CHANGE client_ip client_ip VARCHAR(15) NOT NULL');
        $this->addSql('ALTER TABLE links CHANGE short_code short_code VARCHAR(25) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE links CHANGE short_code short_code VARCHAR(25) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE statistics CHANGE client_ip client_ip VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
