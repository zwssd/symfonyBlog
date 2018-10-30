<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181030083612 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_7390ED899777D11E');
        $this->addSql('DROP INDEX IDX_7390ED89F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfonyBlog_post AS SELECT id, author_id, category_id_id, title, slug, summary, content, published_at FROM symfonyBlog_post');
        $this->addSql('DROP TABLE symfonyBlog_post');
        $this->addSql('CREATE TABLE symfonyBlog_post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, category_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, slug VARCHAR(255) NOT NULL COLLATE BINARY, summary VARCHAR(255) NOT NULL COLLATE BINARY, content CLOB NOT NULL COLLATE BINARY, published_at DATETIME NOT NULL, CONSTRAINT FK_7390ED89F675F31B FOREIGN KEY (author_id) REFERENCES symfonyBlog_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_7390ED8912469DE2 FOREIGN KEY (category_id) REFERENCES symfonyBlog_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO symfonyBlog_post (id, author_id, category_id, title, slug, summary, content, published_at) SELECT id, author_id, category_id_id, title, slug, summary, content, published_at FROM __temp__symfonyBlog_post');
        $this->addSql('DROP TABLE __temp__symfonyBlog_post');
        $this->addSql('CREATE INDEX IDX_7390ED89F675F31B ON symfonyBlog_post (author_id)');
        $this->addSql('CREATE INDEX IDX_7390ED8912469DE2 ON symfonyBlog_post (category_id)');
        $this->addSql('DROP INDEX IDX_C7C4BEA7BAD26311');
        $this->addSql('DROP INDEX IDX_C7C4BEA74B89032C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfonyBlog_post_tag AS SELECT post_id, tag_id FROM symfonyBlog_post_tag');
        $this->addSql('DROP TABLE symfonyBlog_post_tag');
        $this->addSql('CREATE TABLE symfonyBlog_post_tag (post_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(post_id, tag_id), CONSTRAINT FK_C7C4BEA74B89032C FOREIGN KEY (post_id) REFERENCES symfonyBlog_post (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C7C4BEA7BAD26311 FOREIGN KEY (tag_id) REFERENCES symfonyBlog_tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO symfonyBlog_post_tag (post_id, tag_id) SELECT post_id, tag_id FROM __temp__symfonyBlog_post_tag');
        $this->addSql('DROP TABLE __temp__symfonyBlog_post_tag');
        $this->addSql('CREATE INDEX IDX_C7C4BEA7BAD26311 ON symfonyBlog_post_tag (tag_id)');
        $this->addSql('CREATE INDEX IDX_C7C4BEA74B89032C ON symfonyBlog_post_tag (post_id)');
        $this->addSql('DROP INDEX IDX_4C87AAE9F675F31B');
        $this->addSql('DROP INDEX IDX_4C87AAE94B89032C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfonyBlog_comment AS SELECT id, post_id, author_id, content, published_at FROM symfonyBlog_comment');
        $this->addSql('DROP TABLE symfonyBlog_comment');
        $this->addSql('CREATE TABLE symfonyBlog_comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_id INTEGER NOT NULL, author_id INTEGER NOT NULL, content CLOB NOT NULL COLLATE BINARY, published_at DATETIME NOT NULL, CONSTRAINT FK_4C87AAE94B89032C FOREIGN KEY (post_id) REFERENCES symfonyBlog_post (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4C87AAE9F675F31B FOREIGN KEY (author_id) REFERENCES symfonyBlog_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO symfonyBlog_comment (id, post_id, author_id, content, published_at) SELECT id, post_id, author_id, content, published_at FROM __temp__symfonyBlog_comment');
        $this->addSql('DROP TABLE __temp__symfonyBlog_comment');
        $this->addSql('CREATE INDEX IDX_4C87AAE9F675F31B ON symfonyBlog_comment (author_id)');
        $this->addSql('CREATE INDEX IDX_4C87AAE94B89032C ON symfonyBlog_comment (post_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_4C87AAE94B89032C');
        $this->addSql('DROP INDEX IDX_4C87AAE9F675F31B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfonyBlog_comment AS SELECT id, post_id, author_id, content, published_at FROM symfonyBlog_comment');
        $this->addSql('DROP TABLE symfonyBlog_comment');
        $this->addSql('CREATE TABLE symfonyBlog_comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_id INTEGER NOT NULL, author_id INTEGER NOT NULL, content CLOB NOT NULL, published_at DATETIME NOT NULL)');
        $this->addSql('INSERT INTO symfonyBlog_comment (id, post_id, author_id, content, published_at) SELECT id, post_id, author_id, content, published_at FROM __temp__symfonyBlog_comment');
        $this->addSql('DROP TABLE __temp__symfonyBlog_comment');
        $this->addSql('CREATE INDEX IDX_4C87AAE94B89032C ON symfonyBlog_comment (post_id)');
        $this->addSql('CREATE INDEX IDX_4C87AAE9F675F31B ON symfonyBlog_comment (author_id)');
        $this->addSql('DROP INDEX IDX_7390ED89F675F31B');
        $this->addSql('DROP INDEX IDX_7390ED8912469DE2');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfonyBlog_post AS SELECT id, author_id, category_id, title, slug, summary, content, published_at FROM symfonyBlog_post');
        $this->addSql('DROP TABLE symfonyBlog_post');
        $this->addSql('CREATE TABLE symfonyBlog_post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, content CLOB NOT NULL, published_at DATETIME NOT NULL, category_id_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO symfonyBlog_post (id, author_id, category_id_id, title, slug, summary, content, published_at) SELECT id, author_id, category_id, title, slug, summary, content, published_at FROM __temp__symfonyBlog_post');
        $this->addSql('DROP TABLE __temp__symfonyBlog_post');
        $this->addSql('CREATE INDEX IDX_7390ED89F675F31B ON symfonyBlog_post (author_id)');
        $this->addSql('CREATE INDEX IDX_7390ED899777D11E ON symfonyBlog_post (category_id_id)');
        $this->addSql('DROP INDEX IDX_C7C4BEA74B89032C');
        $this->addSql('DROP INDEX IDX_C7C4BEA7BAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__symfonyBlog_post_tag AS SELECT post_id, tag_id FROM symfonyBlog_post_tag');
        $this->addSql('DROP TABLE symfonyBlog_post_tag');
        $this->addSql('CREATE TABLE symfonyBlog_post_tag (post_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(post_id, tag_id))');
        $this->addSql('INSERT INTO symfonyBlog_post_tag (post_id, tag_id) SELECT post_id, tag_id FROM __temp__symfonyBlog_post_tag');
        $this->addSql('DROP TABLE __temp__symfonyBlog_post_tag');
        $this->addSql('CREATE INDEX IDX_C7C4BEA74B89032C ON symfonyBlog_post_tag (post_id)');
        $this->addSql('CREATE INDEX IDX_C7C4BEA7BAD26311 ON symfonyBlog_post_tag (tag_id)');
    }
}
