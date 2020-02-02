<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200202112912 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_answer DROP FOREIGN KEY FK_BF8F5118A76ED395');
        $this->addSql('ALTER TABLE user_answer DROP FOREIGN KEY FK_BF8F5118AA334807');
        $this->addSql('DROP INDEX UNIQ_BF8F5118AA334807 ON user_answer');
        $this->addSql('DROP INDEX IDX_BF8F5118A76ED395 ON user_answer');
        $this->addSql('ALTER TABLE user_answer DROP user_id, DROP answer_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_answer ADD user_id INT NOT NULL, ADD answer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F5118A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F5118AA334807 FOREIGN KEY (answer_id) REFERENCES answer_item (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BF8F5118AA334807 ON user_answer (answer_id)');
        $this->addSql('CREATE INDEX IDX_BF8F5118A76ED395 ON user_answer (user_id)');
    }
}
