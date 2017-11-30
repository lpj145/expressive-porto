<?php
namespace App\Containers\Authentication\Data\Cache;

use AuthExpressive\Interfaces\StorageInterface;
use Predis\Client;

class UserCache implements StorageInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get($key, $default = null)
    {
        return $this->client->get($key);
    }

    public function set($key, $value, $ttl = null)
    {
        return $this->client->set($key, $value);
    }

    public function delete($key)
    {
        return $this->client->del($key);
    }

    public function has($key)
    {
        return $this->client->exists($key);
    }

    public function clear(){}
    public function getMultiple($keys, $default = null){}
    public function setMultiple($values, $ttl = null){}
    public function deleteMultiple($keys){}
}
