<?php
namespace App\Ship\Data\Factories;

use Illuminate\Database\Capsule\Manager;
use Jenssegers\Mongodb\Connection;
use Psr\Container\ContainerInterface;

class DataFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $capsule = new Manager();
        $capsule->getDatabaseManager()->extend('mongodb', function($config){
            return new Connection($config);
        });
        $capsule->addConnection($container->get('config')['database']['mongodb']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        return $capsule;
    }
}
