<?php
namespace App\Ship\Migrator;

use Psr\Container\ContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;

class AbstractMigratorFactory
{
    public function __invoke(ContainerInterface $container, $requestName)
    {
        return new $requestName($container->get(Capsule::class));
    }
}
