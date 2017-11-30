<?php
namespace App\Ship\Provides;

use Zend\ServiceManager\AbstractFactory\ConfigAbstractFactory;

abstract class AbstractProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->dependencies(),
            $this->config(),
            ConfigAbstractFactory::class => $this->abstract_factories(),
        ];
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
