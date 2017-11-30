<?php
namespace App\Ship\Command;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

abstract class Command extends SymfonyCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(string $name = null, ContainerInterface $container)
    {
        $this->container = $container;
        parent::__construct($name);
    }
}
