<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230617115719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE docente_curso_academico (docente_id INT NOT NULL, curso_academico_id INT NOT NULL, INDEX IDX_D3B5A4CA94E27525 (docente_id), INDEX IDX_D3B5A4CA7D35438E (curso_academico_id), PRIMARY KEY(docente_id, curso_academico_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE docente_curso_academico ADD CONSTRAINT FK_D3B5A4CA94E27525 FOREIGN KEY (docente_id) REFERENCES docente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE docente_curso_academico ADD CONSTRAINT FK_D3B5A4CA7D35438E FOREIGN KEY (curso_academico_id) REFERENCES curso_academico (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE curso_academico_docente DROP FOREIGN KEY FK_14DC7A5D7D35438E');
        $this->addSql('ALTER TABLE curso_academico_docente DROP FOREIGN KEY FK_14DC7A5D94E27525');
        $this->addSql('DROP TABLE curso_academico_docente');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE curso_academico_docente (curso_academico_id INT NOT NULL, docente_id INT NOT NULL, INDEX IDX_14DC7A5D94E27525 (docente_id), INDEX IDX_14DC7A5D7D35438E (curso_academico_id), PRIMARY KEY(curso_academico_id, docente_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE curso_academico_docente ADD CONSTRAINT FK_14DC7A5D7D35438E FOREIGN KEY (curso_academico_id) REFERENCES curso_academico (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE curso_academico_docente ADD CONSTRAINT FK_14DC7A5D94E27525 FOREIGN KEY (docente_id) REFERENCES docente (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE docente_curso_academico DROP FOREIGN KEY FK_D3B5A4CA94E27525');
        $this->addSql('ALTER TABLE docente_curso_academico DROP FOREIGN KEY FK_D3B5A4CA7D35438E');
        $this->addSql('DROP TABLE docente_curso_academico');
    }
}
