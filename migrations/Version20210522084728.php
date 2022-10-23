<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210522084728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_type (user_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_F65F1BE0A76ED395 (user_id), INDEX IDX_F65F1BE0C54C8C93 (type_id), PRIMARY KEY(user_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_relation (user_id INT NOT NULL, relation_id INT NOT NULL, INDEX IDX_8204A349A76ED395 (user_id), INDEX IDX_8204A3493256915B (relation_id), PRIMARY KEY(user_id, relation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_type ADD CONSTRAINT FK_F65F1BE0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_type ADD CONSTRAINT FK_F65F1BE0C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_relation ADD CONSTRAINT FK_8204A349A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_relation ADD CONSTRAINT FK_8204A3493256915B FOREIGN KEY (relation_id) REFERENCES relation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_type');
        $this->addSql('DROP TABLE user_relation');
    }
}
