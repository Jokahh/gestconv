<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230605081832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conducta_contraria (id INT AUTO_INCREMENT NOT NULL, parte_id INT NOT NULL, categoria_id INT NOT NULL, orden VARCHAR(100) DEFAULT NULL, INDEX IDX_D324C9C83BF3F87E (parte_id), INDEX IDX_D324C9C83397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conducta_contraria ADD CONSTRAINT FK_D324C9C83BF3F87E FOREIGN KEY (parte_id) REFERENCES parte (id)');
        $this->addSql('ALTER TABLE conducta_contraria ADD CONSTRAINT FK_D324C9C83397707A FOREIGN KEY (categoria_id) REFERENCES categoria_conducta_contraria (id)');
        $this->addSql('ALTER TABLE conductas_contrarias DROP FOREIGN KEY FK_8206231E3397707A');
        $this->addSql('ALTER TABLE conductas_contrarias DROP FOREIGN KEY FK_8206231E3BF3F87E');
        $this->addSql('DROP TABLE conductas_contrarias');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3B3F3FAD34EF7A01 ON estudiante (nie)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conductas_contrarias (id INT AUTO_INCREMENT NOT NULL, parte_id INT NOT NULL, categoria_id INT NOT NULL, orden VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_8206231E3BF3F87E (parte_id), INDEX IDX_8206231E3397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE conductas_contrarias ADD CONSTRAINT FK_8206231E3397707A FOREIGN KEY (categoria_id) REFERENCES categoria_conducta_contraria (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE conductas_contrarias ADD CONSTRAINT FK_8206231E3BF3F87E FOREIGN KEY (parte_id) REFERENCES parte (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE conducta_contraria DROP FOREIGN KEY FK_D324C9C83BF3F87E');
        $this->addSql('ALTER TABLE conducta_contraria DROP FOREIGN KEY FK_D324C9C83397707A');
        $this->addSql('DROP TABLE conducta_contraria');
        $this->addSql('DROP INDEX UNIQ_3B3F3FAD34EF7A01 ON estudiante');
    }
}
