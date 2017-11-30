<?php
namespace App\Ship\Provides;

use App\Ship\Cache\Cache;
use App\Ship\Cache\CacheFactory;
use App\Ship\Command\Factories\CommandFactory;
use App\Ship\Command\Factories\CommandLoaderFactory;
use App\Ship\Command\Loader\CommandLoader;
use App\Ship\Data\Factories\DataFactory;
use App\Ship\Logger\Middleware\LoggerMiddleware;
use App\Ship\Logger\MonologFactory;
use App\Ship\Migrator\AbstractMigrator;
use App\Ship\Migrator\AbstractMigratorFactory;
use App\Ship\Migrator\MigratorCommand;
use Illuminate\Database\Capsule\Manager as Capsule;
use Monolog\Logger;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

class ShipProvider extends AbstractProvider
{
    protected function dependencies(): array
    {
        return [
            'factories' => [
                // Eloquent factory
                Capsule::class => DataFactory::class,
                //CommandLoader Interface
                CommandLoaderInterface::class => CommandLoaderFactory::class,
                //Abstract Migrator
                AbstractMigrator::class => AbstractMigratorFactory::class,
                // Cache Redis Factory
                Cache::class => CacheFactory::class,
                //Logger factory
                Logger::class => MonologFactory::class,
            ]
        ];
    }

    protected function abstract_factories(): array
    {
        return [
            LoggerMiddleware::class => [
                Logger::class
            ]
        ];
    }
}
