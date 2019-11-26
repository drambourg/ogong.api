<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126081657 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event ADD start_date_time DATETIME NOT NULL, DROP date, DROP start_time, DROP end_time, DROP speaking_time, DROP change_time, DROP break_start_time, DROP break_end_time, DROP participants_per_table, DROP number_of_tables, DROP number_of_rounds, DROP participants_registered, DROP participants_attended, CHANGE logo logo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE company_id company_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE company CHANGE owner_id owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE participant CHANGE photo photo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE company CHANGE owner_id owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD date DATE NOT NULL, ADD start_time TIME NOT NULL, ADD end_time TIME NOT NULL, ADD speaking_time INT NOT NULL, ADD change_time INT NOT NULL, ADD break_start_time TIME NOT NULL, ADD break_end_time TIME NOT NULL, ADD participants_per_table INT NOT NULL, ADD number_of_tables INT NOT NULL, ADD number_of_rounds INT NOT NULL, ADD participants_registered INT NOT NULL, ADD participants_attended INT NOT NULL, DROP start_date_time, CHANGE logo logo VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE participant CHANGE photo photo VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE company_id company_id INT DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
