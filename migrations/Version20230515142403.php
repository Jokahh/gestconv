<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230515142403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actitud_familia (id INT AUTO_INCREMENT NOT NULL, curso_academico_id INT NOT NULL, orden VARCHAR(100) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, fecha DATETIME DEFAULT NULL, INDEX IDX_30B34CB7D35438E (curso_academico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria_conducta_contraria (id INT AUTO_INCREMENT NOT NULL, curso_academico_id INT NOT NULL, orden VARCHAR(100) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, prioritaria TINYINT(1) DEFAULT NULL, INDEX IDX_5097C69A7D35438E (curso_academico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria_medida (id INT AUTO_INCREMENT NOT NULL, orden VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comunicacion_parte (id INT AUTO_INCREMENT NOT NULL, tipo_id INT DEFAULT NULL, parte_id INT NOT NULL, fecha DATETIME DEFAULT NULL, anotacion VARCHAR(255) DEFAULT NULL, INDEX IDX_646BBAF1A9276E6C (tipo_id), INDEX IDX_646BBAF13BF3F87E (parte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comunicacion_sancion (id INT AUTO_INCREMENT NOT NULL, tipo_id INT DEFAULT NULL, sancion_id INT NOT NULL, fecha DATETIME DEFAULT NULL, anotacion VARCHAR(255) DEFAULT NULL, INDEX IDX_7F893191A9276E6C (tipo_id), INDEX IDX_7F893191BCB305E7 (sancion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conductas_contrarias (id INT AUTO_INCREMENT NOT NULL, parte_id INT NOT NULL, categoria_id INT NOT NULL, orden VARCHAR(100) DEFAULT NULL, INDEX IDX_8206231E3BF3F87E (parte_id), INDEX IDX_8206231E3397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE curso_academico (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, fecha_inicio DATE DEFAULT NULL, fecha_fin DATE DEFAULT NULL, estado TINYINT(1) DEFAULT NULL, semestre VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE docente (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, apellido1 VARCHAR(100) NOT NULL, apellido2 VARCHAR(100) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, telefono VARCHAR(15) DEFAULT NULL, notificaciones TINYINT(1) DEFAULT NULL, es_admin TINYINT(1) DEFAULT NULL, esta_activo TINYINT(1) DEFAULT NULL, esta_bloqueado TINYINT(1) DEFAULT NULL, es_externo TINYINT(1) DEFAULT NULL, es_directivo TINYINT(1) DEFAULT NULL, es_convivencia TINYINT(1) DEFAULT NULL, usuario VARCHAR(100) DEFAULT NULL, password VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estudiante (id INT AUTO_INCREMENT NOT NULL, nie VARCHAR(8) NOT NULL, nombre VARCHAR(100) NOT NULL, apellido1 VARCHAR(100) NOT NULL, apellido2 VARCHAR(100) DEFAULT NULL, telefono1 VARCHAR(15) DEFAULT NULL, telefono2 VARCHAR(15) DEFAULT NULL, nota_telefono1 VARCHAR(255) DEFAULT NULL, nota_telefono2 VARCHAR(255) DEFAULT NULL, tutor1 VARCHAR(100) DEFAULT NULL, tutor2 VARCHAR(100) DEFAULT NULL, fecha_nacimiento DATE DEFAULT NULL, direccion VARCHAR(100) DEFAULT NULL, observaciones VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupo (id INT AUTO_INCREMENT NOT NULL, curso_academico_id INT NOT NULL, nombre VARCHAR(100) DEFAULT NULL, descripcion VARCHAR(255) DEFAULT NULL, INDEX IDX_8C0E9BD37D35438E (curso_academico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupo_docente (grupo_id INT NOT NULL, docente_id INT NOT NULL, INDEX IDX_A29641039C833003 (grupo_id), INDEX IDX_A296410394E27525 (docente_id), PRIMARY KEY(grupo_id, docente_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grupo_estudiante (grupo_id INT NOT NULL, estudiante_id INT NOT NULL, INDEX IDX_3BD479769C833003 (grupo_id), INDEX IDX_3BD4797659590C39 (estudiante_id), PRIMARY KEY(grupo_id, estudiante_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medida (id INT AUTO_INCREMENT NOT NULL, categoria_id INT NOT NULL, dias INT DEFAULT NULL, nombre VARCHAR(100) DEFAULT NULL, orden VARCHAR(100) DEFAULT NULL, INDEX IDX_9C1C2A8C3397707A (categoria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE observacion_parte (id INT AUTO_INCREMENT NOT NULL, parte_id INT NOT NULL, fecha DATETIME DEFAULT NULL, anotacion VARCHAR(255) DEFAULT NULL, INDEX IDX_E38F9A833BF3F87E (parte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE observacion_sancion (id INT AUTO_INCREMENT NOT NULL, sancion_id INT NOT NULL, fecha DATETIME DEFAULT NULL, anotacion VARCHAR(255) DEFAULT NULL, INDEX IDX_59EE8DC9BCB305E7 (sancion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parte (id INT AUTO_INCREMENT NOT NULL, docente_id INT NOT NULL, tramo_id INT NOT NULL, estudiante_id INT NOT NULL, sancion_id INT DEFAULT NULL, fecha_creacion DATETIME DEFAULT NULL, fecha_suceso DATETIME DEFAULT NULL, fecha_aviso DATETIME DEFAULT NULL, fecha_recordatorio DATETIME DEFAULT NULL, anotacion VARCHAR(255) NOT NULL, prescrito TINYINT(1) NOT NULL, hay_expulsion TINYINT(1) NOT NULL, actividades_realizadas TINYINT(1) DEFAULT NULL, prioritaria TINYINT(1) DEFAULT NULL, INDEX IDX_9D9412AF94E27525 (docente_id), INDEX IDX_9D9412AF6E801575 (tramo_id), INDEX IDX_9D9412AF59590C39 (estudiante_id), INDEX IDX_9D9412AFBCB305E7 (sancion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sancion (id INT AUTO_INCREMENT NOT NULL, actitud_familia_id INT NOT NULL, fecha_sancion DATETIME DEFAULT NULL, fecha_registro_salida DATETIME DEFAULT NULL, fecha_comunicado DATETIME DEFAULT NULL, fecha_inicio_sancion DATETIME DEFAULT NULL, fecha_fin_sancion DATETIME DEFAULT NULL, anotacion VARCHAR(255) DEFAULT NULL, reclamacion TINYINT(1) DEFAULT NULL, registrado_en_seneca TINYINT(1) DEFAULT NULL, medidas_efectivas TINYINT(1) DEFAULT NULL, motivos_no_aplicacion VARCHAR(255) DEFAULT NULL, INDEX IDX_83BC936ED74396ED (actitud_familia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sancion_medida (sancion_id INT NOT NULL, medida_id INT NOT NULL, INDEX IDX_F8F629ABCB305E7 (sancion_id), INDEX IDX_F8F629AF504B72F (medida_id), PRIMARY KEY(sancion_id, medida_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_comunicacion (id INT AUTO_INCREMENT NOT NULL, curso_academico_id INT NOT NULL, descripcion VARCHAR(100) DEFAULT NULL, INDEX IDX_1DCC46F07D35438E (curso_academico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tramo (id INT AUTO_INCREMENT NOT NULL, curso_academico_id INT NOT NULL, orden VARCHAR(100) DEFAULT NULL, dia_semana VARCHAR(100) DEFAULT NULL, hora_inicio DATETIME DEFAULT NULL, hora_fin DATETIME DEFAULT NULL, aula VARCHAR(100) DEFAULT NULL, INDEX IDX_4F0D11317D35438E (curso_academico_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE actitud_familia ADD CONSTRAINT FK_30B34CB7D35438E FOREIGN KEY (curso_academico_id) REFERENCES curso_academico (id)');
        $this->addSql('ALTER TABLE categoria_conducta_contraria ADD CONSTRAINT FK_5097C69A7D35438E FOREIGN KEY (curso_academico_id) REFERENCES curso_academico (id)');
        $this->addSql('ALTER TABLE comunicacion_parte ADD CONSTRAINT FK_646BBAF1A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo_comunicacion (id)');
        $this->addSql('ALTER TABLE comunicacion_parte ADD CONSTRAINT FK_646BBAF13BF3F87E FOREIGN KEY (parte_id) REFERENCES parte (id)');
        $this->addSql('ALTER TABLE comunicacion_sancion ADD CONSTRAINT FK_7F893191A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo_comunicacion (id)');
        $this->addSql('ALTER TABLE comunicacion_sancion ADD CONSTRAINT FK_7F893191BCB305E7 FOREIGN KEY (sancion_id) REFERENCES sancion (id)');
        $this->addSql('ALTER TABLE conductas_contrarias ADD CONSTRAINT FK_8206231E3BF3F87E FOREIGN KEY (parte_id) REFERENCES parte (id)');
        $this->addSql('ALTER TABLE conductas_contrarias ADD CONSTRAINT FK_8206231E3397707A FOREIGN KEY (categoria_id) REFERENCES categoria_conducta_contraria (id)');
        $this->addSql('ALTER TABLE grupo ADD CONSTRAINT FK_8C0E9BD37D35438E FOREIGN KEY (curso_academico_id) REFERENCES curso_academico (id)');
        $this->addSql('ALTER TABLE grupo_docente ADD CONSTRAINT FK_A29641039C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grupo_docente ADD CONSTRAINT FK_A296410394E27525 FOREIGN KEY (docente_id) REFERENCES docente (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grupo_estudiante ADD CONSTRAINT FK_3BD479769C833003 FOREIGN KEY (grupo_id) REFERENCES grupo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grupo_estudiante ADD CONSTRAINT FK_3BD4797659590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medida ADD CONSTRAINT FK_9C1C2A8C3397707A FOREIGN KEY (categoria_id) REFERENCES categoria_medida (id)');
        $this->addSql('ALTER TABLE observacion_parte ADD CONSTRAINT FK_E38F9A833BF3F87E FOREIGN KEY (parte_id) REFERENCES parte (id)');
        $this->addSql('ALTER TABLE observacion_sancion ADD CONSTRAINT FK_59EE8DC9BCB305E7 FOREIGN KEY (sancion_id) REFERENCES sancion (id)');
        $this->addSql('ALTER TABLE parte ADD CONSTRAINT FK_9D9412AF94E27525 FOREIGN KEY (docente_id) REFERENCES docente (id)');
        $this->addSql('ALTER TABLE parte ADD CONSTRAINT FK_9D9412AF6E801575 FOREIGN KEY (tramo_id) REFERENCES tramo (id)');
        $this->addSql('ALTER TABLE parte ADD CONSTRAINT FK_9D9412AF59590C39 FOREIGN KEY (estudiante_id) REFERENCES estudiante (id)');
        $this->addSql('ALTER TABLE parte ADD CONSTRAINT FK_9D9412AFBCB305E7 FOREIGN KEY (sancion_id) REFERENCES sancion (id)');
        $this->addSql('ALTER TABLE sancion ADD CONSTRAINT FK_83BC936ED74396ED FOREIGN KEY (actitud_familia_id) REFERENCES actitud_familia (id)');
        $this->addSql('ALTER TABLE sancion_medida ADD CONSTRAINT FK_F8F629ABCB305E7 FOREIGN KEY (sancion_id) REFERENCES sancion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sancion_medida ADD CONSTRAINT FK_F8F629AF504B72F FOREIGN KEY (medida_id) REFERENCES medida (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tipo_comunicacion ADD CONSTRAINT FK_1DCC46F07D35438E FOREIGN KEY (curso_academico_id) REFERENCES curso_academico (id)');
        $this->addSql('ALTER TABLE tramo ADD CONSTRAINT FK_4F0D11317D35438E FOREIGN KEY (curso_academico_id) REFERENCES curso_academico (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actitud_familia DROP FOREIGN KEY FK_30B34CB7D35438E');
        $this->addSql('ALTER TABLE categoria_conducta_contraria DROP FOREIGN KEY FK_5097C69A7D35438E');
        $this->addSql('ALTER TABLE comunicacion_parte DROP FOREIGN KEY FK_646BBAF1A9276E6C');
        $this->addSql('ALTER TABLE comunicacion_parte DROP FOREIGN KEY FK_646BBAF13BF3F87E');
        $this->addSql('ALTER TABLE comunicacion_sancion DROP FOREIGN KEY FK_7F893191A9276E6C');
        $this->addSql('ALTER TABLE comunicacion_sancion DROP FOREIGN KEY FK_7F893191BCB305E7');
        $this->addSql('ALTER TABLE conductas_contrarias DROP FOREIGN KEY FK_8206231E3BF3F87E');
        $this->addSql('ALTER TABLE conductas_contrarias DROP FOREIGN KEY FK_8206231E3397707A');
        $this->addSql('ALTER TABLE grupo DROP FOREIGN KEY FK_8C0E9BD37D35438E');
        $this->addSql('ALTER TABLE grupo_docente DROP FOREIGN KEY FK_A29641039C833003');
        $this->addSql('ALTER TABLE grupo_docente DROP FOREIGN KEY FK_A296410394E27525');
        $this->addSql('ALTER TABLE grupo_estudiante DROP FOREIGN KEY FK_3BD479769C833003');
        $this->addSql('ALTER TABLE grupo_estudiante DROP FOREIGN KEY FK_3BD4797659590C39');
        $this->addSql('ALTER TABLE medida DROP FOREIGN KEY FK_9C1C2A8C3397707A');
        $this->addSql('ALTER TABLE observacion_parte DROP FOREIGN KEY FK_E38F9A833BF3F87E');
        $this->addSql('ALTER TABLE observacion_sancion DROP FOREIGN KEY FK_59EE8DC9BCB305E7');
        $this->addSql('ALTER TABLE parte DROP FOREIGN KEY FK_9D9412AF94E27525');
        $this->addSql('ALTER TABLE parte DROP FOREIGN KEY FK_9D9412AF6E801575');
        $this->addSql('ALTER TABLE parte DROP FOREIGN KEY FK_9D9412AF59590C39');
        $this->addSql('ALTER TABLE parte DROP FOREIGN KEY FK_9D9412AFBCB305E7');
        $this->addSql('ALTER TABLE sancion DROP FOREIGN KEY FK_83BC936ED74396ED');
        $this->addSql('ALTER TABLE sancion_medida DROP FOREIGN KEY FK_F8F629ABCB305E7');
        $this->addSql('ALTER TABLE sancion_medida DROP FOREIGN KEY FK_F8F629AF504B72F');
        $this->addSql('ALTER TABLE tipo_comunicacion DROP FOREIGN KEY FK_1DCC46F07D35438E');
        $this->addSql('ALTER TABLE tramo DROP FOREIGN KEY FK_4F0D11317D35438E');
        $this->addSql('DROP TABLE actitud_familia');
        $this->addSql('DROP TABLE categoria_conducta_contraria');
        $this->addSql('DROP TABLE categoria_medida');
        $this->addSql('DROP TABLE comunicacion_parte');
        $this->addSql('DROP TABLE comunicacion_sancion');
        $this->addSql('DROP TABLE conductas_contrarias');
        $this->addSql('DROP TABLE curso_academico');
        $this->addSql('DROP TABLE docente');
        $this->addSql('DROP TABLE estudiante');
        $this->addSql('DROP TABLE grupo');
        $this->addSql('DROP TABLE grupo_docente');
        $this->addSql('DROP TABLE grupo_estudiante');
        $this->addSql('DROP TABLE medida');
        $this->addSql('DROP TABLE observacion_parte');
        $this->addSql('DROP TABLE observacion_sancion');
        $this->addSql('DROP TABLE parte');
        $this->addSql('DROP TABLE sancion');
        $this->addSql('DROP TABLE sancion_medida');
        $this->addSql('DROP TABLE tipo_comunicacion');
        $this->addSql('DROP TABLE tramo');
    }
}
