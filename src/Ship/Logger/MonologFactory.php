<?php
namespace App\Ship\Logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

class MonologFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $loggerName = $container->get('config')['logger']['name'] ?? 'default-log';
        $logger = new Logger($loggerName);
        $logger->pushHandler(new StreamHandler(__DIR__.'/../../../data/'.$loggerName.'.log', Logger::WARNING));
        return $logger;
    }
}
