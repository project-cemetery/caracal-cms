<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180801132421 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ad (id VARCHAR(32) NOT NULL, name VARCHAR(255) DEFAULT NULL, body LONGTEXT DEFAULT NULL, images JSON NOT NULL COMMENT \'(DC2Type:json_array)\', expire_at DATETIME DEFAULT NULL, published TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallery (id VARCHAR(32) NOT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id VARCHAR(32) NOT NULL, gallery_id VARCHAR(32) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, link VARCHAR(511) NOT NULL, INDEX IDX_14B784184E7AF8F (gallery_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE library (id VARCHAR(32) NOT NULL, parent_id VARCHAR(32) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_A18098BC727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id VARCHAR(32) NOT NULL, library_id VARCHAR(32) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, body LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_23A0E66FE2541D7 (library_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784184E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
        $this->addSql('ALTER TABLE library ADD CONSTRAINT FK_A18098BC727ACA70 FOREIGN KEY (parent_id) REFERENCES library (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FE2541D7 FOREIGN KEY (library_id) REFERENCES library (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784184E7AF8F');
        $this->addSql('ALTER TABLE library DROP FOREIGN KEY FK_A18098BC727ACA70');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FE2541D7');
        $this->addSql('DROP TABLE ad');
        $this->addSql('DROP TABLE gallery');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE library');
        $this->addSql('DROP TABLE article');
    }
}
