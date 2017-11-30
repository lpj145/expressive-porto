<?php
namespace App\Ship\Cache;

use Predis\Client;

class Cache
{
    const DEFAULT_TTL = 3600;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var array
     */
    private $cacheConfig;

    public function __construct(Client $client, array $cacheConfig)
    {
        $this->client = $client;
        $this->cacheConfig = $cacheConfig;
    }

    public function set($key, $value)
    {
        return $this->client->setex($key, $this->cacheConfig['ttl'] ?? self::DEFAULT_TTL, $value);
    }

    public function get($key)
    {
        return $this->client->get($key);
    }

    public function has($key) : bool
    {
        return (bool)$this->client->exists($key);
    }
}
