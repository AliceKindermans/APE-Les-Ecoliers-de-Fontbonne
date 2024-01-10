<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110123305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_user (image_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7FA93CD73DA5256D (image_id), INDEX IDX_7FA93CD7A76ED395 (user_id), PRIMARY KEY(image_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_user ADD CONSTRAINT FK_7FA93CD73DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_user ADD CONSTRAINT FK_7FA93CD7A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F3256915B');
        $this->addSql('DROP INDEX UNIQ_C53D045F3256915B ON image');
        $this->addSql('ALTER TABLE image CHANGE relation_id pub_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F83FDE077 FOREIGN KEY (pub_id) REFERENCES pub (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F83FDE077 ON image (pub_id)');
        $this->addSql('ALTER TABLE pub DROP FOREIGN KEY FK_5A443C853DA5256D');
        $this->addSql('DROP INDEX IDX_5A443C853DA5256D ON pub');
        $this->addSql('ALTER TABLE pub DROP image_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_user DROP FOREIGN KEY FK_7FA93CD73DA5256D');
        $this->addSql('ALTER TABLE image_user DROP FOREIGN KEY FK_7FA93CD7A76ED395');
        $this->addSql('DROP TABLE image_user');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F83FDE077');
        $this->addSql('DROP INDEX IDX_C53D045F83FDE077 ON image');
        $this->addSql('ALTER TABLE image CHANGE pub_id relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F3256915B FOREIGN KEY (relation_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C53D045F3256915B ON image (relation_id)');
        $this->addSql('ALTER TABLE pub ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pub ADD CONSTRAINT FK_5A443C853DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_5A443C853DA5256D ON pub (image_id)');
    }
}
