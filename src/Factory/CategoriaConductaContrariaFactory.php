<?php

namespace App\Factory;

use App\Entity\CategoriaConductaContraria;
use App\Repository\CategoriaConductaContrariaRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<CategoriaConductaContraria>
 *
 * @method        CategoriaConductaContraria|Proxy create(array|callable $attributes = [])
 * @method static CategoriaConductaContraria|Proxy createOne(array $attributes = [])
 * @method static CategoriaConductaContraria|Proxy find(object|array|mixed $criteria)
 * @method static CategoriaConductaContraria|Proxy findOrCreate(array $attributes)
 * @method static CategoriaConductaContraria|Proxy first(string $sortedField = 'id')
 * @method static CategoriaConductaContraria|Proxy last(string $sortedField = 'id')
 * @method static CategoriaConductaContraria|Proxy random(array $attributes = [])
 * @method static CategoriaConductaContraria|Proxy randomOrCreate(array $attributes = [])
 * @method static CategoriaConductaContrariaRepository|RepositoryProxy repository()
 * @method static CategoriaConductaContraria[]|Proxy[] all()
 * @method static CategoriaConductaContraria[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static CategoriaConductaContraria[]|Proxy[] createSequence(array|callable $sequence)
 * @method static CategoriaConductaContraria[]|Proxy[] findBy(array $attributes)
 * @method static CategoriaConductaContraria[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CategoriaConductaContraria[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class CategoriaConductaContrariaFactory extends ModelFactory
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
            'orden' => self::faker()->numberBetween(0, 50),
            'descripcion' => self::faker()->realTextBetween(5, 15),
            'prioritaria' => self::faker()->boolean(25)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this// ->afterInstantiate(function(CategoriaConductaContraria $categoriaConductaContraria): void {})
            ;
    }

    protected static function getClass(): string
    {
        return CategoriaConductaContraria::class;
    }
}
