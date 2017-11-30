<?php
namespace App\Containers\Authentication\Data\Factories;

use App\Containers\Authentication\Data\Model\UserModel;
use App\Containers\Authentication\Data\Repositories\UserRepository;
use App\Containers\Authentication\UI\API\Controller\ListUsersController;
use Psr\Container\ContainerInterface;

class ListUsersControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ListUsersController($container->get(UserRepository::class));
    }
}
