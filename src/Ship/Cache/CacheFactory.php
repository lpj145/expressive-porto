<?php
namespace App\Ship\Cache;

use Predis\Client;
use Psr\Container\ContainerInterface;

class CacheFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new Cache(
            $container->get(Client::class),
            $container->get('config')['redis']
        );
    }
}
