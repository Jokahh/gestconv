<?php

namespace App\Factory;

use App\Entity\Parte;
use App\Repository\ParteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Parte>
 *
 * @method        Parte|Proxy create(array|callable $attributes = [])
 * @method static Parte|Proxy createOne(array $attributes = [])
 * @method static Parte|Proxy find(object|array|mixed $criteria)
 * @method static Parte|Proxy findOrCreate(array $attributes)
 * @method static Parte|Proxy first(string $sortedField = 'id')
 * @method static Parte|Proxy last(string $sortedField = 'id')
 * @method static Parte|Proxy random(array $attributes = [])
 * @method static Parte|Proxy randomOrCreate(array $attributes = [])
 * @method static ParteRepository|RepositoryProxy repository()
 * @method static Parte[]|Proxy[] all()
 * @method static Parte[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Parte[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Parte[]|Proxy[] findBy(array $attributes)
 * @method static Parte[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Parte[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class ParteFactory extends ModelFactory
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
        $fechaCreacion = self::faker()->dateTime();
        $fechaAviso = self::faker()->boolean(75) ? self::faker()->dateTimeBetween($fechaCreacion) : null;
        return [
            'fechaCreacion' => $fechaCreacion,
            'fechaSuceso' => self::faker()->dateTimeBetween($fechaCreacion),
            'fechaAviso' => $fechaAviso,
            'fechaRecordatorio' => self::faker()->boolean(25) ? self::faker()->dateTimeBetween($fechaAviso) : null,
            'anotacion' => self::faker()->realText(15),
            'actividades' => self::faker()->realTextBetween(5,25),
            'prescrito' => self::faker()->boolean(25),
            'hayExpulsion' => self::faker()->boolean(20),
            'actividadesRealizadas' => self::faker()->boolean(85),
            'prioritaria' => self::faker()->boolean(15),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Parte $parte): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Parte::class;
    }
}
