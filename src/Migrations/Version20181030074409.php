<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181030074409 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE symfonyBlog_post (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER NOT NULL, category_id_id INTEGER NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, content CLOB NOT NULL, published_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_7390ED89F675F31B ON symfonyBlog_post (author_id)');
        $this->addSql('CREATE INDEX IDX_7390ED899777D11E ON symfonyBlog_post (category_id_id)');
        $this->addSql('CREATE TABLE symfonyBlog_post_tag (post_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(post_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_C7C4BEA74B89032C ON symfonyBlog_post_tag (post_id)');
        $this->addSql('CREATE INDEX IDX_C7C4BEA7BAD26311 ON symfonyBlog_post_tag (tag_id)');
        $this->addSql('CREATE TABLE symfonyBlog_comment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, post_id INTEGER NOT NULL, author_id INTEGER NOT NULL, content CLOB NOT NULL, published_at DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_4C87AAE94B89032C ON symfonyBlog_comment (post_id)');
        $this->addSql('CREATE INDEX IDX_4C87AAE9F675F31B ON symfonyBlog_comment (author_id)');
        $this->addSql('CREATE TABLE symfonyBlog_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A489574DF85E0677 ON symfonyBlog_user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A489574DE7927C74 ON symfonyBlog_user (email)');
        $this->addSql('CREATE TABLE symfonyBlog_tag (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0C12BFA5E237E06 ON symfonyBlog_tag (name)');
        $this->addSql('CREATE TABLE symfonyBlog_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cname VARCHAR(100) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE symfonyBlog_post');
        $this->addSql('DROP TABLE symfonyBlog_post_tag');
        $this->addSql('DROP TABLE symfonyBlog_comment');
        $this->addSql('DROP TABLE symfonyBlog_user');
        $this->addSql('DROP TABLE symfonyBlog_tag');
        $this->addSql('DROP TABLE symfonyBlog_category');
    }
}
