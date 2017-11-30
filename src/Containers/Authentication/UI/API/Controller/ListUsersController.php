<?php
namespace App\Containers\Authentication\UI\API\Controller;

use App\Containers\Authentication\Data\Repositories\UserRepository;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class ListUsersController implements MiddlewareInterface
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new JsonResponse(['users' => $this->repository->thisMonth()]);
    }

}
