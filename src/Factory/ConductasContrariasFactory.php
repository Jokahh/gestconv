<?php

namespace App\Factory;

use App\Entity\ConductasContrarias;
use App\Repository\ConductasContrariasRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ConductasContrarias>
 *
 * @method        ConductasContrarias|Proxy create(array|callable $attributes = [])
 * @method static ConductasContrarias|Proxy createOne(array $attributes = [])
 * @method static ConductasContrarias|Proxy find(object|array|mixed $criteria)
 * @method static ConductasContrarias|Proxy findOrCreate(array $attributes)
 * @method static ConductasContrarias|Proxy first(string $sortedField = 'id')
 * @method static ConductasContrarias|Proxy last(string $sortedField = 'id')
 * @method static ConductasContrarias|Proxy random(array $attributes = [])
 * @method static ConductasContrarias|Proxy randomOrCreate(array $attributes = [])
 * @method static ConductasContrariasRepository|RepositoryProxy repository()
 * @method static ConductasContrarias[]|Proxy[] all()
 * @method static ConductasContrarias[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ConductasContrarias[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ConductasContrarias[]|Proxy[] findBy(array $attributes)
 * @method static ConductasContrarias[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ConductasContrarias[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ConductasContrariasFactory extends ModelFactory
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
            'orden' => self::faker()->boolean() ? 'ASC' : 'DESC'
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ConductasContrarias $conductasContrarias): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ConductasContrarias::class;
    }
}
