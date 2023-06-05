<?php

namespace App\Factory;

use App\Entity\ObservacionParte;
use App\Repository\ObservacionParteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ObservacionParte>
 *
 * @method        ObservacionParte|Proxy create(array|callable $attributes = [])
 * @method static ObservacionParte|Proxy createOne(array $attributes = [])
 * @method static ObservacionParte|Proxy find(object|array|mixed $criteria)
 * @method static ObservacionParte|Proxy findOrCreate(array $attributes)
 * @method static ObservacionParte|Proxy first(string $sortedField = 'id')
 * @method static ObservacionParte|Proxy last(string $sortedField = 'id')
 * @method static ObservacionParte|Proxy random(array $attributes = [])
 * @method static ObservacionParte|Proxy randomOrCreate(array $attributes = [])
 * @method static ObservacionParteRepository|RepositoryProxy repository()
 * @method static ObservacionParte[]|Proxy[] all()
 * @method static ObservacionParte[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ObservacionParte[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ObservacionParte[]|Proxy[] findBy(array $attributes)
 * @method static ObservacionParte[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ObservacionParte[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ObservacionParteFactory extends ModelFactory
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
            'anotacion' => self::faker()->boolean(75) ? self::faker()->realText(25) : null
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ObservacionParte $observacionParte): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ObservacionParte::class;
    }
}
