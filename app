<?php

use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;

require __DIR__.'/vendor/autoload.php';

/** @var \Psr\Container\ContainerInterface $container */
$container = require __DIR__.'/config/container.php';

$application = new \Symfony\Component\Console\Application();

$application->setCommandLoader($container->get(CommandLoaderInterface::class));

$application->run();
