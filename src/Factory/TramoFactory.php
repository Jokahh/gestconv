<?php

namespace App\Factory;

use App\Entity\Tramo;
use App\Repository\TramoRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Tramo>
 *
 * @method        Tramo|Proxy create(array|callable $attributes = [])
 * @method static Tramo|Proxy createOne(array $attributes = [])
 * @method static Tramo|Proxy find(object|array|mixed $criteria)
 * @method static Tramo|Proxy findOrCreate(array $attributes)
 * @method static Tramo|Proxy first(string $sortedField = 'id')
 * @method static Tramo|Proxy last(string $sortedField = 'id')
 * @method static Tramo|Proxy random(array $attributes = [])
 * @method static Tramo|Proxy randomOrCreate(array $attributes = [])
 * @method static TramoRepository|RepositoryProxy repository()
 * @method static Tramo[]|Proxy[] all()
 * @method static Tramo[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Tramo[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Tramo[]|Proxy[] findBy(array $attributes)
 * @method static Tramo[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Tramo[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TramoFactory extends ModelFactory
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
            'diaSemana' => self::faker()->dayOfWeek(),
            'horaInicio' => self::faker()->time('H:i'),
            'horaFin' => self::faker()->time('H:i'),
            'orden' => self::faker()->numberBetween(0, 50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this// ->afterInstantiate(function(Tramo $tramo): void {})
            ;
    }

    protected static function getClass(): string
    {
        return Tramo::class;
    }
}
