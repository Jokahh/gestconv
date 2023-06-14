<?php

namespace App\Factory;

use App\Entity\Docente;
use App\Repository\DocenteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Docente>
 *
 * @method        Docente|Proxy create(array|callable $attributes = [])
 * @method static Docente|Proxy createOne(array $attributes = [])
 * @method static Docente|Proxy find(object|array|mixed $criteria)
 * @method static Docente|Proxy findOrCreate(array $attributes)
 * @method static Docente|Proxy first(string $sortedField = 'id')
 * @method static Docente|Proxy last(string $sortedField = 'id')
 * @method static Docente|Proxy random(array $attributes = [])
 * @method static Docente|Proxy randomOrCreate(array $attributes = [])
 * @method static DocenteRepository|RepositoryProxy repository()
 * @method static Docente[]|Proxy[] all()
 * @method static Docente[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Docente[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Docente[]|Proxy[] findBy(array $attributes)
 * @method static Docente[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Docente[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class DocenteFactory extends ModelFactory
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
            'nombre' => self::faker()->firstName(),
            'apellido1' => self::faker()->lastName(),
            'apellido2' => self::faker()->boolean(75) ? self::faker()->lastName() : null,
            'email' => self::faker()->boolean(75) ? self::faker()->email() : null,
            'telefono' => self::faker()->boolean(60) ? self::faker()->phoneNumber() : null,
            'usuario' => self::faker()->userName(),
            'password' => self::faker()->password(),
            'notificaciones' => self::faker()->boolean(20),
            'esAdmin' => self::faker()->boolean(10),
            'estaActivo' => self::faker()->boolean(90),
            'esExterno' => self::faker()->boolean(10),
            'esDirectivo' => self::faker()->boolean(10),
            'esComisionario' => self::faker()->boolean(10)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this// ->afterInstantiate(function(Docente $docente): void {})
            ;
    }

    protected static function getClass(): string
    {
        return Docente::class;
    }
}
