<?php
namespace App\Containers\Consumers\Data\Factories;

use App\Containers\Consumers\Data\Repositories\ConsumerRepository;
use App\Ship\Cache\Cache;
use Psr\Container\ContainerInterface;

class ConsumerRepositoryFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new ConsumerRepository($container->get(Cache::class));
    }
}
