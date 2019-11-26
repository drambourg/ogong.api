<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126102813 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, format_id INT NOT NULL, status_id INT NOT NULL, company_id INT NOT NULL, title VARCHAR(255) NOT NULL, size INT NOT NULL, registration_url VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, end_message VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, start_date_time DATETIME NOT NULL, file_attachment VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_3BAE0AA7D629F605 (format_id), INDEX IDX_3BAE0AA76BF700BD (status_id), INDEX IDX_3BAE0AA7979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE table_participant (id INT AUTO_INCREMENT NOT NULL, event_round_table_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_E4C198AC6E0C2175 (event_round_table_id), INDEX IDX_E4C198AC9D1C3019 (participant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json_array)\', first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, telephone VARCHAR(255) NOT NULL, INDEX IDX_8D93D649979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_4FBF094F7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_round (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, round_number INT NOT NULL, INDEX IDX_84F55B1871F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_format (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, event_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, attended TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D79F6B1171F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_round_table (id INT AUTO_INCREMENT NOT NULL, event_round_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_8BD3483FE0ECB570 (event_round_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7D629F605 FOREIGN KEY (format_id) REFERENCES event_format (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA76BF700BD FOREIGN KEY (status_id) REFERENCES event_status (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE table_participant ADD CONSTRAINT FK_E4C198AC6E0C2175 FOREIGN KEY (event_round_table_id) REFERENCES event_round_table (id)');
        $this->addSql('ALTER TABLE table_participant ADD CONSTRAINT FK_E4C198AC9D1C3019 FOREIGN KEY (participant_id) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE event_round ADD CONSTRAINT FK_84F55B1871F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B1171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE event_round_table ADD CONSTRAINT FK_8BD3483FE0ECB570 FOREIGN KEY (event_round_id) REFERENCES event_round (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_round DROP FOREIGN KEY FK_84F55B1871F7E88B');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B1171F7E88B');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F7E3C61F9');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA76BF700BD');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7979B1AD6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('ALTER TABLE event_round_table DROP FOREIGN KEY FK_8BD3483FE0ECB570');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7D629F605');
        $this->addSql('ALTER TABLE table_participant DROP FOREIGN KEY FK_E4C198AC9D1C3019');
        $this->addSql('ALTER TABLE table_participant DROP FOREIGN KEY FK_E4C198AC6E0C2175');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE table_participant');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE event_status');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE event_round');
        $this->addSql('DROP TABLE event_format');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE event_round_table');
    }
}
