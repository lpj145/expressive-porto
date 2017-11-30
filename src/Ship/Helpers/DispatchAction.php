<?php
namespace App\Ship\Helpers;


use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Trait DispatchAction
 * @package App\Ship\Helpers
 * @property array $mapMethods
 */
trait DispatchAction
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $dictionary = [
            'GET' => 'index',
            'POST' => 'create',
            'PUT' => 'edit',
            'DELETE' => 'delete'
        ];

        if (property_exists($this, 'mapMethods')) {
            $dictionary = array_merge($dictionary, $this->mapMethods);
        }

        if (method_exists($this, $dictionary[$request->getMethod()])) {
            return $this->{$dictionary[$request->getMethod()]}($request);
        }

        throw new \Exception('Not found action: '.$dictionary[$request->getMethod()].' on '.get_class($this));
    }
}