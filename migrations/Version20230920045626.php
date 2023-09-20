<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920045626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense_report (id INT AUTO_INCREMENT NOT NULL, report_type_id INT NOT NULL, company_id INT NOT NULL, owner_id INT NOT NULL, report_date DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, registration_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_280A691A5D5F193 (report_type_id), INDEX IDX_280A691979B1AD6 (company_id), INDEX IDX_280A6917E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense_report_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expense_report ADD CONSTRAINT FK_280A691A5D5F193 FOREIGN KEY (report_type_id) REFERENCES expense_report_type (id)');
        $this->addSql('ALTER TABLE expense_report ADD CONSTRAINT FK_280A691979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE expense_report ADD CONSTRAINT FK_280A6917E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expense_report DROP FOREIGN KEY FK_280A691A5D5F193');
        $this->addSql('ALTER TABLE expense_report DROP FOREIGN KEY FK_280A691979B1AD6');
        $this->addSql('ALTER TABLE expense_report DROP FOREIGN KEY FK_280A6917E3C61F9');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE expense_report');
        $this->addSql('DROP TABLE expense_report_type');
        $this->addSql('DROP TABLE user');
    }
}
