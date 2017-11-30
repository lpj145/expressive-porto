<?php

return [
    'commands' => [
        //User command
        'user:add' => \App\Containers\Authentication\UI\CLI\Commands\AddUser::class,
        'user:remove' => \App\Containers\Authentication\UI\CLI\Commands\RemoveUser::class,
        'user:password' => \App\Containers\Authentication\UI\CLI\Commands\ChangePassword::class,

        //Consumer commands
        'consumer:create' => \App\Containers\Consumers\UI\CLI\CreateConsumer::class,
        'consumer:remove' => \App\Containers\Consumers\UI\CLI\RemoverConsumer::class,
    ]
];