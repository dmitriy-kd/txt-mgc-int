<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230911093653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE test_result_item_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE test_result_item DROP CONSTRAINT test_result_item_pkey');
        $this->addSql('ALTER TABLE test_result_item ADD id INT NOT NULL');
        $this->addSql('ALTER TABLE test_result_item ALTER question_id DROP NOT NULL');
        $this->addSql('ALTER TABLE test_result_item ALTER answer_id DROP NOT NULL');
        $this->addSql('ALTER TABLE test_result_item ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE test_result_item_id_seq CASCADE');
        $this->addSql('DROP INDEX test_result_item_pkey');
        $this->addSql('ALTER TABLE test_result_item DROP id');
        $this->addSql('ALTER TABLE test_result_item ALTER question_id SET NOT NULL');
        $this->addSql('ALTER TABLE test_result_item ALTER answer_id SET NOT NULL');
        $this->addSql('ALTER TABLE test_result_item ADD PRIMARY KEY (question_id, answer_id)');
    }
}
