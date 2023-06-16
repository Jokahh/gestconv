<?php

namespace App\DataFixtures;

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
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        CursoAcademicoFactory::createMany(10);

        ActitudFamiliaFactory::createMany(25, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random()
            ];
        });

        TramoFactory::createMany(10, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random()
            ];
        });


        TipoComunicacionFactory::createMany(10, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random()
            ];
        });

        DocenteFactory::createMany(15);

        GrupoFactory::createMany(5, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random(),
                'tutores' => DocenteFactory::randomRange(0, 2)
            ];
        });

        EstudianteFactory::createMany(75, function () {
            return [
                'grupos' => GrupoFactory::randomRange(0, 1)
            ];
        });

        GrupoFactory::createMany(10, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random(),
                'tutores' => DocenteFactory::randomRange(0, 2),
                'estudiantes' => EstudianteFactory::randomRange(0, 5)
            ];
        });

        ParteFactory::createMany(30, function () {
            return [
                'docente' => DocenteFactory::random(),
                'estudiante' => EstudianteFactory::random(),
                'tramo' => TramoFactory::random()
            ];
        });

        DocenteFactory::createMany(30, function () {
            return [
                'partes' => ParteFactory::randomRange(0, 3)
            ];
        });

        ComunicacionParteFactory::createMany(15, function () {
            return [
                'tipo' => TipoComunicacionFactory::random(),
                'parte' => ParteFactory::random()
            ];
        });

        ObservacionParteFactory::createMany(15, function () {
            return [
                'parte' => ParteFactory::random()
            ];
        });

        CategoriaConductaContrariaFactory::createMany(15, function () {
            return [
                'cursoAcademico' => CursoAcademicoFactory::random()
            ];
        });

        ConductaContrariaFactory::createMany(25, function () {
            return [
                'categoria' => CategoriaConductaContrariaFactory::random(),
                'parte' => ParteFactory::random()
            ];
        });


        MedidaFactory::createMany(15, function () {
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

        ObservacionSancionFactory::createMany(20, function () {
            return [
                'sancion' => SancionFactory::random(),
            ];
        });

        SancionFactory::createMany(20, function () {
            return [
                'medidas' => MedidaFactory::randomRange(0, 4),
                'actitudFamilia' => ActitudFamiliaFactory::random(),
                'observaciones' => ObservacionSancionFactory::randomRange(0, 2),
                'partes' => ParteFactory::randomRange(0, 5)
            ];
        });

        ComunicacionSancionFactory::createMany(15, function () {
            return [
                'sancion' => SancionFactory::random(),
                'tipo' => TipoComunicacionFactory::random()
            ];
        });


        $manager->flush();
    }
}
