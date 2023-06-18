<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230618130159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parte_conducta_contraria (parte_id INT NOT NULL, conducta_contraria_id INT NOT NULL, INDEX IDX_CADA657E3BF3F87E (parte_id), INDEX IDX_CADA657EDFC68ACD (conducta_contraria_id), PRIMARY KEY(parte_id, conducta_contraria_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE parte_conducta_contraria ADD CONSTRAINT FK_CADA657E3BF3F87E FOREIGN KEY (parte_id) REFERENCES parte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE parte_conducta_contraria ADD CONSTRAINT FK_CADA657EDFC68ACD FOREIGN KEY (conducta_contraria_id) REFERENCES conducta_contraria (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parte_conducta_contraria DROP FOREIGN KEY FK_CADA657E3BF3F87E');
        $this->addSql('ALTER TABLE parte_conducta_contraria DROP FOREIGN KEY FK_CADA657EDFC68ACD');
        $this->addSql('DROP TABLE parte_conducta_contraria');
    }
}
