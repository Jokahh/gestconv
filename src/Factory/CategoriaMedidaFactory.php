<?php

namespace App\Factory;

use App\Entity\CategoriaMedida;
use App\Repository\CategoriaMedidaRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CategoriaMedida>
 *
 * @method        CategoriaMedida|Proxy create(array|callable $attributes = [])
 * @method static CategoriaMedida|Proxy createOne(array $attributes = [])
 * @method static CategoriaMedida|Proxy find(object|array|mixed $criteria)
 * @method static CategoriaMedida|Proxy findOrCreate(array $attributes)
 * @method static CategoriaMedida|Proxy first(string $sortedField = 'id')
 * @method static CategoriaMedida|Proxy last(string $sortedField = 'id')
 * @method static CategoriaMedida|Proxy random(array $attributes = [])
 * @method static CategoriaMedida|Proxy randomOrCreate(array $attributes = [])
 * @method static CategoriaMedidaRepository|RepositoryProxy repository()
 * @method static CategoriaMedida[]|Proxy[] all()
 * @method static CategoriaMedida[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CategoriaMedida[]|Proxy[] createSequence(array|callable $sequence)
 * @method static CategoriaMedida[]|Proxy[] findBy(array $attributes)
 * @method static CategoriaMedida[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CategoriaMedida[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CategoriaMedidaFactory extends ModelFactory
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
            'orden' => self::faker()->boolean() ? 'ASC' : 'DESC',
            'descripcion' => self::faker()->realTextBetween(5,15)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(CategoriaMedida $categoriaMedida): void {})
        ;
    }

    protected static function getClass(): string
    {
        return CategoriaMedida::class;
    }
}
