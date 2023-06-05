<?php

namespace App\Factory;

use App\Entity\ObservacionSancion;
use App\Repository\ObservacionSancionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ObservacionSancion>
 *
 * @method        ObservacionSancion|Proxy create(array|callable $attributes = [])
 * @method static ObservacionSancion|Proxy createOne(array $attributes = [])
 * @method static ObservacionSancion|Proxy find(object|array|mixed $criteria)
 * @method static ObservacionSancion|Proxy findOrCreate(array $attributes)
 * @method static ObservacionSancion|Proxy first(string $sortedField = 'id')
 * @method static ObservacionSancion|Proxy last(string $sortedField = 'id')
 * @method static ObservacionSancion|Proxy random(array $attributes = [])
 * @method static ObservacionSancion|Proxy randomOrCreate(array $attributes = [])
 * @method static ObservacionSancionRepository|RepositoryProxy repository()
 * @method static ObservacionSancion[]|Proxy[] all()
 * @method static ObservacionSancion[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ObservacionSancion[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ObservacionSancion[]|Proxy[] findBy(array $attributes)
 * @method static ObservacionSancion[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ObservacionSancion[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ObservacionSancionFactory extends ModelFactory
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
            'anotacion' => self::faker()->boolean(75) ? self::faker()->realText(15) : null
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ObservacionSancion $observacionSancion): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ObservacionSancion::class;
    }
}
