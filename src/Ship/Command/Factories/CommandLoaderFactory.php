<?php
/**
 * Created by PhpStorm.
 * User: Marcos
 * Date: 21/11/2017
 * Time: 18:31
 */

namespace App\Ship\Command\Factories;


use App\Ship\Command\Loader\CommandLoader;
use Psr\Container\ContainerInterface;

class CommandLoaderFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CommandLoader($container->get('config')['commands'] ?? [], $container);
    }
}