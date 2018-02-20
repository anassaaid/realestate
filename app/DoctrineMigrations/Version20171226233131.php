<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171226233131 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->write('<info>Clean up books without author ...</info>');

        $booksIds = $this->connection->fetchAll('SELECT id FROM book WHERE book.author_id IS NULL ');

        foreach ($booksIds as $bookId) {
            $this->addSql('DELETE FROM book WHERE id = :id', $bookId);
        }

        $this->addSql('ALTER TABLE book ADD created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, CHANGE author_id author_id INT NOT NULL, CHANGE publishedat published_at DATE NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE book DROP created_at, CHANGE author_id author_id INT DEFAULT NULL, CHANGE published_at publishedAt DATE NOT NULL');
    }
}
