<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231126164849 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media ADD article_video_id INT DEFAULT NULL, ADD article_content_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C7C29F425 FOREIGN KEY (article_video_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C7846B4F1 FOREIGN KEY (article_content_image_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C7C29F425 ON media (article_video_id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C7846B4F1 ON media (article_content_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C7C29F425');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C7846B4F1');
        $this->addSql('DROP INDEX IDX_6A2CA10C7C29F425 ON media');
        $this->addSql('DROP INDEX IDX_6A2CA10C7846B4F1 ON media');
        $this->addSql('ALTER TABLE media DROP article_video_id, DROP article_content_image_id');
    }
}
