<?php

namespace App\Factory;

use App\Entity\ComunicacionParte;
use App\Repository\ComunicacionParteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ComunicacionParte>
 *
 * @method        ComunicacionParte|Proxy create(array|callable $attributes = [])
 * @method static ComunicacionParte|Proxy createOne(array $attributes = [])
 * @method static ComunicacionParte|Proxy find(object|array|mixed $criteria)
 * @method static ComunicacionParte|Proxy findOrCreate(array $attributes)
 * @method static ComunicacionParte|Proxy first(string $sortedField = 'id')
 * @method static ComunicacionParte|Proxy last(string $sortedField = 'id')
 * @method static ComunicacionParte|Proxy random(array $attributes = [])
 * @method static ComunicacionParte|Proxy randomOrCreate(array $attributes = [])
 * @method static ComunicacionParteRepository|RepositoryProxy repository()
 * @method static ComunicacionParte[]|Proxy[] all()
 * @method static ComunicacionParte[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ComunicacionParte[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ComunicacionParte[]|Proxy[] findBy(array $attributes)
 * @method static ComunicacionParte[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ComunicacionParte[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ComunicacionParteFactory extends ModelFactory
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
            // ->afterInstantiate(function(ComunicacionParte $comunicacionParte): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ComunicacionParte::class;
    }
}
