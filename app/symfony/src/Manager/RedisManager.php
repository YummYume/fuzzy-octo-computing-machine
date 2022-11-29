<?php

namespace App\Manager;

use Symfony\Component\Config\Definition\Exception\InvalidTypeException;

final class RedisManager {
    private ?\Redis $redis = null;

    public function __construct(string $redisHost, string $redisPort, string $redisAuth)
    {
        $port = intval($redisPort);

        if (0 === $port) {
            throw new InvalidTypeException(sprintf('Expected argument $redisPort to be convertible to int, but got "%s".', $port));
        }

        $this->redis = new \Redis();
        $this->redis->connect($redisHost, $port);
        $this->redis->auth($redisAuth);
    }

    public function getRedisInstance(): \Redis
    {
        return $this->redis;
    }
}
