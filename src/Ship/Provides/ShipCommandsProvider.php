<?php
namespace App\Ship\Provides;

use App\Ship\Migrator\Commands\ListMigrations;
use App\Ship\Migrator\MigratorCommand;

class ShipCommandsProvider
{
    public function __invoke()
    {
        return [
            'commands' => [
                'migrations' => MigratorCommand::class,
                'migrations:list' => ListMigrations::class,
            ]
        ];
    }
}
