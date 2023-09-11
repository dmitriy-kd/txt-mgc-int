<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230910125204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE test_result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE test_result (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE test_result_item (question_id INT NOT NULL, answer_id INT NOT NULL, test_result_id INT DEFAULT NULL, is_right_answer BOOLEAN NOT NULL, PRIMARY KEY(question_id, answer_id))');
        $this->addSql('CREATE INDEX IDX_D05E85EE1E27F6BF ON test_result_item (question_id)');
        $this->addSql('CREATE INDEX IDX_D05E85EEAA334807 ON test_result_item (answer_id)');
        $this->addSql('CREATE INDEX IDX_D05E85EE853A2189 ON test_result_item (test_result_id)');
        $this->addSql('ALTER TABLE test_result_item ADD CONSTRAINT FK_D05E85EE1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE test_result_item ADD CONSTRAINT FK_D05E85EEAA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE test_result_item ADD CONSTRAINT FK_D05E85EE853A2189 FOREIGN KEY (test_result_id) REFERENCES test_result (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE test_result_id_seq CASCADE');
        $this->addSql('ALTER TABLE test_result_item DROP CONSTRAINT FK_D05E85EE1E27F6BF');
        $this->addSql('ALTER TABLE test_result_item DROP CONSTRAINT FK_D05E85EEAA334807');
        $this->addSql('ALTER TABLE test_result_item DROP CONSTRAINT FK_D05E85EE853A2189');
        $this->addSql('DROP TABLE test_result');
        $this->addSql('DROP TABLE test_result_item');
    }
}
