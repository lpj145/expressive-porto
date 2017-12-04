<?php
namespace App\Ship\Provides;

use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

abstract class AbstractProvider
{
    public function __invoke()
    {
        $services['dependencies'] = $this->dependencies();
        $services[ConfigAbstractFactory::class] = $this->abstract_factories();
        $services = array_merge($services, $this->config());
        return $services;
    }

    abstract protected function dependencies():array;

    protected function config()
    {
        return [];
    }

    protected function abstract_factories() : array
    {
        return [];
    }
}
