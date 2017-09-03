<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170903080621 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles_products DROP INDEX UNIQ_122EAC404584665A, ADD INDEX IDX_122EAC404584665A (product_id)');
        $this->addSql('ALTER TABLE articles_products DROP INDEX IDX_122EAC407294869C, ADD UNIQUE INDEX UNIQ_122EAC407294869C (article_id)');
        $this->addSql('ALTER TABLE articles_galleries DROP INDEX UNIQ_ACD033B4E7AF8F, ADD INDEX IDX_ACD033B4E7AF8F (gallery_id)');
        $this->addSql('ALTER TABLE articles_galleries DROP INDEX IDX_ACD033B7294869C, ADD UNIQUE INDEX UNIQ_ACD033B7294869C (article_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE articles_galleries DROP INDEX UNIQ_ACD033B7294869C, ADD INDEX IDX_ACD033B7294869C (article_id)');
        $this->addSql('ALTER TABLE articles_galleries DROP INDEX IDX_ACD033B4E7AF8F, ADD UNIQUE INDEX UNIQ_ACD033B4E7AF8F (gallery_id)');
        $this->addSql('ALTER TABLE articles_products DROP INDEX UNIQ_122EAC407294869C, ADD INDEX IDX_122EAC407294869C (article_id)');
        $this->addSql('ALTER TABLE articles_products DROP INDEX IDX_122EAC404584665A, ADD UNIQUE INDEX UNIQ_122EAC404584665A (product_id)');
    }
}
