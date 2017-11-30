<?php
namespace App\Ship\Logger\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoggerMiddleware implements MiddlewareInterface
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        try {
            return $delegate->process($request);
        }catch (\Throwable $exception) {
            $this->logger->warning($exception->getMessage(), [
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'route' => $request->getRequestTarget()
            ]);
        }
    }
}
