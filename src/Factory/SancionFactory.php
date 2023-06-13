<?php

namespace App\Factory;

use App\Entity\Sancion;
use App\Repository\SancionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Sancion>
 *
 * @method        Sancion|Proxy create(array|callable $attributes = [])
 * @method static Sancion|Proxy createOne(array $attributes = [])
 * @method static Sancion|Proxy find(object|array|mixed $criteria)
 * @method static Sancion|Proxy findOrCreate(array $attributes)
 * @method static Sancion|Proxy first(string $sortedField = 'id')
 * @method static Sancion|Proxy last(string $sortedField = 'id')
 * @method static Sancion|Proxy random(array $attributes = [])
 * @method static Sancion|Proxy randomOrCreate(array $attributes = [])
 * @method static SancionRepository|RepositoryProxy repository()
 * @method static Sancion[]|Proxy[] all()
 * @method static Sancion[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Sancion[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Sancion[]|Proxy[] findBy(array $attributes)
 * @method static Sancion[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Sancion[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class SancionFactory extends ModelFactory
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
        $fechaSancion = self::faker()->dateTime();
        $fechaComunicado = self::faker()->boolean() ? self::faker()->dateTimeBetween($fechaSancion) : null;
        $fechaInicioSancion = self::faker()->boolean(75) ? self::faker()->dateTimeBetween($fechaComunicado) : null;
        $fechaFinSancion = null;
        if ($fechaInicioSancion != null) {
            $fechaFinSancion = self::faker()->boolean(75) ? self::faker()->dateTimeBetween($fechaInicioSancion) : null;
        }
        $fechaIncorporacion = null;
        if ($fechaFinSancion != null) {
            $fechaIncorporacion = self::faker()->boolean() ? self::faker()->dateTimeBetween($fechaFinSancion) : null;
        }

        return [
            'anotacion' => self::faker()->boolean(80) ? self::faker()->realTextBetween(5, 15) : null,
            'fechaSancion' => $fechaSancion,
            'fechaRegistroSalida' => self::faker()->boolean(75) ? self::faker()->dateTimeBetween($fechaSancion) : null,
            'fechaComunicado' => $fechaComunicado,
            'fechaInicioSancion' => $fechaInicioSancion,
            'fechaFinSancion' => $fechaFinSancion,
            'reclamacion' => self::faker()->boolean(15),
            'registradoEnSeneca' => self::faker()->boolean(25),
            'medidasEfectivas' => self::faker()->boolean(75),
            'motivosNoAplicacion' => ($fechaInicioSancion == null) ? self::faker()->realText(35) : null,
            'fechaIncorporacion' => $fechaIncorporacion
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this// ->afterInstantiate(function(Sancion $sancion): void {})
            ;
    }

    protected static function getClass(): string
    {
        return Sancion::class;
    }
}
