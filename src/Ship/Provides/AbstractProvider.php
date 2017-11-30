<?php
namespace App\Ship\Provides;

abstract class AbstractProvider
{
    public function __invoke()
    {
        return [
          'dependencies' => $this->dependencies(),
          $this->config()
        ];
    }

    abstract protected function dependencies():array;

    protected function config()
    {
        return [];
    }
}
