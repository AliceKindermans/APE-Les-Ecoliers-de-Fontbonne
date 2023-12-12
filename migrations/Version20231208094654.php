<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231208094654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE association (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, siret VARCHAR(50) NOT NULL, adress VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE child (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, grade VARCHAR(50) NOT NULL, mistress VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE child_user (child_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_38A275BBDD62C21B (child_id), INDEX IDX_38A275BBA76ED395 (user_id), PRIMARY KEY(child_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, relation_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C53D045F3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_association (image_id INT NOT NULL, association_id INT NOT NULL, INDEX IDX_32536A423DA5256D (image_id), INDEX IDX_32536A42EFB9C8A5 (association_id), PRIMARY KEY(image_id, association_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_event (image_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_2CEB8E0E3DA5256D (image_id), INDEX IDX_2CEB8E0E71F7E88B (event_id), PRIMARY KEY(image_id, event_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, status VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', rgpd TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE verbatim (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE child_user ADD CONSTRAINT FK_38A275BBDD62C21B FOREIGN KEY (child_id) REFERENCES child (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE child_user ADD CONSTRAINT FK_38A275BBA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F3256915B FOREIGN KEY (relation_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE image_association ADD CONSTRAINT FK_32536A423DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_association ADD CONSTRAINT FK_32536A42EFB9C8A5 FOREIGN KEY (association_id) REFERENCES association (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_event ADD CONSTRAINT FK_2CEB8E0E3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_event ADD CONSTRAINT FK_2CEB8E0E71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE child_user DROP FOREIGN KEY FK_38A275BBDD62C21B');
        $this->addSql('ALTER TABLE child_user DROP FOREIGN KEY FK_38A275BBA76ED395');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F3256915B');
        $this->addSql('ALTER TABLE image_association DROP FOREIGN KEY FK_32536A423DA5256D');
        $this->addSql('ALTER TABLE image_association DROP FOREIGN KEY FK_32536A42EFB9C8A5');
        $this->addSql('ALTER TABLE image_event DROP FOREIGN KEY FK_2CEB8E0E3DA5256D');
        $this->addSql('ALTER TABLE image_event DROP FOREIGN KEY FK_2CEB8E0E71F7E88B');
        $this->addSql('DROP TABLE association');
        $this->addSql('DROP TABLE child');
        $this->addSql('DROP TABLE child_user');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE image_association');
        $this->addSql('DROP TABLE image_event');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE verbatim');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
