<?php
namespace App\Containers\Consumers\Middlewares;

use App\Containers\Consumers\Data\Repositories\ConsumerRepository;
use App\Ship\Response\Unauthorized;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthorizeConsumer implements MiddlewareInterface
{
    /**
     * @var ConsumerRepository
     */
    private $consumerRepository;

    public function __construct(ConsumerRepository $consumerRepository)
    {
        $this->consumerRepository = $consumerRepository;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $key = $request->getHeaderLine('x-api-key');

        if (
            empty($key) ||
            null === $consumer = $this->consumerRepository->getById($key)
        ) {
            return new Unauthorized();
        }

        return $delegate->process($request->withAttribute('consumer', $consumer));
    }
}
