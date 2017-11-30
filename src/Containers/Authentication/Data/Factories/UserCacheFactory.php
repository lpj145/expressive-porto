<?php
namespace App\Containers\Authentication\Data\Factories;

use App\Containers\Authentication\Data\Cache\UserCache;
use Predis\Client;
use Psr\Container\ContainerInterface;

class UserCacheFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new UserCache($container->get(Client::class));
    }
}
