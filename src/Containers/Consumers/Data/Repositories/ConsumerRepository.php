<?php
namespace App\Containers\Consumers\Data\Repositories;

use App\Containers\Consumers\Data\Model\Consumers;
use App\Ship\Cache\Cache;
use App\Ship\Repositories\AbstractRepository;

class ConsumerRepository extends AbstractRepository
{
    /**
     * @var Cache
     */
    private $cache;

    protected $entity = Consumers::class;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function getById($id)
    {
        if ($this->cache->has($id)) {
            return $this->cache->get($id);
        }

        $consumer = parent::getById($id);

        if (null === $consumer) {
            return $consumer;
        }

        $this->cache->set($id, $consumer);
        return $consumer;
    }
}
