<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170815133558 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gallery_image DROP FOREIGN KEY FK_21A0D47C4E7AF8F');
        $this->addSql('ALTER TABLE gallery_image ADD CONSTRAINT FK_21A0D47C4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gallery_image DROP FOREIGN KEY FK_21A0D47C4E7AF8F');
        $this->addSql('ALTER TABLE gallery_image ADD CONSTRAINT FK_21A0D47C4E7AF8F FOREIGN KEY (gallery_id) REFERENCES gallery (id)');
    }
}
