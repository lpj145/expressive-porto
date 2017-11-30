<?php
namespace App\Containers\Authentication\Providers;

use App\Containers\Authentication\Data\Cache\UserCache;
use App\Containers\Authentication\Data\Factories\ListUsersControllerFactory;
use App\Containers\Authentication\Data\Factories\UserCacheFactory;
use App\Containers\Authentication\Data\Model\UserModel;
use App\Containers\Authentication\Data\Repositories\UserRepository;
use App\Containers\Authentication\UI\API\Controller\ListUsersController;
use App\Ship\Cache\Cache;
use App\Ship\Provides\AbstractProvider;
use AuthExpressive\Interfaces\DatabaseInterface;
use AuthExpressive\Interfaces\StorageInterface;
use Predis\Client;

class MainProvider extends AbstractProvider
{
    protected function dependencies(): array
    {
        return [
            'invokables' => [
                DatabaseInterface::class => UserRepository::class,
                UserRepository::class => UserRepository::class,
            ],
            'aliases' => [
                StorageInterface::class => Cache::class
            ]
        ];
    }

    protected function abstract_factories(): array
    {
        return [
            ListUsersController::class => [
                UserRepository::class
            ]
        ];
    }
}
