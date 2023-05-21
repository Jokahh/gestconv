<?php

namespace App\Factory;

use App\Entity\ComunicacionSancion;
use App\Repository\ComunicacionSancionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ComunicacionSancion>
 *
 * @method        ComunicacionSancion|Proxy create(array|callable $attributes = [])
 * @method static ComunicacionSancion|Proxy createOne(array $attributes = [])
 * @method static ComunicacionSancion|Proxy find(object|array|mixed $criteria)
 * @method static ComunicacionSancion|Proxy findOrCreate(array $attributes)
 * @method static ComunicacionSancion|Proxy first(string $sortedField = 'id')
 * @method static ComunicacionSancion|Proxy last(string $sortedField = 'id')
 * @method static ComunicacionSancion|Proxy random(array $attributes = [])
 * @method static ComunicacionSancion|Proxy randomOrCreate(array $attributes = [])
 * @method static ComunicacionSancionRepository|RepositoryProxy repository()
 * @method static ComunicacionSancion[]|Proxy[] all()
 * @method static ComunicacionSancion[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ComunicacionSancion[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ComunicacionSancion[]|Proxy[] findBy(array $attributes)
 * @method static ComunicacionSancion[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ComunicacionSancion[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ComunicacionSancionFactory extends ModelFactory
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
        return [
            'fecha' => self::faker()->dateTime(),
            'anotacion' => self::faker()->boolean(75) ? self::faker()->realText(100) : null
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ComunicacionSancion $comunicacionSancion): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ComunicacionSancion::class;
    }
}
