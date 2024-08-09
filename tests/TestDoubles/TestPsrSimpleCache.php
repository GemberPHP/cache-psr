<?php

declare(strict_types=1);

namespace Gember\CachePsr\Test\TestDoubles;

use Psr\SimpleCache\CacheInterface;
use DateInterval;

final class TestPsrSimpleCache implements CacheInterface
{
    /**
     * @var array<string, array{mixed, int|DateInterval|null}>
     */
    public array $data = [];

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->data[$key][0] ?? null;
    }

    public function set(string $key, mixed $value, DateInterval|int|null $ttl = null): bool
    {
        $this->data[$key] = [$value, $ttl];

        return true;
    }

    public function delete(string $key): bool
    {
        // n/a
        return true;
    }

    public function clear(): bool
    {
        // n/a
        return true;
    }

    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        // n/a
        return [];
    }

    /**
     * @param iterable<mixed> $values
     */
    public function setMultiple(iterable $values, DateInterval|int|null $ttl = null): bool
    {
        // n/a
        return true;
    }

    public function deleteMultiple(iterable $keys): bool
    {
        // n/a
        return true;
    }

    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }
}
