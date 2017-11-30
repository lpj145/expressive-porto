<?php
namespace App\Containers\Consumers\Middlewares\Factories;

use App\Containers\Consumers\Data\Repositories\ConsumerRepository;
use App\Containers\Consumers\Middlewares\AuthorizeConsumer;
use Psr\Container\ContainerInterface;

class AuthorizeConsumerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new AuthorizeConsumer($container->get(ConsumerRepository::class));
    }
}
