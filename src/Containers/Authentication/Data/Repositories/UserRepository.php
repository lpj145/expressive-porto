<?php
namespace App\Containers\Authentication\Data\Repositories;

use App\Containers\Authentication\Data\Model\UserModel;
use App\Ship\Repositories\AbstractRepository;
use AuthExpressive\Interfaces\DatabaseInterface;
use AuthExpressive\Model\User;

class UserRepository extends AbstractRepository implements DatabaseInterface
{

    protected $entity = UserModel::class;

    public function retrieveById($identifier): array
    {
        $user = $this->getById($identifier);
        return $user === null ? [] : $user->first()->toArray();
    }

    public function retrieveByCredentials(array $credentials): array
    {
        return $this->retrieveById($credentials['username']);
    }

    public function retrieveList(): array
    {
        return $this->getAll();
    }

    public function persist($attributes): bool
    {
        return $this->save($attributes);
    }

    public function save($attributes)
    {
        $user = new User($attributes);
        return parent::save($user->toArray());
    }
}
