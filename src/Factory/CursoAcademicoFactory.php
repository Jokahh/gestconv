<?php

namespace App\Factory;

use App\Entity\CursoAcademico;
use App\Repository\CursoAcademicoRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CursoAcademico>
 *
 * @method        CursoAcademico|Proxy create(array|callable $attributes = [])
 * @method static CursoAcademico|Proxy createOne(array $attributes = [])
 * @method static CursoAcademico|Proxy find(object|array|mixed $criteria)
 * @method static CursoAcademico|Proxy findOrCreate(array $attributes)
 * @method static CursoAcademico|Proxy first(string $sortedField = 'id')
 * @method static CursoAcademico|Proxy last(string $sortedField = 'id')
 * @method static CursoAcademico|Proxy random(array $attributes = [])
 * @method static CursoAcademico|Proxy randomOrCreate(array $attributes = [])
 * @method static CursoAcademicoRepository|RepositoryProxy repository()
 * @method static CursoAcademico[]|Proxy[] all()
 * @method static CursoAcademico[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CursoAcademico[]|Proxy[] createSequence(array|callable $sequence)
 * @method static CursoAcademico[]|Proxy[] findBy(array $attributes)
 * @method static CursoAcademico[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CursoAcademico[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CursoAcademicoFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $semestres = ['1º Semestre','2º Semestre','3º Semestre'];
        $fechaInicio = self::faker()->dateTime();
        return [
            'descripcion' => self::faker()->realText(25),
            'fechaInicio' => $fechaInicio,
            'fechaFin' => self::faker()->dateTimeInInterval($fechaInicio,'+1 years'),

            //true = activo, false = inactivo
            'estado' => self::faker()->boolean(75),
            'semestre' => self::faker()->randomElement($semestres)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(CursoAcademico $cursoAcademico): void {})
        ;
    }

    protected static function getClass(): string
    {
        return CursoAcademico::class;
    }
}
