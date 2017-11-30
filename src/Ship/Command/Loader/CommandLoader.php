<?php
namespace App\Ship\Command\Loader;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Symfony\Component\Console\Exception\CommandNotFoundException;

class CommandLoader implements CommandLoaderInterface
{
    /**
     * @var array
     */
    private $commandArray;
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(array $commandArray, ContainerInterface $container)
    {
        $this->commandArray = $commandArray;
        $this->container = $container;
    }

    public function get($name)
    {
        if (!isset($this->commandArray[$name])) {
            throw new CommandNotFoundException('Command :'.$name.' not found!');
        }
        return new $this->commandArray[$name]($name, $this->container);
    }

    public function has($name)
    {
        return isset($this->commandArray[$name]);
    }

    public function getNames()
    {
        return array_keys($this->commandArray);
    }

}
