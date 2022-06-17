<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617072647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sclass (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE smarks (id INT AUTO_INCREMENT NOT NULL, sstudent_id_id INT NOT NULL, ssubject_id_id INT NOT NULL, mark VARCHAR(2) NOT NULL, INDEX IDX_C63CD382BFB24E11 (sstudent_id_id), INDEX IDX_C63CD3822616F654 (ssubject_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sstudent (id INT AUTO_INCREMENT NOT NULL, sclass_id_id INT DEFAULT NULL, fio VARCHAR(255) NOT NULL, INDEX IDX_6DB23957DA159BE6 (sclass_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ssubject (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ssubject_steacher (ssubject_id INT NOT NULL, steacher_id INT NOT NULL, INDEX IDX_40605FC6EDF331EF (ssubject_id), INDEX IDX_40605FC6AE4D9375 (steacher_id), PRIMARY KEY(ssubject_id, steacher_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE steacher (id INT AUTO_INCREMENT NOT NULL, fio VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE smarks ADD CONSTRAINT FK_C63CD382BFB24E11 FOREIGN KEY (sstudent_id_id) REFERENCES sstudent (id)');
        $this->addSql('ALTER TABLE smarks ADD CONSTRAINT FK_C63CD3822616F654 FOREIGN KEY (ssubject_id_id) REFERENCES ssubject (id)');
        $this->addSql('ALTER TABLE sstudent ADD CONSTRAINT FK_6DB23957DA159BE6 FOREIGN KEY (sclass_id_id) REFERENCES sclass (id)');
        $this->addSql('ALTER TABLE ssubject_steacher ADD CONSTRAINT FK_40605FC6EDF331EF FOREIGN KEY (ssubject_id) REFERENCES ssubject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ssubject_steacher ADD CONSTRAINT FK_40605FC6AE4D9375 FOREIGN KEY (steacher_id) REFERENCES steacher (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sstudent DROP FOREIGN KEY FK_6DB23957DA159BE6');
        $this->addSql('ALTER TABLE smarks DROP FOREIGN KEY FK_C63CD382BFB24E11');
        $this->addSql('ALTER TABLE smarks DROP FOREIGN KEY FK_C63CD3822616F654');
        $this->addSql('ALTER TABLE ssubject_steacher DROP FOREIGN KEY FK_40605FC6EDF331EF');
        $this->addSql('ALTER TABLE ssubject_steacher DROP FOREIGN KEY FK_40605FC6AE4D9375');
        $this->addSql('DROP TABLE sclass');
        $this->addSql('DROP TABLE smarks');
        $this->addSql('DROP TABLE sstudent');
        $this->addSql('DROP TABLE ssubject');
        $this->addSql('DROP TABLE ssubject_steacher');
        $this->addSql('DROP TABLE steacher');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
