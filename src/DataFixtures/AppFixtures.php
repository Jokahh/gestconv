<?php

namespace App\DataFixtures;

use App\Entity\CursoAcademico;
use App\Entity\Docente;
use App\Factory\ActitudFamiliaFactory;
use App\Factory\CategoriaConductaContrariaFactory;
use App\Factory\CategoriaMedidaFactory;
use App\Factory\ComunicacionParteFactory;
use App\Factory\ComunicacionSancionFactory;
use App\Factory\ConductaContrariaFactory;
use App\Factory\CursoAcademicoFactory;
use App\Factory\DocenteFactory;
use App\Factory\EstudianteFactory;
use App\Factory\GrupoFactory;
use App\Factory\MedidaFactory;
use App\Factory\ObservacionParteFactory;
use App\Factory\ObservacionSancionFactory;
use App\Factory\ParteFactory;
use App\Factory\SancionFactory;
use App\Factory\TipoComunicacionFactory;
use App\Factory\TramoFactory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CursoAcademicoFactory::createMany(1);
        $cursoActivo = new CursoAcademico();
        $cursoActivo->setDescripcion('2023/2024');
        $cursoActivo->setEstado(1);
        $cursoActivo->setEsActivo(1);
        $cursoActivo->setFechaInicio(new DateTime('now'));
        $cursoActivo->setFechaFin(new DateTime('+1 years'));
        $manager->persist($cursoActivo);

        ActitudFamiliaFactory::createMany(6, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random()
            ];
        });

        TramoFactory::createMany(15, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random()
            ];
        });


        TipoComunicacionFactory::createMany(8, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random()
            ];
        });

        $docenteAdmin = new Docente();
        $docenteAdmin->setApellido1("admin");
        $docenteAdmin->setEsAdmin(true);
        $docenteAdmin->setEstaActivo(true);
        $docenteAdmin->setUsuario("admin");
        $docenteAdmin->setPassword("admin");
        $docenteAdmin->setNombre("admin");
        $manager->persist($docenteAdmin);

        $docenteDirectivo = new Docente();
        $docenteDirectivo->setApellido1("directivo");
        $docenteDirectivo->setEsDirectivo(true);
        $docenteDirectivo->setEstaActivo(true);
        $docenteDirectivo->setUsuario("directivo");
        $docenteDirectivo->setPassword("directivo");
        $docenteDirectivo->setNombre("directivo");
        $manager->persist($docenteDirectivo);

        $docenteComisionario = new Docente();
        $docenteComisionario->setApellido1("comisionario");
        $docenteComisionario->setEsComisionario(true);
        $docenteComisionario->setEstaActivo(true);
        $docenteComisionario->setUsuario("comisionario");
        $docenteComisionario->setPassword("comisionario");
        $docenteComisionario->setNombre("comisionario");
        $manager->persist($docenteComisionario);

        $docente = new Docente();
        $docente->setApellido1("docente");
        $docente->setEstaActivo(true);
        $docente->setUsuario("docente");
        $docente->setPassword("docente");
        $docente->setNombre("docente");
        $manager->persist($docente);

        $docenteTutor = new Docente();
        $docenteTutor->setApellido1("tutor");
        $docenteTutor->setEstaActivo(true);
        $docenteTutor->setUsuario("tutor");
        $docenteTutor->setPassword("tutor");
        $docenteTutor->setNombre("tutor");
        $manager->persist($docenteTutor);


        DocenteFactory::createMany(3);

        GrupoFactory::createMany(2, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random(),
                'tutores' => DocenteFactory::randomRange(0, 2)
            ];
        });

        EstudianteFactory::createMany(25, function () {
            return [
                'grupos' => GrupoFactory::randomRange(0, 1)
            ];
        });

        GrupoFactory::createMany(2, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random(),
                'tutores' => DocenteFactory::randomRange(0, 2),
                'estudiantes' => EstudianteFactory::randomRange(0, 5)
            ];
        });

        ParteFactory::createMany(10, function () {
            return [
                'docente' => DocenteFactory::random(),
                'estudiante' => EstudianteFactory::random(),
                'tramo' => TramoFactory::random()
            ];
        });

        DocenteFactory::createMany(2, function () {
            return [
                'partes' => ParteFactory::randomRange(0, 3)
            ];
        });

        ComunicacionParteFactory::createMany(5, function () {
            return [
                'tipo' => TipoComunicacionFactory::random(),
                'parte' => ParteFactory::random()
            ];
        });

        ObservacionParteFactory::createMany(5, function () {
            return [
                'parte' => ParteFactory::random()
            ];
        });

        CategoriaConductaContrariaFactory::createMany(15, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random()
            ];
        });

        ConductaContrariaFactory::createMany(15, function () {
            return [
                'categoria' => CategoriaConductaContrariaFactory::random(),
                'partes' => ParteFactory::randomRange(0, 1)
            ];
        });


        MedidaFactory::createMany(10, function () {
            return [
                'categoria' => CategoriaMedidaFactory::createOne()
            ];
        });


        SancionFactory::createMany(10, function () {
            return [
                'medidas' => MedidaFactory::randomRange(0, 4),
                'actitudFamilia' => ActitudFamiliaFactory::random(),
            ];
        });

        ObservacionSancionFactory::createMany(10, function () {
            return [
                'sancion' => SancionFactory::random(),
            ];
        });

        SancionFactory::createMany(15, function () {
            return [
                'medidas' => MedidaFactory::randomRange(0, 4),
                'actitudFamilia' => ActitudFamiliaFactory::random(),
                'observaciones' => ObservacionSancionFactory::randomRange(0, 2),
                'partes' => ParteFactory::randomRange(0, 5)
            ];
        });

        ComunicacionSancionFactory::createMany(10, function () {
            return [
                'sancion' => SancionFactory::random(),
                'tipo' => TipoComunicacionFactory::random()
            ];
        });


        $manager->flush();
    }
}
