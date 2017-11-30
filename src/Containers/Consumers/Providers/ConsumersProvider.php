<?php
namespace App\Containers\Consumers\Providers;

use App\Containers\Consumers\Data\Factories\ConsumerRepositoryFactory;
use App\Containers\Consumers\Data\Repositories\ConsumerRepository;
use App\Containers\Consumers\Middlewares\AuthorizeConsumer;
use App\Containers\Consumers\Middlewares\Factories\AuthorizeConsumerFactory;
use App\Ship\Cache\Cache;
use App\Ship\Provides\AbstractProvider;

class ConsumersProvider extends AbstractProvider
{
    protected function dependencies(): array
    {
        return [
        ];
    }

    protected function abstract_factories(): array
    {
        return [
            ConsumerRepository::class => [
                Cache::class
            ],
            AuthorizeConsumer::class => [
                ConsumerRepository::class
            ],
        ];
    }
}
