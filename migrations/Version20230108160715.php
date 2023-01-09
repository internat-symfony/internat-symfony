<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230108160715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cars_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE company_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE heloo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE testing_table_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cars (id INT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE company (id INT NOT NULL, company_name VARCHAR(255) NOT NULL, company_origin VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE company_cars (company_id INT NOT NULL, cars_id INT NOT NULL, PRIMARY KEY(company_id, cars_id))');
        $this->addSql('CREATE INDEX IDX_D6AA07FA979B1AD6 ON company_cars (company_id)');
        $this->addSql('CREATE INDEX IDX_D6AA07FA8702F506 ON company_cars (cars_id)');
        $this->addSql('CREATE TABLE heloo (id INT NOT NULL, hellothere VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE testing_table (id INT NOT NULL, random_column VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE company_cars ADD CONSTRAINT FK_D6AA07FA979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE company_cars ADD CONSTRAINT FK_D6AA07FA8702F506 FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cars_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE company_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE heloo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE testing_table_id_seq CASCADE');
        $this->addSql('ALTER TABLE company_cars DROP CONSTRAINT FK_D6AA07FA979B1AD6');
        $this->addSql('ALTER TABLE company_cars DROP CONSTRAINT FK_D6AA07FA8702F506');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_cars');
        $this->addSql('DROP TABLE heloo');
        $this->addSql('DROP TABLE testing_table');
    }
}
