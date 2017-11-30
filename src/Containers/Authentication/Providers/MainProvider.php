<?php
namespace App\Containers\Authentication\Providers;

use App\Containers\Authentication\Data\Cache\UserCache;
use App\Containers\Authentication\Data\Factories\ListUsersControllerFactory;
use App\Containers\Authentication\Data\Factories\UserCacheFactory;
use App\Containers\Authentication\Data\Model\UserModel;
use App\Containers\Authentication\Data\Repositories\UserRepository;
use App\Containers\Authentication\UI\API\Controller\ListUsersController;
use AuthExpressive\Interfaces\DatabaseInterface;
use AuthExpressive\Interfaces\StorageInterface;

class MainProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies()
        ];
    }

    public function getDependencies()
    {
        return [
            'invokables' => [
                DatabaseInterface::class => UserRepository::class,

                UserRepository::class => UserRepository::class
            ],
            'factories' => [
                StorageInterface::class => UserCacheFactory::class,
                ListUsersController::class => ListUsersControllerFactory::class,
            ]
        ];
    }
}
