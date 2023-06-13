<?php

namespace App\Factory;

use App\Entity\ConductaContraria;
use App\Repository\ConductaContrariaRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ConductaContraria>
 *
 * @method        ConductaContraria|Proxy create(array|callable $attributes = [])
 * @method static ConductaContraria|Proxy createOne(array $attributes = [])
 * @method static ConductaContraria|Proxy find(object|array|mixed $criteria)
 * @method static ConductaContraria|Proxy findOrCreate(array $attributes)
 * @method static ConductaContraria|Proxy first(string $sortedField = 'id')
 * @method static ConductaContraria|Proxy last(string $sortedField = 'id')
 * @method static ConductaContraria|Proxy random(array $attributes = [])
 * @method static ConductaContraria|Proxy randomOrCreate(array $attributes = [])
 * @method static ConductaContrariaRepository|RepositoryProxy repository()
 * @method static ConductaContraria[]|Proxy[] all()
 * @method static ConductaContraria[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ConductaContraria[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ConductaContraria[]|Proxy[] findBy(array $attributes)
 * @method static ConductaContraria[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ConductaContraria[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ConductaContrariaFactory extends ModelFactory
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
            'orden' => self::faker()->numberBetween(0, 50)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this// ->afterInstantiate(function(ConductaContraria $conductasContrarias): void {})
            ;
    }

    protected static function getClass(): string
    {
        return ConductaContraria::class;
    }
}
