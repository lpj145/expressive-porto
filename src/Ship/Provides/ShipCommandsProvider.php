<?php
namespace App\Ship\Provides;

use App\Ship\Migrator\Commands\ListMigrations;
use App\Ship\Migrator\MigratorCommand;

class ShipCommandsProvider extends AbstractProvider
{
    protected function dependencies(): array
    {
        return [

        ];
    }

    protected function config()
    {
        return [
            'commands' => [
                'migrations' => MigratorCommand::class,
                'migrations:list' => ListMigrations::class,
            ]
        ];
    }
}
