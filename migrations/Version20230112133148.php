<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112133148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eqp_ext (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eqp_ext_gite (eqp_ext_id INT NOT NULL, gite_id INT NOT NULL, INDEX IDX_552A6A15A6976614 (eqp_ext_id), INDEX IDX_552A6A15652CAE9B (gite_id), PRIMARY KEY(eqp_ext_id, gite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eqp_int (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eqp_int_gite (eqp_int_id INT NOT NULL, gite_id INT NOT NULL, INDEX IDX_68BD6AE3EF5C44D (eqp_int_id), INDEX IDX_68BD6AE652CAE9B (gite_id), PRIMARY KEY(eqp_int_id, gite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, contact_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zipcode VARCHAR(255) NOT NULL, departement VARCHAR(255) NOT NULL, region VARCHAR(255) NOT NULL, surface INT NOT NULL, rooms INT NOT NULL, beds INT NOT NULL, animal_allowed TINYINT(1) NOT NULL, animal_fee DOUBLE PRECISION DEFAULT NULL, green_price DOUBLE PRECISION NOT NULL, red_price DOUBLE PRECISION DEFAULT NULL, start_red DATE DEFAULT NULL, end_red DATE DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', update_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B638C92CA76ED395 (user_id), INDEX IDX_B638C92CE7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gite_service (id INT AUTO_INCREMENT NOT NULL, service_id INT DEFAULT NULL, gite_id INT DEFAULT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_1527AE9AED5CA9E6 (service_id), INDEX IDX_1527AE9A652CAE9B (gite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eqp_ext_gite ADD CONSTRAINT FK_552A6A15A6976614 FOREIGN KEY (eqp_ext_id) REFERENCES eqp_ext (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eqp_ext_gite ADD CONSTRAINT FK_552A6A15652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eqp_int_gite ADD CONSTRAINT FK_68BD6AE3EF5C44D FOREIGN KEY (eqp_int_id) REFERENCES eqp_int (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE eqp_int_gite ADD CONSTRAINT FK_68BD6AE652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE gite ADD CONSTRAINT FK_B638C92CE7A1254A FOREIGN KEY (contact_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9AED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE gite_service ADD CONSTRAINT FK_1527AE9A652CAE9B FOREIGN KEY (gite_id) REFERENCES gite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eqp_ext_gite DROP FOREIGN KEY FK_552A6A15A6976614');
        $this->addSql('ALTER TABLE eqp_ext_gite DROP FOREIGN KEY FK_552A6A15652CAE9B');
        $this->addSql('ALTER TABLE eqp_int_gite DROP FOREIGN KEY FK_68BD6AE3EF5C44D');
        $this->addSql('ALTER TABLE eqp_int_gite DROP FOREIGN KEY FK_68BD6AE652CAE9B');
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92CA76ED395');
        $this->addSql('ALTER TABLE gite DROP FOREIGN KEY FK_B638C92CE7A1254A');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9AED5CA9E6');
        $this->addSql('ALTER TABLE gite_service DROP FOREIGN KEY FK_1527AE9A652CAE9B');
        $this->addSql('DROP TABLE eqp_ext');
        $this->addSql('DROP TABLE eqp_ext_gite');
        $this->addSql('DROP TABLE eqp_int');
        $this->addSql('DROP TABLE eqp_int_gite');
        $this->addSql('DROP TABLE gite');
        $this->addSql('DROP TABLE gite_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
