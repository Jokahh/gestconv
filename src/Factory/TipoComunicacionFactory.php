<?php

namespace App\Factory;

use App\Entity\TipoComunicacion;
use App\Repository\TipoComunicacionRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<TipoComunicacion>
 *
 * @method        TipoComunicacion|Proxy create(array|callable $attributes = [])
 * @method static TipoComunicacion|Proxy createOne(array $attributes = [])
 * @method static TipoComunicacion|Proxy find(object|array|mixed $criteria)
 * @method static TipoComunicacion|Proxy findOrCreate(array $attributes)
 * @method static TipoComunicacion|Proxy first(string $sortedField = 'id')
 * @method static TipoComunicacion|Proxy last(string $sortedField = 'id')
 * @method static TipoComunicacion|Proxy random(array $attributes = [])
 * @method static TipoComunicacion|Proxy randomOrCreate(array $attributes = [])
 * @method static TipoComunicacionRepository|RepositoryProxy repository()
 * @method static TipoComunicacion[]|Proxy[] all()
 * @method static TipoComunicacion[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static TipoComunicacion[]|Proxy[] createSequence(array|callable $sequence)
 * @method static TipoComunicacion[]|Proxy[] findBy(array $attributes)
 * @method static TipoComunicacion[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TipoComunicacion[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class TipoComunicacionFactory extends ModelFactory
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
            'descripcion' => self::faker()->realTextBetween(5,25)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(TipoComunicacion $tipoComunicacion): void {})
        ;
    }

    protected static function getClass(): string
    {
        return TipoComunicacion::class;
    }
}
