<?php

namespace App\Factory;

use App\Entity\ActitudFamilia;
use App\Repository\ActitudFamiliaRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<ActitudFamilia>
 *
 * @method        ActitudFamilia|Proxy create(array|callable $attributes = [])
 * @method static ActitudFamilia|Proxy createOne(array $attributes = [])
 * @method static ActitudFamilia|Proxy find(object|array|mixed $criteria)
 * @method static ActitudFamilia|Proxy findOrCreate(array $attributes)
 * @method static ActitudFamilia|Proxy first(string $sortedField = 'id')
 * @method static ActitudFamilia|Proxy last(string $sortedField = 'id')
 * @method static ActitudFamilia|Proxy random(array $attributes = [])
 * @method static ActitudFamilia|Proxy randomOrCreate(array $attributes = [])
 * @method static ActitudFamiliaRepository|RepositoryProxy repository()
 * @method static ActitudFamilia[]|Proxy[] all()
 * @method static ActitudFamilia[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ActitudFamilia[]|Proxy[] createSequence(array|callable $sequence)
 * @method static ActitudFamilia[]|Proxy[] findBy(array $attributes)
 * @method static ActitudFamilia[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ActitudFamilia[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ActitudFamiliaFactory extends ModelFactory
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
            'descripcion' => self::faker()->realText(15),
            'fecha' => self::faker()->dateTime(),
            'orden' => self::faker()->boolean() ? 'ASC' : 'DESC'
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(ActitudFamilia $actitudFamilia): void {})
        ;
    }

    protected static function getClass(): string
    {
        return ActitudFamilia::class;
    }
}
