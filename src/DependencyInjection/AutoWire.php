<?php declare(strict_types=1);

namespace App\DependencyInjection;

use Jasny\Autowire\AutowireInterface;
use Jasny\Autowire\ReflectionAutowire;

final class AutoWire
{
    private static ?AutowireInterface $autoWire = null;

    private function __construct()
    {
    }

    public static function get(string $dependencyClass): mixed
    {
        if (self::$autoWire === null) {
            self::$autoWire = new ReflectionAutowire((new ContainerGenerator())->getContainer());
        }

        if (self::$autoWire->getContainer()->has($dependencyClass)) {
            return self::$autoWire->getContainer()->get($dependencyClass);
        }

        return self::$autoWire->instantiate($dependencyClass);
    }
}