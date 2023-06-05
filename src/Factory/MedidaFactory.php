<?php

namespace App\Factory;

use App\Entity\Medida;
use App\Repository\MedidaRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Medida>
 *
 * @method        Medida|Proxy create(array|callable $attributes = [])
 * @method static Medida|Proxy createOne(array $attributes = [])
 * @method static Medida|Proxy find(object|array|mixed $criteria)
 * @method static Medida|Proxy findOrCreate(array $attributes)
 * @method static Medida|Proxy first(string $sortedField = 'id')
 * @method static Medida|Proxy last(string $sortedField = 'id')
 * @method static Medida|Proxy random(array $attributes = [])
 * @method static Medida|Proxy randomOrCreate(array $attributes = [])
 * @method static MedidaRepository|RepositoryProxy repository()
 * @method static Medida[]|Proxy[] all()
 * @method static Medida[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Medida[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Medida[]|Proxy[] findBy(array $attributes)
 * @method static Medida[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Medida[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class MedidaFactory extends ModelFactory
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
            'dias' => self::faker()->boolean(80) ? self::faker()->numberBetween(0,30) : null,
            'nombre' => self::faker()->realTextBetween(5,15),
            'orden' => self::faker()->boolean() ? 'ASC' : 'DESC'
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Medida $medida): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Medida::class;
    }
}
