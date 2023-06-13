<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613091652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actitud_familia CHANGE orden orden INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categoria_conducta_contraria CHANGE orden orden INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categoria_medida CHANGE orden orden INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conducta_contraria CHANGE orden orden INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medida CHANGE orden orden INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tramo DROP aula, CHANGE orden orden INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actitud_familia CHANGE orden orden VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE categoria_conducta_contraria CHANGE orden orden VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE categoria_medida CHANGE orden orden VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE conducta_contraria CHANGE orden orden VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE medida CHANGE orden orden VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE tramo ADD aula VARCHAR(100) DEFAULT NULL, CHANGE orden orden VARCHAR(100) DEFAULT NULL');
    }
}
