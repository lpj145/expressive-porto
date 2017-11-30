<?php
namespace App\Ship\Provides;

use App\Ship\Cache\Cache;
use App\Ship\Cache\CacheFactory;
use App\Ship\Command\Factories\CommandFactory;
use App\Ship\Command\Factories\CommandLoaderFactory;
use App\Ship\Command\Loader\CommandLoader;
use App\Ship\Data\Factories\DataFactory;
use App\Ship\Migrator\AbstractMigrator;
use App\Ship\Migrator\AbstractMigratorFactory;
use App\Ship\Migrator\MigratorCommand;
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;

class ShipProvider
{
    public function __invoke()
    {
        return [
          'dependencies' => $this->getDependencies(),
        ];
    }

    public function getDependencies()
    {
        return [
            'factories' => [
                // Database factory
                Capsule::class => DataFactory::class,
                // Commands factory
                CommandLoaderInterface::class => CommandLoaderFactory::class,
                // Abstract Migrator
                AbstractMigrator::class => AbstractMigratorFactory::class,
                // Cache Redis Factory
                Cache::class => CacheFactory::class,
            ]
        ];
    }
}
