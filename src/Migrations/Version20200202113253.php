<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200202113253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_answer_answer_item (user_answer_id INT NOT NULL, answer_item_id INT NOT NULL, INDEX IDX_2C7AB006AAD3C5E3 (user_answer_id), INDEX IDX_2C7AB0065A2F9D2F (answer_item_id), PRIMARY KEY(user_answer_id, answer_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_answer_answer_item ADD CONSTRAINT FK_2C7AB006AAD3C5E3 FOREIGN KEY (user_answer_id) REFERENCES user_answer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_answer_answer_item ADD CONSTRAINT FK_2C7AB0065A2F9D2F FOREIGN KEY (answer_item_id) REFERENCES answer_item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_answer ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_answer ADD CONSTRAINT FK_BF8F5118A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BF8F5118A76ED395 ON user_answer (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_answer_answer_item');
        $this->addSql('ALTER TABLE user_answer DROP FOREIGN KEY FK_BF8F5118A76ED395');
        $this->addSql('DROP INDEX IDX_BF8F5118A76ED395 ON user_answer');
        $this->addSql('ALTER TABLE user_answer DROP user_id');
    }
}
